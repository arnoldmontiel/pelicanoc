<script type="text/javascript">

docReady( function() {
  var container = document.querySelector('#itemsContainer');

  //variables para calcular columnas por fila de acuerdo al tama�o del viewport
  var count = $("#itemsContainer").children().length;
  var viewport = $( window ).width();
  var sizer = $( '.grid-sizer' ).width()+10;
  var idealCols = parseInt(viewport/sizer);
  
  var hasFitWidth = false;
  //si el total es mayor al ideal, centramos, si no, no hay suficientes items a lo ancho y queda feo, entonces a la izquierda
  //esto se deberia recalcular con los filtros y cambio en el tama�o de la pantalla (capaz es muy complejo)
  if(count>idealCols){
	//en este caso deberiamos armar isotope con el isFitWidth=true
	  hasFitWidth = true
  }
  
  var iso = window.iso = new Isotope( container, {
    transitionDuration: '0.8s',
  itemSelector: '.item',
  masonry: {
    columnWidth: '.grid-sizer',
    isFitWidth: hasFitWidth,
    gutter: 10
  },
  filter: function() {
      var isMatched = true;
      var $this = $(this);      

      for ( var prop in filters ) 
      {          
    	  if(filters[prop].length > 0)
        	  isMatched = false;
    	  
    	  for ( var index = 0; index < filters[prop].length; index++ ) {
    	        var filter = filters[prop][ index ];
    	             
    	        // test each filter
    	        if ( filter ) {
    	          //isMatched = isMatched || $(this).is( filter );
    	          isMatched = isMatched || $(this).is('[class*="'+filter+'"]')
    	        }

    	      }   
	      
    	// break if not matched
          if ( !isMatched && filters[prop].length > 0) {
            break;
          }
      }     
      return isMatched;
    }
  
 });
  
	// layout Isotope again after all images have loaded
	 imagesLoaded( container, function() {
  	  iso.layout();
  	});

  $('.pushMenuGroup').on( 'click', 'a', function() {
	    var $this = $(this);
	    var key = $this.parent().attr('data-filter-group');
	    if(key != 'header')
	    {
		    if($this.hasClass('pushMenuActive'))
		    	filters[key].push($this.attr('data-filter'));
		    else
		    	filters[key].splice( filters[key].indexOf( $this.attr('data-filter') ), 1 );
		    
	    }
	    else
	    {
		    if($this.attr('data-filter') != "*")
		    {
		    	filters[key] = [];
	    		filters[key].push($this.attr('data-filter'));
		    }
		    else
	    		clearFilters();
	    }
	    
	    iso.arrange();
	    
	  });

  $('#main-search').change(function(){
 		
	  	var $this = $(this);
	    var key = $this.parent().attr('data-filter-group');
	    
	    filters[key] = [];
	    
	    var value = 'flr-' + $this.val().toLowerCase().trim().replace(/ /gi,'-');
	    
	    if(value.lenght != 0)
	    {
			filters[key].push(value);
	    	iso.arrange();
	    }
	});
	
  
});


function openMovieShowDetail(id, sourceType, idResource)
{
	var param = 'id='+id+'&sourcetype='+sourceType+'&idresource='+idResource; 
	$.ajax({
		type: 'POST',
		url: "<?php echo SiteController::createUrl('AjaxMovieShowDetail')?>",
		data: param,
	}).success(function(data)
	{	
		$('#myModal').html(data);	
		$('#myModal').modal({
			show: true
		})		
	});
	return false;	
}
</script>

<div class="container" id="screenHome" >
	<div class="row">
    	<div class="col-md-12">
			<div id="itemsContainer" role="main">
				<div class="grid-sizer"></div>
					<?php 
						foreach($dataProvider->getData() as $data) 
						{
							echo $this->renderPartial('_view',array('data'=>$data)); 
						}
					?>	
			</div>
		</div> <!-- /col-md-12 -->
	</div><!-- /row -->
</div><!-- /container -->