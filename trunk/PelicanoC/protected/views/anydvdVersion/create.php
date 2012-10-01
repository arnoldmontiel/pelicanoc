<?php
$this->breadcrumbs=array(
	'Anydvd Versions'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List AnydvdVersion', 'url'=>array('index')),
	array('label'=>'Manage AnydvdVersion', 'url'=>array('admin')),
);
?>

<h1>Create AnydvdVersion</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>