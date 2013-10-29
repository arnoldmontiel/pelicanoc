 <!--  <div id="myModalExternalStorage" class="modal noPlaying">-->   
   <div id="myModalExternalStorage" class="modal hide fade noPlaying in" style="display: block;" aria-hidden="false" aria-labelledby="myModalLabel" role="dialog" tabindex="-1">
    <div class="modal-header">
    	<button type="button" class="close" data-dismiss="modal" aria-hidden="true"> <i class="icon-remove-sign icon-large"></i></button>
    	<h3 id="myModalLabel">Unidades Externas</h3>
    </div>
    <div class="modal-body"> 
	    <div class="row-fluid">
		    <div class="span3 pagination-centered">
		   		<img class="aficheDetail" src="img/discIn.jpg" width="100%" height="100%" border="0">
		    </div><!--/.span3PRINCIPAL -->
	    
    
			<div class="span9">
				<div id="external-unit"></div>
		    </div><!--/.span9PRINCIPAL -->
		    
		</div><!--/.rowPRINCIPAL -->
    </div>
    
    <div class="modal-footer">
    	<button id="btn-process" class="btn btn-primary btn-large"><span class="iconFontButton iconPlay"></span> Descargar</button>    	
    	<button id="btn-cancel" class="btn btn-primary btn-large"><span class="iconFontButton iconPlay"></span> Cancelar</button>
    </div>
  </div>
  <script>
	
	$('#btn-cancel').click(function(){
		$('#myModalExternalStorage').modal('hide');
		markRead();
		return false;
	});

	$('.usb-button-scan').click(function(){
		var id = $(this).attr("id");		
		$.post("<?php echo SiteController::createUrl('AjaxExternalStorageExplore'); ?>",
			{
				id:id			    
			}
		).success(
			function(data){
		});
				
		return false;
	});

	$('#btn-process').click(function(){		
		var id = $(this).attr("id");		
		$.post("<?php echo SiteController::createUrl('AjaxProcessExternalStorage'); ?>",
			{
				id:23			    
			}
		).success(
			function(data){
		});
		markRead();
		return false;
	});
	
	function markRead()
	{
		$.post("<?php echo SiteController::createUrl('AjaxMarkCurrentESRead'); ?>"
		).success(
			function(data){
		});
	}
	$('.close').click(function(){
		markRead();
	});
  </script>
