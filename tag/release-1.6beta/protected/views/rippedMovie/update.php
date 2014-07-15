<?php
$this->breadcrumbs=array(
	'Ripped Movies'=>array('index'),
	$model->Id=>array('view','id'=>$model->Id),
	'Update',
);

$this->menu=array(
	array('label'=>'List RippedMovie', 'url'=>array('index')),
	array('label'=>'Create RippedMovie', 'url'=>array('create')),
	array('label'=>'View RippedMovie', 'url'=>array('view', 'id'=>$model->Id)),
	array('label'=>'Manage RippedMovie', 'url'=>array('admin')),
);
?>

<h1>Update RippedMovie <?php echo $model->Id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>