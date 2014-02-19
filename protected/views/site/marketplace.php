<div class="selectedFiltersWrapper">
<div class="selectedFilters">
<span class="filterStart">FILTROS:</span>
<span class="labelFilter">Comedia</span>
<span class="labelFilter">Drama</span>
<span class="labelFilter">2013</span>
<span class="labelFilter">Estrenos</span>
<span class="filterEnd"><i class="fa fa-times-circle"></i> Reset</span>
</div>
</div>
<nav class="navbar navbar-default navbar-fixed-top" role="navigation"
		id="menuSecond">
		<div class="container-fluid">
			<div class="nav navbar-nav navbar-left">
		    <ul id="filtroGenero" class="nav nav-pills hidden-xs hidden-sm">
					<li class="generoItem active"><a href="#" data-filter="*">Pel&iacute;culas</a></li>
					<li class="generoItem"><a href="#" data-filter=".comedy">Series</a></li>
				</ul>
			</div>
			<div class="nav navbar-nav navbar-right">
				<button
					class="toggle-menu menu-right btn btn-primary navbar-btn"
					id="toggleMarketplace">
					<i class="fa fa-filter fa-fw"></i> Filtro
				</button>
			</div>
			<form class="navbar-form navbar-right" role="search">
				<div class="searchMain form-group marketplace">
					<input id="main-search" type="text"
						class="form-control form-search"
						placeholder=" Buscar Pel&iacute;cula">
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
    <div class="scrollItems clearfix">
    <div class="element">
	<a href="#myModal" data-toggle="modal" class="">    
        <img class="peliAfiche" src="images/63973.jpg" alt="details">    
    </a>			
    <div class="peliTitulo">
		<p class="slide-text26">AC/DC: Live at River Plate</p>    
	</div>    
	</div><!-- element -->
    <div class="element">
	<a href="#myModal" data-toggle="modal" class="">    
        <img class="peliAfiche" src="images/4982.jpg" alt="details">    
    </a>			
    <div class="peliTitulo">
		<p class="slide-text26">AC/DC: Live at River Plate</p>    
	</div>  
	</div><!-- element -->
    <div class="element">
	<a href="#myModal" data-toggle="modal" class="">    
        <img class="peliAfiche" src="images/73611.jpg" alt="details">    
    </a>			
    <div class="peliTitulo">
		<p class="slide-text26">AC/DC: Live at River Plate</p>   
	</div>     
	</div><!-- element -->
    <div class="element">
	<a href="#myModal" data-toggle="modal" class="">    
        <img class="peliAfiche" src="images/39356.jpg" alt="details">    
    </a>			
    <div class="peliTitulo">
		<p class="slide-text26">AC/DC: Live at River Plate</p>   
	</div>     
	</div><!-- element -->
    <div class="element">
	<a href="#myModal" data-toggle="modal" class="">    
        <img class="peliAfiche" src="images/63973.jpg" alt="details">    
    </a>			
    <div class="peliTitulo">
		<p class="slide-text26">AC/DC: Live at River Plate</p>    
	</div>    
	</div><!-- element -->
    <div class="element">
	<a href="#myModal" data-toggle="modal" class="">    
        <img class="peliAfiche" src="images/4982.jpg" alt="details">    
    </a>			
    <div class="peliTitulo">
		<p class="slide-text26">AC/DC: Live at River Plate</p>   
	</div>     
	</div><!-- element -->
    <div class="element">
	<a href="#myModal" data-toggle="modal" class="">    
        <img class="peliAfiche" src="images/73611.jpg" alt="details">    
    </a>			
    <div class="peliTitulo">
		<p class="slide-text26">AC/DC: Live at River Plate</p>    
	</div>    
	</div><!-- element -->
    <div class="element">
	<a href="#myModal" data-toggle="modal" class="">    
        <img class="peliAfiche" src="images/39356.jpg" alt="details">    
    </a>			
    <div class="peliTitulo">
		<p class="slide-text26">AC/DC: Live at River Plate</p>  
	</div>      
	</div><!-- element -->
    <div class="element">
	<a href="#myModal" data-toggle="modal" class="">    
        <img class="peliAfiche" src="images/4982.jpg" alt="details">    
    </a>			
    <div class="peliTitulo">
		<p class="slide-text26">AC/DC: Live at River Plate</p>   
	</div>     
	</div><!-- element -->
    <div class="element">
	<a href="#myModal" data-toggle="modal" class="">    
        <img class="peliAfiche" src="images/73611.jpg" alt="details">    
    </a>			
    <div class="peliTitulo">
		<p class="slide-text26">AC/DC: Live at River Plate</p>    
	</div>    
	</div><!-- element -->
    <div class="element">
	<a href="#myModal" data-toggle="modal" class="">    
        <img class="peliAfiche" src="images/39356.jpg" alt="details">    
    </a>			
    <div class="peliTitulo">
		<p class="slide-text26">AC/DC: Live at River Plate</p>  
	</div>      
	</div><!-- element -->
    <div class="element">
	<a href="#myModal" data-toggle="modal" class="">    
        <img class="peliAfiche" src="images/4982.jpg" alt="details">    
    </a>			
    <div class="peliTitulo">
		<p class="slide-text26">AC/DC: Live at River Plate</p>   
	</div>     
	</div><!-- element -->
    <div class="element">
	<a href="#myModal" data-toggle="modal" class="">    
        <img class="peliAfiche" src="images/73611.jpg" alt="details">    
    </a>			
    <div class="peliTitulo">
		<p class="slide-text26">AC/DC: Live at River Plate</p>    
	</div>    
	</div><!-- element -->
    <div class="element">
	<a href="#myModal" data-toggle="modal" class="">    
        <img class="peliAfiche" src="images/39356.jpg" alt="details">    
    </a>			
    <div class="peliTitulo">
		<p class="slide-text26">AC/DC: Live at River Plate</p>  
	</div>      
	</div><!-- element -->
	</div><!-- scrollItems -->
</div>
    </div>

	<!-- <div class="flexslider carousel">
		<ul class="slides superScroll"> -->
		    <?php 
    			foreach($dataProvider->getData() as $data)
    			{
    				$modelMyMovieNzb = $data->myMovieDiscNzb->myMovieNzb;
    				echo CHtml::openTag('li');
    				echo CHtml::link(
    				
    				CHtml::image("images/".$modelMyMovieNzb->poster,'',array("class"=>"peliAfiche aficheClick",
    								"width"=>"180", "height"=>"260", "border"=>"0",
    								"idMovie"=>$modelMyMovieNzb->Id,
    								"idResource"=>$data->Id)),
    				
    				'',array("style"=>"position:relative", "data-toggle"=>"modal", "href"=>"#myModal"));
    					
    					echo CHtml::openTag("div",array("id"=>$data->Id, "class"=>"peliTitulo"));
    						echo CHtml::openTag("p",array("class"=>PelicanoHelper::setAnimationClass($modelMyMovieNzb->original_title)));
    							echo $modelMyMovieNzb->original_title;
    						echo CHtml::closeTag("p");
    					echo CHtml::closeTag("div");
    					
    					
    				echo CHtml::closeTag("li");
    				
    			}
    		?>        	
<!--		</ul>
	</div>  -->
<!-- /content -->

<!-- Le javascript
    ================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
  <script type="text/javascript">
    $(window).load(function(){
      $('.flexslider').flexslider({
        animation: "slide",
        animationLoop: false,
        itemWidth: 180,
        itemMargin: 5,
		slideshow: false,
		touch: true,
        start: function(slider){
          $('body').removeClass('loading');
        }
      });
    });
  </script>

<?php 
// $this->beginWidget('bootstrap.widgets.TbModal', array('id' => 'myModal')); 

// echo CHtml::openTag('div',array('id'=>'myModal'));
// //place holder
// echo CHtml::closeTag('div'); 

// $this->endWidget(); ?>

</div><!-- /container -->
