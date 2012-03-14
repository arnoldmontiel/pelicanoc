
<div id="conteiner" class="movie-view" style="">

	<div style="width: 205px; float:left;">
		<?php echo CHtml::image( "images/".$modelImdbdata->Poster, $modelImdbdata->Title,array('id'=>'Imdbdata_Poster_img', 'style'=>'height: 290px;width: 190px;margin: 5px 5px 5px 7px;')); ?>

	</div>
	<div style="float: left;padding: 5px 10px; width: 50%">
	<?php echo CHtml::openTag('div',array('class'=>'movie-title'));?>
			<?php echo $modelImdbdata->Title; ?>
		<?php echo CHtml::closeTag('div');?> 
		
	<?php echo CHtml::openTag('div');?>
		<?php echo $modelImdbdata->Year; ?>
	<?php echo CHtml::closeTag('div');?> 

	<?php echo CHtml::openTag('div');?>
		<?php echo CHtml::openTag('b');?>
			<?php echo $modelImdbdata->getAttributeLabel('Genre').':'; ?>
		<?php echo CHtml::closeTag('b');?>
		<?php echo $modelImdbdata->Genre; ?>		
	<?php echo CHtml::closeTag('div');?> 
	
	<?php echo CHtml::openTag('div');?>
		<?php echo CHtml::openTag('b');?>
			<?php echo $modelImdbdata->getAttributeLabel('Director').':'; ?>
		<?php echo CHtml::closeTag('b');?>
		<?php echo $modelImdbdata->Director; ?>
	<?php echo CHtml::closeTag('div');?> 

	<?php echo CHtml::openTag('div');?>
		<?php echo CHtml::openTag('b');?>
			<?php echo $modelImdbdata->getAttributeLabel('Plot').':'; ?>
		<?php echo CHtml::closeTag('b');?>
		<?php echo $modelImdbdata->Plot; ?>
	<?php echo CHtml::closeTag('div');?> 
	<?php echo CHtml::openTag('div');?>
			<?php echo CHtml::openTag('b');?>
				<?php echo $modelImdbdata->getAttributeLabel('Actors').':'; ?>
			<?php echo CHtml::closeTag('b');?>
			<?php echo $modelImdbdata->Actors; ?>
		<?php echo CHtml::closeTag('div');?> 
	</div>		
	<div class="movie-rating-box" >
	<?php echo CHtml::openTag('div',array('class'=>'movie-rating'));?>
		<?php echo $modelImdbdata->Rating; ?>
	<?php echo CHtml::closeTag('div');?> 
	</div>
	<div class="movie-download-box" >
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
						$.post("/PelicanoC/index.php?r=imdbdata/AjaxRequestMovie",
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
						$.post("/PelicanoC/index.php?r=imdbdata/AjaxCancelRequestedMovie",
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
	 <div class="movie-view-logo" style="display:none">
	 	<img class="movie-view-logo" alt="surround" src="images/dolby-surround-logo.png" style="width: 120px; height: 50px;">
	 	<img class="movie-view-logo" alt="surround" src="images/thx_logo.png" style=" width: 80px; height: 70px;">
	 </div>
	
</div>
	<?php
	$setting = Setting::getInstance();
	$nzbCustomer = NzbCustomer::model()->findByPk(array('Id_nzb'=>$model->Id,'Id_customer'=>$setting->getId_customer()));
	Yii::app()->clientScript->registerScript(__CLASS__.'#Imdbdata', "
	ChangeBG('images/','".$modelImdbdata->Backdrop."');
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

");
?>
	
	