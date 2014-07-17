	<div class="row">
    	<div class="col-md-12">
			<h2 class="sliderTitle modified">Descargando desde Disco &Oacute;ptico</h2> 
			<?php if(!empty($modelMyMovie)):?>
			<ul class="nav nav-pills">
  				<!-- <li class="active"><a data-toggle="tab" href="#">Todas</a></li> -->
  			</ul>
			<?php endif?>
  		</div>
    </div>
<?php if(!empty($modelMyMovie)):?>
	<div id="flexsliderRipping" class="flexslider carousel">
		<ul class="slides superScroll">
		    <?php
    			foreach($modelMyMovie as $myMovie)
    			{
					$moviePoster = $myMovie->poster;
						
    				echo CHtml::openTag('li');
    				echo CHtml::link(
    				
    				CHtml::image("images/".$moviePoster,'',array(
    								"width"=>"180", "height"=>"260", "border"=>"0",
    								)),
    				
    				'',array("class"=>"peliAfiche aficheClickCurrentDisc","idMovie"=>$myMovie->Id,
    								"sourceType"=>2));    			
    					
//     					echo CHtml::openTag("div",array("id"=>$movie->Id, "class"=>"peliTitulo"));
//     						echo CHtml::openTag("p",array("class"=>PelicanoHelper::setAnimationClass($myMovie->original_title)));
//     							echo $myMovie->original_title;
//     						echo CHtml::closeTag("p");
//     					echo CHtml::closeTag("div");
    					
    					
    				echo CHtml::closeTag("li");
    				
    				
    			}
    		?>        	
		</ul>
	</div>
<?php else:?>
	<div class="row">
    <div class="col-md-12">
			<div class="noSliderResults">NO HAY DESCARGAS EN CURSO</div> 
    	    			</div>
    </div>

<?php endif?>
		
<!-- /content -->

<!-- Le javascript
    ================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
  <script type="text/javascript">
    $(window).load(function(){
      $('#flexsliderRipping').flexslider({
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

