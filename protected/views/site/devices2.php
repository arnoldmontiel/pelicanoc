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
				else
				{
					$('#wizardDispositivos').html("<p>La unidad se esta escaneando...</p>");
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
							if(isUnknown == 1)
							{
								$('#unknownTable').append(tr);
							}
						}						
					}
				}
				
				if(obj.finishScan == 1)
					$('#hidden-second-scan-working').val(0);
		});	
	}
}

setInterval(function() {
	getDevices();
	getFirstScan();
	getSecondScan();
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