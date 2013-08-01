 <!--  <div id="myModalNoPlaying" class="modal noPlaying">-->   
   <div id="myModalNoPlaying" class="modal hide fade noPlaying in" style="display: block;" aria-hidden="false" aria-labelledby="myModalLabel" role="dialog" tabindex="-1">
    <div class="modal-header">
    	<button type="button" class="close" data-dismiss="modal" aria-hidden="true"> <i class="icon-remove-sign icon-large"></i></button>
    	<h3 id="myModalLabel">Reproducci&oacute;n</h3>
    </div>
    <div class="modal-body"> 
	    <div class="row-fluid">
		    <div class="span3 pagination-centered">
		   		<img class="aficheDetail" src="img/discIn.jpg" width="100%" height="100%" border="0">
		    </div><!--/.span3PRINCIPAL -->
	    
    
			<div class="span9">			    
			    	<p>Actualmente no se est&aacute; reproduciendo nada</p>
		    </div><!--/.span9PRINCIPAL -->
		    
		</div><!--/.rowPRINCIPAL -->
    </div>
    
    <div class="modal-footer">
    	<button id="btn-close" class="btn btn-primary btn-large"><span class="iconFontButton iconPlay"></span> Cerrar</button>
    </div>
  </div>
  <script>
	$('#btn-close').click(function(){
		$('#myModalNoPlaying').modal('hide');
		return false;
	});
  </script>
