<?php
$this->breadcrumbs=array(
	'Resource Types'=>array('index'),
	$model->Id,
);

$this->menu=array(
	array('label'=>'List ResourceType', 'url'=>array('index')),
	array('label'=>'Create ResourceType', 'url'=>array('create')),
	array('label'=>'Update ResourceType', 'url'=>array('update', 'id'=>$model->Id)),
	array('label'=>'Delete ResourceType', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->Id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ResourceType', 'url'=>array('admin')),
);
?>

<h1>View ResourceType #<?php echo $model->Id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'Id',
		'description',
	),
)); ?>
