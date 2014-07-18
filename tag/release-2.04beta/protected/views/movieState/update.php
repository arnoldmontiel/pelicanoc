<?php
$this->breadcrumbs=array(
	'Movie States'=>array('index'),
	$model->Id=>array('view','id'=>$model->Id),
	'Update',
);

$this->menu=array(
	array('label'=>'List MovieState', 'url'=>array('index')),
	array('label'=>'Create MovieState', 'url'=>array('create')),
	array('label'=>'View MovieState', 'url'=>array('view', 'id'=>$model->Id)),
	array('label'=>'Manage MovieState', 'url'=>array('admin')),
);
?>

<h1>Update MovieState <?php echo $model->Id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>