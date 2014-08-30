<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'tmdb-form',
		'enableAjaxValidation'=>false,
)); ?>

<?php

echo $form->hiddenField($model,'TMDB_id');
echo CHtml::hiddenField('idResource',$idResource);
echo CHtml::hiddenField('sourceType',$sourceType);

$posters= array();

//$posters[]=CHtml::image("./images/".$myMovie->poster,'',array("style"=>'width:154px'));
$first = true;
foreach ($images as $image)
{
	if($first===true)
	{
		$first = $image->file_path;
	}
	$posters[$image->file_path]=CHtml::image($image->file_path);
}
echo CHtml::radioButtonList("poster",$first,$posters,
		array('labelOptions'=>array('style'=>'display:inline;')
				));
echo "<br>";
$backs= array();

//$backs[]=CHtml::image("./images/".$myMovie->backdrop,'',array("style"=>'width:300px'));

$first = true;
foreach ($bds as $bd)
{
	if($first===true)
	{
		$first = $bd->file_path;
	}
	$backs [$bd->file_path] =CHtml::image($bd->file_path);
}
echo CHtml::radioButtonList("backdrop",$first,$backs);

?>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Save',array('id'=>'save')); ?>
	</div>

<?php $this->endWidget(); ?>

