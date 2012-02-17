<?php 
Yii::app()->clientScript->registerScript(__CLASS__.'#Imdbdata_view', "

");

?>

<div class="movie-index-view" >
	<div class="left-movie-view" >
		<?php
		echo CHtml::link( CHtml::image("images/".$data->imdbdata->Poster,'details',array('id'=>'Imdbdata_Poster_button', 'style'=>'height: 200px;width: 125px;')
                            ),array('view', 'id'=>$data->Id));
		?>
	</div>
	<div class="right-movie-view" >
		<?php echo CHtml::encode($data->imdbdata->Title); ?>
		<br />
		<b><?php echo CHtml::encode($data->imdbdata->getAttributeLabel('Year')); ?>:</b>
		<?php echo CHtml::encode($data->imdbdata->Year); ?>
		<br />
	
		<b><?php echo CHtml::encode($data->imdbdata->getAttributeLabel('Genre')); ?>:</b>
		<?php echo CHtml::encode($data->imdbdata->Genre); ?>
		<br />
	
		<b><?php echo CHtml::encode($data->imdbdata->getAttributeLabel('Plot')); ?>:</b>
		<?php echo CHtml::encode($data->imdbdata->Plot); ?>
		<br />
	
		<b><?php echo CHtml::encode($data->imdbdata->getAttributeLabel('Actors')); ?>:</b>
		<?php echo CHtml::encode($data->imdbdata->Actors); ?>
		<br />
		<b><?php echo CHtml::encode($data->imdbdata->getAttributeLabel('Director')); ?>:</b>
		<?php echo CHtml::encode($data->imdbdata->Director); ?>
		<br />
	
	</div>
</div>