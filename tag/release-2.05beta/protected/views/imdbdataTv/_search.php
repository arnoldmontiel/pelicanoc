<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'ID'); ?>
		<?php echo $form->textField($model,'ID',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Title'); ?>
		<?php echo $form->textField($model,'Title',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Year'); ?>
		<?php echo $form->textField($model,'Year'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Rated'); ?>
		<?php echo $form->textField($model,'Rated',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Released'); ?>
		<?php echo $form->textField($model,'Released',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Genre'); ?>
		<?php echo $form->textField($model,'Genre',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Director'); ?>
		<?php echo $form->textField($model,'Director',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Writer'); ?>
		<?php echo $form->textField($model,'Writer',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Actors'); ?>
		<?php echo $form->textArea($model,'Actors',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Plot'); ?>
		<?php echo $form->textArea($model,'Plot',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Poster'); ?>
		<?php echo $form->textField($model,'Poster',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Poster_original'); ?>
		<?php echo $form->textField($model,'Poster_original',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Backdrop'); ?>
		<?php echo $form->textField($model,'Backdrop',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Backdrop_original'); ?>
		<?php echo $form->textField($model,'Backdrop_original',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Runtime'); ?>
		<?php echo $form->textField($model,'Runtime',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Rating'); ?>
		<?php echo $form->textField($model,'Rating'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Votes'); ?>
		<?php echo $form->textField($model,'Votes',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Response'); ?>
		<?php echo $form->textField($model,'Response',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Id_parent'); ?>
		<?php echo $form->textField($model,'Id_parent',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'season'); ?>
		<?php echo $form->textField($model,'season'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'episode'); ?>
		<?php echo $form->textField($model,'episode'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->