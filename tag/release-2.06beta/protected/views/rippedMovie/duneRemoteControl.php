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
	

<div id="conteiner" class="start-view" align="center" style="">

	
	<div style="float: left; padding: 5px 10px; width: 95%">
		<?php
		echo CHtml::imageButton('images/player_power.png', array('id'=>'powerButton'));
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
	