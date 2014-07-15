
<div id="conteiner" class="serie-view" style="">

	<div style="width: 205px; float:left;">
		<?php echo CHtml::image( "images/".$modelImdbdataTv->Poster, $modelImdbdataTv->Title,array('id'=>'Imdbdata_Poster_img', 'style'=>'height: 290px;width: 190px;margin: 5px 5px 5px 7px;')); ?>

	</div>
	<div style="float: left;padding: 5px 10px; width: 50%">
	<?php echo CHtml::openTag('div',array('class'=>'serie-title'));?>
			<?php echo $modelImdbdataTv->Title; ?>
		<?php echo CHtml::closeTag('div');?> 
		
	<?php echo CHtml::openTag('div');?>
		<?php echo $modelImdbdataTv->Year; ?>
	<?php echo CHtml::closeTag('div');?> 

	<?php echo CHtml::openTag('div');?>
		<?php echo CHtml::openTag('b');?>
			<?php echo $modelImdbdataTv->getAttributeLabel('Season').':'; ?>
		<?php echo CHtml::closeTag('b');?>
		<?php echo $modelImdbdataTv->Season; ?>		
	<?php echo CHtml::closeTag('div');?> 
	
	<?php echo CHtml::openTag('div');?>
		<?php echo CHtml::openTag('b');?>
			<?php echo $modelImdbdataTv->getAttributeLabel('Episode').':'; ?>
		<?php echo CHtml::closeTag('b');?>
		<?php echo $modelImdbdataTv->Episode; ?>		
	<?php echo CHtml::closeTag('div');?> 
		
	<?php echo CHtml::openTag('div');?>
		<?php echo CHtml::openTag('b');?>
			<?php echo $modelImdbdataTv->getAttributeLabel('Genre').':'; ?>
		<?php echo CHtml::closeTag('b');?>
		<?php echo $modelImdbdataTv->Genre; ?>		
	<?php echo CHtml::closeTag('div');?> 
	
	<?php echo CHtml::openTag('div');?>
		<?php echo CHtml::openTag('b');?>
			<?php echo $modelImdbdataTv->getAttributeLabel('Director').':'; ?>
		<?php echo CHtml::closeTag('b');?>
		<?php echo $modelImdbdataTv->Director; ?>
	<?php echo CHtml::closeTag('div');?> 

	<?php echo CHtml::openTag('div');?>
		<?php echo CHtml::openTag('b');?>
			<?php echo $modelImdbdataTv->getAttributeLabel('Plot').':'; ?>
		<?php echo CHtml::closeTag('b');?>
		<?php echo $modelImdbdataTv->Plot; ?>
	<?php echo CHtml::closeTag('div');?> 
	<?php echo CHtml::openTag('div');?>
			<?php echo CHtml::openTag('b');?>
				<?php echo $modelImdbdataTv->getAttributeLabel('Actors').':'; ?>
			<?php echo CHtml::closeTag('b');?>
			<?php echo $modelImdbdataTv->Actors; ?>
		<?php echo CHtml::closeTag('div');?> 
	</div>		
	<div class="serie-rating-box" >
	<?php echo CHtml::openTag('div',array('class'=>'serie-rating'));?>
		<?php echo $modelImdbdataTv->Rating; ?>
	<?php echo CHtml::closeTag('div');?> 
	</div>
	<div class="serie-download-box" >
	<?php if (Yii::app()->user->checkAccess('ManageDownload')):?>		
		<?php
		 $this->widget('zii.widgets.jui.CJuiButton',
			 array(
			 	'id'=>'downloadButton',
			 	'name'=>'download',
			 	'caption'=>'Download',
			 	'value'=>'Click to download serie',
			 	'onclick'=>'js:function(){
			 		if(confirm("Are you sure start downloading?"))
			 		{
						$.post("'.ImdbdataController::createUrl('AjaxStartDownload').'",
								{id_nzb: "'.$model->Id.'"}
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
	 	<div id="finish-display" style="display: none;float: left;padding: 5px 10px; ">
	 		<img alt="Download Finished" src="images/downloaded.png">
	 	</div>
	 <?php endif ?>	
	 <?php if (Yii::app()->user->checkAccess('ManageRequest')):?>
		<?php
		$this->widget('zii.widgets.jui.CJuiButton',
			array(
			 	'id'=>'requestButton',
			 	'name'=>'request',
			 	'caption'=>'Solicitar',
			 	'value'=>'Click para solicitar la pelicula',
			 	'onclick'=>'js:function(){
			 		if(confirm("Esta seguro de solicitar este eposidio?"))
			 		{
						$.post("'.ImdbdataTvController::createUrl('AjaxRequestSerie').'",
								{id_nzb: "'.$model->Id.'"}
						).success(
							function(data) 
							{
	 							$("#requestButton").hide();
	 							$("#cancelRequestButton").animate({opacity: "show"},"slow");
							}
						);
		 
			 		}
			 		return false;
				}',
				'htmlOptions'=>array('style'=>'display: none;')
		 	)
		);
		?>	
		<?php
		$this->widget('zii.widgets.jui.CJuiButton',
			 array(
			 	'id'=>'cancelRequestButton',
			 	'name'=>'cancelRequest',
			 	'caption'=>'Cancelar Solicitud',
			 	'value'=>'Click cancelar la solicitud de la pelicula',
			 	'onclick'=>'js:function(){
			 		if(confirm("Esta seguro de que desea cancelar esta solicitud?"))
			 		{
						$.post("'.ImdbdataTvController::createUrl('AjaxCancelRequestedSerie').'",
								{id_nzb: "'.$model->Id.'"}
						).success(
							function(data) 
							{
	 							$("#cancelRequestButton").hide();
	 							$("#requestButton").animate({opacity: "show"},"slow");
							}
						);
		 
			 		}
			 		return false;
				}',
				'htmlOptions'=>array('style'=>'display: none;')
		 	)
		 );
		?>	
	<?php endif ?>	
	 	 
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
	 	<?php
//	 	echo CHtml::image("images/stop.png",'Stop',array('id'=>'stop_button', 'style'=>'height: 128px;width: 128px;'));
// 			echo CHtml::link( 
// 			),array('http://DUNE/cgi-bin/do?cmd=main_screen'));		
		?>
	 </div>
	 
	</div>
	 <div class="serie-view-logo" style="display:none">
	 	<img class="serie-view-logo" alt="surround" src="images/dolby-surround-logo.png" style="width: 120px; height: 50px;">
	 	<img class="serie-view-logo" alt="surround" src="images/thx_logo.png" style=" width: 80px; height: 70px;">
	 </div>
	 <?php endif ?>
	
</div>
	<?php
	$setting = Setting::getInstance();
	$nzbCustomer = NzbCustomer::model()->findByPk(array('Id_nzb'=>$model->Id,'Id_customer'=>$setting->getId_customer()));
		
Yii::app()->clientScript->registerScript(__CLASS__.'#Imdbdata', "
	//ChangeBG('images/','".$modelImdbdataTv->Backdrop."');

	ShowDownload();
	ShowRequest();

	$('.leftcurtain').addClass('showLeftCurtian');
	$('.rightcurtain').addClass('showRightCurtian');
	OpenCurtains(2000);

	function ShowRequest()
	{
		if('".Yii::app()->user->checkAccess('ManageRequest')."'!='1')
		{
			return false;
		}
		if('".$nzbCustomer->requested."'=='1')
		{
			$('#cancelRequestButton').show();
		}
		else
		{
			$('#requestButton').show();
		}		
		return false;
	}
	function ShowDownload()
	{
		if('".Yii::app()->user->checkAccess('ManageDownload')."'!='1')
		{
			return false;
		}
		if('".$nzbCustomer->downloading."'=='1')
		{
			$('#started-display').show();
		}
		else if('".$nzbCustomer->downloaded."'=='1')
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
							$.post('".ImdbdataController::createUrl('AjaxStartMedia')."'
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
	
	