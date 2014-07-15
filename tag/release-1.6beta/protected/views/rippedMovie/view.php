
<div id="conteiner" class="movie-view" style="">

<div class="rip-layout-left">
	<div style="width: 205px; float:left;">
		<?php echo CHtml::image( "images/".$model->myMovieDisc->myMovie->poster, $model->myMovieDisc->myMovie->original_title,array('id'=>'MyMovie_Poster_img', 'style'=>'height: 290px;width: 190px;margin: 5px 5px 5px 7px;')); ?>

	</div>
	
	<div class="play-box" >
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
	 
	<div class="movie-rating-box" >
	<?php echo CHtml::openTag('div',array('class'=>'movie-rating'));?>
		<?php echo $model->myMovieDisc->myMovie->rating; ?>
	<?php echo CHtml::closeTag('div');?> 
	</div>
	
</div>
<div class="rip-layout-centre">
	<div style="float: left;padding: 5px 10px;">
	<?php echo CHtml::openTag('div',array('class'=>'movie-title'));?>
			<?php echo $model->myMovieDisc->myMovie->local_title; ?>
			<?php echo ' - '. $model->myMovieDisc->name; ?>
		<?php echo CHtml::closeTag('div');?> 
	<br>
	<?php echo CHtml::openTag('div');?>
		<?php echo CHtml::openTag('b');?>
			<?php echo $model->myMovieDisc->myMovie->getAttributeLabel('year').':'; ?>
		<?php echo CHtml::closeTag('b');?>
		<?php echo $model->myMovieDisc->myMovie->production_year; ?>		
	<?php echo CHtml::closeTag('div');?> 
		
	<?php echo CHtml::openTag('div');?>
		<?php echo CHtml::openTag('b');?>
			<?php echo $model->myMovieDisc->myMovie->getAttributeLabel('genre').':'; ?>
		<?php echo CHtml::closeTag('b');?>
		<?php echo $model->myMovieDisc->myMovie->genre; ?>		
	<?php echo CHtml::closeTag('div');?> 
	
	<?php echo CHtml::openTag('div');?>
		<?php echo CHtml::openTag('b');?>
			<?php echo $model->myMovieDisc->myMovie->getAttributeLabel('country').':'; ?>
		<?php echo CHtml::closeTag('b');?>
		<?php echo $model->myMovieDisc->myMovie->country; ?>
	<?php echo CHtml::closeTag('div');?> 

	<?php echo CHtml::openTag('div');?>
		<?php echo CHtml::openTag('b');?>
			<?php echo $model->myMovieDisc->myMovie->getAttributeLabel('description').':'; ?>
		<?php echo CHtml::closeTag('b');?>
		<?php echo $model->myMovieDisc->myMovie->description; ?>
	<?php echo CHtml::closeTag('div');?> 
	
	<?php echo CHtml::openTag('div');?>
		<?php echo CHtml::openTag('b');?>
			<?php echo $model->myMovieDisc->myMovie->getAttributeLabel('running_time').':'; ?>
		<?php echo CHtml::closeTag('b');?>
		<?php echo $model->myMovieDisc->myMovie->running_time; ?>
	<?php echo CHtml::closeTag('div');?>
	 
	<?php echo CHtml::openTag('div');?>
		<?php echo CHtml::openTag('b');?>
			<?php echo $model->myMovieDisc->myMovie->getAttributeLabel('imdb').':'; ?>
		<?php echo CHtml::closeTag('b');?>
		<?php echo $model->myMovieDisc->myMovie->imdb; ?>
	<?php echo CHtml::closeTag('div');?>
	 
	<?php echo CHtml::openTag('div');?>
		<?php echo CHtml::openTag('b');?>
			<?php echo $model->myMovieDisc->myMovie->getAttributeLabel('genre').':'; ?>
		<?php echo CHtml::closeTag('b');?>
		<?php echo $model->myMovieDisc->myMovie->genre; ?>
	<?php echo CHtml::closeTag('div');?>
	
	<?php echo CHtml::openTag('div');?>
		<?php echo CHtml::openTag('b');?>
			<?php echo $model->myMovieDisc->myMovie->getAttributeLabel('studio').':'; ?>
		<?php echo CHtml::closeTag('b');?>
		<?php echo $model->myMovieDisc->myMovie->studio; ?>
	<?php echo CHtml::closeTag('div');?>
	
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
		 	echo "<td>".$model->myMovieDisc->myMovie->video_standard ." / ". $model->myMovieDisc->myMovie->aspect_ratio ."</td>";
		 	echo "</tr>";
	 	
		 	$criteria = new CDbCriteria();
		 	$criteria->with[]='audioTrack';
		 	$criteria->order = "audioTrack.type";
		 	
	 		$myMovieAudioTracks = MyMovieAudioTrack::model()->findAllByAttributes(array('Id_my_movie'=>$model->myMovieDisc->Id_my_movie),$criteria);
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
	 		
	 		$myMovieSubtitles = MyMovieSubtitle::model()->findAllByAttributes(array('Id_my_movie'=>$model->myMovieDisc->Id_my_movie));
	 		
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
</div>
<div class="rip-layout-right">
	<div class="extra-feature-box" >
		<div class="extra-feature-title" >
			BONUS FEATURES
		</div>
		<div style="display:inline-block;">
		<?php
		$features = explode("\n" ,$model->myMovieDisc->myMovie->extra_features);
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
	</div>
</div>
	
	 <div class="rip-layout-footer" >
	 
		<div class="mpaa-box" >
		 	<div>				
				<?php 
				echo CHtml::image("images/".$model->myMovieDisc->myMovie->parentalControl->img_url,"",array('style'=>'width:90%'));
				?>
			</div>
			<div align="center">
			<?php 
				if(!empty($model->myMovieDisc->myMovie->parental_rating_desc))
					echo $model->myMovieDisc->myMovie->parental_rating_desc;
			?>
			</div>
		</div>
		<?php 
			if($model->isBluray()):
			?>
		<div class="rip-logo">
			<img alt="mpaa" src="images/blu-ray.png" style="width:90px;height:50px">
		</div>
		<?php
		endif
		?>
		<?php
		if($model->isDvd()):
		?>
			<div class="rip-logo">
				<img alt="mpaa" src="images/dvd.jpg" style="width:90px;height:50px">
			</div>
			<?php
			endif
			?>
		<?php 
			if($model->hasDolbyDigital()):
			?>
		<div class="rip-logo">
			<img alt="mpaa" src="images/dolby-digital.jpg" style="width:90px;height:50px">
		</div>
		<?php
		endif
		?>
		
		<?php 
			if($model->hasDolbyTrueHD()):
			?>
		<div class="rip-logo">
			<img alt="mpaa" src="images/true-hd.jpg" style="width:90px;height:50px">
		</div>
		<?php
		endif
		?>
		
		<?php 
			if($model->hasDts()):
			?>
		<div class="rip-logo">
			<img alt="mpaa" src="images/dts.jpg" style="width:90px;height:50px">
		</div>
		<?php
		endif
		?>
		
		<?php 
			if($model->hasDolbySurround()):
			?>
		<div class="rip-logo">
			<img alt="mpaa" src="images/dolby-surround.gif" style="width:90px;height:50px">
		</div>
		<?php
		endif
		?>
	</div>
	
</div>
<?php
Yii::app()->clientScript->registerScript(__CLASS__.'#Imdbdata', "
	
	ChangeBG('images/','".$model->myMovieDisc->myMovie->backdrop."');

// 	$('.leftcurtain').addClass('showLeftCurtian');
// 	$('.rightcurtain').addClass('showRightCurtian');
// 	OpenCurtains(2000);
");
?>
	
	
	