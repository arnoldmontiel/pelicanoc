
<div id="conteiner" class="movie-view" style="">

	<div style="width: 205px; float:left;">
		<?php echo CHtml::image( "images/".$model->imdbdata->Poster, $model->imdbdata->Title,array('id'=>'Imdbdata_Poster_img', 'style'=>'height: 290px;width: 190px;margin: 5px 5px 5px 7px;')); ?>

	</div>
	<div style="float: left;padding: 5px 10px; width: 50%">
	<?php echo CHtml::openTag('div',array('class'=>'movie-title'));?>
			<?php echo $model->imdbdata->Title . " (".$model->imdbdata->Year.")"; ?>
		<?php echo CHtml::closeTag('div');?> 
	<br>
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
		<?php echo $model->myMovie->description; ?>
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
	<?php echo CHtml::openTag('div');?>
		<?php echo CHtml::openTag('b');?>
			<?php echo $model->myMovie->getAttributeLabel('Studio').':'; ?>
		<?php echo CHtml::closeTag('b');?>
		<?php echo $model->myMovie->studio; ?>
	<?php echo CHtml::closeTag('div');?>
	</div>		
	<div class="movie-rating-box" >
	<?php echo CHtml::openTag('div',array('class'=>'movie-rating'));?>
		<?php echo $model->imdbdata->Rating; ?>
	<?php echo CHtml::closeTag('div');?> 
	</div>
	<div class="movie-download-box" >
	<div id="play-display" style="float: left;padding: 5px 10px;">
	 	
	 	<?php
	 	//	echo CHtml::image("images/play.png",'Play',array('id'=>'play_button', 'style'=>'height: 128px;width: 128px;'));
 		//	echo CHtml::link( 
 		//	),array('http://DUNE/cgi-bin/do?cmd=start_file_playback&media_url=smb://ARNOLD-PC/COSAS/Back.to.the.Future.720.HDrip.H264.AAC.ITS-ALI.mp4'));
	 	echo CHtml::link( CHtml::image('images/play.png','Play' ,array(
	 															 'title'=>'Play',
	 													         'style'=>'height: 128px;width: 128px;',
	 													         'id'=>'btnPlay',
	 	)
	 	),RippedMovieController::createUrl('AjaxStart', array('id'=>$model->Id)));
	 	
		?>
	 </div>
	</div> 
	
	<div class="extra-feature-box" >
		<div class="extra-feature-title" >
			BONUS FEATURES
		</div>
		<?php 
		$features = explode("\n" ,$model->myMovie->extra_features);
		
		foreach($features as $feature)
		{
			if(!empty($feature))
			{
				$text = (substr($feature, 0, 1) == "-")?substr( $feature,1):$feature;
				echo "<li>" . $text . "</li><br>";
			}	
		}
		?>
	</div> 
	
	 <div class="specifications" >
	 	<table class="specifications">
	 	<tr>
		 	<th colspan="3" scope="col">
		 		<div class="extra-feature-title" >
					SPECIFICATIONS
				</div>
		 	</th>
	 	</tr>
	 	<?php

		 	echo "<tr>";
		 	echo "<td>VIDEO</td>";
		 	echo "<td>".$model->myMovie->video_standard ." / ". $model->myMovie->aspect_ratio ."</td>";
		 	echo "</tr>";
	 	
		 	$criteria = new CDbCriteria();
		 	$criteria->with[]='audioTrack';
		 	$criteria->order = "audioTrack.type";
		 	
	 		$myMovieAudioTracks = MyMovieAudioTrack::model()->findAllByAttributes(array('Id_my_movie'=>$model->Id_my_movie),$criteria);
	 		$audio = "";
	 		
	 		$audioArr = array();
	 		$index = 0;
	 		$type = "";
	 		foreach($myMovieAudioTracks as $item)
	 		{
	 			if($type != $item->audioTrack->type)
	 			{
	 				if(!empty($type))
	 					$index ++;
	 				
	 				$type = $item->audioTrack->type;
	 				$audioArr[$index] = $item->audioTrack->type . ": ";
	 				$audioArr[$index] = $audioArr[$index] . $item->audioTrack->language . " " . $item->audioTrack->chanel;
	 			}
	 			else 
	 			{
	 				$audioArr[$index] = $audioArr[$index] .", ". $item->audioTrack->language . " " . $item->audioTrack->chanel;
	 			}
	 		}
	 		echo "<tr>";
	 		echo "<td>AUDIO</td>";
	 		echo "<td>".implode("; ",$audioArr)."</td>";
	 		echo "</tr>";
	 		
	 		$myMovieSubtitles = MyMovieSubtitle::model()->findAllByAttributes(array('Id_my_movie'=>$model->Id_my_movie));
	 		
	 		$subtitleArr = array();
			$index = 0;
			foreach($myMovieSubtitles as $item)
			{
				$subtitleArr[$index] = $item->subtitle->language;
				$index ++;
			}
	 		echo "<tr>";
	 		echo "<td>SUBTITLE</td>";
	 		echo "<td>".implode(", ",$subtitleArr)."</td>";
	 		echo "</tr>";
		?>
		</table>
	 </div>
	 <div class="footer-area" >
	 
		 <div class="mpaa-box" >
		 	<div>
			<img alt="mpaa" src="images/mpaa_logo.gif" style="width:200px">
			</div>
			<div>
			<?php 
				if(!empty($model->myMovie->parental_rating_desc))
					echo $model->myMovie->parental_rating_desc;
				else
					echo "Unrated";
			?>
			</div>
		</div>
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
	
	
	