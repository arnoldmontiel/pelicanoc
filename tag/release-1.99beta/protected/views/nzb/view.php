<?php
$this->breadcrumbs=array(
	'Nzbs'=>array('index'),
	$model->Id,
);

$this->menu=array(
	array('label'=>'List Nzb', 'url'=>array('index')),
	array('label'=>'Create Nzb', 'url'=>array('create')),
	array('label'=>'Update Nzb', 'url'=>array('update', 'id'=>$model->Id)),
	array('label'=>'Delete Nzb', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->Id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Nzb', 'url'=>array('admin')),
);
?>


<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'Id',
		'url',
		'downloaded',
		'path',
		'description',
		'file_name',
		'Id_imdbdata',
	),
)); ?>
