<div class="container" id="screenInit" >
    	 <div class="wrapper clearfix">
    	 <div class="row">
    	 <div class="col-md-2"></div>
    	 <div class="col-md-8 col-sm-12">
    	 <div class="initText">
    	 Ingrese el Device ID y seleccione como proceder<br/>
    	 <br/>
    	 <?php echo CHtml::activeTextField($model, 'Id_device', array('class'=>'form-control formDeviceId'));?>
    	 </div>
    	     	 <br/><br/>
    	 
    	 <button onclick="setupAutomatic(this)" class="btn btn-lg btn-default">
    	 
    	 Configurar Autom&aacute;ticamente
    	 </button>
    	 <br/><br/>
    	 <button onclick="setupManual(this)" class="btn btn-lg btn-default">
    	 
    	 Configurar Manualmente
    	 </button>    	 
    	 </div>
    	 <div class="col-md-2"></div>
    	 </div>
    	 
    	 </div><!-- /wrapper -->
<script type="text/javascript">
function setupManual(object)
{
	var value = $("#Setting_Id_device").val();
	if(value.length > 0)
	{
		$("button").attr("disabled","disabled");
		$("#Setting_Id_device").attr("disabled","disabled");
		$(object).html('<i class="fa fa-spinner fa-spin"></i> Configurando...');		
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

function setupAutomatic(object)
{
	var value = $("#Setting_Id_device").val();
	if(value.length > 0)
	{
		$("button").attr("disabled","disabled");
		$("#Setting_Id_device").attr("disabled","disabled");
		$(object).html('<i class="fa fa-spinner fa-spin"></i> Configurando...');

		$.post("<?php echo SiteController::createUrl('AjaxValidateDeviceId'); ?>",
				{
					idDevice:$("#Setting_Id_device").val()
				}
			).success(
				function(data){
					if(data != '')
					{
						$(object).html('<i class="fa fa-spinner fa-spin"></i> Iniciando ' + data +' Configuracion...');
						$.post("<?php echo SiteController::createUrl('AjaxSaveDeviceId'); ?>",
							{
								idDevice:value
							}
						).success(
							function(data){
								window.location = <?php echo '"'. SiteController::createUrl('Config') . '"'; ?>;
								return false;
							});
					}
					else
					{
						$(object).html('El Id device no existe. Intente con otro');
						$("button").removeAttr("disabled");
						$("#Setting_Id_device").removeAttr("disabled");
					}	
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