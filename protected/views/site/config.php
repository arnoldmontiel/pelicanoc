<div class="container" id="screenConfig" >
    	 <div class="wrapper clearfix">
    	 <div class="row">
    	 <div class="col-md-2"></div>
    	 <div class="col-md-8 col-sm-12">
    	 <div  class="configForm">
		    <form id="general-config-form"  role="form">
  				<div class="inlineForm">
  					<label class="inlineFormLabel">Servidor Multimedia</label>
  					<div class="row">
	  					<div class="form-group col-sm-6 ">
	    					<label>Servidor Multimedia IP</label>
	      					<?php echo CHtml::activeTextField($model, 'host_file_server', array('class'=>'form-control', 'onkeyup'=>'changeSaveLabel();'));?>
	      				</div>
	  					<div class="form-group col-sm-6">
	    					<label>Servidor Multimedia Path Archivos</label>
	      					<?php echo CHtml::activeTextField($model, 'host_file_server_path', array('class'=>'form-control', 'onkeyup'=>'changeSaveLabel();'));?>
	      				</div>
  					</div>  					
  					<div class="row">
						<div class="form-group col-sm-6">
	    					<label>Servidor Multimedia Usuario</label>
	    					<?php echo CHtml::activeTextField($model, 'host_file_server_user', array('class'=>'form-control', 'onkeyup'=>'changeSaveLabel();'));?>
						</div>
	  					<div class="form-group col-sm-6 ">
	    					<label>Servidor Multimedia Password</label>
	    					<?php echo CHtml::activeTextField($model, 'host_file_server_passwd', array('class'=>'form-control', 'onkeyup'=>'changeSaveLabel();'));?>
						</div>
  					</div>
  					<div class="row">
						<div class="form-group col-sm-6">
	    					<label>Servidor Multimedia Nombre</label>
	    					<?php echo CHtml::activeTextField($model, 'host_file_server_name', array('class'=>'form-control', 'onkeyup'=>'changeSaveLabel();'));?>
	      				</div>
  					</div>
  				</div>
				<div class="inlineForm">
	  					<label class="inlineFormLabel">Varios</label>
	  					<div class="row">
		  					<div class="form-group col-sm-6 ">
		  						<label>Sabnzbd API Key</label>
		  						<?php echo CHtml::activeTextField($model, 'sabnzb_api_key', array('class'=>'form-control', 'onkeyup'=>'changeSaveLabel();'));?>
		      				</div>
	  					</div>
				</div>
				<div class="inlineForm" id="network-group">
	  					<label class="inlineFormLabel">Network</label>
	  					<div class="row">
	  					<?php if(isset($network)&&is_array($network)&&!empty($network)):?>
		  					<div class="form-group col-sm-6 ">
		  					  <label>METODO</label>
						      <div>
								<?php 
									$methos['dhcp'] = 'dhcp'; 
									$methos['static'] = 'static'; 
									echo CHtml::dropDownList('Network[method]', $network['method'], $methos,array('id'=>'method'));
								?>      
							</div>
		      				</div>
	  						<div class="form-group col-sm-6 ">
		  						<label>DIRECCION IP</label>
		  						<div>
		  						<?php echo CHtml::textField('Network[address][0]',$network['address'][0] ,array('class'=>'form-control inputSmall align-center ip-form', 'onkeyup'=>'changeSaveLabel();'));?>  .
		  						<?php echo CHtml::textField('Network[address][1]',$network['address'][1] ,array('class'=>'form-control inputSmall align-center ip-form', 'onkeyup'=>'changeSaveLabel();'));?>  .
		  						<?php echo CHtml::textField('Network[address][2]',$network['address'][2] ,array('class'=>'form-control inputSmall align-center ip-form', 'onkeyup'=>'changeSaveLabel();'));?>  .
		  						<?php echo CHtml::textField('Network[address][3]',$network['address'][3] ,array('class'=>'form-control inputSmall align-center ip-form', 'onkeyup'=>'changeSaveLabel();'));?>
		  						</div>
		      				</div>
		  					<div class="form-group col-sm-6 ">
		  						<label>MASCARA DE SUBRED</label>
		  						<div>
		  						<?php echo CHtml::textField('Network[netmask][0]',$network['netmask'][0] ,array('class'=>'form-control inputSmall align-center ip-form', 'onkeyup'=>'changeSaveLabel();'));?>  .
		  						<?php echo CHtml::textField('Network[netmask][1]',$network['netmask'][1] ,array('class'=>'form-control inputSmall align-center ip-form', 'onkeyup'=>'changeSaveLabel();'));?>  .
		  						<?php echo CHtml::textField('Network[netmask][2]',$network['netmask'][2] ,array('class'=>'form-control inputSmall align-center ip-form', 'onkeyup'=>'changeSaveLabel();'));?>  .
		  						<?php echo CHtml::textField('Network[netmask][3]',$network['netmask'][3] ,array('class'=>'form-control inputSmall align-center ip-form', 'onkeyup'=>'changeSaveLabel();'));?>
		  						</div>
		      				</div>
		  					<div class="form-group col-sm-6 ">
		  						<label>BROADCAST</label>
		  						<div>
		  						<?php echo CHtml::textField('Network[broadcast][0]',$network['broadcast'][0] ,array('class'=>'form-control inputSmall align-center ip-form', 'onkeyup'=>'changeSaveLabel();'));?>  .
		  						<?php echo CHtml::textField('Network[broadcast][1]',$network['broadcast'][1] ,array('class'=>'form-control inputSmall align-center ip-form', 'onkeyup'=>'changeSaveLabel();'));?>  .
		  						<?php echo CHtml::textField('Network[broadcast][2]',$network['broadcast'][2] ,array('class'=>'form-control inputSmall align-center ip-form', 'onkeyup'=>'changeSaveLabel();'));?>  .
		  						<?php echo CHtml::textField('Network[broadcast][3]',$network['broadcast'][3] ,array('class'=>'form-control inputSmall align-center ip-form', 'onkeyup'=>'changeSaveLabel();'));?>
		  						</div>
		      				</div>
		  					<div class="form-group col-sm-6 ">
		  						<label>GATEWAT</label>
		  						<div>
		  						<?php echo CHtml::textField('Network[gateway][0]',$network['gateway'][0] ,array('class'=>'form-control inputSmall align-center ip-form', 'onkeyup'=>'changeSaveLabel();'));?>  .
		  						<?php echo CHtml::textField('Network[gateway][1]',$network['gateway'][1] ,array('class'=>'form-control inputSmall align-center ip-form', 'onkeyup'=>'changeSaveLabel();'));?>  .
		  						<?php echo CHtml::textField('Network[gateway][2]',$network['gateway'][2] ,array('class'=>'form-control inputSmall align-center ip-form', 'onkeyup'=>'changeSaveLabel();'));?>  .
		  						<?php echo CHtml::textField('Network[gateway][3]',$network['gateway'][3] ,array('class'=>'form-control inputSmall align-center ip-form', 'onkeyup'=>'changeSaveLabel();'));?>
		  						</div>
		      				</div>
		  					<div class="form-group col-sm-6 ">
		  						<label>DNS 1</label>
		  						<div>
		  						<?php echo CHtml::textField('Network[dns1][0]',$network['dns1'][0] ,array('class'=>'form-control inputSmall align-center ip-form', 'onkeyup'=>'changeSaveLabel();'));?>  .
		  						<?php echo CHtml::textField('Network[dns1][1]',$network['dns1'][1] ,array('class'=>'form-control inputSmall align-center ip-form', 'onkeyup'=>'changeSaveLabel();'));?>  .
		  						<?php echo CHtml::textField('Network[dns1][2]',$network['dns1'][2] ,array('class'=>'form-control inputSmall align-center ip-form', 'onkeyup'=>'changeSaveLabel();'));?>  .
		  						<?php echo CHtml::textField('Network[dns1][3]',$network['dns1'][3] ,array('class'=>'form-control inputSmall align-center ip-form', 'onkeyup'=>'changeSaveLabel();'));?>
		  						</div>
		      				</div>
		  					<div class="form-group col-sm-6 ">
		  						<label>DNS 2</label>
		  						<div>
		  						<?php echo CHtml::textField('Network[dns2][0]',$network['dns2'][0] ,array('class'=>'form-control inputSmall align-center ip-form', 'onkeyup'=>'changeSaveLabel();'));?>  .
		  						<?php echo CHtml::textField('Network[dns2][1]',$network['dns2'][1] ,array('class'=>'form-control inputSmall align-center ip-form', 'onkeyup'=>'changeSaveLabel();'));?>  .
		  						<?php echo CHtml::textField('Network[dns2][2]',$network['dns2'][2] ,array('class'=>'form-control inputSmall align-center ip-form', 'onkeyup'=>'changeSaveLabel();'));?>  .
		  						<?php echo CHtml::textField('Network[dns2][3]',$network['dns2'][3] ,array('class'=>'form-control inputSmall align-center ip-form', 'onkeyup'=>'changeSaveLabel();'));?>
		  						</div>
		      				</div>
		      				<?php else:?>
								<div class="form-group col-sm-6 ">
		  						<label>No se encontraron datos</label>
			      				</div>		      				
		      				<?php endif;?>
		      			</div>
				</div>
				<div class="form-group buttonGroup">
    					<div class="col-sm-12">    	
    						<button id="btn-save-config" onclick="submitGeneralConfig();" type="button" class="btn btn-alternate btn-lg pull-right"><i class="fa fa-save"></i> <span id="save-description">Guardar</span>    						
    						</button>
    						<button onclick="resetDevice();" type="button" class="btn btn-default btn-lg pull-right"><i class="fa fa-bomb"></i> Resetear Device ID    						
    						</button>
    						<button onclick="goToLocalFolderAdmin();" type="button" class="btn btn-default btn-lg pull-right"><i class="fa fa-database"></i> Escaneo Local    						
    						</button>
    					</div>
    				</div>
			</form>
               </div> 
    	 
    	 </div>
    	 <div class="col-md-2"></div>
    	 </div>
    	 
    	 </div><!-- /wrapper -->
    	 
<script type="text/javascript">

$("#network-group .row div input").change(
		function()
		{
			if($.isNumeric($(this).val()))
			{
				if($(this).val()>255)
				{
					$(this).val(255);					
				}
				else if($(this).val()<0)
				{
					$(this).val(0);
				}
				
			}else
			{
				$(this).val(0);
			}
		}
		);
<?php if(isset($network['method'])):?>
if("<?php echo $network['method']?>"=="dhcp")
{
	$("#network-group .row div input").attr("disabled","disabled");
}
else
{
	$("#network-group .row div input").removeAttr("disabled");				
}
<?php endif?>
$("#method").change(
		function()
		{
			if($(this).val()=="dhcp")
			{
				$("#network-group .row div input").attr("disabled","disabled");
			}
			else
			{
				$("#network-group .row div input").removeAttr("disabled");				
			}			
			return false;
		}
		);
function goToLocalFolderAdmin()
{
	window.location = <?php echo '"'. SiteController::createUrl('localFolderAdmin') . '"'; ?>;
	return false;
}
function resetDevice()
{
	if (confirm("\u00bfSeguro desea resetear el Device ID?"))
	{
		$.post("<?php echo SiteController::createUrl('AjaxResetDeviceId'); ?>"
			).success(
				function(data){
					window.location = <?php echo '"'. SiteController::createUrl('Config') . '"'; ?>;
					return false;
				});
	}
}
function changeSaveLabel()
{
	$("#save-description").html("Guardar");
}
function submitGeneralConfig()
{
	
	$('#general-config-form').submit();
}

$("#general-config-form").submit(function(e)
{
	var formURL = "<?php echo SiteController::createUrl("AjaxSaveGeneralConfig"); ?>";	
	var formData = new FormData(this);

	$("#btn-save-config").attr("disabled","disabled");	
	
	$.ajax({
		   url: formURL,
		   type: 'POST',
		        data:  formData,
		   mimeType:"multipart/form-data",
		   contentType: false,
		   cache: false,
		   processData:false,
		   success: function(data, textStatus, jqXHR)
		   {	
				$("#btn-save-config").removeAttr("disabled");
				$("#save-description").html("Guardado");
					    		
		   },
		   error: function(jqXHR, textStatus, errorThrown)
		   {
			   	$("#btn-save-config").removeAttr("disabled");
			   	$("#save-description").html("Error al guardar");
		   }         
	});
	
	e.preventDefault();
	e.stopImmediatePropagation();
});	
</script>      	
</div><!-- /container -->