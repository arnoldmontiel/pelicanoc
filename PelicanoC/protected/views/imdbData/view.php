<?php
// $this->breadcrumbs=array(
// 	'Imdbdatas'=>array('index'),
// 	$modelImdbdata->Title,
// );
?>

<div id="conteiner" class="movie-view" style="">

	<div style="width: 205px; float:left;">
		<?php echo CHtml::image( "images/".$modelImdbdata->Poster, $modelImdbdata->Title,array('id'=>'Imdbdata_Poster_img', 'style'=>'height: 290px;width: 190px;margin: 5px 5px 5px 7px;')); ?>

	</div>
	<div style="float: left;padding: 5px 10px; width: 50%">
	<?php echo CHtml::openTag('div',array('class'=>'movie-title'));?>
			<?php echo $modelImdbdata->Title; ?>
		<?php echo CHtml::closeTag('div');?> 
		
	<?php echo CHtml::openTag('div');?>
		<?php echo $modelImdbdata->Year; ?>
	<?php echo CHtml::closeTag('div');?> 

	<?php echo CHtml::openTag('div');?>
		<?php echo CHtml::openTag('b');?>
			<?php echo $modelImdbdata->getAttributeLabel('Genre').':'; ?>
		<?php echo CHtml::closeTag('b');?>
		<?php echo $modelImdbdata->Genre; ?>		
	<?php echo CHtml::closeTag('div');?> 
	
	<?php echo CHtml::openTag('div');?>
		<?php echo CHtml::openTag('b');?>
			<?php echo $modelImdbdata->getAttributeLabel('Director').':'; ?>
		<?php echo CHtml::closeTag('b');?>
		<?php echo $modelImdbdata->Director; ?>
	<?php echo CHtml::closeTag('div');?> 

	<?php echo CHtml::openTag('div');?>
		<?php echo CHtml::openTag('b');?>
			<?php echo $modelImdbdata->getAttributeLabel('Plot').':'; ?>
		<?php echo CHtml::closeTag('b');?>
		<?php echo $modelImdbdata->Plot; ?>
	<?php echo CHtml::closeTag('div');?> 
	<?php echo CHtml::openTag('div');?>
			<?php echo CHtml::openTag('b');?>
				<?php echo $modelImdbdata->getAttributeLabel('Actors').':'; ?>
			<?php echo CHtml::closeTag('b');?>
			<?php echo $modelImdbdata->Actors; ?>
		<?php echo CHtml::closeTag('div');?> 
		
	<?php 

	// 	$this->widget('zii.widgets.CDetailView', array(
// 			'data'=>$modelImdbdata,
// 			'cssFile'=>Yii::app()->baseUrl . '/css/detail-view-custom.css',
// 			'attributes'=>array(
// 				'Year',
// 				'Rated',
// 				'Released',
// 				'Genre',
// 				'Director',
// 				'Writer',
// 				'Actors',
// 				'Runtime',
// 				'Rating',
// 				'Votes',
// 	),
// 	)); 
	?>
	</div>		
	<div class="movie-rating-box" >
	<?php echo CHtml::openTag('div',array('class'=>'movie-rating'));?>
		<?php echo $modelImdbdata->Rating; ?>
	<?php echo CHtml::closeTag('div');?> 
	</div>
	<div class="movie-download-box" >
	
	<?php
		 $this->widget('zii.widgets.jui.CJuiButton',
			 array(
			 	'id'=>'downloadButton',
			 	'name'=>'download',
			 	'caption'=>'Download',
			 	'value'=>'Click to download movie',
			 	'onclick'=>'js:function(){
			 		if(confirm("Save button clicked"))
			 		{
						$.post("'.ImdbdataController::createUrl('AjaxStartDownload').'",
								{id_nzb: "'.$model->Id.'"}
						).success(
							function(data) 
							{
	 							$("#downloadButton").hide();
	 							$("#started-display").animate({opacity: "show"},"slow");
							}
						);
		 
			 		}
			 		return false;
				}',
				'htmlOptions'=>array('style'=>'display: none;')
		 	)
		 );
	 ?>	
	 <div id="started-display" style="display: none;float: left;padding: 5px 10px; ">
	 	<img alt="Download Started" src="images/downloading.png">
	 </div>
	 <div id="finish-display" style="display: none; float: left;padding: 5px 10px;">
	 	<img alt="Download Started" src="images/downloaded.png">
	 </div>
	</div>
</div>
	<?php
Yii::app()->clientScript->registerScript(__CLASS__.'#Imdbdata', "
	ShowDownload();
	function ShowDownload()
	{
		if('".$model->downloading."'=='1')
		{
			$('#started-display').show();
		}
		else if('".$model->downloaded."'=='1')
		{
			$('#finish-display').show();
		}
		else 
		{
			$('#downloadButton').show();
		}
		
	}	

");
?>
	
	