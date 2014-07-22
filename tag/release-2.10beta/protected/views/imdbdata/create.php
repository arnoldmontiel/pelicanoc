<?php
$this->breadcrumbs=array(
	'Imdbdatas'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Imdbdata', 'url'=>array('index')),
	array('label'=>'Manage Imdbdata', 'url'=>array('admin')),
);
?>

<h1>Create Imdbdata</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>