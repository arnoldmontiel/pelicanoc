<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'tmdb-form',
		'enableAjaxValidation'=>false,
)); ?>

<?php

//echo $form->hiddenField($model,'TMDB_id');
echo CHtml::hiddenField('idResource',$idResource);
echo CHtml::hiddenField('sourceType',$sourceType);
echo CHtml::hiddenField('idMyMovie',$myMovie->Id);

echo $myMovie->original_title." (".$myMovie->production_year.")";
echo "<br>";

//var_dump($movies);
$moviesList = array();
$first = true;
foreach ($movies as $movie)
{
	if($first===true)
	{
		$first = $movie->id;
	}
	$date = date_parse($movie->release_date);
	$moviesList[$movie->id]=$movie->original_title." (".$date['year'].")";
}
echo CHtml::radioButtonList("movie",$first,$moviesList,
		array('labelOptions'=>array('style'=>'display:inline;')
		));
echo "<br>";


?>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Save',array('id'=>'save')); ?>
	</div>

<?php $this->endWidget(); ?>

