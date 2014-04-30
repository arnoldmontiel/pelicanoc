<script type="text/javascript">
docReady( function() {
  var container = document.querySelector('#itemsContainer');

  //variables para calcular columnas por fila de acuerdo al tama–o del viewport
  var count = $("#itemsContainer").children().length;
  var viewport = $( window ).width();
  var sizer = $( '.grid-sizer' ).width()+10;
  var idealCols = parseInt(viewport/sizer);

  //si el total es mayor al ideal, centramos, si no, no hay suficientes items a lo ancho y queda feo, entonces a la izquierda
  //esto se deberia recalcular con los filtros y cambio en el tama–o de la pantalla (capaz es muy complejo)
  if(count>idealCols){
	//en este caso deberiamos armar isotope con el isFitWidth=true
  }else{
		//en este caso con el isFitWidth=false
  }
  var iso = window.iso = new Isotope( container, {
    transitionDuration: '0.8s',
  itemSelector: '.item',
  masonry: {
    columnWidth: '.grid-sizer',
    isFitWidth: true,
    gutter: 10
  },
  
 });
  
	// layout Isotope again after all images have loaded
	 imagesLoaded( container, function() {
  	  iso.layout();
  	});

  var options = document.querySelector('#filters');

  eventie.bind( options, 'click', function( event ) {
    var value = event.target.getAttribute('data-filter');
    iso.options[ 'filter' ] = value;
    iso.arrange();
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
			<div id="filters" class="button-group">
			  <button data-filter="*">show all</button>
			  <button data-filter=".comedy">comedy</button>
			  <button data-filter=".romance">romance</button>
			  <button data-filter=".alkali, .alkaline-earth">alkali & alkaline-earth</button>
			  <button data-filter=":not(.transition)">not transition</button>
			  <button data-filter=".metal:not(.transition)">metal but not transition</button>
			</div>
    
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