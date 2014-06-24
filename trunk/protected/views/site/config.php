<div class="container" id="screenConfig" >
    	 <div class="wrapper clearfix">
    	 <div class="row">
    	 <div class="col-md-2"></div>
    	 <div class="col-md-8 col-sm-12">
    	 <div  class="configForm">
		    <form id="general-config-form"  role="form">
  					<div class="inlineForm">
  					<label class="inlineFormLabel">Sabnzbd</label>
  					<div class="row">
						<div class="form-group col-sm-6">
	    					<label>Sabnzbd password path</label>
	    					<?php echo CHtml::activeTextField($model, 'sabnzb_pwd_file_path', array('class'=>'form-control', 'onkeyup'=>'changeSaveLabel();'));?>
						</div>
	  					<div class="form-group col-sm-6 ">
	    					<label>Sabnzbd path descarga</label>
	    					<?php echo CHtml::activeTextField($model, 'path_sabnzbd_download', array('class'=>'form-control', 'onkeyup'=>'changeSaveLabel();'));?>
	    				</div>
  					</div>
  					<div class="row">   
  						<div class="form-group col-sm-6 ">
	    					<label>Sabnzbd API URL</label>
	    					<?php echo CHtml::activeTextField($model, 'sabnzb_api_url', array('class'=>'form-control', 'placeholder'=>'Url', 'onkeyup'=>'changeSaveLabel();'));?>
	      				</div> 
  					</div>			
  					</div>
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
		    					<label>Path Compartidos</label>
		    					<?php echo CHtml::activeTextField($model, 'path_shared', array('class'=>'form-control', 'onkeyup'=>'changeSaveLabel();'));?>
		    				</div>
		  					<div class="form-group col-sm-6 ">
		  						<label>Password MJ</label>
		  						<?php echo CHtml::activeTextField($model, 'michael_jackson', array('class'=>'form-control', 'onkeyup'=>'changeSaveLabel();'));?>
		      				</div>
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