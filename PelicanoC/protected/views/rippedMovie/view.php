
<div id="conteiner" class="movie-view" style="">

	<div style="width: 205px; float:left;">
		<?php echo CHtml::image( "images/".$model->imdbdata->Poster, $model->imdbdata->Title,array('id'=>'Imdbdata_Poster_img', 'style'=>'height: 290px;width: 190px;margin: 5px 5px 5px 7px;')); ?>

	</div>
	<div style="float: left;padding: 5px 10px; width: 50%">
	<?php echo CHtml::openTag('div',array('class'=>'movie-title'));?>
			<?php echo $model->imdbdata->Title; ?>
		<?php echo CHtml::closeTag('div');?> 
		
	<?php echo CHtml::openTag('div');?>
		<?php echo $model->imdbdata->Year; ?>
	<?php echo CHtml::closeTag('div');?> 

	<?php echo CHtml::openTag('div');?>
		<?php echo CHtml::openTag('b');?>
			<?php echo $model->imdbdata->getAttributeLabel('Genre').':'; ?>
		<?php echo CHtml::closeTag('b');?>
		<?php echo $model->imdbdata->Genre; ?>		
	<?php echo CHtml::closeTag('div');?> 
	
	<?php echo CHtml::openTag('div');?>
		<?php echo CHtml::openTag('b');?>
			<?php echo $model->imdbdata->getAttributeLabel('Director').':'; ?>
		<?php echo CHtml::closeTag('b');?>
		<?php echo $model->imdbdata->Director; ?>
	<?php echo CHtml::closeTag('div');?> 

	<?php echo CHtml::openTag('div');?>
		<?php echo CHtml::openTag('b');?>
			<?php echo $model->imdbdata->getAttributeLabel('Plot').':'; ?>
		<?php echo CHtml::closeTag('b');?>
		<?php echo $model->imdbdata->Plot; ?>
	<?php echo CHtml::closeTag('div');?> 
	<?php echo CHtml::openTag('div');?>
		<?php echo CHtml::openTag('b');?>
			<?php echo $model->imdbdata->getAttributeLabel('Actors').':'; ?>
		<?php echo CHtml::closeTag('b');?>
		<?php echo $model->imdbdata->Actors; ?>
	<?php echo CHtml::closeTag('div');?> 
	<?php echo CHtml::openTag('div');?>
		<?php echo CHtml::openTag('b');?>
			<?php echo $model->imdbdata->getAttributeLabel('Writer').':'; ?>
		<?php echo CHtml::closeTag('b');?>
		<?php echo $model->imdbdata->Writer; ?>
	<?php echo CHtml::closeTag('div');?> 
	<?php echo CHtml::openTag('div');?>
		<?php echo CHtml::openTag('b');?>
			<?php echo $model->imdbdata->getAttributeLabel('Runtime').':'; ?>
		<?php echo CHtml::closeTag('b');?>
		<?php echo $model->imdbdata->Runtime; ?>
	<?php echo CHtml::closeTag('div');?>
	</div>		
	<div class="movie-rating-box" >
	<?php echo CHtml::openTag('div',array('class'=>'movie-rating'));?>
		<?php echo $model->imdbdata->Rating; ?>
	<?php echo CHtml::closeTag('div');?> 
	</div>
	<div class="movie-download-box" >
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
</div>
<?php
Yii::app()->clientScript->registerScript(__CLASS__.'#Imdbdata', "
	
	ChangeBG('images/','".$model->imdbdata->Backdrop."');

	$('.leftcurtain').addClass('showLeftCurtian');
	$('.rightcurtain').addClass('showRightCurtian');
	OpenCurtains(2000);
");
?>
	
	
	