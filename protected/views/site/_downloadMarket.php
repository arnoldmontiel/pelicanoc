	<div class="row">
    	
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
			    $orderNzb = array();
			    $jobs = $sABnzbdStatus->jobs;
			    foreach ($jobs as $job)
			    {
			    	foreach ($nzbDownloading as $key => $nzb)
			    	{
			    		if($job['nzb_id']==$nzb->Id)
			    		{
			    			$orderNzb[]=$nzb;
			    			unset($nzbDownloading[$key]);
			    		}
			    	}
			    		
			    }
			    if(!empty($orderNzb))
			    {
			    	$nzbDownloading =$orderNzb;
			    }
		    
		    	$first =true;
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
    				
    				CHtml::image(PelicanoHelper::getImageName($moviePoster),'',array(
    								"width"=>"180", "height"=>"260", "border"=>"0",
    								)),
    				
    				'',array("class"=>"peliAfiche peliDesc aficheClickNzb","idMovie"=>$myMovie->Id,
    								"idResource"=>$modelSource->Id,
    								"sourceType"=>1,'onclick'=>'showDownloading('.$nzb->Id.')'));    			
    					

    				//knob 
    				$hide='style="display:none"';
					
    				echo '<div class="knob" id="knob_'.$nzb->Id.'" '.(!$first?$hide:'').'><input id="'.$nzb->Id.'" type="text" value="0" data-width="90" data-readOnly="true" data-thickness=".3" data-displayInput="true" class="dial"></div>';
    				echo '<div class="frente" '.(!$first?$hide:'').'><div>DESCARGANDO</div></div>';
    				//preparando
    				echo '<div class="preparando" id="preparing_'.$nzb->Id.'" '.$hide.'><i class="fa fa-cog fa-spin"></i><br/>PREPARANDO</div>';
    				//error
    				echo '<div class="fallo" id="error_'.$nzb->Id.'" '.$hide.'><div class="label label-danger"><i class="fa fa-exclamation-circle fa-lg"></i><br/> ERROR EN LA DESCARGA</div><button class="btn btn-primary btn-xs" id="restart_'.$nzb->Id.'" onclick="retrytDownload('.$nzb->Id.')"><i class="fa fa-refresh fa-lg"></i> Reintentar</button></div>';
    				//en cola
    				echo '<div class="frente" id="queued_'.$nzb->Id.'" '.($first?$hide:'').'><div>EN COLA</div><button class="btn btn-primary btn-xs" onclick="downloadFirst('.$nzb->Id.',this)"><i class="fa fa-chevron-circle-left"></i> Descargar Primero</button></div>';
    				
    				echo CHtml::closeTag("li");		
    				if($first)
    				{
    					$first= false;
    				}
    				
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
    			/*'''''''''''''''''''''''''EJEMPLOO'''''''''''''''''''''''''
    			echo CHtml::openTag("li",array("class"=>"liSlider"));
    			echo CHtml::link(
    					 
    					CHtml::image("images/6bc6839c-0a99-4c81-afdf-08b7eb0a4643.jpg",'',array(
    							"width"=>"180", "height"=>"260", "border"=>"0",
    					)),
    					 
    					'',array("class"=>"peliAfiche peliDesc aficheClickNzb","idMovie"=>"testmymovie",
    							"idResource"=>"1",
    							"sourceType"=>1,'onclick'=>'showDownloading(this)'));
    			echo '<div class="knob"><input id="'.$nzb->Id.'" type="text" value="0%" data-width="90" data-readOnly="true" data-thickness=".3" data-displayInput="true" class="dial"></div>';
    			echo '<div class="frente"><div>EN COLA</div><button class="btn btn-primary btn-xs"><i class="fa fa-chevron-circle-left"></i> Descargar Primero</button></div>';
    			echo CHtml::closeTag("li");*/
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
    			echo '<div class="fallo"><div class="label label-danger"><i class="fa fa-exclamation-circle fa-lg"></i><br/> ERROR EN LA DESCARGA</div><button class="btn btn-primary btn-xs"><i class="fa fa-refresh fa-lg"></i> Reintentar</button></div>';
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


