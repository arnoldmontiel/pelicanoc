<nav class="navbar navbar-default navbar-fixed-top" role="navigation" id="menuSecond">
		<div class="container-fluid">
			<div class="nav navbar-nav navbar-left">
		    <!-- Comentado para Pelicano Lite #####
		    	<ul id="filtroGenero" class="nav nav-pills hidden-xs hidden-sm">
					<li class="generoItem active"><a href="#" data-filter="*">Pel&iacute;culas</a></li>
					<li class="generoItem"><a href="#" data-filter=".comedy">Series</a></li>
				</ul>
				 -->
			</div>
			<div class="nav navbar-nav navbar-left">
				<button class="toggle-menu menu-left btn btn-primary navbar-btn" id="toggleMarketplace">
					<i class="fa fa-filter fa-fw"></i> Filtro
				</button>
			</div>
				<div class="filterDesc pull-left">Todas las Peliculas</div>
			<form class="navbar-form navbar-right" role="search">
				<div class="searchMain form-group marketplace">
					<input id="main-search" type="text" class="form-control form-search" placeholder=" Buscar Pel&iacute;cula">
				</div>
			</form>
		</div>
	</nav>
<div class="container" id="screenMarketplace" >

<?php 
Yii::app()->clientScript->registerScript(__CLASS__.'#marketPlace_view', "
	$('.aficheClick').click(function(){
		var target = $(this).attr('href');
		var id = $(this).attr('idMovie');
		var idNzb = $(this).attr('idResource');
		var param = 'id='+id + '&idNzb=' + idNzb; 
		$.ajax({
	   		type: 'POST',
	   		url: '". SiteController::createUrl('AjaxMarketShowDetail') . "',
	   		data: param,
	 	}).success(function(data)
	 	{
	 	
			$('#myModal').html(data);
			
		}
	 	);	
		
});

");

?>
	<!--<div class="row">
    	<div class="col-md-9">
 <h2 class="sliderTitle">Pel&iacute;culas</h2> 
    					<ul class="nav nav-pills">
  				<li class="active"><a data-toggle="tab" href="#">Todas</a></li>
  				<li><a data-toggle="tab" href="#">Estrenos</a></li>
  				<li><a href="#" data-toggle="tab">M&aacute;s Vistas</a></li>
  				<li><a href="#" data-toggle="tab">&Uacute;ltimas Agregadas</a></li>
			</ul> 
		</div>
    	    <div class="col-md-3">  
    	    
    	    
    	    
    	    <div class="botonTodas"><a href="control.php" class="btn btn-primary btn-lg">Series <i class="fa fa-arrow-right"></i> </a></div>
		</div>
    </div>-->
    <div class="row">
    <div class="col-sm-12">
    <?php

$this->widget('ext.isotope.Isotope',array(
    'dataProvider'=>$dataProvider,
    'itemView'=>'_viewMarketplace',
    'itemSelectorClass'=>'item',
	'summaryText' =>"",
	'onClickLocation'=>SiteController::createUrl('AjaxMarketShowDetail'),
	'onClickLocationParam'=>array('id','idresource','sourcetype'),
    'options'=>array(), // options for the isotope jquery
    'infiniteScroll'=>true, // default to true
    'infiniteOptions'=>array(), // javascript options for infinite scroller
    'id'=>'wall',
));
?>
	</div>
    </div>
</div><!-- /container -->
    
<!-- Le javascript
    ================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
  <script type="text/javascript">
  </script>

