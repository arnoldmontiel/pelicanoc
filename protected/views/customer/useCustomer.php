
<h1>Use Customer</h1>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'use-customer-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>


	<div class="row">
		<?php echo CHtml::label('Code','code'); ?>
		<?php echo CHtml::textField('code','',array('id'=>'code','size'=>45,'maxlength'=>100)); ?>
	</div>
	
	<?php if($hasError): ?>
	<p class="note"><span class="required">There was an error with customer code</span></p>
	<?php endif ?>
	
	<div class="row buttons">
		<?php echo CHtml::submitButton('Use code'); ?>
		<?php echo CHtml::submitButton('Cancel',array('name'=>'cancel')); ?>
	</div>
		
<?php $this->endWidget(); ?>

</div><!-- form -->