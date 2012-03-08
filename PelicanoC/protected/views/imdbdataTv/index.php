<?php
$this->breadcrumbs=array(
	'Imdbdata Tvs',
);

$this->menu=array(
	array('label'=>'Create ImdbdataTv', 'url'=>array('create')),
	array('label'=>'Manage ImdbdataTv', 'url'=>array('admin')),
);
?>

<h1>Imdbdata Tvs</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
