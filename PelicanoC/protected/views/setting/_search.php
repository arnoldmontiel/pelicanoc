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
		<?php echo $form->label($model,'shared_path'); ?>
		<?php echo $form->textField($model,'shared_path',array('size'=>60,'maxlength'=>255)); ?>
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

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->