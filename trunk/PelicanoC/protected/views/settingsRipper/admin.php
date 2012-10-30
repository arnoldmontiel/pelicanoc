<?php
$this->breadcrumbs=array(
	'Settings Rippers'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List SettingsRipper', 'url'=>array('index')),
	array('label'=>'Create SettingsRipper', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('settings-ripper-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Settings Rippers</h1>

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
	'id'=>'settings-ripper-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'Id',
		'drive_letter',
		'temp_folder_ripping',
		'final_folder_ripping',
		'time_from_reboot',
		'time_to_reboot',
		/*
		'mymovies_username',
		'mymovies_password',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
