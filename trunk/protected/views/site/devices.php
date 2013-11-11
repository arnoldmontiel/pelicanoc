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
						var alreadyExists = obj.modelFinishESDataArray[index].alreadyExists;
						var isUnknown = obj.modelFinishESDataArray[index].isUnknown;
						var name = obj.modelFinishESDataArray[index].name;
						var status = obj.modelFinishESDataArray[index].status;
						var copy = obj.modelFinishESDataArray[index].copy;
						var tr = $('#wizardDispositivos').find('#idTr_' + id);
												
						if(tr.length > 0)
						{			
							var tdName = tr.find('#idTdName_' + id);
							if(tdName.length > 0)
							{
								tdName.html(name);
							}
											
							var tdStatus = tr.find('#idTdStatus_' + id);
							if(tdStatus.length > 0)
							{								
								if(status == 7)
								{
									if(alreadyExists == 1)
										tdStatus.html("<i class='fa fa-warning'></i> El archivo ya existe en la biblioteca");
									else
										tdStatus.html("<i class='fa fa-smile-o'></i> Disponible");
								}
								else
									tdStatus.html("<i class='fa fa-check'></i> Importado");

								if(copy == 1 obj.inProcess == 1)
								{
									tdStatus.html("<i class='fa fa-spinner fa-spin'></i> Importando...");
								}
									
							}
							var tdButton = tr.find('#idTdButton_' + id);
							if(tdButton.length > 0)
							{
								if(status == 7)
								{
									if(alreadyExists == 1)
										tdButton.html("<button type='button' alreadyexists="+alreadyExists+" onclick='copyVideo("+id+")' class='btn btn-primary'>Sobreescribir</button>");
									else
										tdButton.html("<button type='button' alreadyexists="+alreadyExists+" onclick='copyVideo("+id+")' class='btn btn-primary'>Importar</button>");
								}
								else
									tdButton.html("<button type='button' onclick='playVideo("+id+")' class='btn btn-primary'>Ver</button>");

								if(copy == 1 && obj.inProcess == 1)
								{
									tdButton.children().text('Cancelar');
									tdButton.children().removeClass('btn-primary');
									tdButton.children().addClass('btn-danger');				
									tdButton.children().attr('onclick','cancelCopy('+id+')');
								}
							}
							var tdAsoc = tr.find('#idTdAsoc_' + id);
							if(tdAsoc.length > 0)
							{
								if(status == 7)								
									tdAsoc.children().removeAttr('disabled');
							}
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
							var tdStatus = $('#wizardDispositivos').find('#idTdStatus_' + id);
							if(tdStatus.length > 0)
							{
								tdStatus.html("<i class='fa fa-check'></i> Importado");								
							}
							var tdButton = $('#wizardDispositivos').find('#idTdButton_' + id);
							if(tdButton.length > 0)
							{
								tdButton.children().removeClass('btn-danger');
								tdButton.children().addClass('btn-primary');
								tdButton.children().text('Ver');
								tdButton.children().attr('onclick','playVideo('+id+')');	
							}
							var tdAsoc = $('#wizardDispositivos').find('#idTdAsoc_' + id);
							if(tdAsoc.length > 0)
							{
								tdAsoc.children().attr('disabled','disabled');
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
				if(data != 0)
				{	
					var tdButton = $('#wizardDispositivos').find('#idTdButton_' + id);
					if(tdButton.length > 0)
					{	
						var alreadyexists = tdButton.children().attr('alreadyexists');
						if(alreadyexists == 0)
							tdButton.children().text('Importar');
						else
							tdButton.children().text('Sobreescribir');

						tdButton.children().removeClass('btn-danger');
						tdButton.children().addClass('btn-primary');
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
			var tdStatus = $('#wizardDispositivos').find('#idTdStatus_' + id);
			if(tdStatus.length > 0)
			{				
				tdStatus.html("<i class='fa fa-spinner fa-spin'></i> Importando...");				
			}
			var tdButton = $('#wizardDispositivos').find('#idTdButton_' + id);						
			if(tdButton.length > 0)
			{	
				tdButton.children().text('Cancelar');
				tdButton.children().removeClass('btn-primary');
				tdButton.children().addClass('btn-danger');				
				tdButton.children().attr('onclick','cancelCopy('+id+')');				
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
//		$('#open-movie-list').removeAttr('disabled');
//   	$('#open-movie-list i').removeClass();
//		$('#open-movie-list i').addClass('fa fa-link');
	}
 	).error(function(){
//		$('#open-movie-list').removeAttr('disabled');
//		$('#open-movie-list i').removeClass();
//		$('#open-movie-list i').addClass('fa fa-link');
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