<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'my-movie-form',
	'enableAjaxValidation'=>false,
)); ?>


	<div class="row">
	<?php echo $form->labelEx($model,'original_title'); ?>
		<?php echo $form->textField($model,'original_title'); ?>
	</div>

	<div class="row">
		<?php 
		$yearNow = date("Y");
		$yearFrom = $yearNow - 100;
		$yearTo = $yearNow;
		$arrYears = array();
		foreach (range($yearFrom, $yearTo) as $number) {
			$arrYears[$number] = $number; 
		}
		$arrYears = array_reverse($arrYears, true);
		?>
		<?php echo $form->labelEx($model,'production_year'); ?>
		<?php echo $form->dropDownList($model,'production_year',$arrYears); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'running_time'); ?>
		<?php echo $form->textField($model,'running_time',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo CHtml::label('SINÓPSIS',get_class($model).'_description'); ?>
		<?php echo $form->textArea($model,'description',array('size'=>60,'maxlength'=>256)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->