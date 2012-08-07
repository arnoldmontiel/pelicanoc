<div class="movie-title-index">
	Ripped Movies
	
	<div class="index-searchbox">
		<input type="text" name="index_search" id="index_search" placeholder="<?php echo CHtml::decode("Search by title, actors, directors, genre...")?>" autocomplete="off">
	</div>	
</div>

<div id="imdb_index" class="movie-index">
<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
	'id'=>'listMovies-view',
	'summaryText' =>"",
)); ?>
</div>
<?php 
Yii::app()->clientScript->registerScript(__CLASS__.'#RippedMovie_index', "
$('#index_search').change(
					function(){
					var searchFilter = 'searchFilter=' + $(this).val();
					$.fn.yiiListView.update('listMovies-view',{data:searchFilter});
				});
");
?>