<?php
$this->breadcrumbs=array(
	'Imdbdata Tvs'=>array('index'),
	$model->Title,
);

$this->menu=array(
	array('label'=>'List ImdbdataTv', 'url'=>array('index')),
	array('label'=>'Create ImdbdataTv', 'url'=>array('create')),
	array('label'=>'Update ImdbdataTv', 'url'=>array('update', 'id'=>$model->ID)),
	array('label'=>'Delete ImdbdataTv', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ImdbdataTv', 'url'=>array('admin')),
);
?>

<h1>View ImdbdataTv #<?php echo $model->ID; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'ID',
		'Title',
		'Year',
		'Rated',
		'Released',
		'Genre',
		'Director',
		'Writer',
		'Actors',
		'Plot',
		'Poster',
		'Poster_original',
		'Backdrop',
		'Backdrop_original',
		'Runtime',
		'Rating',
		'Votes',
		'Response',
		'Id_parent',
		'season',
		'episode',
	),
)); ?>
