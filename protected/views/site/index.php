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
	  hasFitWidth = true;
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
    	        var filter = filters[prop][ index ].key;
    	             
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

	iso.on('layoutComplete', function(isoInstance, laidOutItems){
		hasFitWidth = false;
	  	if(laidOutItems.length > idealCols)
		 	hasFitWidth = true;
		  
	  	isoInstance.options.masonry.isFitWidth = hasFitWidth;
  });
  
	// layout Isotope again after all images have loaded
	imagesLoaded( container, function() {
		iso.layout();
	});

	$('.pushMenuGroup').on( 'click', 'a', function() {
		setFilters(this);
	    iso.arrange();
	    updateFilterSummary();
	    
	  });

	$('#main-search').change(function()
	{
		setTextFilter(this);
		iso.arrange();
    	updateFilterSummary();		
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