
<div id="conteiner" class="start-view" align="center" style="">
	<?php echo CHtml::openTag('div',array('class'=>'start-title'));?>
			<?php echo " Reproduciendo: ". $model->myMovieDisc->myMovie->original_title . " (".$model->myMovieDisc->myMovie->production_year.")";  ?>
		<?php echo CHtml::closeTag('div');?> 
	<br>
	<div style="float: left; padding: 5px 10px; width: 95%">
		<?php
		echo CHtml::imageButton('images/player_popupmenu.png', array('id'=>'popUpMenuButton'));
		echo CHtml::imageButton('images/player_return.png', array('id'=>'returnButton'));
		?>
	</div>				 
	
	<div style="float: left; padding: 5px 10px; width: 95%">
		<?php
		echo CHtml::imageButton('images/player_prev.png', array('id'=>'prevButton'));
		echo CHtml::imageButton('images/player_rewind.png', array('id'=>'rewButton'));
		echo CHtml::imageButton('images/pause.png', array('id'=>'playButton'));
		?>
		<?php
		echo CHtml::imageButton('images/stop.png', array('id'=>'stopButton'));
		echo CHtml::imageButton('images/player_forward.png', array('id'=>'fwButton'));
		echo CHtml::imageButton('images/player_next.png', array('id'=>'nextButton'));
		?>
	</div>				 
	<div style="float: left; padding: 5px 10px; width: 95%">
		<?php echo CHtml::imageButton('images/player_up.png', array('id'=>'upButton'));?>
	</div>				 
	<div style="float: left; padding: 5px 10px; width: 95%">
	<?php 
			echo CHtml::imageButton('images/player_left.png', array('id'=>'leftButton'));
			echo CHtml::imageButton('images/player_enter.png', array('id'=>'enterButton'));
			echo CHtml::imageButton('images/player_right.png', array('id'=>'rightButton'));
	?>
	</div>				 
	<div style="float: left; padding: 5px 10px; width: 95%">
	<?php 
		echo CHtml::imageButton('images/player_down.png', array('id'=>'downButton'));
	?>
	</div>				 
	
</div>				 
	<?php
Yii::app()->clientScript->registerScript(__CLASS__.'#MyMovieStart-adult', "
		

");
?>
	
	
	