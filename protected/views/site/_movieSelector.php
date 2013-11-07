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
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
