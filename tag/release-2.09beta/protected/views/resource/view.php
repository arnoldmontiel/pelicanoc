<?php
$this->breadcrumbs=array(
	'Resources'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Resource', 'url'=>array('index')),
	array('label'=>'Create Resource', 'url'=>array('create')),
	array('label'=>'Update Resource', 'url'=>array('update', 'id'=>$model->Id)),
	array('label'=>'Delete Resource', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->Id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Resource', 'url'=>array('admin')),
);
?>

<h1>View Resource #<?php echo $model->Id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'Id',
		'name',
		'type',
		'description',
	),
)); ?>
