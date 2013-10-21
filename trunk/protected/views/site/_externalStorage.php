 <!--  <div id="myModalExternalStorage" class="modal noPlaying">-->   
   <div id="myModalExternalStorage" class="modal hide fade noPlaying in" style="display: block;" aria-hidden="false" aria-labelledby="myModalLabel" role="dialog" tabindex="-1">
    <div class="modal-header">
    	<button type="button" class="close" data-dismiss="modal" aria-hidden="true"> <i class="icon-remove-sign icon-large"></i></button>
    	<h3 id="myModalLabel">Unidad Externa Reconocida</h3>
    </div>
    <div class="modal-body"> 
	    <div class="row-fluid">
		    <div class="span3 pagination-centered">
		   		<img class="aficheDetail" src="img/discIn.jpg" width="100%" height="100%" border="0">
		    </div><!--/.span3PRINCIPAL -->
	    
    
			<div class="span9">			    
			    	<p id="ESModalMsg">&iquest;Desea descargar a Pelicano el contenido de video del dispositivo externo?</p>
		    </div><!--/.span9PRINCIPAL -->
		    
		</div><!--/.rowPRINCIPAL -->
    </div>
    
    <div class="modal-footer">
    	<button id="btn-process" class="btn btn-primary btn-large"><span class="iconFontButton iconPlay"></span> Descargar</button>
    	<button id="btn-ripping" disabled="disabled" class="btn btn-primary btn-large"><span class="iconFontButton iconPlay"></span> Descargando...</button>
    	<button id="btn-cancel" class="btn btn-primary btn-large"><span class="iconFontButton iconPlay"></span> Cancelar</button>
    </div>
  </div>
  <script>
	$('#btn-cancel').click(function(){
		$('#myModalExternalStorage').modal('hide');
		markRead();
		return false;
	});

	$('#btn-process').click(function(){
		$('#myModalExternalStorage').modal('hide');
		$.post("<?php echo SiteController::createUrl('AjaxProcessExternalStorage'); ?>"
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
