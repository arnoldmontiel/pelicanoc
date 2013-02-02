
<div id="conteiner" class="movie-view" style="">

	<div style="width: 205px; float:left;">
		<?php echo CHtml::image( "images/".$model->myMovieDiscNzb->myMovieNzb->poster, $model->myMovieDiscNzb->myMovieNzb->original_title,array('id'=>'MyMovieNzb_Poster_img', 'style'=>'height: 290px;width: 190px;margin: 5px 5px 5px 7px;')); ?>

	</div>
	<div style="float: left;padding: 5px 10px; width: 50%">
	<?php echo CHtml::openTag('div',array('class'=>'movie-title'));?>
			<?php echo $model->myMovieDiscNzb->myMovieNzb->original_title . " (".$model->myMovieDiscNzb->myMovieNzb->production_year.")"; ?>
		<?php echo CHtml::closeTag('div');?> 
	<br>
	<?php echo CHtml::openTag('div');?>
		<?php echo CHtml::openTag('b');?>
			<?php echo $model->myMovieDiscNzb->myMovieNzb->getAttributeLabel('genre').':'; ?>
		<?php echo CHtml::closeTag('b');?>
		<?php echo $model->myMovieDiscNzb->myMovieNzb->genre; ?>		
	<?php echo CHtml::closeTag('div');?> 
	
	<?php echo CHtml::openTag('div');?>
		<?php echo CHtml::openTag('b');?>
			<?php echo $model->myMovieDiscNzb->myMovieNzb->getAttributeLabel('country').':'; ?>
		<?php echo CHtml::closeTag('b');?>
		<?php echo $model->myMovieDiscNzb->myMovieNzb->country; ?>
	<?php echo CHtml::closeTag('div');?> 

	<?php echo CHtml::openTag('div');?>
		<?php echo CHtml::openTag('b');?>
			<?php echo $model->myMovieDiscNzb->myMovieNzb->getAttributeLabel('description').':'; ?>
		<?php echo CHtml::closeTag('b');?>
		<?php echo $model->myMovieDiscNzb->myMovieNzb->description; ?>
	<?php echo CHtml::closeTag('div');?> 
	
	<?php echo CHtml::openTag('div');?>
		<?php echo CHtml::openTag('b');?>
			<?php echo $model->myMovieDiscNzb->myMovieNzb->getAttributeLabel('running_time').':'; ?>
		<?php echo CHtml::closeTag('b');?>
		<?php echo $model->myMovieDiscNzb->myMovieNzb->running_time; ?>
	<?php echo CHtml::closeTag('div');?>
	 
	<?php echo CHtml::openTag('div');?>
		<?php echo CHtml::openTag('b');?>
			<?php echo $model->myMovieDiscNzb->myMovieNzb->getAttributeLabel('imdb').':'; ?>
		<?php echo CHtml::closeTag('b');?>
		<?php echo $model->myMovieDiscNzb->myMovieNzb->imdb; ?>
	<?php echo CHtml::closeTag('div');?>
	 
	<?php echo CHtml::openTag('div');?>
		<?php echo CHtml::openTag('b');?>
			<?php echo $model->myMovieDiscNzb->myMovieNzb->getAttributeLabel('genre').':'; ?>
		<?php echo CHtml::closeTag('b');?>
		<?php echo $model->myMovieDiscNzb->myMovieNzb->genre; ?>
	<?php echo CHtml::closeTag('div');?>
	
	<?php echo CHtml::openTag('div');?>
		<?php echo CHtml::openTag('b');?>
			<?php echo $model->myMovieDiscNzb->myMovieNzb->getAttributeLabel('studio').':'; ?>
		<?php echo CHtml::closeTag('b');?>
		<?php echo $model->myMovieDiscNzb->myMovieNzb->studio; ?>
	<?php echo CHtml::closeTag('div');?>
	
	<?php echo CHtml::openTag('div');?>
		<?php echo CHtml::openTag('b');?>
			<?php echo $model->getAttributeLabel('Points').':'; ?>
		<?php echo CHtml::closeTag('b');?>
		<?php echo $model->points; ?>
	<?php echo CHtml::closeTag('div');?> 
	</div>		
	<div class="movie-rating-box" >
	<?php echo CHtml::openTag('div',array('class'=>'movie-rating'));?>
		<?php echo $model->myMovieDiscNzb->myMovieNzb->rating; ?>
	<?php echo CHtml::closeTag('div');?> 
	</div>
	<div class="movie-download-box" >
	<?php if (true):?>
		
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
		 	
		 //	 		echo CHtml::image("images/play.png",'Play',array('id'=>'play_button', 'style'=>'height: 128px;width: 128px;'));
		 // 			echo CHtml::link(
		 // 			),array('http://DUNE/cgi-bin/do?cmd=start_file_playback&media_url=smb://ARNOLD-PC/COSAS/Back.to.the.Future.720.HDrip.H264.AAC.ITS-ALI.mp4'));
		 ?>
		</div>
	 	 
	 <?php endif?>
	<?php if (Yii::app()->user->checkAccess('ManagePlayer')):?>		
	 
	 <div id="play-display" style="display: none; float: left;padding: 5px 10px;">
	 	<img alt="Play" src="images/play.png">
	 	<?php
//	 		echo CHtml::image("images/play.png",'Play',array('id'=>'play_button', 'style'=>'height: 128px;width: 128px;'));
// 			echo CHtml::link( 
// 			),array('http://DUNE/cgi-bin/do?cmd=start_file_playback&media_url=smb://ARNOLD-PC/COSAS/Back.to.the.Future.720.HDrip.H264.AAC.ITS-ALI.mp4'));		
		?>
	 </div>
	 <div id="stop-display" style="display: none ; float: left;padding: 5px 10px;">
	 	<img alt="Play" src="images/stop.png">
	 	<?php
//	 	echo CHtml::image("images/stop.png",'Stop',array('id'=>'stop_button', 'style'=>'height: 128px;width: 128px;'));
// 			echo CHtml::link( 
// 			),array('http://DUNE/cgi-bin/do?cmd=main_screen'));		
		?>
	 </div>
	 
	</div>
	 <div class="movie-view-logo" style="display:none">
	 	<img class="movie-view-logo" alt="surround" src="images/dolby-surround-logo.png" style="width: 120px; height: 50px;">
	 	<img class="movie-view-logo" alt="surround" src="images/thx_logo.png" style=" width: 80px; height: 70px;">
	 </div>
	<?php endif ?>
	
</div>
	<?php
	$setting = Setting::getInstance();
	//$nzbCustomer = NzbCustomer::model()->findByPk(array('Id_nzb'=>$model->Id,'Id_customer'=>$setting->getId_customer()));
	Yii::app()->clientScript->registerScript(__CLASS__.'#Imdbdata', "
	ChangeBG('images/','".$model->myMovieDiscNzb->myMovieNzb->backdrop."');
	ShowDownload();
	
// 	$('.leftcurtain').addClass('showLeftCurtian');
// 	$('.rightcurtain').addClass('showRightCurtian');
// 	OpenCurtains(2000);

	function ShowDownload()
	{
// 		if('".Yii::app()->user->checkAccess('ManageDownload')."'!='1')
// 		{
// 			return false;
// 		}
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

// 			$.ajax({
//       			url: 'http://DUNE/cgi-bin/do?cmd=start_file_playback&smb://ARNOLD-PC/COSAS/Back.to.the.Future.720.HDrip.H264.AAC.ITS-ALI.mp4',
// 			    dataType: 'xml',
//       			success: function(data) {
//       			debugger;      			
// 					$('#play-display').html(data);
// 					$('#stop-display').show();
// 				},
//       			error: function(data) {
//       			debugger;
// 					$('#play-display').html(data);
// 					$('#stop-display').show();
// 				}
// 			}
//     	);
// 	 });
// 	$('#stop_button').click(
// 		function () {
// 			$.ajax({
//       			url: 'http://DUNE/cgi-bin/do?cmd=main_screen',
// 			    dataType: 'xml',
//       			success: function(data) {
// 					debugger;
// 					$('#play-display').show();
// 					$('#stop-display').hide();
// 				},
//       			error: function(data) {
// 					debugger;
// 				}
// 			}
// 		);

	 });

");
?>
	
	