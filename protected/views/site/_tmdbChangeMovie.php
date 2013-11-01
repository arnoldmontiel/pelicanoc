<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'tmdb-form',
		'enableAjaxValidation'=>false,
)); ?>

<?php

//echo $form->hiddenField($model,'TMDB_id');
echo CHtml::hiddenField('idResource',$idResource);
echo CHtml::hiddenField('sourceType',$sourceType);
echo CHtml::hiddenField('idMyMovie',$myMovie->Id);

echo $myMovie->original_title." (".$myMovie->production_year.")";
echo "<br>";
?>
	<div class="row">
	<?php echo CHtml::textField('buscar','',array('id'=>'txt_search'));?>
	<?php echo CHtml::button('buscar',array('id'=>'btn_search'));?>
	</div>
	<div id="searchMoviesResult" class="">
		<?php echo $this->renderPartial('_searchMoviesResult', array('movies'=>$movies));?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Save',array('id'=>'save')); ?>
	</div>

<?php $this->endWidget(); ?>

  <script>
	$('#btn_search').click(function(){
		$(this).attr("disabled", "disabled");
		$('#searchMoviesResult').html("Buscando...");
		$.post("<?php echo SiteController::createUrl('AjaxShearMovieTMDB'); ?>",
			{title: $('#txt_search').val()}
		).success(
			function(data) 
			{									
				$('#btn_search').removeAttr("disabled");
				$('#searchMoviesResult').html(data);
				return false;
			}
		).error(
			function(data) 
			{									
				$('#btn_search').removeAttr("disabled");
				$('#searchMoviesResult').html("");
				return false;
			}
		);
		return false;
	});
  </script>
