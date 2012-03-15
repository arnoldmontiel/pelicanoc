
<div id="conteiner" class="serie-view" style="">

	<div style="width: 205px; float:left;">
		<?php echo CHtml::image( "images/".$modelImdbdataTv->Poster, $modelImdbdataTv->Title,array('id'=>'Imdbdata_Poster_img', 'style'=>'height: 290px;width: 190px;margin: 5px 5px 5px 7px;')); ?>

	</div>
	<div style="float: left;padding: 5px 10px; width: 50%">
	<?php echo CHtml::openTag('div',array('class'=>'serie-title'));?>
			<?php echo $modelImdbdataTv->parent->Title.': '.$modelImdbdataTv->Title; ?>
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
	 	<?php
		 $this->widget('zii.widgets.jui.CJuiButton',
			 array(
			 	'id'=>'requestButton',
			 	'name'=>'request',
			 	'caption'=>'Solicitar',
			 	'value'=>'Click para solicitar la pelicula',
			 	'onclick'=>'js:function(){
			 		if(confirm("Esta seguro de solicitar esta pelicula?"))
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
	 
	 
	</div>
	
</div>
	<?php
	$setting = Setting::getInstance();
	$nzbCustomer = NzbCustomer::model()->findByPk(array('Id_nzb'=>$model->Id,'Id_customer'=>$setting->getId_customer()));
		
Yii::app()->clientScript->registerScript(__CLASS__.'#Imdbdata', "
	//ChangeBG('images/','".$modelImdbdataTv->Backdrop."');
	ShowDownload();

	$('.leftcurtain').addClass('showLeftCurtian');
	$('.rightcurtain').addClass('showRightCurtian');
	OpenCurtains(2000);
	//
	function ShowDownload()
	{
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
	$('#play_button').click(
		function () {
							$.post('".ImdbdataController::createUrl('AjaxStartMedia')."'
					).success(
						function(data) 
						{
						$('#play-display').html(data);
						}
					);

	 });

");
?>
	
	