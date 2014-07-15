
<div id="conteiner" class="movie-view" style="">

<div class="rip-layout-left">
	<div style="width: 205px; float:left;">
		<?php echo CHtml::image( "images/".$model->poster, $model->name,array('id'=>'Imdbdata_Poster_img', 'style'=>'height: 290px;width: 190px;margin: 5px 5px 5px 7px;')); ?>
	</div>
</div>
<div class="rip-layout-centre">
	<div style="float: left;padding: 5px 10px;">
	<?php echo CHtml::openTag('div',array('class'=>'movie-title'));?>
			<?php echo $model->name; ?>
		<?php echo CHtml::closeTag('div');?> 
	<br>
	<?php echo CHtml::openTag('div');?>
		<?php echo CHtml::openTag('b');?>
			<?php echo $model->getAttributeLabel('Description').':'; ?>
		<?php echo CHtml::closeTag('b');?>
		<?php echo $model->description; ?>		
	<?php echo CHtml::closeTag('div');?> 
	
	<?php echo CHtml::openTag('div');?>
			<?php echo CHtml::openTag('b');?>
				<?php echo $model->getAttributeLabel('Genre').':'; ?>
			<?php echo CHtml::closeTag('b');?>
			<?php echo $model->genre; ?>
	<?php echo CHtml::closeTag('div');?> 
		
	<?php echo CHtml::openTag('div');?>
		<?php echo CHtml::openTag('b');?>
			<?php echo $model->getAttributeLabel('Rating').':'; ?>
		<?php echo CHtml::closeTag('b');?>
		<?php echo $model->rating; ?>
	<?php echo CHtml::closeTag('div');?> 

	<?php echo CHtml::openTag('div');?>
		<?php echo CHtml::openTag('b');?>
			<?php echo $model->getAttributeLabel('Network').':'; ?>
		<?php echo CHtml::closeTag('b');?>
		<?php echo $model->original_network; ?>
	<?php echo CHtml::closeTag('div');?> 
	
	<?php echo CHtml::openTag('div');?>
		<?php echo CHtml::openTag('b');?>
			<?php echo $model->getAttributeLabel('Status').':'; ?>
		<?php echo CHtml::closeTag('b');?>
		<?php echo $model->original_status; ?>
	<?php echo CHtml::closeTag('div');?> 
	
	</div>		
	
</div>
<div class="rip-layout-right">
	
</div>
	
<div class="rip-layout-footer" >
	 <?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
	'id'=>'listMovies-view',
	'summaryText' =>"",
	'pager'=>array('cssFile'=>Yii::app()->baseUrl.'/css/pager-custom.css','header'=>''),
	'afterAjaxUpdate'=>'js:function(id, data){
					$("#" + id).find(".id_rippedMovie").each(
						function(index, item){
							$("#Imdbdata_Poster_button_" + $(item).val()).click(function(){
															}
										var url = "'.RippedMovieController::CreateUrl('rippedMovie/view') .'";
 										var param = "&id="+$(item).val();
 										window.location = url + param;
 										return false;
	 
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
// 										var url = "'.RippedMovieController::CreateUrl('rippedMovie/view') .'";
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
</div>
<?php
Yii::app()->clientScript->registerScript(__CLASS__.'#SerieView', "
	
	$('.leftcurtain').addClass('showLeftCurtian');
	$('.rightcurtain').addClass('showRightCurtian');
	OpenCurtains(2000);
");
?>
	
	
	