 <!--  <div id="myModal" class="modal modalDetail">-->   
 <!--    <div id="myModal" class="modal hide fade noPlaying in" style="display: block;" aria-hidden="false" aria-labelledby="myModalLabel" role="dialog" tabindex="-1">-->
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true"> <i class="icon-remove-sign icon-large"></i></button>
      <h3 id="myModalLabel">Disco no Reconocido</h3>
    </div>
     <div class="modal-body"> 
	    <div class="row-fluid">
		    <div class="span3 pagination-centered">
		   		<img class="aficheDetail" src="img/discIn.jpg" width="100%" height="100%" border="0">
		    </div><!--/.span3PRINCIPAL -->
	    
    
			<div class="span9">			    
			    	<p>La informaci&oacute;n del disco no est&aacute; disponible</p>
		    </div><!--/.span9PRINCIPAL -->
		    
		</div><!--/.rowPRINCIPAL -->
    </div>
    <div class="modal-footer">    	
    	<button id="btn-eject" class="btn btn-primary btn-large"><i class="icon-eject icon-large"></i></button>
    </div>
 <!--</div>-->

  <script>

	$('.close').click(function(){
		$.post("<?php echo SiteController::createUrl('AjaxMarkCurrentDiscRead'); ?>"
		).success(
			function(data){
		});
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
