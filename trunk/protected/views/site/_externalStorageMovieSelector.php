  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true"> <i class="fa fa-times-circle fa-lg"></i></button>
              <h4 class="modal-title">Editar Informaci&oacute;n</h4>
      </div>
      <div class="modal-body">

<div class="buscarAsociacion">
          <form class="form-horizontal" role="form">
          <div class="row">
        <div class="form-group col-sm-6">
    <label for="fieldSearchName" class="col-sm-3 control-label">Buscar</label>
    <div class="col-sm-9">	
                            <input id="fieldSearchName" type="text" class="form-control" placeholder="Título de la película">
                            </div>
                  </div>
        <div class="form-group col-sm-5">
    <label for="fieldAno" class="col-sm-2 control-label">Año</label>
    <div class="col-sm-10">
         <select class="form-control" id="fieldAno">
  <option value="">Cualquiera</option>
          <?php 
		$yearNow = date("Y");
		$yearFrom = $yearNow - 100;
		$yearTo = $yearNow;
		$arrYears = array();
		foreach (range($yearFrom, $yearTo) as $number) {
			$arrYears[$number] = $number; 
		}
		$arrYears = array_reverse($arrYears, true);
		foreach ($arrYears as $year)
		{
			echo "<option value'".$year."'>".$year."</option>";
		}
		?>
</select>            
</div>
</div>
          <div class="col-sm-1">
        <button id="btn_search" type="button" class="btn btn-default">Buscar</button>
        </div>
        </div>
      </form>
          </div>
<div id="list-movies" class="list-group scrollable-list">
		<?php
		foreach ($movies as $movie)
		{
       		$date = date_parse($movie['release_date']);
			$date = " (".$date['year'].")";
			echo "<a id='".$movie['id']."' href='#' class='list-group-item'>".$movie['original_title'].$date."</a>";
		}
       ?>  
</div>
      </div>
      <div class="modal-footer">
      <button id="btn-cancel" type="button" class="btn btn-default btn-lg" data-dismiss="modal">Cancelar</button>
      <button id ="btn-save" type="button" class="btn btn-primary btn-lg"><i class="fa fa-save "></i> Guardar</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->

  <script>
  bindActions();
	$('#btn_search').click(function(){
		$('#list-movies').html('<div class="loadingMessage"><i class="fa fa-spinner fa-spin"></i> Buscando opciones..</div>');		
		$(this).attr("disabled", "disabled");
		$('#searchMoviesResult').html("Buscando...");
		$.post("<?php echo SiteController::createUrl('AjaxShearMovieTMDB'); ?>",
			{title: $('#fieldSearchName').val(),
			year:$('#fieldAno').val()}
		).success(
			function(data) 
			{	
				$('#btn_search').removeAttr("disabled");
				$('#list-movies').html(data);
				bindActions();								
				return false;
			}
		).error(
			function(data) 
			{									
				$('#btn_search').removeAttr("disabled");
				$('#list-movies').html("");
				return false;
			}
		);
		return false;
	});
  function bindActions()
  {
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
  }
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
		   		url: '<?php echo SiteController::createUrl('AjaxExternalStorageSaveSelectedMovie');?>',
		   		data: {id:target.id,idExternal_storage_data:<?php echo $id_external_storage_data; ?>},
		 	}).success(function(data)
		 	{	
		 		$('#myModalEditarAsoc').modal('hide');
		 		var tr = $('#wizardDispositivos').find('#idTr_' + <?php echo $id_external_storage_data; ?>);
		 		if(tr.length > 0)
		 		{
		 			var tdName = tr.find('#idTdName_' + <?php echo $id_external_storage_data; ?>);
		 			if(tdName.length > 0)
					{				
						tdName.html(target.text);				
					}

					if(tr.attr('unknown') == 1)
					{
						tr.attr('unknown','0');
						$('#knownTable').append(tr);
					}
			 	}
		 						
			});
		 }
	});
  </script>