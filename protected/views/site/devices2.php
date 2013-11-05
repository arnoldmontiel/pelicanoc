<div class="container" id="screenDevices">
	<div class="row">
    	<div class="col-md-12">
    		<h1 class="pageTitle">Dispositivos Conectados</h1>
    	</div> <!-- /col-md-12 -->
   	</div> <!-- /row -->
	<div class="row">		
		<input type="hidden" id="hidden-unit" value="0">
		<input type="hidden" id="hidden-first-scan-working" value="0">
    	<div id="devices" class="col-md-3">    		    		
    		<?php
    			$this->renderPartial('_devicesUnit',array('modelCurrentESs'=>$modelCurrentESs));
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

setInterval(function() {
	getDevices();
	getFirstScan();
}, 5000);	

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