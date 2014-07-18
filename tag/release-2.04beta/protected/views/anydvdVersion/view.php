<?php
$this->breadcrumbs=array(
	'Anydvd Versions'=>array('index'),
	$model->Id,
);

$this->menu=array(
	array('label'=>'List AnydvdVersion', 'url'=>array('index')),
	array('label'=>'Create AnydvdVersion', 'url'=>array('create')),
	array('label'=>'Update AnydvdVersion', 'url'=>array('update', 'id'=>$model->Id)),
	array('label'=>'Delete AnydvdVersion', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->Id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage AnydvdVersion', 'url'=>array('admin')),
);
?>

<h1>View AnydvdVersion #<?php echo $model->Id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'Id',
		'version',
		'file_name',
	),
)); ?>
