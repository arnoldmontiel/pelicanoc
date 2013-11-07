<?php
$modelTMDB =  $modelResource->TMDBData;
if(isset($modelTMDB)&&$modelTMDB->big_poster!="")
{
	$moviePoster = $modelTMDB->big_poster;
}
else
{
	$moviePoster = $model->big_poster;
}

if(isset($modelTMDB)&&$modelTMDB->backdrop!="")
{
	$backdrop = $modelTMDB->backdrop;
}
else
{
	$backdrop = $model->backdrop;
}

Yii::app()->clientScript->registerScript('update-my-movie', "
		
		$('#open-movie-list').click(function()
		{
		$.ajax({
	   		type: 'POST',
	   		url: '". SiteController::createUrl('ajaxFillMovieList') . "',
	   		data: {sourceType:".$sourceType.",idResource:".$idResource."},
	 	}).success(function(data)
	 	{	
			$('#myModalEditarAsoc').html(data);
			$('#myModalEditarAsoc').modal('show');	   						   				
		}
	 	);
	   		return false;	   				
		}
		);
		
		$('#open-change-poster').click(function()
		{
		$.ajax({
	   		type: 'POST',
	   		url: '". SiteController::createUrl('ajaxFillMoviePosterSelector') . "',
	   		data: {id:'".$model->Id."',sourceType:".$sourceType.",idResource:".$idResource."},
	 	}).success(function(data)
	 	{	
			$('#myModalCambiarAfiche').html(data);
			$('#myModalCambiarAfiche').modal('show');	   						   				
		}
	 	);
	   		return false;	   				
		}
		);
		$('#open-change-backdrop').click(function()
		{
		$.ajax({
	   		type: 'POST',
	   		url: '". SiteController::createUrl('ajaxFillMovieBackdropSelector') . "',
	   		data: {id:'".$model->Id."',sourceType:".$sourceType.",idResource:".$idResource."},
	 	}).success(function(data)
	 	{	
			$('#myModalCambiarAfiche').html(data);
			$('#myModalCambiarAfiche').modal('show');	   						   				
		}
	 	);			
	   		return false;
		}
		);
	   				
		$('#actors').select2({tags:[],tokenSeparators: [',']});
		$('#directors').select2({tags:[],tokenSeparators: [',']});
		$('#genres').select2({tags:[],tokenSeparators: [',']});
		
		$.ajax({
	   		type: 'POST',
	   		url: '". SiteController::createUrl('AjaxGenres') . "',
	   		data: {id:'".$model->Id."',sourceType:".$sourceType.",idResource:".$idResource.",type:'Actor'},
	   		dataType: 'json'
	 	}).success(function(data)
	 	{	
	   		vals = '';
	   		first = true;
			for (var i in data) {
				item = data[i];
				if(first)
   				{
	   				first = false;
	   				vals = item;
				}
	   			else
	   			{
	   				vals = vals+','+item;
	   			}
			} 				
			$('#genres').select2({tags:data,tokenSeparators: [',']});
	   		$('#genres').val(vals).trigger('change');
			$('#input_genres').val(vals);	   						   				
		}
	 	);
		$('#genres').on('change',function(e){ $('#input_genres').val(e.val);});
	   				
		$.ajax({
	   		type: 'POST',
	   		url: '". SiteController::createUrl('AjaxGetPersons') . "',
	   		data: {id:'".$model->Id."',sourceType:".$sourceType.",idResource:".$idResource.",type:'Actor'},
	   		dataType: 'json'
	 	}).success(function(data)
	 	{	
	   		vals = '';
	   		first = true;
			for (var i in data) {
				item = data[i];
				if(first)
   				{
	   				first = false;
					vals = item.id;
				}
	   			else
	   			{
	   				vals = vals+','+item.id;
	   			}
			} 				
	   		//alert(data[0].id);
			$('#actors').select2({tags:data,tokenSeparators: [',']});
	   		$('#actors').val(vals).trigger('change');
			$('#input_actors').val(vals);	   						   				
		}
	 	);
		$('#actors').on('change',function(e){ $('#input_actors').val(e.val);});
		$.ajax({
	   		type: 'POST',
	   		url: '". SiteController::createUrl('AjaxGetPersons') . "',
	   		data: {id:'".$model->Id."',sourceType:".$sourceType.",idResource:".$idResource.",type:'Director'},
	   		dataType: 'json'
	 	}).success(function(data)
	 	{	 				
	   		vals = '';
	   		first = true;
			for (var i in data) {
				item = data[i];
				if(first)
   				{
	   				first = false;
					vals = item.id;
				}
	   			else
	   			{
	   				vals = vals+','+item.id;
	   			}
			} 				
	   		//alert(data[0].id);
			$('#directors').select2({tags:data,tokenSeparators: [',']});
	   		$('#directors').val(vals).trigger('change');
	   		$('#input_directors').val(vals);	
	   					   				
		}
	 	);
		$('#directors').on('change',function(e){ $('#input_directors').val(e.val);});
	   	ChangeBG('images/','".$backdrop."');			
		");
?>

<div class="container" id="screenEditMovie">
  <div class="row">
    <div class="col-md-12">
    <h1 class="pageTitle">Editar Pelicula</h1>
        </div> <!-- /col-md-12 -->
    </div> <!-- /row -->
    <div class="row pageSubtitleBorder">
    <div class="col-md-6">
            <h2 class="pageSubtitle"><?php echo $model->original_title; ?></h2>
        </div> <!-- /col-md-6 -->
    <div class="col-md-6 align-right">
                <button type="submit" class="btn btn-danger" data-toggle="modal" data-target="#myModalEditarAsoc"><i class="fa fa-unlink "></i> Desasociar</button>
            <button id="open-movie-list" type="submit" class="btn btn-primary"><i class="fa fa-link "></i> Cambiar Asociacion</button>
            <button type="submit" class="btn btn-primary" data-toggle="modal" data-target="#myModalEditarAsoc"><i class="fa fa-refresh "></i> Restaurar Asociacion</button>
        </div> <!-- /col-md-6 -->
    </div>
    <div class="row">
    <div class="col-md-3">
    <div class="editAfiche">
<img id="poster" class="aficheImg" src="images/<?php echo $moviePoster;?>" border="0">
</div>
<div class="editImagesButtons">   
<a id="open-change-poster" data-toggle="modal"  class="btn btn-large btn-primary"><i class="fa fa-pencil"></i> Cambiar Afiche</a>
<a id="open-change-backdrop" data-toggle="modal" class="btn btn-large btn-primary"><i class="fa fa-pencil"></i> Cambiar Fondo</a>
</div>
</div>
    <!-- /col-md-3 -->
    <div class="col-md-9">
    <form class="form-horizontal" id="my-movie-form" role="form" method="post" action=<?php echo SiteController::createUrl('EditMovie',array('idResource'=>$idResource,'sourceType'=>$sourceType));?> >
    <?php
    echo CHtml::hiddenField('idResource',$idResource);
	echo CHtml::hiddenField('sourceType',$sourceType);
	echo CHtml::hiddenField('id_my_movie',$model->Id);	
	echo CHtml::hiddenField('input_actors');
	echo CHtml::hiddenField('input_genres');	
	echo CHtml::hiddenField('input_directors');	
	?>
    <div class="row">
        <div class="col-md-12">
          <div class="form-group">
    <label for="fieldTitulo" class="col-md-1 control-label">Titulo</label>
    <div class="col-md-11">
      <input type="text" class="form-control" id="fieldTitulo" name="<?php echo get_class($model).'[original_title]'?>" placeholder="Título" value="<?php echo $model->original_title; ?>">
    </div>
    </div>
    </div><!-- /col-md-12 -->
    </div><!-- /row -->
    <div class="row">
        <div class="col-md-12">
          <div class="form-group">
    <label for="fieldGenero" class="col-md-1 control-label">Genero</label>
    <div class="col-md-11">
      <div id="genres" style="width:100%">
    </div>
    </div>
    </div>
    </div><!-- /col-md-12 -->
    </div><!-- /row -->
    <div class="row">
    <div class="col-md-6">
  <div class="form-group">
    <label for="fieldValoracion" class="col-md-2 control-label">Control Parental</label>
      <div class="col-md-10">
      <?php
		$parentalControl=ParentalControl::model()->findAll();
		$list= CHtml::listData(
		$parentalControl, 'Id', 'description');
		echo CHtml::dropDownList(get_class($model).'[Id_parental_control]', $model->Id_parental_control, $list);
		?>
      
      </div>
  </div>
    </div><!-- /col-md-6 -->
    <div class="col-md-6">
  <div class="form-group">
    <label for="fieldRating" class="col-md-2 control-label">Rating</label>
      <div class="col-md-10">
              <?php 
		$from = 1;
		$to = 10;
		$ratings = array();
		foreach (range($from, $to) as $number) {
			$ratings[$number] = $number; 
		}
		echo CHtml::dropDownList(get_class($model).'[rating]', $model->rating, $ratings);
		?>
      
          </div>
  </div>
  </div><!-- /col-md-6 -->
    </div><!-- /row -->
    <div class="row">
    <div class="col-md-6">
  <div class="form-group">
    <label for="fieldAno" class="col-md-2 control-label">Año</label>
        <div class="col-md-10">
        <?php 
		$yearNow = date("Y");
		$yearFrom = $yearNow - 100;
		$yearTo = $yearNow;
		$arrYears = array();
		foreach (range($yearFrom, $yearTo) as $number) {
			$arrYears[$number] = $number; 
		}
		$arrYears = array_reverse($arrYears, true);
		echo CHtml::dropDownList(get_class($model).'[production_year]', $model->production_year, $arrYears);
		?>
	</div>
  </div>
    </div><!-- /col-md-6 -->
    <div class="col-md-6">
  <div class="form-group">
    <label for="fieldDuracion" class="col-md-2 control-label">Duracion</label>
      <div class="col-md-10">
      <input type="text" class="form-control" id="fieldDuracion" placeholder="Duración" name="<?php echo get_class($model).'[running_time]'?>" value="<?php echo $model->running_time; ?>">
                </div>
  </div>
  </div><!-- /col-md-6 -->
    </div><!-- /row -->
    <div class="row">
        <div class="col-md-12">
          <div class="form-group">
    <label for="fieldDirector" class="col-md-1 control-label">Director</label>
              <div class="col-md-11">
	<div id="directors" style="width:100%">
    </div>
	</div>
    </div>
    </div><!-- /col-md-12 -->
    </div><!-- /row -->
    <div class="row">
        <div class="col-md-12">
          <div class="form-group">
    <label for="fieldActores" class="col-md-1 control-label">Actores</label>
              <div class="col-md-11">
	<div id="actors" style="width:100%">
    </div>
      
	</div>
    </div>
    </div><!-- /col-md-12 -->
    </div><!-- /row -->
    <div class="row">
        <div class="col-md-12">
          <div class="form-group">
    <label for="fieldResumen" class="col-md-1 control-label">Resumen</label>
              <div class="col-md-11">
<textarea class="form-control" id="fieldResumen" name="<?php echo get_class($model).'[description]'?>" rows="3"><?php echo $model->description; ?></textarea>
                  </div>
    </div>
    </div><!-- /col-md-12 -->
    </div><!-- /row -->
 <div class="row">
        <div class="col-md-12">
 <div class="buttonGroup"><button type="submit" class="btn btn-default btn-large">Cancelar</button><button type="submit" class="btn btn-primary btn-large noMargin"><i class="fa fa-save "></i> Guardar</button></div>
    </div><!-- /col-md-12 -->
    </div><!-- /row -->    
</form>
    </div>
    <!-- /col-md-9 -->
 </div><!-- /row interna -->
 </div> <!-- /container -->  
