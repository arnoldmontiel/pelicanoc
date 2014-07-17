<?php
$this->breadcrumbs=array(
	'Links'=>array('index'),
	$model->Id=>array('view','id'=>$model->Id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Link', 'url'=>array('index')),
	array('label'=>'Create Link', 'url'=>array('create')),
	array('label'=>'View Link', 'url'=>array('view', 'id'=>$model->Id)),
	array('label'=>'Manage Link', 'url'=>array('admin')),
);
?>

<h1>Update Link <?php echo $model->Id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>