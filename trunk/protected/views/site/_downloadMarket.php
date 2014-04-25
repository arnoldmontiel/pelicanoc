	<div class="row">
    	
    	<script>
$(function() {
    $(".dial").knob({
        'bgColor' : "rgba(255,255,255,0.3)",
        'inputColor' : "white",
        'font' : "GudeaBold",
        'fgColor' : "white"
    });
});
</script>
    	<div class="col-md-12">
			<h2 class="sliderTitle modified">Descargando desde Marketplace</h2> 
			<?php if(!empty($nzbDownloading)):?>
			<ul class="nav nav-pills">
  				 <!-- <li class="active"><a data-toggle="tab" href="#">Todas</a></li> -->
  			</ul>
			<?php endif?>
  		</div>
    </div>
<?php if(!empty($nzbDownloading)):?>
    
	<div id="flexsliderMarket" class="flexslider carousel">
		<ul class="slides superScroll">
		    <?php
    			foreach($nzbDownloading as $nzb)
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
    				
    				CHtml::image("images/".$moviePoster,'',array(
    								"width"=>"180", "height"=>"260", "border"=>"0",
    								)),
    				
    				'',array("class"=>"peliAfiche peliDesc aficheClickNzb","idMovie"=>$myMovie->Id,
    								"idResource"=>$modelSource->Id,
    								"sourceType"=>1,'onclick'=>'showDownloading(this)'));    			
    					
//     					echo CHtml::openTag("div",array("id"=>$movie->Id, "class"=>"peliTitulo"));
//     						echo CHtml::openTag("p",array("class"=>PelicanoHelper::setAnimationClass($myMovie->original_title)));
//     							echo $myMovie->original_title;
//     						echo CHtml::closeTag("p");
//     					echo CHtml::closeTag("div");

    				echo '<div class="knob"><input id="'.$nzb->Id.'" type="text" value="0" data-width="90" data-readOnly="true" data-thickness=".3" data-displayInput="true" class="dial"></div>';
    				echo CHtml::closeTag("li");		
    				
    			}

    			/*'''''''''''''''''''''''''EJEMPLOO'''''''''''''''''''''''''
    			 echo CHtml::openTag("li",array("class"=>"liSlider"));
    			echo CHtml::link(
    					 
    					CHtml::image("images/6bc6839c-0a99-4c81-afdf-08b7eb0a4643.jpg",'',array(
    							"width"=>"180", "height"=>"260", "border"=>"0",
    					)),
    					 
    					'',array("class"=>"peliAfiche peliDesc aficheClickNzb","idMovie"=>$myMovie->Id,
    							"idResource"=>$modelSource->Id,
    							"sourceType"=>1,'onclick'=>'showDownloading(this)'));
    			echo '<div class="preparando"><i class="fa fa-cog fa-spin"></i><br/>PREPARANDO</div>';
    			echo CHtml::closeTag("li");*/
    			/*'''''''''''''''''''''''''FIN EJEMPLO'''''''''''''''''''''''''*/
    			/*'''''''''''''''''''''''''EJEMPLOO'''''''''''''''''''''''''*/
    			echo CHtml::openTag("li",array("class"=>"liSlider"));
    			echo CHtml::link(
    					 
    					CHtml::image("images/6bc6839c-0a99-4c81-afdf-08b7eb0a4643.jpg",'',array(
    							"width"=>"180", "height"=>"260", "border"=>"0",
    					)),
    					 
    					'',array("class"=>"peliAfiche peliDesc aficheClickNzb","idMovie"=>"testmymovie",
    							"idResource"=>"1",
    							"sourceType"=>1,'onclick'=>'showDownloading(this)'));
    			echo '<div class="frente"><div>EN COLA</div><button class="btn btn-primary"><i class="fa fa-chevron-circle-left"></i> Mandar al Frente</button></div>';
    			echo CHtml::closeTag("li");
    			/*'''''''''''''''''''''''''FIN EJEMPLO'''''''''''''''''''''''''*/
    			
    			/*'''''''''''''''''''''''''EJEMPLOO'''''''''''''''''''''''''
    			echo CHtml::openTag("li",array("class"=>"liSlider"));
    			echo CHtml::link(
    					 
    					CHtml::image("images/6bc6839c-0a99-4c81-afdf-08b7eb0a4643.jpg",'',array(
    							"width"=>"180", "height"=>"260", "border"=>"0",
    					)),
    					 
    					'',array("class"=>"peliAfiche peliDesc aficheClickNzb","idMovie"=>$myMovie->Id,
    							"idResource"=>$modelSource->Id,
    							"sourceType"=>1,'onclick'=>'showDownloading(this)'));
    			echo '<div class="fallo"><div class="label label-danger"><i class="fa fa-exclamation-circle fa-lg"></i><br/> ERROR EN LA DESCARGA</div><button class="btn btn-primary"><i class="fa fa-refresh fa-lg"></i> Reintentar</button></div>';
    			echo CHtml::closeTag("li");*/
    			/*'''''''''''''''''''''''''FIN EJEMPLO'''''''''''''''''''''''''*/
    			
    			
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
    function showDownloading(object)
    {
		var id = $(object).attr('idMovie');
		var idNzb = $(object).attr('idResource');
		var param = 'id='+id + '&idNzb=' + idNzb; 
		$.ajax({
	   		type: 'POST',
	   		url: '<?php echo SiteController::createUrl('AjaxMarketShowDetail') ?> ',
	   		data: param,
	 	}).success(function(data)
	 	{
	 	
			$('#myModal').html(data);
			$('#myModal').modal('show');
			
		}
	 	);	
    
    }
  </script>


