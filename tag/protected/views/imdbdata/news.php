<div class="movie-title-index" id="title-news">
	
	<div id="movie-title-index-loading" style="display:inline-block; float:left; padding-right: 10px;">&nbsp;</div>
	<div style="display:inline-block; float:left;">News</div>
	<div class="index-searchbox">
		<input type="text" name="index_search" id="index_search" placeholder="<?php echo CHtml::decode("Search by title, actors, directors, genre...")?>" autocomplete="off">
	</div>	
</div>

<div id="imdb_news" class="movie-index">
<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
	'summaryText' =>"",
	'pager'=>array('cssFile'=>Yii::app()->baseUrl.'/css/pager-custom.css','header'=>''),
)); ?>
</div>
<?php 
Yii::app()->clientScript->registerScript(__CLASS__.'#Imdbdata_news', "
$('#index_search').change(
					function(){
					$.post('".ImdbdataController::createUrl('AjaxNewsSearch')."',
							{imdb_search_field: $(this).val()}
					).success(
						function(data) 
						{
 							$('#imdb_news').html(data);
						}
					);
				});
");
Yii::app()->clientScript->registerScript(__CLASS__.'#Imdbdata_news_ready', "
$('#movie-title-index-loading').addClass('input-loading');
$.post('".ImdbdataController::createUrl('AjaxGetNews')."').success(
	function(data) 
	{
		$('#imdb_news').html(data);
		$('#movie-title-index-loading').removeClass('input-loading');
	}
)",CClientScript::POS_READY);
?>