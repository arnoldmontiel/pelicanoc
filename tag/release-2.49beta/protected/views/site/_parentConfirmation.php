<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"
						aria-hidden="true">
						<i class="fa fa-times-circle fa-lg"></i>
					</button>
					<h4 class="modal-title">Ingrese clave para poder ver pelicula clase "R"</h4>
				</div>
				<div class="modal-body">
					<div class="reproTableContainer">
						<input id="confirmation-pwd" type="password" >
					</div>
					<span id="wrong-pwd" class="label label-danger"></span>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default btn-lg" onclick="cancelParentConfirmation();">Cancelar</button>
					<button type="button" class="btn btn-default btn-lg" onclick="doParentConfirmation();">Aceptar</button>
				</div>
			</div>
			<!-- /.modal-content -->
		</div>
<script>
function doParentConfirmation()
{
	$.post("<?php echo SiteController::createUrl('AjaxCheckParentConfirmation'); ?>",
			{
				pwd:$("#confirmation-pwd").val()
			}
	).success(
		function(data){
			if(data == 1)
				doPlay();
			else
				$("#wrong-pwd").text("Clave incorrecta");
		});
	
	return false;
}			
function cancelParentConfirmation()
{
	$("#myModalParentConfirmation").modal('hide');
	$("#btn-play").removeAttr("disabled");				
	$("#btn-play").html('<i class="fa fa-play-circle"></i> Ver Pel&iacute;cula');
	$("#myModal").modal('show');
}
</script>
