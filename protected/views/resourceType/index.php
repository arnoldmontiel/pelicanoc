<?php
$this->breadcrumbs=array(
	'Resource Types',
);

$this->menu=array(
	array('label'=>'Create ResourceType', 'url'=>array('create')),
	array('label'=>'Manage ResourceType', 'url'=>array('admin')),
);
?>

<h1>Resource Types</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
