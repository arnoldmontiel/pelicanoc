<script type="text/javascript">

docReady( function() {

	
  var container = document.querySelector('#itemsContainer');

  //variables para calcular columnas por fila de acuerdo al tama�o del viewport
  var count = $("#itemsContainer").children().length-1;
  var viewport = $( window ).width();
  var sizer = $( '.grid-sizer' ).width()+10;
  var idealCols = parseInt(viewport/sizer);
  
  var hasFitWidth = true;
  //si el total es menos al ideal vamos a tocar a mano el width para que no quede centrado.
  //decidimos no hacerlo por que los filtros taparian las pelis. pero queda por las dudas comentado.
  //if(count<idealCols){
  //hasFitWidth = false;
  //$("#itemsContainer").css("width", "300px");
  //}


  
  var iso = window.iso = new Isotope( container, {
    transitionDuration: '0.8s',
  itemSelector: '.item',
  masonry: {
	isFitWidth: hasFitWidth,
    columnWidth: '.grid-sizer',
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

    	        if(prop == 'header' && filter == "*") //cuando filtra por todos
    	        	isMatched = true;
    	        else
    	        {
	    	        // test each filter
	    	        if ( filter ) {
	    	          isMatched = isMatched || $(this).is('[class*="'+filter+'"]')
	    	        }
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
//or with vanilla JS
//initialize Isotope
imagesLoaded( container, function() {
		iso.layout();	
	});
  
 	iso.on('layoutComplete', function(isoInstance, laidOutItems){
//  	  	if(laidOutItems.length > idealCols)
//  	  	$('#itemsContainer').addClass('centrado');

//  	  	if(laidOutItems.length < idealCols)
//  	  	$('#itemsContainer').removeClass('centrado');
 	});

 	function startFilter()
 	{
 		iso.arrange();	
 	    updateFilterSummary();    
 	}

	$('.pushMenuGroup').on( 'click', 'a', function() {
		if ($(this).hasClass('pushMenuRadio')){
			  $('.pushSelectable .pushMenuSuperGroup a.pushMenuRadio').removeClass( "pushMenuActive" );
		}
		else
		{
			$( this ).toggleClass( "pushMenuClicked" );
		}
		$(this).toggleClass( "pushMenuActive");
		setMenuFilters(this);
		return false;		
	  });

	$( ".pushSelectable .btnAplicar" ).click(function() {		
		setTimeout(startFilter, 50);
		return false;
	});
	
	$( ".pushSelectable .btnLimpiar" ).click(function() {
		clearFilters();
		iso.arrange();
		updateFilterSummary();
	});

	$( ".pushSelectable .pushMenuGroupTitle" ).click(function() {
		clearFilterByKey(this);
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
	var param = 'id='+id+'&sourcetype='+sourceType+'&idNzb='+idResource; 
	$.ajax({
		type: 'POST',
		url: "<?php echo SiteController::createUrl('AjaxMarketShowDetail')?>",
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
<div class="container needsclick" id="screenMarketplace" >
    	 <div class="wrapper clearfix needsclick">
			<div id="itemsContainer" role="main" class="clearfix centrado needsclick">
				<div class="grid-sizer needsclick"></div>
					<?php 
						foreach($dataProvider->getData() as $data) 
						{					
							echo $this->renderPartial('_viewMarketplace',array('data'=>$data)); 
						}
					?>	
			</div>
		</div><!-- /wrapper -->
</div><!-- /container -->