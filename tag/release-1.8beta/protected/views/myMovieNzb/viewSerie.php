<?php $modelMyMovieNzb = $model->myMovieDiscNzb->myMovieNzb;
	  $modelSerie = $modelMyMovieNzb->myMovieSerieHeader;
?>

<div id="conteiner" class="movie-view" style="">
<div class="rip-layout-left">
	<div style="width: 205px; float:left;">
		<?php echo CHtml::image( "images/".$modelSerie->poster, $modelSerie->name,array('id'=>'Imdbdata_Poster_img', 'style'=>'height: 290px;width: 190px;margin: 5px 5px 5px 7px;')); ?>
	</div>
</div>
<div class="rip-layout-centre">
	<div style="float: left;padding: 5px 10px;">
	<?php echo CHtml::openTag('div',array('class'=>'movie-title'));?>
			<?php echo $modelSerie->name; ?>
		<?php echo CHtml::closeTag('div');?> 
	<br>
	<?php echo CHtml::openTag('div');?>
		<?php echo CHtml::openTag('b');?>
			<?php echo $model->getAttributeLabel('Description').':'; ?>
		<?php echo CHtml::closeTag('b');?>
		<?php echo $modelSerie->description; ?>		
	<?php echo CHtml::closeTag('div');?> 
	
	<?php echo CHtml::openTag('div');?>
			<?php echo CHtml::openTag('b');?>
				<?php echo $model->getAttributeLabel('Genre').':'; ?>
			<?php echo CHtml::closeTag('b');?>
			<?php echo $modelSerie->genre; ?>
	<?php echo CHtml::closeTag('div');?> 
		
	<?php echo CHtml::openTag('div');?>
		<?php echo CHtml::openTag('b');?>
			<?php echo $model->getAttributeLabel('Rating').':'; ?>
		<?php echo CHtml::closeTag('b');?>
		<?php echo $modelSerie->rating; ?>
	<?php echo CHtml::closeTag('div');?> 

	<?php echo CHtml::openTag('div');?>
		<?php echo CHtml::openTag('b');?>
			<?php echo $model->getAttributeLabel('Network').':'; ?>
		<?php echo CHtml::closeTag('b');?>
		<?php echo $modelSerie->original_network; ?>
	<?php echo CHtml::closeTag('div');?> 
	
	<?php echo CHtml::openTag('div');?>
		<?php echo CHtml::openTag('b');?>
			<?php echo $model->getAttributeLabel('Status').':'; ?>
		<?php echo CHtml::closeTag('b');?>
		<?php echo $modelSerie->original_status; ?>
	<?php echo CHtml::closeTag('div');?> 
	
	</div>		
	
</div>
<div class="movie-rating-box" >
	<?php echo CHtml::openTag('div',array('class'=>'movie-rating'));?>
		<?php echo $modelSerie->rating; ?>
	<?php echo CHtml::closeTag('div');?> 
	</div>
<div class="rip-layout-right">
	<div class="movie-download-box" >
		<?php
			 $this->widget('zii.widgets.jui.CJuiButton',
				 array(
				 	'id'=>'downloadButton',
				 	'name'=>'download',
				 	'caption'=>'Download',
				 	'value'=>'Click to download movie',
				 	'onclick'=>'js:function(){
				 		if(confirm("Are you sure start downloading?"))
				 		{
							$.post("'.MyMovieNzbController::createUrl('AjaxStartDownload').'",
									{Id_nzb: "'.$model->Id.'"}
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
		 <?php
		 echo CHtml::link( CHtml::image('images/play.png','Play' ,array(
		 	 															 'title'=>'Play',
		 	 													         'style'=>'height: 128px;width: 128px;',
		 	 													         'id'=>'btnPlay',
		 )
		 ),MyMovieNzbController::createUrl('AjaxStart', array('id'=>$model->Id)));
		 ?>
		</div>
	</div>

</div>
<div class="rip-layout-footer" >
<?php 
$this->widget('zii.widgets.grid.CGridView',
	array(
				'id'=>'jobs-grid',
				'cssFile'=>Yii::app()->baseUrl.'/css/grid-view-custom.css',
				'dataProvider' => $dataProvider,
				'summaryText' =>"",			
				'columns' => array(
						array('name' => 'Description','type' => 'raw','value' => 'CHtml::encode($data["description"])','htmlOptions'=>array('style'=>'width:300px')),
						array('name' => 'Season','type' => 'raw','value' => 'CHtml::encode($data["season_number"])'),
						array('name' => 'Episode','type' => 'raw','value' => 'CHtml::encode($data["episode_number"])'),												
						)
));

?>
</div>
</div>
<?php
	$setting = Setting::getInstance();	
	Yii::app()->clientScript->registerScript(__CLASS__.'#Imdbdata', "
	ChangeBG('images/','".$model->myMovieDiscNzb->myMovieNzb->backdrop."');
	ShowDownload();

	function ShowDownload()
	{
		if('".$model->downloading."'=='1')
		{
			$('#started-display').show();
		}
		else if('".$model->downloaded."'=='1')
		{
			if('".Yii::app()->user->checkAccess('ManagePlayer')."'=='1')
			{
				$('#play-display').show();
			}
			else
			{
				$('#finish-display').show();
			}			
		}
		else 
		{
			$('#downloadButton').show();
		}
	}
	$('#play_button').click(
		function () {
							$.post('".MyMovieNzbController::createUrl('AjaxStartMedia')."'
					).success(
						function(data) 
						{
						$('#play-display').html(data);
						}
					);
	 });

");
?>
	