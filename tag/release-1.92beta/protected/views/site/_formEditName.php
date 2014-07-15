	<div class="modal-dialog">
    	<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"> <i class="fa fa-times-circle fa-lg"></i></button>
				<h4 class="modal-title">Editar Nombre</h4>
			</div>
			<div class="modal-body">
				<form class="form-horizontal" role="form">
  					<div class="form-group">
    					<label for="fieldNombre" class="col-sm-2 control-label">Nombre</label>
    					<div class="col-sm-10">
      						<input type="email" class="form-control" id="fieldName" placeholder="Nombre" value="<?php echo $modelESData->title; ?>">
    					</div>
  					</div>
				</form>
			</div>
			<div class="modal-footer">
        		<button type="button" class="btn btn-default btn-lg" data-dismiss="modal">Cancelar</button>
        		<button type="button" id="btn-save-name" class="btn btn-primary btn-lg" data-dismiss="modal"><i class="fa fa-save "></i> Guardar</button>
      		</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
	
<script type="text/javascript">
$("#btn-save-name").click(function(){
	$.post("<?php echo SiteController::createUrl('AjaxSaveChangedName'); ?>",
			{
				id:<?php echo $modelESData->Id; ?>,
				name:$('#fieldName').val()
			}
		).success(
			function(data){
				if(data != null)
				{						
					$('#myModalEditName').modal('hide');
					var tdName = $('#wizardDispositivos').find('#idTdName_' + <?php echo $modelESData->Id; ?>);
					if(tdName.length > 0)
					{				
						tdName.html($('#fieldName').val());				
					}
				}							
		});
});
</script>