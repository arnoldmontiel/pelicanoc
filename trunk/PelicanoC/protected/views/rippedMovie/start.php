
<div id="conteiner" class="start-view" align="center" style="">
	<?php echo CHtml::openTag('div',array('class'=>'start-title'));?>
			<?php echo "Reproduciendo: ". $model->myMovieDisc->myMovie->local_title . " - ".$model->myMovieDisc->name;  ?>
		<?php echo CHtml::closeTag('div');?> 
	<br>
	<div style="float: left; padding: 5px 10px; width: 95%">
		<?php
		echo CHtml::imageButton('images/play.png', array('id'=>'playButton'));
		?>
		<?php
		echo CHtml::link( CHtml::image('images/stop.png','Stop' ,array(
	 															 'title'=>'Stop',
	 													         'style'=>'height: 128px;width: 128px;',
	 													         'id'=>'btnStop',
	 	)
	 	),RippedMovieController::createUrl('View', array('id'=>$model->Id)));
		?>
		<img alt="Pause" src="images/pause.png">
	</div>				 
</div>
<?php
Yii::app()->clientScript->registerScript(__CLASS__.'#MyMovieStart', "
	
	ChangeBG('images/','".$model->myMovieDisc->myMovie->backdrop."');

	$('#playButton').click(function(){
	$.ajax({
   		type: 'GET',
   		url: '". RippedMovieController::createUrl('AjaxPlay') . "',
   		data: 'idRippedMovie=".$model->Id."',
 	});
});

");
?>
	
	
	