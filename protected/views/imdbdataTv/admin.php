<?php
$this->breadcrumbs=array(
	'Imdbdata Tvs'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List ImdbdataTv', 'url'=>array('index')),
	array('label'=>'Create ImdbdataTv', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('imdbdata-tv-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Imdbdata Tvs</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'imdbdata-tv-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'ID',
		'Title',
		'Year',
		'Rated',
		'Released',
		'Genre',
		/*
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
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
