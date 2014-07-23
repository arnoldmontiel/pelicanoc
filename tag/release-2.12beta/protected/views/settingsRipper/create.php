<?php
$this->breadcrumbs=array(
	'Settings Rippers'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List SettingsRipper', 'url'=>array('index')),
	array('label'=>'Manage SettingsRipper', 'url'=>array('admin')),
);
?>

<h1>Create SettingsRipper</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>