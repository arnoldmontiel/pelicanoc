
<div class="movie-title-index">
	
	
</div>

<div id="imdb_index" class="movie-index">

<?php 

echo CHtml::hiddenField("media-type-filter","*",array('Id'=>'media-type-filter'));
echo CHtml::hiddenField("current-filter","*",array('Id'=>'current-filter'));
echo CHtml::hiddenField("search-filter","",array('Id'=>'search-filter'));

$this->widget('ext.isotope.Isotope',array(
    'dataProvider'=>$dataProvider,
    'itemView'=>'_view',
    'itemSelectorClass'=>'item',
	'summaryText' =>"",
    'options'=>array(), // options for the isotope jquery
    'infiniteScroll'=>true, // default to true
    'infiniteOptions'=>array(), // javascript options for infinite scroller
    'id'=>'wall',
));
?>
</div>

<?php 
Yii::app()->clientScript->registerScript(__CLASS__.'#Imdbdata_view', "
");
?>

