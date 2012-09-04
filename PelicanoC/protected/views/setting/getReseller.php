<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'reseller-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fill the fields to get the reseller</p>
	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'password'); ?>
	</div>
	
	<div class="row buttons">
		<?php echo CHtml::submitButton('Get Reseller'); ?>
		<?php echo CHtml::submitButton('Cancel',array('name'=>'cancel')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->