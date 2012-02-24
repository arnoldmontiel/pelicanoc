<div class="form">
<?php

Yii::app()->clientScript->registerScript(__CLASS__.'#imdbdata', "
function fillIMDBDataField(data)
{
	$('#Imdbdata_ID').val(data.ID);
	$('#Imdbdata_Year').val(data.Year);
	$('#Imdbdata_Title').val(data.Title);
	$('#Imdbdata_Rated').val(data.Rated);
	$('#Imdbdata_Released').val(data.Released);
	$('#Imdbdata_Genre').val(data.Genre);
	$('#Imdbdata_Director').val(data.Director);
	$('#Imdbdata_Writer').val(data.Writer);
	$('#Imdbdata_Actors').val(data.Actors);
	$('#Imdbdata_Plot').val(data.Plot);
	$('#Imdbdata_Runtime').val(data.Runtime);
	$('#Imdbdata_Rating').val(data.Rating);
	$('#Imdbdata_Votes').val(data.Votes);
	$('#Imdbdata_Response').val(data.Response);
	$('#Imdbdata_Poster').val(data.Poster);
	$('#Imdbdata_Poster_img').attr('alt',data.Title);
	$('#Imdbdata_Poster_img').attr('src',data.Poster);

}
$('#Imdbdata_ID').change(function(){
$(this).addClass('input-loading');
$.ajax({
      url: 'http://www.imdbapi.com/?i='+$(this).val(),
      dataType: 'jsonp',
      success: function(data) {
	      	fillIMDBDataField(data);
	      	$('#Imdbdata_ID').removeClass('input-loading');
		}
    });
});
$('#Imdbdata_Title').change(function(){
$(this).addClass('input-loading');
$.ajax({
      url: 'http://www.imdbapi.com/?t='+$(this).val(),
      dataType: 'jsonp',
      success:
      	function(data) {
      		fillIMDBDataField(data);
	      	$('#Imdbdata_Title').removeClass('input-loading');
		}
    });
});

");
?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'imdbdata-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
	<div id="conteiner" style="display: inline-block;">

	<div id="right" style="display: inline-block;">

	<div class="row">
		<?php echo $form->labelEx($model,'ID'); ?>
		<?php echo $form->textField($model,'ID',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'ID'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Title'); ?>
		<?php echo $form->textField($model,'Title',array('size'=>45,'maxlength'=>255)); ?>
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
		<?php echo $form->textField($model,'Genre',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'Genre'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Director'); ?>
		<?php echo $form->textField($model,'Director',array('size'=>45,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'Director'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Writer'); ?>
		<?php echo $form->textField($model,'Writer',array('size'=>45,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'Writer'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Actors'); ?>
		<?php echo $form->textArea($model,'Actors',array('rows'=>6, 'cols'=>40)); ?>
		<?php echo $form->error($model,'Actors'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Plot'); ?>
		<?php echo $form->textArea($model,'Plot',array('rows'=>6, 'cols'=>40)); ?>
		<?php echo $form->error($model,'Plot'); ?>
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

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>
	</div>
	<div id="left" style="display: inline-block; vertical-align: top;">
	
	<div class="row">
	<?php echo $form->labelEx($model,'Poster'); ?>
			<?php echo $form->textField($model,'Poster',array('size'=>45,'maxlength'=>255)); ?>
			<?php echo $form->error($model,'Poster'); ?>			
		</div>
			<?php echo CHtml::image( $model->Poster, $model->Title,array('id'=>'Imdbdata_Poster_img', 'style'=>'height: 320px;width: 220px;')); ?>
		
	</div>
	</div>
		

<?php $this->endWidget(); ?>

</div><!-- form -->