<?php
$this->breadcrumbs=array(
	'Imdbdata Tvs'=>array('index'),
	$model->Title=>array('view','id'=>$model->ID),
	'Update',
);

$this->menu=array(
	array('label'=>'List ImdbdataTv', 'url'=>array('index')),
	array('label'=>'Create ImdbdataTv', 'url'=>array('create')),
	array('label'=>'View ImdbdataTv', 'url'=>array('view', 'id'=>$model->ID)),
	array('label'=>'Manage ImdbdataTv', 'url'=>array('admin')),
);
?>

<h1>Update ImdbdataTv <?php echo $model->ID; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>