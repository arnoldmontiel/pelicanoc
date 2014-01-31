	<div class="row">
    	<div class="col-md-12">
			<h2 class="sliderTitle modified">Finalizadas recientemente</h2> 
			<ul class="nav nav-pills">			
  				<li <?php echo ($filter=="pill-filter-all")?'class="active"':'';?>><a id="pill-filter-all" data-toggle="tab" href="#">Todas</a></li>
  				<li <?php echo ($filter=="pill-filter-market")?'class="active"':'';?>><a id="pill-filter-market" href="#" data-toggle="tab">Marketplace</a></li>
  				<li <?php echo ($filter=="pill-filter-usb")?'class="active"':'';?>><a id="pill-filter-usb" href="#" data-toggle="tab">USB</a></li>
  				<li <?php echo ($filter=="pill-filter-disco")?'class="active"':'';?>><a id="pill-filter-disco" href="#" data-toggle="tab">Disco</a></li>
  			</ul>
		</div>
    </div>
<?php if(!empty($movies)):?>
    
	<div id="flexsliderFinished" class="flexslider carousel">
		<ul class="slides superScroll">
		    <?php
    			foreach($movies as $movie)
    			{
					if($movie->source_type == 1)
					{
						$modelSource = Nzb::model()->findByPk($movie->Id);
						$myMovie = $modelSource->myMovieDiscNzb->myMovieNzb;
					}
					else if($movie->source_type == 2)
					{
						$modelSource = RippedMovie::model()->findByPk($movie->Id);
						$myMovie = $modelSource->myMovieDisc->myMovie;
					}
					else
					{
						$modelSource = LocalFolder::model()->findByPk($movie->Id);
						$myMovie = $modelSource->myMovieDisc->myMovie;
					}
					$modelTMDB =  $modelSource->TMDBData;
					$moviePoster = $myMovie->poster;
					if(isset($modelTMDB)&&$modelTMDB->poster!="")
					{
						$moviePoster = $modelTMDB->poster;
					}
						
    				echo CHtml::openTag("li",array("class"=>"liSlider"));
    				echo CHtml::link(
    				
    				CHtml::image("images/".$moviePoster,'',array(
    								"width"=>"180", "height"=>"260", "border"=>"0",
    								)),
    				
    				'',array("class"=>"peliAfiche aficheClickFinished","idMovie"=>$myMovie->Id,
    								"idResource"=>$movie->Id,
    								"sourceType"=>$movie->source_type));
    					
     					echo CHtml::openTag("div",array("id"=>$movie->Id, "class"=>"peliTitulo"));
     						echo CHtml::openTag("p",array("class"=>PelicanoHelper::setAnimationClass($myMovie->original_title)));
     							echo $myMovie->original_title;
     						echo CHtml::closeTag("p");
     					echo CHtml::closeTag("div");
    					
    echo '<div class="ribbon"><div class="ribbonTxt">FINALIZADA</div></div>';		

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
  			$('#flexsliderFinished').flexslider({
  		      animation: 'slide',
  		      animationLoop: false,
  		      itemWidth: 180,
  		      itemMargin: 5,
  				slideshow: false,
  				touch: true,
  		      start: function(slider){
  		        $('body').removeClass('loading');
  		      }
  		    });
  		    
    	$("#pill-filter-market").click(function()
    	{
		});
    });
  </script>

<?php 
// $this->beginWidget('bootstrap.widgets.TbModal', array('id' => 'myModal')); 

// echo CHtml::openTag('div',array('id'=>'myModal'));
// //place holder
// echo CHtml::closeTag('div'); 

// $this->endWidget(); ?>
