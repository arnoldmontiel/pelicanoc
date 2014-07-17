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
$moviePoster = PelicanoHelper::getImageName($moviePoster,"_big");

if(isset($modelTMDB)&&$modelTMDB->backdrop!="")
{
	$backdrop = $modelTMDB->backdrop;
}
else
{
	$backdrop = $model->backdrop;
}

$backdrop = PelicanoHelper::getImageName($backdrop,"_bd");

// Yii::app()->clientScript->registerScript('update-my-movie-post-head', "
// 		var date = new Date;	 	
// 		if('".$backdrop."'!='')			
// 	   		ChangeBG('','".$backdrop."'+ '?' +date.valueOf());			
// ",CClientScript::POS_BEGIN);

Yii::app()->clientScript->registerScript('update-my-movie', "
		$('#myModalCambiarAfiche').on('hidden.bs.modal', function () {
  			$(this).html('');
		})
		$('#myModalCambiarBackdrop').on('hidden.bs.modal', function () {
  			$(this).html('');
		})
		
		$('#open-movie-list').click(function()
		{
		$('#open-movie-list').attr('disabled', 'disabled');
		$('#open-movie-list i').removeClass();
		$('#open-movie-list i').addClass('fa fa-spinner fa-spin');
		$.ajax({
	   		type: 'POST',
	   		url: '". SiteController::createUrl('ajaxFillMovieList') . "',
	   		data: {sourceType:".$sourceType.",idResource:".$idResource."},
	 	}).success(function(data)
	 	{	
			$('#myModalEditarAsoc').html(data);
			$('#myModalEditarAsoc').modal('show');	   						   				
			$('#open-movie-list').removeAttr('disabled');
	   		$('#open-movie-list i').removeClass();
			$('#open-movie-list i').addClass('fa fa-link');
		}
	 	).error(function(){
			$('#open-movie-list').removeAttr('disabled');
			$('#open-movie-list i').removeClass();
			$('#open-movie-list i').addClass('fa fa-link');
		});
	   		return false;	   				
		}
		);
		
		$('#open-change-poster').click(function()
		{
		$('#open-change-poster').attr('disabled', 'disabled');
		$('#open-change-poster i').removeClass();
		$('#open-change-poster i').addClass('fa fa-spinner fa-spin');
	   				
		$.ajax({
	   		type: 'POST',
	   		url: '". SiteController::createUrl('ajaxFillMoviePosterSelector') . "',
	   		data: {id:'".$model->Id."',sourceType:".$sourceType.",idResource:".$idResource."},
	 	}).success(function(data)
	 	{	
			$('#myModalCambiarAfiche').html(data);
			$('#myModalCambiarAfiche').modal('show');	   						   				
			$('#open-change-poster').removeAttr('disabled');
	   		$('#open-change-poster i').removeClass();
			$('#open-change-poster i').addClass('fa fa-pencil');
		}
	 	).error(function(){
			$('#open-change-poster').removeAttr('disabled');
	   		$('#open-change-poster i').removeClass();
			$('#pen-change-poster i').addClass('fa fa-pencil');
	   				
	   				});
	   		return false;	   				
		}
		);
		$('#open-change-backdrop').click(function()
		{
		$('#open-change-backdrop').attr('disabled', 'disabled');
		$('#open-change-backdrop i').removeClass();
		$('#open-change-backdrop i').addClass('fa fa-spinner fa-spin');
	   				
		$.ajax({
	   		type: 'POST',
	   		url: '". SiteController::createUrl('ajaxFillMovieBackdropSelector') . "',
	   		data: {id:'".$model->Id."',sourceType:".$sourceType.",idResource:".$idResource."},
	 	}).success(function(data)
	 	{	
			$('#myModalCambiarBackdrop').html(data);
			$('#myModalCambiarBackdrop').modal('show');	   						   				
			$('#open-change-backdrop').removeAttr('disabled');
	   		$('#open-change-backdrop i').removeClass();
			$('#open-change-backdrop i').addClass('fa fa-pencil');
	   	}
	 	).error(function(){
			$('#open-change-backdrop').removeAttr('disabled');
	   		$('#open-change-backdrop i').removeClass();
			$('#open-change-backdrop i').addClass('fa fa-pencil');	   				
		});			
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
		");
?>
<div class="container" id="screenEditMovie">
    	 <div class="wrapper clearfix">
  <div class="row">
    <div class="col-sm-12">
    <h2 class="pageSubtitle">Editar Pelicula</h2>
        </div> <!-- /col-sm-12 -->
    </div> <!-- /row -->
    <div class="row pageTitleContainer">
    <div class="col-sm-6">
            <h1 class="pageTitle"><?php echo $model->original_title; ?></h1>
        </div> <!-- /col-sm-6 -->
    <div class="col-sm-6 align-right">
    <?php if(!$modelResource->is_personal):?>
		<button id="unlink-source" type="button" class="btn btn-danger"><i class="fa fa-unlink "></i> Reset</button>
	<?php endif?>
		<button id="open-movie-list" type="submit" class="btn btn-primary"><i class="fa fa-link "></i> Buscar Información</button>
        </div> <!-- /col-sm-6 -->
    </div>
    <div class="row superContainer">
    <div class="col-sm-3">
    <div class="editAfiche">
<img id="poster" class="peliAfiche" src="<?php echo $moviePoster;?>" border="0">
</div>
<div class="editImagesButtons">   
<a id="open-change-poster" data-toggle="modal"  class="btn btn-large btn-primary"><i class="fa fa-pencil"></i> Cambiar Afiche</a>
<!-- <a id="open-change-backdrop" data-toggle="modal" class="btn btn-large btn-primary"><i class="fa fa-pencil"></i> Cambiar Fondo</a> -->
</div>
</div>
    <!-- /col-sm-3 -->
    <div class="col-sm-9">
    <form class="form-horizontal" id="my-movie-form" role="form" method="post" action=<?php echo SiteController::createUrl('EditMovie',array('idResource'=>$idResource,'sourceType'=>$sourceType));?> >
    <?php
    echo CHtml::hiddenField('idResource',$idResource);
	echo CHtml::hiddenField('sourceType',$sourceType);
	echo CHtml::hiddenField('id_my_movie',$model->Id);	
	echo CHtml::hiddenField('input_actors');
	echo CHtml::hiddenField('input_genres');	
	echo CHtml::hiddenField('input_directors');	
	?>
	<?php 
	$modelLocalFolder = null;
	if($sourceType == 3)
		$modelLocalFolder = LocalFolder::model()->findByPk($idResource);
	?>
	<?php if(isset($modelLocalFolder)):?>
    <div class="row">
        <div class="col-sm-12">
        <!-- Lo saco para la demo!!!!!
          <div class="form-group">
    <label for="fieldTitulo" class="col-sm-1 control-label noLeftPad">Ruta</label>
    <div class="col-sm-11 fileName">
     <?php //echo $modelLocalFolder->path;?>
      </div>
    </div>
     -->
    </div><!-- /col-sm-12 -->
    </div><!-- /row -->
    <?php endif;?>
    <div class="row">
        <div class="col-sm-12">
          <div class="form-group">
    <label for="fieldTitulo" class="col-sm-1 control-label noLeftPad">Titulo</label>
    <div class="col-sm-11">
      <input type="text" class="form-control" id="fieldTitulo" name="<?php echo get_class($model).'[original_title]'?>" placeholder="Título" value="<?php echo $model->original_title; ?>">
    </div>
    </div>
    </div><!-- /col-sm-12 -->
    </div><!-- /row -->
    <div class="row">
        <div class="col-sm-12">
          <div class="form-group">
    <label for="fieldGenero" class="col-sm-1 control-label noLeftPad">Genero</label>
    <div class="col-sm-11">
      <div id="genres" style="width:100%">
    </div>
    </div>
    </div>
    </div><!-- /col-sm-12 -->
    </div><!-- /row -->
    <div class="row">
    <div class="col-md-6 col-sm-12 noLeftPad">
    <div class="row">
    <div class="col-sm-6">
  <div class="form-group">
    <label for="fieldValoracion" class="col-md-4 col-sm-2 control-label noLeftPad">Publico</label>
      <div class="col-md-8 col-sm-10">
      <?php
		$parentalControl=ParentalControl::model()->findAll();
		$list= CHtml::listData(
		$parentalControl, 'Id', 'description');
		
		$select = $model->Id_parental_control;
		if(isset($model->certification))
		{
			$modelParental = ParentalControl::model()->findByAttributes(array('description'=>$model->certification));
			if(isset($modelParental))
				$select = $modelParental->Id;
			else
			{
				$list[0] = $model->certification;
				$select = 0;
			}
		}
		

		echo CHtml::dropDownList(get_class($model).'[Id_parental_control]', $select, $list);
		?>
      
      </div>
  </div>
    </div><!-- /col-sm-6 -->
    <div class="col-sm-6">
  <div class="form-group">
    <label for="fieldRating" class="col-sm-3 control-label noLeftPad">Rating</label>
      <div class="col-sm-9">
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
  </div><!-- /col-sm-6 -->
    </div>
    </div>
    <div class="col-md-6 col-sm-12 noLeftPad">
    <div class="row">
    <div class="col-sm-6">
  <div class="form-group">
    <label for="fieldAno" class="col-md-2 col-sm-2 control-label noLeftPad">Año</label>
        <div class="col-md-10 col-sm-10">
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
    </div><!-- /col-sm-6 -->
    <div class="col-sm-6">
  <div class="form-group">
    <label for="fieldDuracion" class="col-md-4 col-sm-3 control-label noLeftPad">Duracion</label>
      <div class="col-sm-8 col-sm-9">
      <input type="text" class="form-control" id="fieldDuracion" placeholder="Duración" name="<?php echo get_class($model).'[running_time]'?>" value="<?php echo $model->running_time; ?>">
               <span>m</span> </div>
  </div>
  </div><!-- /col-sm-6 -->
    </div>
    </div>
    </div><!-- /row -->
    <div class="row">
        <div class="col-sm-12">
          <div class="form-group">
    <label for="fieldDirector" class="col-sm-1 control-label noLeftPad">Director</label>
              <div class="col-sm-11">
	<div id="directors" style="width:100%">
    </div>
	</div>
    </div>
    </div><!-- /col-sm-12 -->
    </div><!-- /row -->
    <div class="row">
        <div class="col-sm-12">
          <div class="form-group">
    <label for="fieldActores" class="col-sm-1 control-label noLeftPad">Actores</label>
              <div class="col-sm-11">
	<div id="actors" style="width:100%">
    </div>
      
	</div>
    </div>
    </div><!-- /col-sm-12 -->
    </div><!-- /row -->
    <div class="row">
        <div class="col-sm-12">
          <div class="form-group">
    <label for="fieldResumen" class="col-sm-1 control-label noLeftPad">Resumen</label>
              <div class="col-sm-11">
<textarea class="form-control" id="fieldResumen" name="<?php echo get_class($model).'[description]'?>" rows="5"><?php echo $model->description; ?></textarea>                  </div>
    </div>
    </div><!-- /col-sm-12 -->
    </div><!-- /row -->
 <div class="row">
        <div class="col-sm-12">
 <div class="buttonGroup"><button type="submit" class="btn btn-default btn-lg"><i class="fa fa-arrow-left "></i> Volver</button><button type="submit" class="btn btn-primary btn-lg noMargin"><i class="fa fa-save "></i> Guardar</button></div>
    </div><!-- /col-sm-12 -->
    </div><!-- /row -->    
</form>
    </div>
    <!-- /col-sm-9 -->
 </div><!-- /row interna -->
 </div> <!-- /wrapper -->  
 </div> <!-- /container -->  
<script>
function unlink()
{
	$.post("<?php echo SiteController::createUrl('AjaxUnlinkMovie'); ?>",
			{
				idResource:<?php echo $idResource; ?>,
			    sourceType:<?php echo $sourceType; ?>
			 }
			).success(
				function(data){
					location.reload(); 
			}).error(function(data){
					location.reload(); 
			});

}
function cancelar()
{
	  $('#unlink-source').popover('hide');
}
$(function () {
	  var elem ='<p>¿Seguro desea desasociar este contenido?</p><div class="popoverButtons"><button id="btn-remove-cancel" class="btn btn-default" type="button" onclick="cancelar()">No</button>'+
	  '<button id="btn-remove-ok" class="btn btn-primary  noMargin" type="button" onclick="unlink()">Si</button></div>';
	  
	  $('#unlink-source').popover({
      title: 'Confirmar',
      placement: 'bottom',
      content:elem,
      html:true
  });
});										
		
</script>