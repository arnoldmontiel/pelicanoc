
<div id="conteiner" class="start-view" align="center" style="">
	<?php echo CHtml::openTag('div',array('class'=>'start-title'));?>
			<?php echo "Reproduciendo: ". $model->myMovieDisc->myMovie->local_title . " - ".$model->myMovieDisc->name;  ?>
		<?php echo CHtml::closeTag('div');?> 
	<br>
	<div style="float: left; padding: 5px 10px; width: 95%">
		<img alt="POP UP MENU" src="images/player_popupmenu.png">
	</div>				 
	
	<div style="float: left; padding: 5px 10px; width: 95%">
		<img alt="PREV" src="images/player_prev.png">
		<img alt="REW" src="images/player_rewind.png">		
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
		<img alt="FWD" src="images/player_forward.png">
		<img alt="NEXT" src="images/player_next.png">
	</div>				 
	<div style="float: left; padding: 5px 10px; width: 95%">
			<img alt="UP" src="images/player_up.png">			
	</div>				 
	<div style="float: left; padding: 5px 10px; width: 95%">
			<img alt="LEFT" src="images/player_left.png">			
			<img alt="LEFT" src="images/player_enter.png">			
			<img alt="RIGHT" src="images/player_right.png">			
	</div>				 
	<div style="float: left; padding: 5px 10px; width: 95%">
			<img alt="DOWN" src="images/player_down.png">			
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
	
	
	