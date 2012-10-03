
<div id="conteiner" class="start-view" align="center" style="">
	<?php echo CHtml::openTag('div',array('class'=>'start-title'));?>
			<?php echo " Reproduciendo: ". $model->myMovie->original_title . " (".$model->myMovie->production_year.")";  ?>
		<?php echo CHtml::closeTag('div');?> 
	<br>
	<div style="float: left; padding: 5px 10px; width: 95%">
		<img alt="Play" src="images/play.png">
		<?php
		echo CHtml::link( CHtml::image('images/stop.png','Stop' ,array(
	 															 'title'=>'Stop',
	 													         'style'=>'height: 128px;width: 128px;',
	 													         'id'=>'btnStop',
	 	)
	 	),RippedMovieController::createUrl('ViewAdult', array('id'=>$model->Id)));
		?>
		<img alt="Pause" src="images/pause.png">
	</div>				 
	
</div>				 
	<?php
Yii::app()->clientScript->registerScript(__CLASS__.'#MyMovieStart', "
	

");
?>
	
	
	