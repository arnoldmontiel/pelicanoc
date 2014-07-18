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
		<?php echo $form->label($model,'path_pending'); ?>
		<?php echo $form->textField($model,'path_pending',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Id_customer'); ?>
		<?php echo $form->textField($model,'Id_customer'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sabnzb_api_key'); ?>
		<?php echo $form->textField($model,'sabnzb_api_key',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sabnzb_api_url'); ?>
		<?php echo $form->textField($model,'sabnzb_api_url',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'host_name'); ?>
		<?php echo $form->textField($model,'host_name',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'path_ready'); ?>
		<?php echo $form->textField($model,'path_ready',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'path_subtitle'); ?>
		<?php echo $form->textField($model,'path_subtitle',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'path_images'); ?>
		<?php echo $form->textField($model,'path_images',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'path_shared'); ?>
		<?php echo $form->textField($model,'path_shared',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->