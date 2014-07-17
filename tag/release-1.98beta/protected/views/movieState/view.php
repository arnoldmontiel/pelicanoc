<?php
$this->breadcrumbs=array(
	'Movie States'=>array('index'),
	$model->Id,
);

$this->menu=array(
	array('label'=>'List MovieState', 'url'=>array('index')),
	array('label'=>'Create MovieState', 'url'=>array('create')),
	array('label'=>'Update MovieState', 'url'=>array('update', 'id'=>$model->Id)),
	array('label'=>'Delete MovieState', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->Id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage MovieState', 'url'=>array('admin')),
);
?>

<h1>View MovieState #<?php echo $model->Id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'Id',
		'description',
	),
)); ?>
