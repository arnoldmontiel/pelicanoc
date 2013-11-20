	<div class="row">
    	<div class="col-md-8">
			<h2 class="sliderTitle modified">Finalizadas recientemente</h2> 
			<ul class="nav nav-pills">
  				<li class="active"><a id="pill-filter-all" data-toggle="tab" href="#">Todas</a></li>
  				<li><a id="pill-filter-market" href="#" data-toggle="tab">Marketplace</a></li>
  				<li><a id="pill-filter-usb" href="#" data-toggle="tab">USB</a></li>
  				<li><a id="pill-filter-disco" href="#" data-toggle="tab">Disco</a></li>
  			</ul>
		</div>
    </div>

	<div class="flexslider carousel">
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
						
    				echo CHtml::openTag('li');
    				echo CHtml::link(
    				
    				CHtml::image("images/".$moviePoster,'',array(
    								"width"=>"162", "height"=>"215", "border"=>"0",
    								)),
    				
    				'',array("class"=>"peliAfiche aficheClickFinished","idMovie"=>$myMovie->Id,
    								"idResource"=>$movie->Id,
    								"sourceType"=>$movie->source_type));
    					
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
<!-- /content -->

<!-- Le javascript
    ================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
  <script type="text/javascript">
  jQuery('.flexslider').flexslider({
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
  
	$(window).load(function(){
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
