<?php
$this->breadcrumbs=array(
	'Resources'=>array('index'),
	$model->name=>array('view','id'=>$model->Id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Resource', 'url'=>array('index')),
	array('label'=>'Create Resource', 'url'=>array('create')),
	array('label'=>'View Resource', 'url'=>array('view', 'id'=>$model->Id)),
	array('label'=>'Manage Resource', 'url'=>array('admin')),
);
?>

<h1>Update Resource <?php echo $model->Id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>