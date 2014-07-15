<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'Id'); ?>
		<?php echo $form->textField($model,'Id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'drive_letter'); ?>
		<?php echo $form->textField($model,'drive_letter',array('size'=>8,'maxlength'=>8)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'temp_folder_ripping'); ?>
		<?php echo $form->textField($model,'temp_folder_ripping',array('size'=>60,'maxlength'=>256)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'final_folder_ripping'); ?>
		<?php echo $form->textField($model,'final_folder_ripping',array('size'=>60,'maxlength'=>256)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'time_from_reboot'); ?>
		<?php echo $form->textField($model,'time_from_reboot'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'time_to_reboot'); ?>
		<?php echo $form->textField($model,'time_to_reboot'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'mymovies_username'); ?>
		<?php echo $form->textField($model,'mymovies_username',array('size'=>60,'maxlength'=>256)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->