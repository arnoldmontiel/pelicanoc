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
		  					<div class="dropdown">
							  <button class="btn btn-default dropdown-toggle" type="button" id="dd-method" data-toggle="dropdown">
							    METODO							    
							    <span id="sp-method" class="caret"></span>
							  </button>
							  <ul id="ul-method" class="dropdown-menu" role="menu" aria-labelledby="dd-method">
							    <li role="presentation"><a role="menuitem" tabindex="-1" href="#">dhcp</a></li>
							    <li role="presentation"><a role="menuitem" tabindex="-1" href="#">static</a></li>
							  </ul>
							</div>		  					
		  						<?php echo CHtml::hiddenField( 'Network[method]',$network['method'] ,array("id"=>'method'));?>
		      				</div>
	  						<div class="form-group col-sm-6 ">
		  						<label>DIRECCION IP</label>
		  						<?php echo CHtml::textField('Network[address]',$network['address'] ,array('class'=>'form-control', 'onkeyup'=>'changeSaveLabel();'));?>
		      				</div>
		  					<div class="form-group col-sm-6 ">
		  						<label>MASCARA DE SUBRED</label>
		  						<?php echo CHtml::textField( 'Network[netmask]',$network['netmask'] ,array('class'=>'form-control', 'onkeyup'=>'changeSaveLabel();'));?>
		      				</div>
		  					<div class="form-group col-sm-6 ">
		  						<label>RED</label>
		  						<?php echo CHtml::textField( 'Network[network]', $network['network'],array('class'=>'form-control', 'onkeyup'=>'changeSaveLabel();'));?>
		      				</div>
		  					<div class="form-group col-sm-6 ">
		  						<label>BROADCAST</label>
		  						<?php echo CHtml::textField( 'Network[broadcast]',(isset($network['broadcast'])?$network['broadcast']:''),array('class'=>'form-control', 'onkeyup'=>'changeSaveLabel();'));?>
		      				</div>
		  					<div class="form-group col-sm-6 ">
		  						<label>GATEWAT</label>
		  						<?php echo CHtml::textField( 'Network[gateway]',isset($network['gateway'])?$network['gateway']:"", array('class'=>'form-control', 'onkeyup'=>'changeSaveLabel();'));?>
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
$("#ul-method a").click(
		function()
		{
			$("#method").val($(this).html());
			if($(this).html()=="dhcp")
			{
				$("#network-group .row div input").attr("disabled","disabled");
			}
			else
			{
				$("#network-group .row div input").removeAttr("disabled");				
			}
			$("#dd-method").dropdown('toggle')
			
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