    	<div class="row">
    	<div class="col-sm-7"><h2 class="sliderTitle modified"><?php echo $data->description?></h2>
			<ul class="nav nav-pills">
  				 <!-- <li class="active"><a data-toggle="tab" href="#">Todas</a></li> -->
  			</ul>
    	</div>    	
		</div>
		<div class="row rowBackground">
    <div class="col-md-12">
	<div id="flexsliderMarket_<?php echo $data->Id?>" class="flexslider carousel">
		<ul class="slides superScroll">
		    <?php
    			foreach($data->nzbs as $nzb)
    			{
    				if($nzb->ready==0  || $nzb->deleted==1)	continue;
					$modelSource = $nzb;
					if(!isset($modelSource->myMovieDiscNzb)) continue;
					$myMovie = $modelSource->myMovieDiscNzb->myMovieNzb;
					$modelTMDB =  $modelSource->TMDBData;
					$moviePoster = $myMovie->poster;
					if(isset($modelTMDB)&&$modelTMDB->poster!="")
					{
						$moviePoster = $modelTMDB->poster;
					}
					$shortTitle = $myMovie->original_title;
					$shortTitle = (strlen($shortTitle) > 26) ? substr($shortTitle,0,23).'...' : $shortTitle;											
					?>
					<li class="liSlider">
						<a class=" aficheClickNzb needsclick" idmovie="<?php echo $myMovie->Id;?>" idresource="<?php echo $modelSource->Id?>" sourcetype="1" onclick="openMovieShowDetail('<?php echo $myMovie->Id?>',1,<?php echo $nzb->Id?>)">
						<img width="180" height="260" class="peliAfiche" border="0" src="<?php echo PelicanoHelper::getImageName($moviePoster)?>" alt="" draggable="false"></a>
						<div id="<?php echo $modelSource->Id?>" class="peliTitulo needsclick">
						<span class="<?php echo PelicanoHelper::setAnimationClass($myMovie->original_title)?>"><?php echo $shortTitle;?></span>							
						<div class="ribMisPeliculas needsclick downloaded_<?php echo $nzb->Id; ?>" id="downloaded_<?php echo $nzb->Id; ?>" <?php echo ($nzb->downloaded)?'':'style="display:none;"';?>><i class="fa fa-check-circle"></i></div>
						<div class="ribDescargando needsclick downloading_<?php echo $nzb->Id; ?>" id="downloading_<?php echo $nzb->Id; ?>" <?php echo ($nzb->downloading)?'':'style="display:none;"';?>><i class="fa fa-spinner fa-spin fa-sm" ></i> <i class="fa fa-download" ></i></div>						
						
						</div>
					</li>
					<?php
//     				echo CHtml::openTag("li",array("class"=>"liSlider"));					
// 					echo CHtml::link(    				
//     					CHtml::image(PelicanoHelper::getImageName($moviePoster),'',array(
//     								"width"=>"180", "height"=>"260", "class"=>"peliAfiche", "border"=>"0",
//     								)),    				
// 							//clases antes peliDesc
//     					'',array("class"=>" aficheClickNzb needsclick","idMovie"=>$myMovie->Id,
//     								"idResource"=>$modelSource->Id,
//     								"sourceType"=>1,'onclick'=>'openMovieShowDetail("'.$myMovie->Id.'",1,'.$nzb->Id.')')
//     				);
					
// 					echo CHtml::openTag("div",array("id"=>$modelSource->Id, "class"=>"peliTitulo needsclick"));
// 						echo CHtml::openTag("span",array("class"=>PelicanoHelper::setAnimationClass($myMovie->original_title)));					
// 						$shortTitle = $myMovie->original_title;
// 						$shortTitle = (strlen($shortTitle) > 26) ? substr($shortTitle,0,23).'...' : $shortTitle;							
// 						echo $shortTitle;
// 						echo CHtml::closeTag("span");
// 						?>
<!-- <div class="ribMisPeliculas needsclick downloaded_<?php echo $nzb->Id; ?>" id="downloaded_<?php echo $nzb->Id; ?>" <?php echo ($nzb->downloaded)?'':'style="display:none;"';?>><i class="fa fa-check-circle"></i></div>
							<div class="ribDescargando needsclick downloading_<?php echo $nzb->Id; ?>" id="downloading_<?php echo $nzb->Id; ?>" <?php echo ($nzb->downloading)?'':'style="display:none;"';?>><i class="fa fa-spinner fa-spin fa-sm" ></i> <i class="fa fa-download" ></i></div>
-->													
						<?php 
// 					echo CHtml::closeTag("div");    				
//     				echo CHtml::closeTag("li");		    				
    			}

    			
    		?>        	
		</ul>
	</div>
</div></div>
	
<!-- /content -->

<!-- Le javascript
    ================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
  <script type="text/javascript">
	  $(window).load(function(){
	      $('#flexsliderMarket_<?php echo $data->Id?>').flexslider({
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
  


