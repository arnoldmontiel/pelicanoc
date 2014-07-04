    	<script>
$(function() {
    $(".dial").knob({
        'bgColor' : "rgba(255,255,255,0.3)",
        'inputColor' : "white",
        'font' : "GudeaBold",
        'fgColor' : "white",
        'draw' : function () { 
        	$(this.i).val(this.cv + '%')
         }
    });
});
</script>
    	
    	<div class="row">
    	<div class="col-sm-7"><h2 class="sliderTitle modified"><?php echo $data->description?></h2>
			<ul class="nav nav-pills">
  				 <!-- <li class="active"><a data-toggle="tab" href="#">Todas</a></li> -->
  			</ul>
    	</div>    	
		</div>
	<div id="flexsliderMarket" class="flexslider carousel">
		<ul class="slides superScroll">
		    <?php
    			foreach($data->nzbs as $nzb)
    			{
					$modelSource = $nzb;
					if(!isset($modelSource->myMovieDiscNzb)) continue;
					$myMovie = $modelSource->myMovieDiscNzb->myMovieNzb;
					$modelTMDB =  $modelSource->TMDBData;
					$moviePoster = $myMovie->poster;
					if(isset($modelTMDB)&&$modelTMDB->poster!="")
					{
						$moviePoster = $modelTMDB->poster;
					}
						
    				echo CHtml::openTag("li",array("class"=>"liSlider"));
					echo CHtml::link(
    				
    				CHtml::image(PelicanoHelper::getImageName($moviePoster),'',array(
    								"width"=>"180", "height"=>"260", "border"=>"0",
    								)),
    				
    				'',array("class"=>"peliAfiche peliDesc aficheClickNzb","idMovie"=>$myMovie->Id,
    								"idResource"=>$modelSource->Id,
    								"sourceType"=>1,'onclick'=>'openMovieShowDetail('.$nzb->Id.')'));
					echo CHtml::openTag("div",array("id"=>$modelSource->Id, "class"=>"peliTitulo"));
					echo CHtml::openTag("p",array("class"=>PelicanoHelper::setAnimationClass($myMovie->original_title)));
					
					$shortTitle = $myMovie->original_title;
					$shortTitle = (strlen($shortTitle) > 26) ? substr($shortTitle,0,23).'...' : $shortTitle;
						
					echo $shortTitle;
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
  function openMovieShowDetail(id, sourceType, idResource)
  {
  	var param = 'id='+id+'&sourcetype='+sourceType+'&idNzb='+idResource; 
  	$.ajax({
  		type: 'POST',
  		url: "<?php echo SiteController::createUrl('AjaxMarketShowDetail')?>",
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
  <?php if(isset($fromAjax) && $fromAjax):?>
	      $('#flexsliderMarket').flexslider({
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
	      $('#flexsliderMarket').flexslider({
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
  


