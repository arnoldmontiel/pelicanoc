
<div class="movie-title-index">
	Movies
	
	<div class="index-searchbox">
		<input type="text" name="index_search" id="index_search" placeholder="<?php echo CHtml::decode("Search by title, actors, directors, genre...")?>" autocomplete="off">
	</div>	
</div>

<div id="imdb_index" class="movie-index">

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_viewRequested',
	'summaryText' =>"",
	'pager'=>array('cssFile'=>Yii::app()->baseUrl.'/css/pager-custom.css','header'=>''),

)); ?>
</div>
<?php 
Yii::app()->clientScript->registerScript(__CLASS__.'#Imdbdata_index', "
$('#index_search').change(
					function(){
					$.post('".NzbController::createUrl('AjaxRequestedSearch')."',
							{imdb_search_field: $(this).val()}
					).success(
						function(data) 
						{
 							$('#imdb_index').html(data);
						}
					);
				});
");
?>