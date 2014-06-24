<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true"> <i class="fa fa-times-circle fa-lg"></i></button>
			<h4 class="modal-title">Ingrese clave para configurar</h4>
		</div><!-- /.modal-header -->
		<div class="modal-body">
		<form class="form-horizontal" role="form">
		<div class="form-group">
    <label for="fieldPassword" class="col-sm-2 control-label">Clave</label>
    <div class="col-sm-10">
  <input id="fieldPassword" type="password" class="form-control" placeholder="Clave"></div>
        </div>
		<div class="form-group">
    <label for="nada" class="col-sm-2 control-label"></label>
    <div class="col-sm-10">
        		<div id="wrong-pass" class="red invisible"><i class="fa fa-times-circle"></i> Clave incorrecta. Vuelva a Intentarlo</div>
            </div>
            </div>
        </form>		
		</div><!-- /.modal-body -->
		<div class="modal-footer">
			<button id ="btn-save" onclick="validatePasswd();" type="button" class="btn btn-primary btn-lg pull-right"><i class="fa fa-sign-in"></i> Ingresar</button> 
			<button id="btn-cancel" type="button" class="btn btn-default btn-lg pull-right"" data-dismiss="modal">Cancelar</button> 
	    </div><!-- /.modal-footert -->
	</div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
<script>
function validatePasswd()
{
	var pwd = $('#fieldPassword').val();
	if(pwd == 'instalador')
	{
		$('#wrong-pass').addClass('invisible');
		window.location = "<?php echo SiteController::createUrl("config")?>"; 
	}
	else
		$('#wrong-pass').removeClass('invisible');
	
}
</script>