<?php
$this->breadcrumbs=array(
	'Imdbdatas'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Imdbdata', 'url'=>array('index')),
	array('label'=>'Create Imdbdata', 'url'=>array('create')),
);
?>


<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'nzb-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'imdbData.ID',
		'imdbData.Title',
		'imdbData.Year',
//		'Rated',
//		'Released',
		'imdbData.Genre',
//		'Director',
//		'Writer',
//		'Actors',
//		'Plot',
//		'Poster',
//		'Runtime',
		'imdbData.Rating',
//		'Votes',
//		'Response',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
