<?php
$this->breadcrumbs=array(
	'Imdbdatas'=>array('index'),
	$model->Title=>array('view','id'=>$model->ID),
	'Update',
);

$this->menu=array(
	array('label'=>'List Imdbdata', 'url'=>array('index')),
	array('label'=>'Create Imdbdata', 'url'=>array('create')),
	array('label'=>'View Imdbdata', 'url'=>array('view', 'id'=>$model->ID)),
	array('label'=>'Manage Imdbdata', 'url'=>array('admin')),
);
?>

<h1>Update Imdbdata <?php echo $model->ID; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>