<div class="container" id="screenDevices">
	<div class="row pageTitleContainer">
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
						var isUnknown = obj.modelFinishESDataArray[index].isUnknown;
						var name = obj.modelFinishESDataArray[index].name;
						var tr = $('#wizardDispositivos').find('#idTr_' + id);
												
						if(tr.length > 0)
						{			
							var tdName = tr.find('#idTdName_' + id);
							if(tdName.length > 0)
								tdName.html(name);
											
							var tdStatus = tr.find('#idTdStatus_' + id);
							if(tdStatus.length > 0)
								tdStatus.html(getTdStatus(obj.modelFinishESDataArray[index]));
							
							var tdButton = tr.find('#idTdButton_' + id);
							if(tdButton.length > 0)
								tdButton.html(getTdButton(obj.modelFinishESDataArray[index]));								
							
							var tdAsoc = tr.find('#idTdAsoc_' + id);
							if(tdAsoc.length > 0)
								getTdAsoc(obj.modelFinishESDataArray[index], tdAsoc);
							
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

function getTdAsoc(obj, td)
{
	td.children().attr('disabled','disabled');
	if(obj != null)
	{
		if(obj.status != 6 && obj.status != 1) //si no esta escaneando puedo saber el estado
		{
			if(obj.copy == 1)
			{
				td.children().attr('disabled','disabled');
			}
			else 
			{
				td.children().removeAttr('disabled');
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
					td = "<button type='button' onclick='playVideo("+obj.id+")' class='btn btn-primary'>Ver</button>";
				else
					td = "<button type='button' onclick='cancelCopy("+obj.id+")' class='btn btn-danger'>Cancelar</button>";
			}
			else 
			{
				if(obj.alreadyExists == 1)
					td = "<button type='button' alreadyexists="+obj.alreadyExists+" onclick='copyVideo("+obj.id+")' class='btn btn-primary'>Sobreescribir</button>";
				else
					td = "<button type='button' alreadyexists="+obj.alreadyExists+" onclick='copyVideo("+obj.id+")' class='btn btn-primary'>Importar</button>";
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
					td = "<i class='fa fa-check'></i> Importado";
				else
					td = "<i class='fa fa-spinner fa-spin'></i> Importando...";
			}
			else 
			{
				if(obj.alreadyExists == 1)
					td = "<i class='fa fa-warning'></i> El archivo ya existe en la biblioteca";
				else
					td = "<i class='fa fa-smile-o'></i> Disponible";
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
					if(obj.modelFinishCopyESDataArray != null)
					{
						for(var index = 0; index < obj.modelFinishCopyESDataArray.length; index++)
						{
							var id = obj.modelFinishCopyESDataArray[index].id;
							
							var tdStatus = $('#wizardDispositivos').find('#idTdStatus_' + id);
							if(tdStatus.length > 0)
								tdStatus.html(getTdStatus(obj.modelFinishCopyESDataArray[index]));								

							var tdButton = $('#wizardDispositivos').find('#idTdButton_' + id);
							if(tdButton.length > 0)
								tdButton.html(getTdButton(obj.modelFinishCopyESDataArray[index]));
							
							var tdAsoc = $('#wizardDispositivos').find('#idTdAsoc_' + id);
							if(tdAsoc.length > 0)
								getTdAsoc(obj.modelFinishCopyESDataArray[index], tdAsoc);
						}
					}
					if(obj.finishCopy == 1)
					{
						$('#hidden-process-working').val(0);
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
						var iddata = obj.onCopyModels[index].id;
						
						var tdStatus = $('#wizardDispositivos').find('#idTdStatus_' + iddata);
				        if(tdStatus.length > 0)
							tdStatus.html(getTdStatus(obj.onCopyModels[index]));
										
				        var tdButton = $('#wizardDispositivos').find('#idTdButton_' + iddata);						
						if(tdButton.length > 0)
							tdButton.html(getTdButton(obj.onCopyModels[index]));
							
						var tdAsoc = $('#wizardDispositivos').find('#idTdAsoc_' + iddata);
						if(tdAsoc.length > 0)
							getTdAsoc(obj.onCopyModels[index], tdAsoc);
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
					var tdStatus = $('#wizardDispositivos').find('#idTdStatus_' + id);
			        if(tdStatus.length > 0)
						tdStatus.html(getTdStatus(obj.canceledModel));
									
			        var tdButton = $('#wizardDispositivos').find('#idTdButton_' + id);						
					if(tdButton.length > 0)
						tdButton.html(getTdButton(obj.canceledModel));

					var tdAsoc = $('#wizardDispositivos').find('#idTdAsoc_' + id);						
					if(tdAsoc.length > 0)
						getTdAsoc(obj.canceledModel, tdAsoc);
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
				var tdStatus = $('#wizardDispositivos').find('#idTdStatus_' + id);
		        if(tdStatus.length > 0)
					tdStatus.html(getTdStatus(obj.processModel));
								
		        var tdButton = $('#wizardDispositivos').find('#idTdButton_' + id);						
				if(tdButton.length > 0)
					tdButton.html(getTdButton(obj.processModel));

				var tdAsoc = $('#wizardDispositivos').find('#idTdAsoc_' + id);						
				if(tdAsoc.length > 0)
					getTdAsoc(obj.processModel, tdAsoc);
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