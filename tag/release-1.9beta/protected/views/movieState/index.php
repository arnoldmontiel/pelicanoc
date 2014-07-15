<?php
$this->breadcrumbs=array(
	'Movie States',
);

$this->menu=array(
	array('label'=>'Create MovieState', 'url'=>array('create')),
	array('label'=>'Manage MovieState', 'url'=>array('admin')),
);
?>

<h1>Movie States</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
