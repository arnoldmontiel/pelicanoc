<?php
$this->breadcrumbs=array(
	'Imdbdata Tvs'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ImdbdataTv', 'url'=>array('index')),
	array('label'=>'Manage ImdbdataTv', 'url'=>array('admin')),
);
?>

<h1>Create ImdbdataTv</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>