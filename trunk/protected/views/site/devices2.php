<div class="container" id="screenDevices">
	<div class="row">
    	<div class="col-md-12">
    		<h1 class="pageTitle">Dispositivos Conectados</h1>
    	</div> <!-- /col-md-12 -->
   	</div> <!-- /row -->
	<div class="row">		
		<input type="hidden" id="hidden-unit" value="<?php echo $idSelected; ?>">
		<input type="hidden" id="hidden-first-scan-working" value="0">
		<input type="hidden" id="hidden-second-scan-working" value="0">
		<input type="hidden" id="hidden-process-working" value="0">
    	<div id="devices" class="col-md-3">    		    		
    		<?php
    			$this->renderPartial('_devicesUnit',array('modelCurrentESs'=>$modelCurrentESs, 'idSelected'=>$idSelected));
			?>        		      		
    	</div> <!-- /col-md-3 -->
    
    	<!-- ACA VAN LOS PASOS ! --><!-- /col-md-9 -->
    	<div class="col-md-9" id="wizardDispositivos">
    	</div> 
    
	</div> <!-- /row -->
</div> <!-- /container -->

<div id="myModalEditarNombre" class="modal fade in">
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
      						<input type="email" class="form-control" id="fieldNombre" placeholder="Nombre" value="Cumple Daniela 2013">
    					</div>
  					</div>
				</form>
			</div>
			<div class="modal-footer">
        		<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        		<button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-save "></i> Guardar</button>
      		</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script>
function getDevices()
{	
	var id = $('#hidden-unit').val();
	$.post("<?php echo SiteController::createUrl('AjaxGetDevices'); ?>",
		{
			id:id			    
		}
	).success(
		function(data){
			$('#devices').html(data);
	});	
}

function getFirstScan()
{
	
	var working = $('#hidden-first-scan-working').val();	
	if(working == "1")
	{		
		$.post("<?php echo SiteController::createUrl('AjaxGetFirstScan'); ?>",
				{
					id:$('#hidden-unit').val()			    
				}
		).success(
			function(data){
				if(data != 0)
				{
					$('#wizardDispositivos').html(data);
					$('#hidden-first-scan-working').val(0);
				}
		});	
	}
}

function getSecondScan()
{
	var working = $('#hidden-second-scan-working').val();
	if(working == "1")
	{		
		$.post("<?php echo SiteController::createUrl('AjaxGetSecondScan'); ?>",
				{
					id:$('#hidden-unit').val()			    
				}
		).success(
			function(data){

				var obj = jQuery.parseJSON(data);				
				if(obj.modelFinishESDataArray != null)
				{
					for(var index = 0; index < obj.modelFinishESDataArray.length; index++)
					{
						var id = obj.modelFinishESDataArray[index].id;
						var alreadyExists = obj.modelFinishESDataArray[index].alreadyExists;
						var isUnknown = obj.modelFinishESDataArray[index].isUnknown;
						
						var tr = $('#wizardDispositivos').find('#idTr_' + id);						
						if(tr.length > 0)
						{							
							var tdStatus = tr.find('#idTdStatus_' + id);
							if(tdStatus.length > 0)
							{
								if(alreadyExists == 1)
									tdStatus.html("<i class='fa fa-warning'></i> El archivo ya existe en la biblioteca");
								else
									tdStatus.html("<i class='fa fa-smile-o'></i> Disponible");
							}
							var tdButton = tr.find('#idTdButton_' + id);
							if(tdButton.length > 0)
							{
								if(alreadyExists == 1)
									tdButton.html("<button type='button' alreadyexists="+alreadyExists+" onclick='copyVideo("+id+")' class='btn btn-primary'>Sobreescribir</button>");
								else
									tdButton.html("<button type='button' alreadyexists="+alreadyExists+" onclick='copyVideo("+id+")' class='btn btn-primary'>Importar</button>");
							}
							if(isUnknown == 1)
							{
								$('#unknownTable').append(tr);
							}
						}						
					}
				}
				
				if(obj.finishScan == 1)
				{
					$('#scaningLabel').hide();
					$('#NoScaningLabel').show();					
					$('#hidden-second-scan-working').val(0);
				}
		});	
	}
}

function getProcessStatus()
{
	var working = $('#hidden-process-working').val();
	if(working == "1")
	{
		$.post("<?php echo SiteController::createUrl('AjaxGetProcessStatus'); ?>",
				{
					id:$('#hidden-unit').val()			    
				}
			).success(
				function(data){	
					var obj = jQuery.parseJSON(data);				
					if(obj.modelFinishCopyESDataArray != null)
					{
						for(var index = 0; index < obj.modelFinishCopyESDataArray.length; index++)
						{
							var id = obj.modelFinishCopyESDataArray[index].id;
							var tdStatus = tr.find('#idTdStatus_' + id);
							if(tdStatus.length > 0)
							{
								tdStatus.html("<i class='fa fa-smile-o'></i> Disponible");
							}
							var tdButton = tr.find('#idTdButton_' + id);
							if(tdButton.length > 0)
							{
								tdButton.children().text('Ver');
								tdButton.children().attr('onclick','playVideo('+id+')');	
							}
						}
					}
					if(obj.finishCopy == 1)
					{
						$('#hidden-process-working').val(0);
					}
			});
	}
}

function playVideo(id)
{
	alert('play ' + id);
}

function cancelCopy(id)
{	
	var tdButton = $('#wizardDispositivos').find('#idTdButton_' + id);
	if(tdButton.length > 0)
	{	
		var alreadyexists = tdButton.children().attr('alreadyexists');
		if(alreadyexists == 0)
			tdButton.children().text('Importar');
		else
			tdButton.children().text('Sobreescribir');
		
		tdButton.children().attr('onclick','copyVideo('+id+')');

		tdStatus = $('#wizardDispositivos').find('#idTdStatus_' + id);
		if(tdStatus.length > 0)
		{
			if(alreadyexists == 1)
				tdStatus.html("<i class='fa fa-warning'></i> El archivo ya existe en la biblioteca");
			else
				tdStatus.html("<i class='fa fa-smile-o'></i> Disponible");
		}				
	}
}

function copyVideo(id)
{	
	$.post("<?php echo SiteController::createUrl('AjaxProcessExternalStorage'); ?>",
		{
			id:id			    
		}
	).success(
		function(data){	
			$('#hidden-process-working').val(1);		
			var tdStatus = $('#wizardDispositivos').find('#idTdStatus_' + id);
			if(tdStatus.length > 0)
			{				
				tdStatus.html("<i class='fa fa-spinner fa-spin'></i> Importando...");				
			}
			var tdButton = $('#wizardDispositivos').find('#idTdButton_' + id);						
			if(tdButton.length > 0)
			{	
				tdButton.children().text('Cancelar');
				tdButton.children().attr('onclick','cancelCopy('+id+')');				
			}			
	});
}

setInterval(function() {
	getDevices();
	getFirstScan();
	getSecondScan();
	getProcessStatus();
}, 5000);	

initPage();

function initPage()
{
	var id = $('#hidden-unit').val();
	if(id > 0 )
	{
		$('#hidden-first-scan-working').val(1);		
		$.post("<?php echo SiteController::createUrl('AjaxExploreExternalStorage'); ?>",
				{
					id:id			    
				}
			).success(
				function(data){	
					$('#wizardDispositivos').html(data);							
			});
	}
}

$('.usb-button-scan').unbind('click');
$('.usb-button-scan').click(function(){
	var id = $(this).attr("id");
	$(this).parent().find('.usb-button-scan').removeClass('active');
	$(this).addClass('active');
	$('#hidden-unit').val(id);
	$('#hidden-first-scan-working').val(1);		
	$.post("<?php echo SiteController::createUrl('AjaxExploreExternalStorage'); ?>",
			{
				id:id			    
			}
		).success(
			function(data){	
				$('#wizardDispositivos').html(data);							
		});
			
	return false;
});


  </script>