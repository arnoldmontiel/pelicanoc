<div class="movie-title-index">
	Ripped
	
	<div class="index-searchbox">
		<input type="text" name="index_search" id="index_search" placeholder="<?php echo CHtml::decode("Search by title, actors, directors, genre...")?>" autocomplete="off">
	</div>	
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
	'onClickLocation'=>RippedMovieController::CreateUrl('rippedMovie/view'),
    'options'=>array(), // options for the isotope jquery
    'infiniteScroll'=>true, // default to true
    'infiniteOptions'=>array(), // javascript options for infinite scroller
    'id'=>'wall',
));

?>
</div>
<?php 
Yii::app()->clientScript->registerScript(__CLASS__.'#RippedMovie_index', "
$('#index_search').change(function(){	
 	var searchFilter = $(this).val().toLowerCase().trim().replace(/ /gi,'-');
 	$('#search-filter').val(searchFilter); 	 	
	$('#wall .items').infinitescroll('filterText');  
});
");
?>