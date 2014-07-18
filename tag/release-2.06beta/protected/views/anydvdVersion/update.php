<?php
$this->breadcrumbs=array(
	'Anydvd Versions'=>array('index'),
	$model->Id=>array('view','id'=>$model->Id),
	'Update',
);

$this->menu=array(
	array('label'=>'List AnydvdVersion', 'url'=>array('index')),
	array('label'=>'Create AnydvdVersion', 'url'=>array('create')),
	array('label'=>'View AnydvdVersion', 'url'=>array('view', 'id'=>$model->Id)),
	array('label'=>'Manage AnydvdVersion', 'url'=>array('admin')),
);
?>

<h1>Update AnydvdVersion <?php echo $model->Id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>