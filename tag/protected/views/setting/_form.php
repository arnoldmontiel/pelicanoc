<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'setting-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'path_pending'); ?>
		<?php echo $form->textField($model,'path_pending',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'path_pending'); ?>
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

	<div class="row">
		<?php echo $form->labelEx($model,'host_name'); ?>
		<?php echo $form->textField($model,'host_name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'host_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'path_ready'); ?>
		<?php echo $form->textField($model,'path_ready',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'path_ready'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'path_subtitle'); ?>
		<?php echo $form->textField($model,'path_subtitle',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'path_subtitle'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'path_images'); ?>
		<?php echo $form->textField($model,'path_images',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'path_images'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'path_shared'); ?>
		<?php echo $form->textField($model,'path_shared',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'path_shared'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
		<?php echo CHtml::submitButton('Cancel',array('name'=>'cancel')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->