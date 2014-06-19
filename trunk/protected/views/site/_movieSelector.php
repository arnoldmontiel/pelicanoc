  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true"> <i class="fa fa-times-circle fa-lg"></i></button>
              <h4 class="modal-title">Buscar Información</h4>
      </div>
      <div class="modal-body">

<div class="buscarAsociacion">
          <form class="form-horizontal" role="form">
          <div class="row">
        <div class="form-group col-sm-6">
    <label for="fieldSearchName" class="col-sm-3 control-label">Buscar</label>
    <div class="col-sm-9">	
                            <input id="fieldSearchName" type="search" class="form-control" placeholder="Título de la película">
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
        <button id="btn_search" type="submit" class="btn btn-default">Buscar</button>
        </div>
        </div>
      </form>
          </div>
<div id="list-movies" class="list-group scrollable-list">
		<?php
		if(count($movies)>0)
		{
			foreach ($movies as $movie)
			{
	       		$date = date_parse($movie->release_date);
				$date = " (".$date['year'].")";
				echo "<a id='".$movie->id."' href='#' class='list-group-item'>".$movie->original_title.$date."</a>";
			}
		}
		else
			echo '<div class="loadingMessage"><i class="fa fa-info-circle"></i> Ingrese el titulo de una pelicula y presione buscar</div>'
       ?>
         
</div>
      </div>
      <div class="modal-footer">
      <button id ="btn-save" disabled type="button" class="btn btn-primary btn-lg pull-right"><i class="fa fa-save "></i> Guardar</button> 
      <button id="btn-cancel" type="button" class="btn btn-default btn-lg pull-right"" data-dismiss="modal">Cancelar</button> 
      <div id="btn-help-txt" class="helpText"><i class="fa fa-info-circle"></i> Para poder guardar primero seleccione una pel&iacute;cula de la lista.</div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->

  <script>
  bindActions();
  $('#btn-help-txt').hide();
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
				if(data.indexOf('No se encontraron resultados')>0)
					$('#btn-help-txt').hide();
				else
					$('#btn-help-txt').show();
				
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
				$('#btn-save').attr("disabled","disabled");
				$('#btn-help-txt').show();				
			}
			else
			{
				$('.list-group-item').removeClass('active');
				$(this).addClass('active');
				$('#btn-save').removeAttr("disabled");
				$('#btn-help-txt').hide();
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