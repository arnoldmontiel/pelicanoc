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
	'id'=>'listEpisodes-view',
	'pager'=>array('cssFile'=>Yii::app()->baseUrl.'/css/pager-custom.css','header'=>''),
	'afterAjaxUpdate'=>'js:function(id, data){
					$("#" + id).find(".id_nzb").each(
						function(index, item){
							//debugger;
							//$(item).find(".keys").text()
							$("#Imdbdata_tv_Poster_button_" + $(item).val()).click(function(){
								//CloseCurtains();
								
								//set top scroll position
								$(".leftcurtain").css("top",$(document).scrollTop());
								$(".rightcurtain").css("top",$(document).scrollTop());
								
								//hidde scroll
								$(document.body).attr("style","overflow:hidden");
		
								$(".leftcurtain").removeClass("hideClass");
								$(".rightcurtain").removeClass("hideClass");
								
								$(".leftcurtain").stop().animate({width:"50%"}, 2000 );
								$(".rightcurtain").stop().animate({width:"51%"}, 2000 ,
									function(){
										var url = "'.ImdbdataController::CreateUrl('imdbdataTv/viewEpisode') .'";
										var param = "&id="+$(item).val();
										window.location = url + param;
										OpenCurtains(10000);
										//show scroll			
										$(document.body).attr("style","overflow:auto");
										return false;
									}
								);
							}
							)
						}
					)
				}',

)); 
?>
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
					var season = 'season=' + $(this).html();
					$.fn.yiiListView.update('listEpisodes-view',{data:season});

});

");
?>