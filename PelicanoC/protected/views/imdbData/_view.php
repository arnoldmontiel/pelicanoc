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
	
	
		<?php /*
		<b><?php echo CHtml::encode($data->imdbdata->getAttributeLabel('Writer')); ?>:</b>
		<?php echo CHtml::encode($data->imdbdata->Writer); ?>
		<br />
		<b><?php echo CHtml::encode($data->imdbdata->getAttributeLabel('Rated')); ?>:</b>
		<?php echo CHtml::encode($data->imdbdata->Rated); ?>
		<br />
	
		<b><?php echo CHtml::encode($data->imdbdata->getAttributeLabel('Released')); ?>:</b>
		<?php echo CHtml::encode($data->imdbdata->Released); ?>
		<br />
	
	
		<b><?php echo CHtml::encode($data->imdbdata->getAttributeLabel('Poster')); ?>:</b>
		<?php echo CHtml::encode($data->imdbdata->Poster); ?>
		<br />
	
		<b><?php echo CHtml::encode($data->imdbdata->getAttributeLabel('Runtime')); ?>:</b>
		<?php echo CHtml::encode($data->imdbdata->Runtime); ?>
		<br />
	
		<b><?php echo CHtml::encode($data->imdbdata->getAttributeLabel('Rating')); ?>:</b>
		<?php echo CHtml::encode($data->imdbdata->Rating); ?>
		<br />
	
		<b><?php echo CHtml::encode($data->imdbdata->getAttributeLabel('Votes')); ?>:</b>
		<?php echo CHtml::encode($data->imdbdata->Votes); ?>
		<br />
	
		<b><?php echo CHtml::encode($data->imdbdata->getAttributeLabel('Response')); ?>:</b>
		<?php echo CHtml::encode($data->imdbdata->Response); ?>
		<br />
	
		*/ ?>
	</div>
</div>