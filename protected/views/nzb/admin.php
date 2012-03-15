<?php
$this->breadcrumbs=array(
	'Nzbs'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Nzb', 'url'=>array('index')),
	array('label'=>'Create Nzb', 'url'=>array('create')),
);

?>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'nzb-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'Id',
		'url',
		'downloaded',
		'path',
		'description',
		'file_name',
		/*
		'Id_imdbdata',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
