<?php
	Yii::app()->clientScript->registerScript('select-my-movie', "
		
	",CClientScript::POS_READY);
?> 
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true"> <i class="fa fa-times-circle fa-lg"></i></button>
              <h4 class="modal-title">Cambiar Asociacion</h4>
      </div>
      <div class="modal-body">
<div class="loadingMessage"><i class="fa fa-spinner fa-spin"></i> Cargando opciones..</div>
<div class="">Elija la opcion correcta:</div>
<div class="list-group">
		<?php
		foreach ($movies as $movie)
		{
       		$date = date_parse($movie->release_date);
			$date = " (".$date['year'].")";
			echo "<a id='".$movie->id."' href='#' class='list-group-item'>".$movie->original_title.$date."</a>";
		}
       ?>
  
</div>
      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
      <button id ="btn-save" type="button" class="btn btn-primary"><i class="fa fa-save "></i>Guardar</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->

  <script>
	$('.list-group-item').click(function(){
		if($(this).hasClass('active'))
		{
			$('.list-group-item').removeClass('active');
		}
		else
		{
			$('.list-group-item').removeClass('active');
			$(this).addClass('active');
		}		
		return false;
	});
	$('#btn-save').click(function()
	{
		if($('.list-group-item.active').length==1)
		{
			var target = $('.list-group-item.active')[0];
			$.ajax({
		   		type: 'POST',
		   		url: '<?php echo SiteController::createUrl('ajaxSaveSelectedMovie');?>',
		   		data: {Id_movie:target.id,sourceType:<?php echo $sourceType; ?>,idResource:'<?php echo $idResource; ?>'},
		 	}).success(function(data)
		 	{	
		 		location.reload();
			}
		 	);
		 }
	});
  </script>