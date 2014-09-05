	<div class="row">
    	<div class="col-md-12">
			<h2 class="sliderTitle modified">Descargando desde USB</h2>
			<?php if(!empty($externalStorageDataCopying)):?>
			 
			<ul class="nav nav-pills">
  				<!-- <li class="active"><a data-toggle="tab" href="#">Todas</a></li> -->
  			</ul>
			<?php endif?>
  		</div>
    </div>
<?php if(!empty($externalStorageDataCopying)):?>
	<div class="flexslider carousel" id="flexsliderExternal">
		<ul class="slides superScroll">
		    <?php
    			foreach($externalStorageDataCopying as $externalStorageData)
    			{
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
						
    				echo CHtml::openTag("li",array("class"=>"liSlider"));
					echo CHtml::link(
    				
    				CHtml::image("images/".$moviePoster,'',array(
    								"width"=>"180", "height"=>"260", "border"=>"0",
    								)),
    				
    				'',array("class"=>"peliAfiche aficheClickLocalFolder","idMovie"=>$myMovie->Id,
    								"idExternalStorage"=>$externalStorageData->Id,
    								"idResource"=>$modelSource->Id,
    								"sourceType"=>4,"onclick"=>"showLocalFolder(this)"));    			
    					
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
  <?php if(isset($fromAjax) && $fromAjax):?>
  $('#flexsliderExternal').flexslider({
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
  
  <?php else:?>
    $(window).load(function(){
      $('#flexsliderExternal').flexslider({
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
    <?php endif?>    
   </script>
