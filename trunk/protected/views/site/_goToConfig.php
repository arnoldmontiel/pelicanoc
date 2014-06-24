<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true"> <i class="fa fa-times-circle fa-lg"></i></button>
			<h4 class="modal-title">Ingrese clave para configurar</h4>
		</div><!-- /.modal-header -->
		<div class="modal-body">
			<div class="buscarAsociacion">
				<form class="form-horizontal" role="form">
					<div class="row">
						<div class="form-group col-sm-6">
							<label for="fieldSearchName" class="col-sm-3 control-label">Clave</label>
							<div class="col-sm-9">	
								<input id="fieldPassword" type="password" class="form-control" placeholder="Clave">
							</div>
						</div>
					</div>
					<div class="row">
						<div id="wrongPass" class="hidden"><i class="fa fa-info-circle"></i> Clave incorrecta.</div>
					</div>
				</form>
			</div>
		</div><!-- /.modal-body -->
		<div class="modal-footer">
			<button id ="btn-save" onclick="validatePasswd();" type="button" class="btn btn-primary btn-lg pull-right"><i class="fa fa-save "></i> Aceptar</button> 
			<button id="btn-cancel" type="button" class="btn btn-default btn-lg pull-right"" data-dismiss="modal">Cancelar</button> 
			<div id="btn-help-txt" class="helpText"><i class="fa fa-info-circle"></i> Ingrese la clave para acceder a la configuraci&oacute;n.</div>
	    </div><!-- /.modal-footert -->
	</div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
<script>
function validatePasswd()
{
	var pwd = $('#fieldPassword').val();
	if(pwd == 'instalador')
	{
		$('#wrongPass').addClass('hidden');
		window.location = "<?php echo SiteController::createUrl("config")?>"; 
	}
	else
		$('#wrongPass').removeClass('hidden');
	
}
</script>