<?php
$this->breadcrumbs=array(
	'Resource Types'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ResourceType', 'url'=>array('index')),
	array('label'=>'Manage ResourceType', 'url'=>array('admin')),
);
?>

<h1>Create ResourceType</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>