
<div id="conteiner" class="start-view" align="center" style="padding-top: 150px;font-size: large; ">
	<?php echo CHtml::openTag('div',array('class'=>'start-title'));?>
			<?php echo $model->original_title;  ?>
		<?php echo CHtml::closeTag('div');?> 
	<br>
	<div style="float: left; width: 60%">
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
	<div style="float: left; padding: 5px 10px; width: 95%">
		<?php
		echo CHtml::imageButton('images/Numbers-0-icon.png', array('id'=>'button0','style'=>'width: 48px;margin-right:5px;'));
		echo CHtml::imageButton('images/Numbers-1-icon.png', array('id'=>'button1','style'=>'width: 48px;margin-right:5px;'));
		echo CHtml::imageButton('images/Numbers-2-icon.png', array('id'=>'button2','style'=>'width: 48px;margin-right:5px;'));
		echo CHtml::imageButton('images/Numbers-3-icon.png', array('id'=>'button3','style'=>'width: 48px;margin-right:5px;'));
		echo CHtml::imageButton('images/Numbers-4-icon.png', array('id'=>'button4','style'=>'width: 48px;margin-right:5px;'));
		echo CHtml::imageButton('images/Numbers-5-icon.png', array('id'=>'button5','style'=>'width: 48px;margin-right:5px;'));
		echo CHtml::imageButton('images/Numbers-6-icon.png', array('id'=>'button6','style'=>'width: 48px;margin-right:5px;'));
		echo CHtml::imageButton('images/Numbers-7-icon.png', array('id'=>'button7','style'=>'width: 48px;margin-right:5px;'));
		echo CHtml::imageButton('images/Numbers-8-icon.png', array('id'=>'button8','style'=>'width: 48px;margin-right:5px;'));
		echo CHtml::imageButton('images/Numbers-9-icon.png', array('id'=>'button9','style'=>'width: 48px;'));
		?>
	</div>
	
	</div>
	<div style="float: left; width: 40%">
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
	
	ChangeBG('','".$backdrop."');

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
$('#button0').click(function(){
	$.ajax({
   		type: 'GET',
   		url: '". SiteController::createUrl('AjaxUseRemote') . "',
   		data: 'ir_code=F50ABF00',
 	});
});
$('#button1').click(function(){
	$.ajax({
   		type: 'GET',
   		url: '". SiteController::createUrl('AjaxUseRemote') . "',
   		data: 'ir_code=F40BBF00',
 	});
});
$('#button2').click(function(){
	$.ajax({
   		type: 'GET',
   		url: '". SiteController::createUrl('AjaxUseRemote') . "',
   		data: 'ir_code=F30CBF00',
 	});
});
$('#button3').click(function(){
	$.ajax({
   		type: 'GET',
   		url: '". SiteController::createUrl('AjaxUseRemote') . "',
   		data: 'ir_code=F20DBF00',
 	});
});
$('#button4').click(function(){
	$.ajax({
   		type: 'GET',
   		url: '". SiteController::createUrl('AjaxUseRemote') . "',
   		data: 'ir_code=F10EBF00',
 	});
});
$('#button5').click(function(){
	$.ajax({
   		type: 'GET',
   		url: '". SiteController::createUrl('AjaxUseRemote') . "',
   		data: 'ir_code=F00FBF00',
 	});
});
$('#button6').click(function(){
	$.ajax({
   		type: 'GET',
   		url: '". SiteController::createUrl('AjaxUseRemote') . "',
   		data: 'ir_code=FE01BF00',
 	});
});
$('#button7').click(function(){
	$.ajax({
   		type: 'GET',
   		url: '". SiteController::createUrl('AjaxUseRemote') . "',
   		data: 'ir_code=EE11BF00',
 	});
});
$('#button8').click(function(){
	$.ajax({
   		type: 'GET',
   		url: '". SiteController::createUrl('AjaxUseRemote') . "',
   		data: 'ir_code=ED12BF00',
 	});
});
$('#button9').click(function(){
	$.ajax({
   		type: 'GET',
   		url: '". SiteController::createUrl('AjaxUseRemote') . "',
   		data: 'ir_code=EC13BF00',
 	});
});
		
");
?>
	
	
	