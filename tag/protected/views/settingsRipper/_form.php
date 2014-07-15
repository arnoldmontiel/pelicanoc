<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'settings-ripper-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'Id'); ?>
		<?php echo $form->textField($model,'Id'); ?>
		<?php echo $form->error($model,'Id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'drive_letter'); ?>
		<?php echo $form->textField($model,'drive_letter',array('size'=>8,'maxlength'=>8)); ?>
		<?php echo $form->error($model,'drive_letter'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'temp_folder_ripping'); ?>
		<?php echo $form->textField($model,'temp_folder_ripping',array('size'=>60,'maxlength'=>256)); ?>
		<?php echo $form->error($model,'temp_folder_ripping'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'final_folder_ripping'); ?>
		<?php echo $form->textField($model,'final_folder_ripping',array('size'=>60,'maxlength'=>256)); ?>
		<?php echo $form->error($model,'final_folder_ripping'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'time_from_reboot'); ?>
		<?php echo $form->textField($model,'time_from_reboot'); ?>
		<?php echo $form->error($model,'time_from_reboot'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'time_to_reboot'); ?>
		<?php echo $form->textField($model,'time_to_reboot'); ?>
		<?php echo $form->error($model,'time_to_reboot'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'mymovies_username'); ?>
		<?php echo $form->textField($model,'mymovies_username',array('size'=>60,'maxlength'=>256)); ?>
		<?php echo $form->error($model,'mymovies_username'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'mymovies_password'); ?>
		<?php echo $form->textField($model,'mymovies_password',array('size'=>60,'maxlength'=>256)); ?>
		<?php echo $form->error($model,'mymovies_password'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->