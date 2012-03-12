<div class="serie-title-index">
	<?php echo $model->Title;?>	
	<div id="seasons-index" class="view-serie-season-index">
		<?php
		$first = true;
		foreach ($model->seasons as $season)
		{
			if($first)
			{
				$first = false;				
				echo CHtml::openTag('div',array("class"=>"view-serie-season-button view-serie-season-button-selected"));
			}
			else
			{
				echo CHtml::openTag('div',array("class"=>"view-serie-season-button"));
					
			}
			echo $season->season; 
			echo CHtml::closeTag('div');
			
		}
		?>
	</div>
	<div class="view-serie-season-index-title">
		Season:
	</div>

</div>

<div id="imdbTv_index" class="serie-index">

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_viewEpisode',
	'summaryText' =>"",
	'pager'=>array('cssFile'=>Yii::app()->baseUrl.'/css/pager-custom.css','header'=>''),

)); ?>
</div>
<?php 
Yii::app()->clientScript->registerScript(__CLASS__.'#ImdbdataTv_index', "
$('.view-serie-season-button').mouseover(
	function(){
		$(this).addClass('view-serie-season-button-hover');
	}
).mouseout(
	function(){
		$(this).removeClass('view-serie-season-button-hover');
  	}
);
$('.view-serie-season-button').click(function(){
					$('#seasons-index').children().removeClass('view-serie-season-button-selected');
					$(this).addClass('view-serie-season-button-selected');
					$.post('".ImdbdataTvController::createUrl('AjaxChangeSeason')."',
							{id_imdbdata_tv_parent:'".$model->ID."' ,season_id: $(this).html()}
					).success(
						function(data) 
						{
 							$('#imdbTv_index').html(data);
						}
)});

");
?>