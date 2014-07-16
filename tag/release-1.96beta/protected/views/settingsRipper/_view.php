<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('Id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->Id), array('view', 'id'=>$data->Id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('drive_letter')); ?>:</b>
	<?php echo CHtml::encode($data->drive_letter); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('temp_folder_ripping')); ?>:</b>
	<?php echo CHtml::encode($data->temp_folder_ripping); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('final_folder_ripping')); ?>:</b>
	<?php echo CHtml::encode($data->final_folder_ripping); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('time_from_reboot')); ?>:</b>
	<?php echo CHtml::encode($data->time_from_reboot); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('time_to_reboot')); ?>:</b>
	<?php echo CHtml::encode($data->time_to_reboot); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('mymovies_username')); ?>:</b>
	<?php echo CHtml::encode($data->mymovies_username); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('mymovies_password')); ?>:</b>
	<?php echo CHtml::encode($data->mymovies_password); ?>
	<br />

	*/ ?>

</div>