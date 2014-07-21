 <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true"> <i class="fa fa-times-circle fa-lg"></i></button>
            	<h3 id="myModalLabel">Nuevo disco</h3>
    </div>
    <div class="modal-body"> 
	    <div class="row">
		    <div class="col-md-3 pagination-centered">
		   		<img class="aficheDetail" src="img/discIn.jpg" width="100%" height="100%" border="0">
		    </div><!--/.col-md-3PRINCIPAL -->
	    
    
			<div class="col-md-9">			    
			    	<div class="col-md-4 pagination-centered detailMain detailMainFirst">
			    		<button id="btn-play" class="btn btn-primary btn-large"><span class="iconFontButton iconPlay"></span> Reproducir</button>
			    	</div><!--/.col-md-4 -->
			    	<div class="col-md-4 pagination-centered detailMain">
						<button id="btn-play-ripp" class="btn btn-primary btn-large"><span class="iconFontButton iconPlay"></span> Rippear</button>    		
			    	</div><!--/.col-md-4 -->
			    	<div class="col-md-4 pagination-centered detailMain" id="ripp-area">
			    	</div><!--/.col-md-4 -->
		    </div><!--/.col-md-9PRINCIPAL -->
		    
		</div><!--/.rowPRINCIPAL -->
    </div>
    
   <div class="modal-footer">
    <button type="button" data-dismiss="modal" class="btn btn-default btn-large">Cerrar</button>
    </div><!--/.modal-footer -->
  </div><!--/.modal-content -->
    </div><!--/.modal-dialog -->
  <script>
	$('#btn-play').click(function(){
		window.location = <?php echo '"'. SiteController::createUrl('site/Ajaxstart',array('id'=>$model->Id,'sourceType'=>$sourceType)) . '"'; ?>;    
		return false;
	});
	$('#btn-play-ripp').click(function(){
		$.post("<?php echo SiteController::createUrl('UseDisc',array('action'=>'aa')); ?>"
			).success(
				function(data){		
					$('#ripp-area').html(data);
		});
		return false;
	});
	
  </script>
