<div class="container" id="screenInit" >
    	 <div class="wrapper clearfix">
    	 <div class="row">
    	 <div class="col-md-2"></div>
    	 <div class="col-md-8 col-sm-12">
    	 <div class="initText">
    	 Ingrese el Device ID y seleccione como proceder<br/>
    	 <br/>
    	 <?php echo CHtml::activeTextField($model, 'Id_device', array('class'=>'form-control'));?>
    	 </div>
    	     	 <br/><br/>
    	 
    	 <button onclick="setupAutomatic()" class="btn btn-lg btn-default">Configurar Autom&aacute;ticamente</button>
    	 <br/><br/>
    	 <button onclick="setupManual()" class="btn btn-lg btn-default">Configurar Manualmente</button>
    	 
    	 </div>
    	 <div class="col-md-2"></div>
    	 </div>
    	 
    	 </div><!-- /wrapper -->
<script type="text/javascript">
function setupManual()
{
	var value = $("#Setting_Id_device").val();
	if(value.length > 0)
	{
		$.post("<?php echo SiteController::createUrl('AjaxSaveDeviceId'); ?>",
			{
				idDevice:$("#Setting_Id_device").val()
			}
		).success(
			function(data){
				window.location = <?php echo '"'. SiteController::createUrl('Config') . '"'; ?>;
				return false;
			});
		}
	else
	{
		alert("Device ID No puede estar vacio");
	}
	return false;;
}

function setupAutomatic()
{
	var value = $("#Setting_Id_device").val();
	if(value.length > 0)
	{
		$.post("<?php echo SiteController::createUrl('AjaxSaveDeviceId'); ?>",
			{
				idDevice:$("#Setting_Id_device").val()
			}
		).success(
			function(data){
				window.location = <?php echo '"'. SiteController::createUrl('index') . '"'; ?>;
				return false;
			});
	}
	else
	{
		alert("Device ID No puede estar vacio");
	}
	return false;
}
</script>
	
</div><!-- /container -->