<div class="container" id="screenMarketplace" >
   <div class="row">
    <div class="col-md-12">

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
	<div class="row">
    	<div class="col-md-8">
			<h2 class="sliderTitle modified">Pel&iacute;culas</h2> 
			<ul class="nav nav-pills">
  				<li class="active"><a data-toggle="tab" href="#">Estrenos</a></li>
  				<li><a href="#" data-toggle="tab">M&aacute;s Vistas</a></li>
  				<li><a href="#" data-toggle="tab">&Uacute;ltimas Agregadas</a></li>
			</ul>
		</div>
    	<div class="col-md-4">  
    		<div class="botonTodas">
    			<a class="btn" ><i class="icon-th"></i> Todas las Pel&iacute;culas</a>
    		</div>
		</div>
    </div>

	<div class="flexslider carousel">
		<ul class="slides superScroll">
		    <?php
    			foreach($dataProvider->getData() as $data)
    			{
    				$modelMyMovieNzb = $data->myMovieDiscNzb->myMovieNzb;
    				echo CHtml::openTag('li');
    				echo CHtml::link(
    				
    				CHtml::image("images/".$modelMyMovieNzb->poster,'',array("class"=>"peliAfiche aficheClick",
    								"width"=>"162", "height"=>"215", "border"=>"0",
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
		</ul>
	</div>
<!-- /content -->

<!-- Le javascript
    ================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
  <script type="text/javascript">
    $(window).load(function(){
      $('.flexslider').flexslider({
        animation: "slide",
        animationLoop: false,
        itemWidth: 165,
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

    </div> <!-- /col-md-12 -->
  </div><!-- /row -->
</div><!-- /container -->
