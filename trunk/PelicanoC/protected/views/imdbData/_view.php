<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->ID), array('view', 'id'=>$data->ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Title')); ?>:</b>
	<?php echo CHtml::encode($data->Title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Year')); ?>:</b>
	<?php echo CHtml::encode($data->Year); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Rated')); ?>:</b>
	<?php echo CHtml::encode($data->Rated); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Released')); ?>:</b>
	<?php echo CHtml::encode($data->Released); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Genre')); ?>:</b>
	<?php echo CHtml::encode($data->Genre); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Director')); ?>:</b>
	<?php echo CHtml::encode($data->Director); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('Writer')); ?>:</b>
	<?php echo CHtml::encode($data->Writer); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Actors')); ?>:</b>
	<?php echo CHtml::encode($data->Actors); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Plot')); ?>:</b>
	<?php echo CHtml::encode($data->Plot); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Poster')); ?>:</b>
	<?php echo CHtml::encode($data->Poster); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Runtime')); ?>:</b>
	<?php echo CHtml::encode($data->Runtime); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Rating')); ?>:</b>
	<?php echo CHtml::encode($data->Rating); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Votes')); ?>:</b>
	<?php echo CHtml::encode($data->Votes); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Response')); ?>:</b>
	<?php echo CHtml::encode($data->Response); ?>
	<br />

	*/ ?>

</div>