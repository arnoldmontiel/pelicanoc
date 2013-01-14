<?php
Yii::app()->clientScript->registerScript(__CLASS__.'#dune-reomte-control', "


setInterval(function() {
	getProgressBar();
}, 5000)

function getProgressBar()
{
 	
 	$.post('".RippedMovieController::createUrl('AjaxGetProgressBar')."'	
		).success(
		function(data){	
			$('#progress-bar-area').find('#progress-bar').progressbar({'value': parseInt(data)});
		});		
}

$('#powerButton').click(function(){
	$.ajax({
   		type: 'GET',
   		url: '". RippedMovieController::createUrl('AjaxUseRemote') . "',
   		data: 'ir_code=BC43BF00',
 	});
});

$('#playButton').click(function(){
	$.ajax({
   		type: 'GET',
   		url: '". RippedMovieController::createUrl('AjaxUseRemote') . "',
   		data: 'ir_code=B748BF00',
 	});
});

$('#stopButton').click(function(){
	$.ajax({
   		type: 'GET',
   		url: '". RippedMovieController::createUrl('AjaxUseRemote') . "',
   		data: 'ir_code=E619BF00',
 	});
});

$('#prevButton').click(function(){
	$.ajax({
   		type: 'GET',
   		url: '". RippedMovieController::createUrl('AjaxUseRemote') . "',
   		data: 'ir_code=B649BF00',
 	});
});

$('#nextButton').click(function(){
	$.ajax({
   		type: 'GET',
   		url: '". RippedMovieController::createUrl('AjaxUseRemote') . "',
   		data: 'ir_code=E21DBF00',
 	});
});

$('#rewButton').click(function(){
	$.ajax({
   		type: 'GET',
   		url: '". RippedMovieController::createUrl('AjaxUseRemote') . "',
   		data: 'ir_code=E31CBF00',
 	});
});
  
$('#fwButton').click(function(){
	$.ajax({
   		type: 'GET',
   		url: '". RippedMovieController::createUrl('AjaxUseRemote') . "',
   		data: 'ir_code=E41BBF00',
 	});
});

$('#enterButton').click(function(){
	$.ajax({
   		type: 'GET',
   		url: '". RippedMovieController::createUrl('AjaxUseRemote') . "',
   		data: 'ir_code=EB14BF00',
 	});
});

$('#returnButton').click(function(){
	$.ajax({
   		type: 'GET',
   		url: '". RippedMovieController::createUrl('AjaxUseRemote') . "',
   		data: 'ir_code=FB04BF00',
 	});
});

$('#popUpMenuButton').click(function(){
	$.ajax({
   		type: 'GET',
   		url: '". RippedMovieController::createUrl('AjaxUseRemote') . "',
   		data: 'ir_code=F807BF00',
 	});
});

$('#topMenuButton').click(function(){
	$.ajax({
   		type: 'GET',
   		url: '". RippedMovieController::createUrl('AjaxUseRemote') . "',
   		data: 'ir_code=AE51BF00',
 	});
});

$('#upButton').click(function(){
	$.ajax({
   		type: 'GET',
   		url: '". RippedMovieController::createUrl('AjaxUseRemote') . "',
   		data: 'ir_code=EA15BF00',
 	});
});

$('#downButton').click(function(){
	$.ajax({
   		type: 'GET',
   		url: '". RippedMovieController::createUrl('AjaxUseRemote') . "',
   		data: 'ir_code=E916BF00',
 	});
});

$('#leftButton').click(function(){
	$.ajax({
   		type: 'GET',
   		url: '". RippedMovieController::createUrl('AjaxUseRemote') . "',
   		data: 'ir_code=E817BF00',
 	});
});

$('#rightButton').click(function(){
	$.ajax({
   		type: 'GET',
   		url: '". RippedMovieController::createUrl('AjaxUseRemote') . "',
   		data: 'ir_code=E718BF00',
 	});
});

$('#aButton').click(function(){
	$.ajax({
   		type: 'GET',
   		url: '". RippedMovieController::createUrl('AjaxUseRemote') . "',
   		data: 'ir_code=BF40BF00',
 	});
});

$('#regionA').click(function(){
	$.ajax({
   		type: 'GET',
   		url: '". RippedMovieController::createUrl('AjaxBRChangeRegion') . "',
   		data: 'zone_code=A',
 	});
});

$('#regionB').click(function(){
	$.ajax({
   		type: 'GET',
   		url: '". RippedMovieController::createUrl('AjaxBRChangeRegion') . "',
   		data: 'zone_code=B',
 	});
});

$('#regionC').click(function(){
	$.ajax({
   		type: 'GET',
   		url: '". RippedMovieController::createUrl('AjaxBRChangeRegion') . "',
   		data: 'zone_code=C',
 	});
});


");
?>
	

<div id="conteiner" class="movie-view" style="">

	<div class="rip-layout-left">
		
	</div>
	
	<div class="rip-layout-centre">
		<br>
		<?php echo CHtml::submitButton('POWER', array('id'=>'powerButton'));?>
		<br>
		<?php echo CHtml::submitButton('PLAY', array('id'=>'playButton'));?>
		<?php echo CHtml::submitButton('STOP', array('id'=>'stopButton'));?>
		<?php echo CHtml::submitButton('PAUSE', array('id'=>'pauseButton'));?>
		<br>
		<?php echo CHtml::submitButton('PREV', array('id'=>'prevButton'));?>
		<?php echo CHtml::submitButton('NEXT', array('id'=>'nextButton'));?>
		<?php echo CHtml::submitButton('REW', array('id'=>'rewButton'));?>
		<?php echo CHtml::submitButton('FW', array('id'=>'fwButton'));?>		
		<br>
		<?php echo CHtml::submitButton('ENTER', array('id'=>'enterButton'));?>
		<?php echo CHtml::submitButton('RETURN', array('id'=>'returnButton'));?>
		<?php echo CHtml::submitButton('POP UP MENU', array('id'=>'popUpMenuButton'));?>
		<?php echo CHtml::submitButton('TOP MENU', array('id'=>'topMenuButton'));?>
		<br>
		<?php echo CHtml::submitButton('UP', array('id'=>'upButton'));?>
		<?php echo CHtml::submitButton('DOWN', array('id'=>'downButton'));?>
		<?php echo CHtml::submitButton('LEFT', array('id'=>'leftButton'));?>
		<?php echo CHtml::submitButton('RIGHT', array('id'=>'rightButton'));?>
		<br>
		<br>
		<?php echo CHtml::submitButton('BR Region A', array('id'=>'regionA'));?>
		<?php echo CHtml::submitButton('BR Region B', array('id'=>'regionB'));?>
		<?php echo CHtml::submitButton('BR Region C', array('id'=>'regionC'));?>
		<br>
		<?php echo CHtml::submitButton('A', array('id'=>'aButton'));?>
	</div>
	
	<div class="rip-layout-right">
	
	</div>
	
	<div id="progress-bar-area" class="rip-layout-footer" >
		 <?php
		 $this->widget('zii.widgets.jui.CJuiProgressBar', array(
		    'value'=>0,
		    'id'=>'progress-bar',
		    // additional javascript options for the progress bar plugin
		    'htmlOptions'=>array(
		        'style'=>'height:20px;'
		    ),
		));
		 ?>
	</div>
	
</div>
	