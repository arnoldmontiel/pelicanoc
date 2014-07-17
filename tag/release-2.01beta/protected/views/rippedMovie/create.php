<?php
$this->breadcrumbs=array(
	'Ripped Movies'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List RippedMovie', 'url'=>array('index')),
	array('label'=>'Manage RippedMovie', 'url'=>array('admin')),
);
?>

<h1>Create RippedMovie</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>