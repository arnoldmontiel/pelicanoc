 <!--  <div id="myModal" class="modal modalDetail">-->   
   <div id="myModal" class="modal hide fade modalDetail in" style="display: block;" aria-hidden="false" aria-labelledby="myModalLabel" role="dialog" tabindex="-1">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true"> <i class="icon-remove-sign icon-large"></i></button>
      <h3 id="myModalLabel"><?php echo $model->original_title;?></h3>
    </div>
    <div class="modal-body"> 
    <div class="row-fluid">
    <div class="span3 pagination-centered">
    <img class="aficheDetail" src="images/<?php echo $model->big_poster;?>" width="100%" height="100%" border="0">
    </div><!--/.span3PRINCIPAL -->
    
    <div class="span9">
    
    <div class="row-fluid detailMainGroup">
    <div class="span4 pagination-centered detailMain detailMainFirst">
    <?php echo $model->genre;?>
    </div><!--/.span4 -->
    <div class="span4 pagination-centered detailMain">
    <?php echo $model->parentalControl->description;?>
    </div><!--/.span4 -->
    <div class="span4 pagination-centered detailMain">
    <?php    	
    	$image = 'rate'.str_pad($model->rating, 2, "0", STR_PAD_LEFT).'.png';    	
	?>
    <img src="images/<?php echo $image;?>" width="100" height="20" border="0">
    </div><!--/.span4 -->
    </div><!--/.row -->
    
    <div class="row-fluid detailSecondGroup">
    <div class="span3 pagination-left detailSecond detailSecondFirst">
    A&Ntilde;O
    </div><!--/.span4 -->
    <div class="span9 pagination-left detailSecond">
    <?php echo $model->production_year;?>
    </div><!--/.span8 -->
    </div><!--/.row -->
    
    <div class="row-fluid detailSecondGroup">
    <div class="span3 pagination-left detailSecond detailSecondFirst">
    DIRECTOR
    </div><!--/.span4 -->
    <div class="span9 pagination-left detailSecond">
    <?php echo $casting['director'];?>
    </div><!--/.span8 -->
    </div><!--/.row -->
    
    <div class="row-fluid detailSecondGroup">
    <div class="span3 pagination-left detailSecond detailSecondFirst">
    ACTORES
    </div><!--/.span4 -->
    <div class="span9 pagination-left detailSecond">
    <?php echo $casting['actors'];?>
    </div><!--/.span8 -->
    </div><!--/.row -->
    
    <div class="row-fluid detailSecondGroup">
    <div class="span3 pagination-left detailSecond detailSecondFirst">
    DURACI&Oacute;N
    </div><!--/.span4 -->
    <div class="span9 pagination-left detailSecond">
    <?php echo $model->running_time;?>mm
    </div><!--/.span8 -->
    </div><!--/.row -->
    
    <div class="row-fluid detailSecondGroup">
    <div class="span3 pagination-left detailSecond detailSecondFirst">
    SIN&Oacute;PSIS
    </div><!--/.span4 -->
    <div class="span9 pagination-left detailSecond">
   <?php echo $model->description;?>
    </div><!--/.span9 -->
    </div><!--/.row -->
    
    </div><!--/.span9PRINCIPAL -->
    </div><!--/.rowPRINCIPAL -->
    
    
    </div>
    <div class="modal-footer">
    	<?php if(isset($modelCurrentDisc) && $modelCurrentDisc->command <> 2):?>
    		<?php if($modelCurrentDisc->isPlaying()):?>
    			<button id="btn-playing" disabled="disabled" class="btn btn-primary btn-large"><span class="iconFontButton iconPlay"></span> Reproduciendo...</button>
    		<?php else:?>
    			<button id="btn-ripp" class="btn btn-primary btn-large"><span class="iconFontButton iconPlay"></span> Copiar</button>
    			<button id="btn-play" class="btn btn-primary btn-large"><span class="iconFontButton iconPlay"></span> Ver Pel&iacute;cula</button>
    		<?php endif;?>
    	<?php else:?>
    		<button id="btn-ripping" disabled="disabled" class="btn btn-primary btn-large"><span class="iconFontButton iconPlay"></span> Copiando...</button>
    	<?php endif;?>
    	<button id="btn-eject" class="btn btn-primary btn-large"><i class="icon-eject icon-large"></i></button>
    </div>
  </div>

  <script>

  
	$('#btn-play').click(function(){
		$('#btn-play').attr("disabled", "disabled");
		<?php $idResource = "";
		?>	    
		 
		window.location = <?php echo '"'. SiteController::createUrl('site/start',array('id'=>$model->Id,'sourceType'=>4,'idResource'=>$idResource)) . '"'; ?>;    
		return false;
	});

	$('.close').click(function(){
		$.post("<?php echo SiteController::createUrl('AjaxMarkCurrentDiscRead'); ?>"
		).success(
			function(data){
		});
	});
	
	$('#btn-ripp').click(function(){
		$('#btn-ripp').attr("disabled", "disabled"); 
		$.post("<?php echo SiteController::createUrl('AjaxRipp'); ?>"
			).success(
				function(data){
					$('#myModal').modal('hide'); 
		});
		return false;    
	});	

	
	$('#btn-eject').click(function(){
		$('#btn-eject').attr("disabled", "disabled");
		if (confirm("\u00bfSeguro desea expulsar el disco?"))
		{
			$.post("<?php echo SiteController::createUrl('AjaxEject'); ?>"
			).success(
				function(data){
					$('#myModal').modal('hide'); 
			});
		}
		else
		{
			$('#btn-eject').removeAttr("disabled");
		}
		
		return false;    
	});
	</script>
