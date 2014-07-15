<?php
$this->breadcrumbs=array(
	'Settings Rippers'=>array('index'),
	$model->Id,
);

$this->menu=array(
	array('label'=>'List SettingsRipper', 'url'=>array('index')),
	array('label'=>'Create SettingsRipper', 'url'=>array('create')),
	array('label'=>'Update SettingsRipper', 'url'=>array('update', 'id'=>$model->Id)),
	array('label'=>'Delete SettingsRipper', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->Id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage SettingsRipper', 'url'=>array('admin')),
);
?>

<h1>View SettingsRipper #<?php echo $model->Id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'Id',
		'drive_letter',
		'temp_folder_ripping',
		'final_folder_ripping',
		'time_from_reboot',
		'time_to_reboot',
		'mymovies_username',
		'mymovies_password',
	),
)); ?>
