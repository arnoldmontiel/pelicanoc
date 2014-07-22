 <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true"> <i class="fa fa-times-circle fa-lg"></i></button>
            	<h3 id="myModalLabel">Unidades Externas</h3>
    </div>
    <div class="modal-body"> 
	    <div class="row">
		    <div class="col-md-3 pagination-centered">
		   		<img class="aficheDetail" src="img/discIn.jpg" width="100%" height="100%" border="0">
		    </div><!--/.col-md-3PRINCIPAL -->
	    
    		<input type="hidden" id="hidden-unit" value="0">
    		<input type="hidden" id="hidden-working" value="0">
			<div class="col-md-9">
				<div id="external-unit"></div>
				<div id="explorer-unit"></div>
		    </div><!--/.col-md-9PRINCIPAL -->
		    
		</div><!--/.rowPRINCIPAL -->
    </div>
      <div class="modal-footer">
    <button type="button" data-dismiss="modal" class="btn btn-default btn-large">Cerrar</button>
    </div><!--/.modal-footer -->
  </div><!--/.modal-content -->
    </div><!--/.modal-dialog -->
 
  <script>
	
	$('#btn-cancel').click(function(){
		$('#myModalExternalStorage').modal('hide');
		markRead();
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
