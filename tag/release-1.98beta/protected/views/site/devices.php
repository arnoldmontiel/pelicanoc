

<div class="container" id="screenDevices">
	<div class="row pageTitleContainer">
    	<div class="col-md-12">
   	 		<h1 class="pageTitle">Dispositivos Conectados</h1>
    	</div> <!-- /col-md-12 -->
    </div> <!-- /row -->
	<div class="row">		
	<div  class="col-md-12">
		<input type="hidden" id="hidden-unit" value="<?php echo $idSelected; ?>">
		<input type="hidden" id="hidden-first-scan-working" value="0">
		<input type="hidden" id="hidden-second-scan-working" value="0">
		<input type="hidden" id="hidden-process-working" value="0">
    	<!-- <div class="devicesSelector" id="devices"> -->    		    		
    		<?php
    			//$this->renderPartial('_devicesUnit',array('modelCurrentESs'=>$modelCurrentESs, 'idSelected'=>$idSelected));
			?>        		      		
    	<!-- </div> -->
    <!-- Single button 
<div class="btn-group">
  <button type="button" class="btn btn-lg btn-default dropdown-toggle" data-toggle="dropdown">
    USB 1 Pablito <span class="caret"></span>
  </button>
  <ul class="dropdown-menu" role="menu">
    <li><a href="#">USB 1</a></li>
    <li><a href="#">USB 2</a></li>
    <li><a href="#">USB 3</a></li>
    <li><a href="#">USB 4</a></li>
  </ul>
</div>-->
    	<!-- ACA VAN LOS PASOS ! --><!-- /col-md-9 -->
    	<div id="wizardDispositivos">
    	</div> 
    
    </div> <!-- /col-md-12 -->
	</div> <!-- /row -->
</div> <!-- /container -->
<script>
function changeDevice(id)
{
	var params = "&idSelected="+id;
	window.location = "<?php echo SiteController::createUrl("GoToDevices")?>" + params; 
	return false;
}

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
						var isUnknown = obj.modelFinishESDataArray[index].isUnknown;
						var name = obj.modelFinishESDataArray[index].name;
						var tr = $('#wizardDispositivos').find('#idTr_' + id);
												
						if(tr.length > 0)
						{			
							var tdName = tr.find('#idTdName_' + id);
							if(tdName.length > 0)
								tdName.html(name);

							updateTds(obj.modelFinishESDataArray[index]);							
							
							if(isUnknown == 1)
							{
								tr.attr('unknown','1');
								$('#unknownTable').append(tr);
							}
						}						
					}
				}

				if(obj.inProcess == 1)
				{
					$('#hidden-process-working').val(1);
				}
				
				if(obj.finishScan == 1)
				{
					$('#scaningLabel').hide();
					$('#NoScaningLabel').show();					
					$('#hidden-second-scan-working').val(0);
					$('#copy-all-known').removeAttr('disabled');
					$('#copy-all-personal').removeAttr('disabled');
					$('#copy-all-unknown').removeAttr('disabled');
				}
		});	
	}
}

function updateTds(obj)
{
	if(obj != null)
	{
		var id = obj.id;
		var tdStatus = $('#wizardDispositivos').find('#idTdStatus_' + id);
		if(tdStatus.length > 0)
			tdStatus.html(getTdStatus(obj));
	
		var tdButton = $('#wizardDispositivos').find('#idTdButton_' + id);
		if(tdButton.length > 0)
			tdButton.html(getTdButton(obj));
		
		var btnAsoc = $('#wizardDispositivos').find('#idBtnAsoc_' + id);
		if(btnAsoc.length > 0)
			getBtnAsoc(obj, btnAsoc);
	}
}

function getBtnAsoc(obj, btn)
{
	btn.attr('disabled','disabled');
	if(obj != null)
	{
		if(obj.status != 6 && obj.status != 1) //si no esta escaneando puedo saber el estado
		{
			if(obj.copy == 1)
			{
				btn.attr('disabled','disabled');
			}
			else 
			{
				btn.removeAttr('disabled');
			}
		}			
	}
}

function getTdButton(obj)
{
	var td = "<button type='button' class='btn btn-primary' disabled='disabled'>Analizando...</button>";
	if(obj != null)
	{
		if(obj.status != 6 && obj.status != 1) //si no esta escaneando puedo saber el estado
		{
			if(obj.copy == 1)
			{
				if(obj.status == 3) //ya esta copiado listo para ver
					td = "<button type='button' onclick='playVideo("+obj.id+")' class='btn btn-primary'><i class='fa fa-play fa-fw'></i> Ver Pel&iacute;cula</button>";
				else
					td = "<button type='button' onclick='cancelCopy("+obj.id+")' class='btn btn-danger'><i class='fa fa-minus-circle fa-fw'></i> Cancelar</button>";
			}
			else 
			{
				if(obj.status == 4) //en el caso de error en el copiado
				{
					td = "<button type='button' alreadyexists="+obj.alreadyExists+" onclick='copyVideo("+obj.id+")' class='btn btn-default'><i class='fa fa-refresh fa-fw'></i> Reintentar</button>";
				}
				else
				{
					if(obj.alreadyExists == 1)
						td = "<button type='button' alreadyexists="+obj.alreadyExists+" onclick='copyVideo("+obj.id+")' class='btn btn-primary'>Sobreescribir</button>";
					else
						td = "<button type='button' alreadyexists="+obj.alreadyExists+" onclick='copyVideo("+obj.id+")' class='btn btn-primary'><i class='fa fa-download fa-fw'></i> Importar</button>";
				}
			}
		}			
	}

	return td;
}

function getTdStatus(obj)
{
	var td = "<i class='fa fa-spinner fa-spin'></i> Analizando...";
	if(obj != null)
	{
		if(obj.status != 6 && obj.status != 1) //si no esta escaneando puedo saber el estado
		{
			if(obj.copy == 1)
			{
				if(obj.status == 3) //ya esta copiado listo para ver
					td = "<i class='fa fa-check  fa-fw '></i> Importado";
				else	
					td = "<i class='fa fa-spinner fa-spin  fa-fw'></i> Importando...";
			}
			else 
			{
				if(obj.status == 4) //en el caso de error en el copiado
				{
					td = "<i class='fa fa-ban fa-fw'></i> Error al copiar";
				}
				else
				{
					if(obj.alreadyExists == 1)
						td = "<i class='fa fa-exclamation  fa-fw'></i> El archivo ya existe";
					else
						td = "<i class='fa fa-circle-o  fa-fw'></i> Disponible";
				}
			}
		}			
	}

	return td;
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
					if(obj != null)
					{			
						if(obj.currentESIn == 1)
						{
							if(obj.modelFinishCopyESDataArray != null)
							{
								for(var index = 0; index < obj.modelFinishCopyESDataArray.length; index++)
								{
									updateTds(obj.modelFinishCopyESDataArray[index]);
								}
							}
							if(obj.finishCopy == 1)
							{
								$('#hidden-process-working').val(0);
							}
						}
						else
						{
							$('#hidden-process-working').val(0);
							$('#wizardDispositivos').html('');
						}
					}
			});
	}
}

function copyAll(idTable)
{
	var id = $('#hidden-unit').val();
	$.post("<?php echo SiteController::createUrl('AjaxProcessAllExternalStorage'); ?>",
			{
				id:id,
				idTable:idTable
			}
		).success(
			function(data){
				var obj = jQuery.parseJSON(data);				
				if(obj.onCopyModels != null)
				{
					for(var index = 0; index < obj.onCopyModels.length; index++)
					{
						updateTds(obj.onCopyModels[index]);
					}
					$('#hidden-process-working').val(1);
				}
		});
}

function playVideo(id)
{
	$.post("<?php echo SiteController::createUrl('AjaxGetPlayES'); ?>",
			{
				id:id			    
			}
		).success(
			function(data){
				if(data != null)
				{	
					var obj = jQuery.parseJSON(data);
					if(obj.playArray != null)
					{						
						var params = '&id='+obj.playArray.id+'&sourceType='+obj.playArray.sourceType+'&idResource='+obj.playArray.idResource;
						window.location = <?php echo '"'. SiteController::createUrl('site/start') .'"'; ?> + params;    
						return false;
					}
				}							
		});
		
}

function cancelCopy(id)
{	
	$.post("<?php echo SiteController::createUrl('AjaxCancelCopy'); ?>",
		{
				id:id			    
		}
		).success(
			function(data){
				var obj = jQuery.parseJSON(data);
				if(obj.canceledModel != null)
				{	
					updateTds(obj.canceledModel);
				}							
	});
	
	
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
			var obj = jQuery.parseJSON(data);
			if(obj.processModel != null)
			{
				updateTds(obj.processModel);
			}
	});
}

function changeName(id){	
	$.post("<?php echo SiteController::createUrl('AjaxOpenChangeName'); ?>",
			{
				id:id			    
			}
		).success(
			function(data){
				if(data != null)
				{	
					$('#myModalEditName').html(data);
					$('#myModalEditName').modal('show');
				}							
		});
		
}

function changeAsoc(id)
{
	$.ajax({
   		type: 'POST',
   		url: "<?php echo SiteController::createUrl('AjaxFillExternalStorageMovieList'); ?>",
   		data: {id_external_storage_data:id},
 	}).success(function(data)
 	{	
		$('#myModalEditarAsoc').html(data);
		$('#myModalEditarAsoc').modal('show');										
	}
 	).error(function(){
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
		$.post("<?php echo SiteController::createUrl('AjaxExploreExternalStorage'); ?>",
				{
					id:id			    
				}
			).success(
				function(data){						
					var obj = jQuery.parseJSON(data);					
					if(obj.workingFirstScan == 1)
					{
						if(obj.msg != null)
							$('#wizardDispositivos').html(obj.msg);
						
						$('#hidden-first-scan-working').val(1);
					}
					else
					{
						$.post("<?php echo SiteController::createUrl('AjaxHardScanES'); ?>",
								{
									id:id
								}
							).success(
								function(data){	
									$('#wizardDispositivos').html(data);	
							});
					}
					
			});
	}
}

$('.usb-button-scan').unbind('click');
$('.usb-button-scan').click(function(){
	var id = $(this).attr("id");
	$(this).parent().find('.usb-button-scan').removeClass('active');
	$(this).addClass('active');
	$('#hidden-unit').val(id);
	$.post("<?php echo SiteController::createUrl('AjaxExploreExternalStorage'); ?>",
			{
				id:id			    
			}
		).success(
			function(data){	
				var obj = jQuery.parseJSON(data);					
				if(obj.workingFirstScan == 1)
				{
					if(obj.msg != null)
						$('#wizardDispositivos').html(obj.msg);
					
					$('#hidden-first-scan-working').val(1);
				}
				else
				{
					$.post("<?php echo SiteController::createUrl('AjaxHardScanES'); ?>",
							{
								id:id
							}
						).success(
							function(data){	
								$('#wizardDispositivos').html(data);
						});
				}									
		});
			
	return false;
});

  </script>