
<?php if (Yii::app()->user->checkAccess('ImdbdataIndex')):?>

<div class="movie-title-index">
	Movies
	
</div>

<div id="imdb_index" class="movie-index">

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
	'summaryText' =>"",
	'pager'=>array('cssFile'=>Yii::app()->baseUrl.'/css/pager-custom.css','header'=>''),
	'pagerCssClass'=>'hideButton',

)); ?>
</div>
<?php endif?>

<?php if (Yii::app()->user->checkAccess('Installer')):
	echo CHtml::link('Customer',array('/customer/index'));
	echo '<br>';
	echo CHtml::link('Settings',array('/setting/index'));
	echo '<br>';
	echo CHtml::link('Get Reseller',array('/setting/getReseller'));
?>
<?php endif?>
<?php 
Yii::app()->clientScript->registerScript(__CLASS__.'#Imdbdata_view', "
");
?>

