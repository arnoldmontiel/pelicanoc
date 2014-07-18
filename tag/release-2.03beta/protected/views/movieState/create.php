<?php
$this->breadcrumbs=array(
	'Movie States'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List MovieState', 'url'=>array('index')),
	array('label'=>'Manage MovieState', 'url'=>array('admin')),
);
?>

<h1>Create MovieState</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>