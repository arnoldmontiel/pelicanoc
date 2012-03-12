<?php 
Yii::app()->clientScript->registerScript(__CLASS__.'#imdbdataTv_view', "

");

?>

<div class="serie-index-view" >
	<div class="left-serie-view" >
		<?php
		echo CHtml::link( CHtml::image("images/".$data->imdbdataTv->Poster,'details',array('id'=>'imdbdataTv_Poster_button', 'style'=>'height: 200px;width: 125px;')
                            ),array('viewEpisode', 'id'=>$data->Id));
		?>
	</div>
	<div class="right-serie-view" >
		<?php echo CHtml::encode($data->imdbdataTv->Title); ?>
		<br />
		<b><?php echo CHtml::encode($data->imdbdataTv->getAttributeLabel('Year')); ?>:</b>
		<?php echo CHtml::encode($data->imdbdataTv->Year); ?>
		<br />
	
		<b><?php echo CHtml::encode($data->imdbdataTv->getAttributeLabel('Episode')); ?>:</b>
		<?php echo CHtml::encode($data->imdbdataTv->episode); ?>
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
	
	</div>
</div>