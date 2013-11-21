	<div class="row">
    	<div class="col-md-8">
			<h2 class="sliderTitle modified">Descargando desde USB</h2> 
			<ul class="nav nav-pills">
  				<li class="active"><a data-toggle="tab" href="#">Todas</a></li>
  			</ul>
		</div>
    </div>
<?php if(!empty($externalStorageDataCopying)):?>
	<div class="flexslider carousel">
		<ul class="slides superScroll">
		    <?php
    			foreach($externalStorageDataCopying as $externalStorageData)
    			{
					var_dump($externalStorageData->localFolder);
    				if(!isset($externalStorageData->localFolder)) continue;
    				$modelSource = $externalStorageData->localFolder;
					if(!isset($modelSource->myMovieDisc)) continue;
					$myMovie = $modelSource->myMovieDisc->myMovie;
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
    				
    				'',array("class"=>"peliAfiche aficheClickLocalFolder","idMovie"=>$myMovie->Id,
    								"idExternalStorage"=>$externalStorageData->Id,
    								"idResource"=>$modelSource->Id,
    								"sourceType"=>4));    			
    					
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
<?php endif?>
	
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
