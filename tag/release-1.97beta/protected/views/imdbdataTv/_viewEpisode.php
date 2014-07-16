<?php 
Yii::app()->clientScript->registerScript(__CLASS__.'#imdbdataTv_view'.$data->Id, "

	$('#Imdbdata_tv_Poster_button_$data->Id').click(function(){
		//CloseCurtains();
		
		//set top scroll position
		$('.leftcurtain').css('top',$(document).scrollTop());
		$('.rightcurtain').css('top',$(document).scrollTop());
		
		//hidde scroll
		$(document.body).attr('style','overflow:hidden');
		
		$('.leftcurtain').removeClass('hideClass');
		$('.rightcurtain').removeClass('hideClass');
		
		$('.leftcurtain').stop().animate({width:'50%'}, 2000 );
		$('.rightcurtain').stop().animate({width:'51%'}, 2000 ,
			function(){
			window.location = '".ImdbdataController::CreateUrl('imdbdataTv/viewEpisode',array('id'=>$data->Id))."';
			OpenCurtains(10000);
			//show scroll			
			$(document.body).attr('style','overflow:auto');
			return false;
		}
		);

		
});
");

?>

<div class="serie-index-view" >
	<div class="left-serie-view" >
		<?php
		echo CHtml::image("images/".$data->imdbdataTv->Poster,'details',
			array('id'=>'Imdbdata_tv_Poster_button_'.$data->Id, 'style'=>'height: 200px;width: 125px;'));
		?>
	</div>
	<div class="right-serie-view" >
		<?php echo CHtml::encode($data->imdbdataTv->Title); ?>
		<br />
		<b><?php echo CHtml::encode($data->imdbdataTv->getAttributeLabel('Year')); ?>:</b>
		<?php echo CHtml::encode($data->imdbdataTv->Year); ?>
		<br />
	
		<b><?php echo CHtml::encode($data->imdbdataTv->getAttributeLabel('Episode')); ?>:</b>
		<?php echo CHtml::encode($data->imdbdataTv->Episode); ?>
		<br />

		<b><?php echo CHtml::encode($data->imdbdataTv->getAttributeLabel('Genre')); ?>:</b>
		<?php echo CHtml::encode($data->imdbdataTv->Genre); ?>
		<br />
	
		<b><?php echo CHtml::encode($data->imdbdataTv->getAttributeLabel('Plot')); ?>:</b>
		<?php echo CHtml::encode($data->imdbdataTv->Plot); ?>
		<br />
	
		<b><?php echo CHtml::encode($data->imdbdataTv->getAttributeLabel('Actors')); ?>:</b>
		<?php echo CHtml::encode($data->imdbdataTv->Actors); ?>
		<br />
		<b><?php echo CHtml::encode($data->imdbdataTv->getAttributeLabel('Director')); ?>:</b>
		<?php echo CHtml::encode($data->imdbdataTv->Director); ?>
		<br />
		<b><?php echo CHtml::encode($data->getAttributeLabel('Points')); ?>:</b>
		<?php echo CHtml::encode($data->points); ?>
		<br />
	
	</div>
	<?php echo CHtml::hiddenField('id_nzb',$data->Id,array('class'=>'id_nzb','style'=>'display:none')); ?>
</div>