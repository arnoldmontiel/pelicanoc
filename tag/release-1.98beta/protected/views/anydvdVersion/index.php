<?php
$this->breadcrumbs=array(
	'Anydvd Versions',
);

$this->menu=array(
	array('label'=>'Create AnydvdVersion', 'url'=>array('create')),
	array('label'=>'Manage AnydvdVersion', 'url'=>array('admin')),
);
?>

<h1>Anydvd Versions</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
