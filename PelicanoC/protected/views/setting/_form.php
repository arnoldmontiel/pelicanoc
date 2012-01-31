<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'setting-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'shared_path'); ?>
		<?php echo $form->textField($model,'shared_path',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'shared_path'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Id_customer'); ?>
		<?php echo $form->textField($model,'Id_customer'); ?>
		<?php echo $form->error($model,'Id_customer'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sabnzb_api_key'); ?>
		<?php echo $form->textField($model,'sabnzb_api_key',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'sabnzb_api_key'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sabnzb_api_url'); ?>
		<?php echo $form->textField($model,'sabnzb_api_url',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'sabnzb_api_url'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->