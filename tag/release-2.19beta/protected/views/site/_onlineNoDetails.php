 <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true"> <i class="fa fa-times-circle fa-lg"></i></button>
      <h3 id="myModalLabel">Disco no Reconocido</h3>
    </div>
     <div class="modal-body"> 
	    <div class="row">
		    <div class="col-md-3 pagination-centered">
		   		<img class="aficheDetail" src="img/discIn.jpg" width="100%" height="100%" border="0">
		    </div><!--/.col-md-3PRINCIPAL -->
	    
    
			<div class="col-md-9">			    
			    	<p>La informaci&oacute;n del disco no est&aacute; disponible</p>
		    </div><!--/.col-md-9PRINCIPAL -->
		    
		</div><!--/.rowPRINCIPAL -->
    </div>
    
     <div class="modal-footer">
    	<button id="btn-eject" class="btn btn-primary btn-large"><i class="fa fa-eject fa-lg"></i></button>
         </div><!--/.modal-footer -->
  </div><!--/.modal-content -->
    </div><!--/.modal-dialog -->


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
