<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'imdbdata-tv-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'ID'); ?>
		<?php echo $form->textField($model,'ID',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'ID'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Title'); ?>
		<?php echo $form->textField($model,'Title',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'Title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Year'); ?>
		<?php echo $form->textField($model,'Year'); ?>
		<?php echo $form->error($model,'Year'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Rated'); ?>
		<?php echo $form->textField($model,'Rated',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'Rated'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Released'); ?>
		<?php echo $form->textField($model,'Released',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'Released'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Genre'); ?>
		<?php echo $form->textField($model,'Genre',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'Genre'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Director'); ?>
		<?php echo $form->textField($model,'Director',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'Director'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Writer'); ?>
		<?php echo $form->textField($model,'Writer',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'Writer'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Actors'); ?>
		<?php echo $form->textArea($model,'Actors',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'Actors'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Plot'); ?>
		<?php echo $form->textArea($model,'Plot',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'Plot'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Poster'); ?>
		<?php echo $form->textField($model,'Poster',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'Poster'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Poster_original'); ?>
		<?php echo $form->textField($model,'Poster_original',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'Poster_original'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Backdrop'); ?>
		<?php echo $form->textField($model,'Backdrop',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'Backdrop'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Backdrop_original'); ?>
		<?php echo $form->textField($model,'Backdrop_original',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'Backdrop_original'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Runtime'); ?>
		<?php echo $form->textField($model,'Runtime',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'Runtime'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Rating'); ?>
		<?php echo $form->textField($model,'Rating'); ?>
		<?php echo $form->error($model,'Rating'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Votes'); ?>
		<?php echo $form->textField($model,'Votes',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'Votes'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Response'); ?>
		<?php echo $form->textField($model,'Response',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'Response'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Id_parent'); ?>
		<?php echo $form->textField($model,'Id_parent',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'Id_parent'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'season'); ?>
		<?php echo $form->textField($model,'season'); ?>
		<?php echo $form->error($model,'season'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'episode'); ?>
		<?php echo $form->textField($model,'episode'); ?>
		<?php echo $form->error($model,'episode'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->