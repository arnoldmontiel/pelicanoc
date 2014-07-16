<?php
$this->breadcrumbs=array(
	'Settings Rippers',
);

$this->menu=array(
	array('label'=>'Create SettingsRipper', 'url'=>array('create')),
	array('label'=>'Manage SettingsRipper', 'url'=>array('admin')),
);
?>

<h1>Settings Rippers</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
