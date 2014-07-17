<?php
$this->breadcrumbs=array(
	'Resource Types'=>array('index'),
	$model->Id=>array('view','id'=>$model->Id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ResourceType', 'url'=>array('index')),
	array('label'=>'Create ResourceType', 'url'=>array('create')),
	array('label'=>'View ResourceType', 'url'=>array('view', 'id'=>$model->Id)),
	array('label'=>'Manage ResourceType', 'url'=>array('admin')),
);
?>

<h1>Update ResourceType <?php echo $model->Id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>