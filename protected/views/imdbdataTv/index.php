
<div class="serie-title-index">
	Series
	
	<div class="index-searchbox">
		<input type="text" name="index_search" id="index_search" placeholder="<?php echo CHtml::decode("Search by title, actors, directors, genre...")?>" autocomplete="off">
	</div>	
</div>

<div id="imdbTv_index" class="serie-index">

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
	'summaryText' =>"",
	'pager'=>array('cssFile'=>Yii::app()->baseUrl.'/css/pager-custom.css','header'=>''),

)); ?>
</div>
<?php 
Yii::app()->clientScript->registerScript(__CLASS__.'#ImdbdataTv_index', "
$('#index_search').change(
					function(){
					$.post('".ImdbdataController::createUrl('AjaxSearch')."',
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