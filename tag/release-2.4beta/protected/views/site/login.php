
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'login-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
    'htmlOptions'=>array(
        'class'=>'loginForm',
    ),
)); ?>

	<p>
		<?php echo $form->textField($model,'username', array('class'=>'inputLogin', 'placeholder'=>'Usuario')); ?>
		<?php echo $form->error($model,'username'); ?>
	</p>

	<p>
		<?php echo $form->passwordField($model,'password', array('class'=>'inputLogin', 'placeholder'=>'Password')); ?>
		<?php echo $form->error($model,'password'); ?>
	</p>

	<div class="rememberMe">
	    <?php echo $form->checkBox($model,'rememberMe'); ?>
		<?php echo $form->label($model,'rememberMe'); ?>
		<?php echo $form->error($model,'rememberMe'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Ingresar', array('class'=>'btn btn-primary')); ?>
		
		
	</div>

<?php $this->endWidget(); ?>