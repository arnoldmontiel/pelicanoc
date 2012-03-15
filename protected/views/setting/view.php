<?php
$this->breadcrumbs=array(
	'Settings'=>array('index'),
	$model->Id,
);

$this->menu=array(
	array('label'=>'List Setting', 'url'=>array('index')),
	array('label'=>'Create Setting', 'url'=>array('create')),
	array('label'=>'Update Setting', 'url'=>array('update', 'id'=>$model->Id)),
	array('label'=>'Delete Setting', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->Id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Setting', 'url'=>array('admin')),
);
?>

<h1>View Setting #<?php echo $model->Id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'Id',
		'path_pending',
		'Id_customer',
		'sabnzb_api_key',
		'sabnzb_api_url',
		'host_name',
		'path_ready',
		'path_subtitle',
		'path_images',
		'path_shared',
	),
)); ?>
