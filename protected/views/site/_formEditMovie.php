<?php
$modelTMDB =  $modelResource->TMDBData;
if(isset($modelTMDB))
{
	$moviePoster = $modelTMDB->big_poster;
	$backdrop = $modelTMDB->backdrop;
}
else
{
	$moviePoster = $model->big_poster;
	$backdrop = $model->backdrop;
}

Yii::app()->clientScript->registerScript('update-my-movie', "
		
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
        <h2 class="pageSubtitle"><?php echo $model->original_title; ?></h2>
        </div> <!-- /col-md-12 -->
    </div> <!-- /row -->
    <div class="row">
    <div class="col-md-3">
    <div class="editAfiche">
<img class="aficheImg" src="images/<?php echo $moviePoster;?>" border="0">
</div>
<div class="editImagesButtons">   
<a data-toggle="modal" data-target="#myModalCambiarAfiche" class="btn btn-large btn-primary"><i class="fa fa-pencil"></i> Cambiar Afiche</a>
<a data-toggle="modal" data-target="#myModalCambiarAfiche" class="btn btn-large btn-primary"><i class="fa fa-pencil"></i> Cambiar Fondo</a>
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
 <div class="buttonGroup"><button type="submit" class="btn btn-primary btn-large"><i class="fa fa-save "></i> Guardar</button></div>
    </div><!-- /col-md-12 -->
    </div><!-- /row -->    
</form>
    </div>
    <!-- /col-md-9 -->
 </div><!-- /row interna -->
 </div> <!-- /container -->  
    
    
    <div id="myModalCambiarAfiche" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false" style="display: hidden;">
     <div class="modal-dialog ">
        <div class="modal-content"> <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true"> <i class="fa fa-times-circle fa-lg"></i></button>
    <h4 class="modal-title">Cambiar Afiche</h4>
    </div>
    <div class="modal-body"> 
    <div class="modal-scroll">
    
        <div class="radio">
  <label>
    <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked>
    <div>Sube tu imagen</div>
    <input type="file" id="selectedFile"  />
  </label>
</div>
<div class="radio">
  <label>
    <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">
    o Elije una de la lista
    
       <select class="image-picker">
        <option data-img-src="images/e99a9936-a674-493f-9617-524c33ea1bb9_big.jpg" value="1"></option>
        <option data-img-src="images/e99a9936-a674-493f-9617-524c33ea1bb9_big.jpg" value="2"></option>
        <option data-img-src="images/e99a9936-a674-493f-9617-524c33ea1bb9_big.jpg" value="3"></option>
        <option data-img-src="images/e99a9936-a674-493f-9617-524c33ea1bb9_big.jpg" value="4"></option>
        <option data-img-src="images/e99a9936-a674-493f-9617-524c33ea1bb9_big.jpg" value="5"></option>
        <option data-img-src="images/e99a9936-a674-493f-9617-524c33ea1bb9_big.jpg" value="6"></option>
        <option data-img-src="images/e99a9936-a674-493f-9617-524c33ea1bb9_big.jpg" value="7"></option>
        <option data-img-src="images/e99a9936-a674-493f-9617-524c33ea1bb9_big.jpg" value="8"></option>
        <option data-img-src="images/e99a9936-a674-493f-9617-524c33ea1bb9_big.jpg" value="9"></option>
        <option data-img-src="images/e99a9936-a674-493f-9617-524c33ea1bb9_big.jpg" value="10"></option>
        <option data-img-src="images/e99a9936-a674-493f-9617-524c33ea1bb9_big.jpg" value="11"></option>
        <option data-img-src="images/e99a9936-a674-493f-9617-524c33ea1bb9_big.jpg" value="12"></option>
      </select>
  </label>
</div>
      </div>
    </div><!--/.modal-body -->
    <div class="modal-footer">
    <button type="button" data-dismiss="modal" class="btn btn-default btn-large">Cancelar</button>
    <button id="btn-play" type="button" class="btn btn-primary btn-large"> Aceptar</button>
    </div><!--/.modal-footer -->
  </div><!--/.modal-content -->
    </div><!--/.modal-dialog -->	
    </div><!--/.modal -->
  <script type="text/javascript">

    jQuery("select.image-picker").imagepicker({
      hide_select:  true,
    });


  </script>