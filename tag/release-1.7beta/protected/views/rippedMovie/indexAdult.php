<div class="movie-title-index">
	Ripped Movies
	
	<div class="index-searchbox">
		<input type="text" name="index_search" id="index_search" placeholder="<?php echo CHtml::decode("Search by title, actors, directors, genre...")?>" autocomplete="off">
	</div>	
</div>

<div id="imdb_index" class="movie-index">
<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_viewAdult',
	'id'=>'listMovies-view',
	'summaryText' =>"",
	'pager'=>array('cssFile'=>Yii::app()->baseUrl.'/css/pager-custom.css','header'=>''),
	'afterAjaxUpdate'=>'js:function(id, data){
					$("#" + id).find(".id_rippedMovie").each(
						function(index, item){
							$("#Imdbdata_Poster_button_" + $(item).val()).click(function(){
										var url = "'.RippedMovieController::CreateUrl('rippedMovie/viewAdult') .'";
										var param = "&id="+$(item).val();
										window.location = url + param;
										return false;
								}
								)
								}
								)
								}',

// 								//CloseCurtains();
								
// 								//set top scroll position
// 								$(".leftcurtain").css("top",$(document).scrollTop());
// 								$(".rightcurtain").css("top",$(document).scrollTop());
								
// 								//hidde scroll
// 								$(document.body).attr("style","overflow:hidden");
		
// 								$(".leftcurtain").removeClass("hideClass");
// 								$(".rightcurtain").removeClass("hideClass");
								
// 								$(".leftcurtain").stop().animate({width:"50%"}, 2000 );
// 								$(".rightcurtain").stop().animate({width:"51%"}, 2000 ,
// 									function(){
// 										var url = "'.RippedMovieController::CreateUrl('rippedMovie/viewAdult') .'";
// 										var param = "&id="+$(item).val();
// 										window.location = url + param;
// 										OpenCurtains(10000);
// 										//show scroll			
// 										$(document.body).attr("style","overflow:auto");
// 										return false;
// 									}
// 								);
// 							}
// 							)
// 						}
// 					)
// 				}',
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
