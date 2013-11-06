
<?php 
Yii::app()->clientScript->registerScript('update-my-movie', "
		$('#actors').select2({tags:[],tokenSeparators: [',']});
		$('#directors').select2({tags:[],tokenSeparators: [',']});
		$('#genres').select2({tags:[],tokenSeparators: [',']});
		
		$.ajax({
	   		type: 'POST',
	   		url: '". SiteController::createUrl('AjaxGenres') . "',
	   		data: {id:'".$model->Id."',sourceType:".$sourceType.",idResource:".$idResource.",type:'Actor'},
	   		dataType: 'json'
	 	}).success(function(data)
	 	{	
	   		vals = '';
	   		first = true;
			for (var i in data) {
				item = data[i];
				if(first)
   				{
	   				first = false;
	   				vals = item;
				}
	   			else
	   			{
	   				vals = vals+','+item;
	   			}
			} 				
			$('#genres').select2({tags:data,tokenSeparators: [',']});
	   		$('#genres').val(vals).trigger('change');
			$('#input_genres').val(vals);	   						   				
		}
	 	);
		$('#genres').on('change',function(e){ $('#input_genres').val(e.val);});
	   				
		$.ajax({
	   		type: 'POST',
	   		url: '". SiteController::createUrl('AjaxGetPersons') . "',
	   		data: {id:'".$model->Id."',sourceType:".$sourceType.",idResource:".$idResource.",type:'Actor'},
	   		dataType: 'json'
	 	}).success(function(data)
	 	{	
	   		vals = '';
	   		first = true;
			for (var i in data) {
				item = data[i];
				if(first)
   				{
	   				first = false;
					vals = item.id;
				}
	   			else
	   			{
	   				vals = vals+','+item.id;
	   			}
			} 				
	   		//alert(data[0].id);
			$('#actors').select2({tags:data,tokenSeparators: [',']});
	   		$('#actors').val(vals).trigger('change');
			$('#input_actors').val(vals);	   						   				
		}
	 	);
		$('#actors').on('change',function(e){ $('#input_actors').val(e.val);});
		$.ajax({
	   		type: 'POST',
	   		url: '". SiteController::createUrl('AjaxGetPersons') . "',
	   		data: {id:'".$model->Id."',sourceType:".$sourceType.",idResource:".$idResource.",type:'Director'},
	   		dataType: 'json'
	 	}).success(function(data)
	 	{	 				
	   		vals = '';
	   		first = true;
			for (var i in data) {
				item = data[i];
				if(first)
   				{
	   				first = false;
					vals = item.id;
				}
	   			else
	   			{
	   				vals = vals+','+item.id;
	   			}
			} 				
	   		//alert(data[0].id);
			$('#directors').select2({tags:data,tokenSeparators: [',']});
	   		$('#directors').val(vals).trigger('change');
	   		$('#input_directors').val(vals);	
	   					   				
		}
	 	);
		$('#directors').on('change',function(e){ $('#input_directors').val(e.val);});
	   				
		");
?>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'my-movie-form',
	'enableAjaxValidation'=>false,
)); 
	echo CHtml::hiddenField('idResource',$idResource);
	echo CHtml::hiddenField('sourceType',$sourceType);
	echo CHtml::hiddenField('id_my_movie',$model->Id);	
	echo CHtml::hiddenField('input_actors');
	echo CHtml::hiddenField('input_genres');	
	echo CHtml::hiddenField('input_directors');	
	?>

	<div class="row">
	<?php echo $form->labelEx($model,'original_title'); ?>
		<?php echo $form->textField($model,'original_title'); ?>
	</div>

	<div class="row">
		<?php 
		$yearNow = date("Y");
		$yearFrom = $yearNow - 100;
		$yearTo = $yearNow;
		$arrYears = array();
		foreach (range($yearFrom, $yearTo) as $number) {
			$arrYears[$number] = $number; 
		}
		$arrYears = array_reverse($arrYears, true);
		?>
		<?php echo $form->labelEx($model,'production_year'); ?>
		<?php echo $form->dropDownList($model,'production_year',$arrYears); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'running_time'); ?>
		<?php echo $form->textField($model,'running_time',array('size'=>10,'maxlength'=>10)); ?>
	</div>
	<div class="row">
		<?php echo CHtml::label('SINÓPSIS',get_class($model).'_description'); ?>
		<?php echo $form->textArea($model,'description',array('style'=>"width:600px;height:200px")); ?>
	</div>
	<div class="row">
		<?php echo CHtml::label('Parental Control',get_class($model).'_Id_parental_control'); ?>
		<?php
		$parentalControl=ParentalControl::model()->findAll();
		$list= CHtml::listData(
		$parentalControl, 'Id', 'description');
		echo $form->dropDownList($model,'Id_parental_control',$list); 
		?>
	</div>
	<div class="row">
		<?php echo CHtml::label('Director','s2id_directors'); ?>
	
	<div id="directors" style="width:200px">
    </div>
	</div>
	<div class="row">
		<?php echo CHtml::label('Actores','s2id_actors'); ?>
		<div id="actors" style="width:600px">
    </div>
	</div>
	<div class="row">
		<?php echo CHtml::label('Generos','s2id_genres'); ?>
		<div id="genres" style="width:600px">
    </div>
	</div>
	
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
		