<?php
$this->breadcrumbs=array(
	'Settings Rippers'=>array('index'),
	$model->Id=>array('view','id'=>$model->Id),
	'Update',
);

$this->menu=array(
	array('label'=>'List SettingsRipper', 'url'=>array('index')),
	array('label'=>'Create SettingsRipper', 'url'=>array('create')),
	array('label'=>'View SettingsRipper', 'url'=>array('view', 'id'=>$model->Id)),
	array('label'=>'Manage SettingsRipper', 'url'=>array('admin')),
);
?>

<h1>Update SettingsRipper <?php echo $model->Id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>