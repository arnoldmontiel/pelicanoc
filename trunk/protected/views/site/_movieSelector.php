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
<div class="buscarAsociacion">
          <form class="form-horizontal" role="form">
          <div class="row">
        <div class="form-group col-sm-6">
    <label for="fieldSearchName" class="col-sm-3 control-label">Buscar</label>
    <div class="col-sm-9">	
                            <input id="fieldSearchName" type="text" class="form-control" placeholder="Nombre">
                            </div>
                  </div>
        <div class="form-group col-sm-5">
    <label for="fieldAno" class="col-sm-2 control-label">Ano</label>
    <div class="col-sm-10">
         <select class="form-control" id="fieldAno">
  <option>Cualquiera</option>
  <option>1988</option>
  <option>1989</option>
  <option>1990</option>
  <option>1991</option>
</select>            
                            </div>
</div>
          <div class="col-sm-1">
        <button type="submit" class="btn btn-default">Buscar</button>
        </div>
        </div>
      </form>
          </div>
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
      <button id="btn-cancel" type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
      <button id ="btn-save" type="button" class="btn btn-primary"><i class="fa fa-save "></i> Guardar</button>
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
			$("#btn-save").attr("disabled", "disabled");
			$("#btn-cancel").attr("disabled", "disabled");
			$("#btn-save i").removeClass();
			$("#btn-save i").addClass("fa fa-spinner fa-spin");
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