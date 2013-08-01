
<div id="conteiner" class="start-view" align="center" style="">
	<?php echo CHtml::openTag('div',array('class'=>'start-title'));?>
			<?php echo "Reproduciendo: ". $model->original_title;  ?>
		<?php echo CHtml::closeTag('div');?> 
	<br>
	<div style="float: left; width: 50%">
	<div style="float: left; padding: 5px 10px; width: 95%">
		<?php
		echo CHtml::imageButton('images/player_popupmenu.png', array('id'=>'popUpMenuButton','style'=>'width: 90px;'));
		echo CHtml::imageButton('images/player_return.png', array('id'=>'returnButton','style'=>'width: 90px;'));
		echo CHtml::imageButton('images/player_subt.png', array('id'=>'subtButton','style'=>'width: 90px;'));
		echo CHtml::imageButton('images/player_audio.png', array('id'=>'audioButton','style'=>'width: 90px;'));
		?>
	</div>				 
	
	<div style="float: left; padding: 5px 10px; width: 95%">
		<?php
		echo CHtml::imageButton('images/player_prev.png', array('id'=>'prevButton','style'=>'width: 90px;'));
		echo CHtml::imageButton('images/player_rewind.png', array('id'=>'rewButton','style'=>'width: 90px;'));
		echo CHtml::imageButton('images/pause.png', array('id'=>'playButton','style'=>'width: 90px;'));
		?>
		<?php
		echo CHtml::imageButton('images/stop.png', array('id'=>'stopButton','style'=>'width: 90px;'));
		echo CHtml::imageButton('images/player_forward.png', array('id'=>'fwButton','style'=>'width: 90px;'));
		echo CHtml::imageButton('images/player_next.png', array('id'=>'nextButton','style'=>'width: 90px;'));
		?>
	</div>
	</div>
	<div style="float: left; width: 50%">
		<div style="float: left; padding: 5px 10px; width: 95%">
		<?php echo CHtml::imageButton('images/player_up.png', array('id'=>'upButton','style'=>'width: 90px;'));?>
	</div>				 
	<div style="float: left; padding: 5px 10px; width: 95%">
	<?php 
			echo CHtml::imageButton('images/player_left.png', array('id'=>'leftButton','style'=>'width: 90px;'));
			echo CHtml::imageButton('images/player_enter.png', array('id'=>'enterButton','style'=>'width: 90px;'));
			echo CHtml::imageButton('images/player_right.png', array('id'=>'rightButton','style'=>'width: 90px;'));
	?>
	</div>				 
	<div style="float: left; padding: 5px 10px; width: 95%">
	<?php 
		echo CHtml::imageButton('images/player_down.png', array('id'=>'downButton','style'=>'width: 90px;'));
	?>
	</div>
	</div>				 
</div>
<?php
Yii::app()->clientScript->registerScript(__CLASS__.'#startMovie', "
	
	ChangeBG('images/','".$model->backdrop."');

$('#playButton').click(function(){
	$.ajax({
   		type: 'GET',
   		url: '". SiteController::createUrl('AjaxUseRemote') . "',
   		data: 'ir_code=B748BF00',
 	});
});

$('#stopButton').click(function(){
	$.ajax({
   		type: 'GET',
   		url: '". SiteController::createUrl('AjaxStop') . "'
 	}).success(function()
 	{
		window.location = '".SiteController::createUrl('index')."'
	}
 	);	
});

$('#prevButton').click(function(){
	$.ajax({
   		type: 'GET',
   		url: '". SiteController::createUrl('AjaxUseRemote') . "',
   		data: 'ir_code=B649BF00',
 	});
});

$('#nextButton').click(function(){
	$.ajax({
   		type: 'GET',
   		url: '". SiteController::createUrl('AjaxUseRemote') . "',
   		data: 'ir_code=E21DBF00',
 	});
});

$('#rewButton').click(function(){
	$.ajax({
   		type: 'GET',
   		url: '". SiteController::createUrl('AjaxUseRemote') . "',
   		data: 'ir_code=E31CBF00',
 	});
});
  
$('#fwButton').click(function(){
	$.ajax({
   		type: 'GET',
   		url: '". SiteController::createUrl('AjaxUseRemote') . "',
   		data: 'ir_code=E41BBF00',
 	});
});

$('#enterButton').click(function(){
	$.ajax({
   		type: 'GET',
   		url: '". SiteController::createUrl('AjaxUseRemote') . "',
   		data: 'ir_code=EB14BF00',
 	});
});

$('#returnButton').click(function(){
	$.ajax({
   		type: 'GET',
   		url: '". SiteController::createUrl('AjaxUseRemote') . "',
   		data: 'ir_code=FB04BF00',
 	});
});

$('#popUpMenuButton').click(function(){
	$.ajax({
   		type: 'GET',
   		url: '". SiteController::createUrl('AjaxUseRemote') . "',
   		data: 'ir_code=F807BF00',
 	});
});

$('#upButton').click(function(){
	$.ajax({
   		type: 'GET',
   		url: '". SiteController::createUrl('AjaxUseRemote') . "',
   		data: 'ir_code=EA15BF00',
 	});
});

$('#downButton').click(function(){
	$.ajax({
   		type: 'GET',
   		url: '". SiteController::createUrl('AjaxUseRemote') . "',
   		data: 'ir_code=E916BF00',
 	});
});

$('#leftButton').click(function(){
	$.ajax({
   		type: 'GET',
   		url: '". SiteController::createUrl('AjaxUseRemote') . "',
   		data: 'ir_code=E817BF00',
 	});
});

$('#rightButton').click(function(){
	$.ajax({
   		type: 'GET',
   		url: '". SiteController::createUrl('AjaxUseRemote') . "',
   		data: 'ir_code=E718BF00',
 	});
});

$('#subtButton').click(function(){
	$.ajax({
   		type: 'GET',
   		url: '". SiteController::createUrl('AjaxUseRemote') . "',
   		data: 'ir_code=AB54BF00',
 	});
});

$('#audioButton').click(function(){
	$.ajax({
   		type: 'GET',
   		url: '". SiteController::createUrl('AjaxUseRemote') . "',
   		data: 'ir_code=BB44BF00',
 	});
});

$('#aButton').click(function(){
	$.ajax({
   		type: 'GET',
   		url: '". SiteController::createUrl('AjaxUseRemote') . "',
   		data: 'ir_code=BF40BF00',
 	});
});

");
?>
	
	
	