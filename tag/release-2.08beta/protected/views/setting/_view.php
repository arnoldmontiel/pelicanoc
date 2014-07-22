<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('path_pending')); ?>:</b>
	<?php echo CHtml::encode($data->path_pending); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sabnzb_api_key')); ?>:</b>
	<?php echo CHtml::encode($data->sabnzb_api_key); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sabnzb_api_url')); ?>:</b>
	<?php echo CHtml::encode($data->sabnzb_api_url); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('host_name')); ?>:</b>
	<?php echo CHtml::encode($data->host_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('path_ready')); ?>:</b>
	<?php echo CHtml::encode($data->path_ready); ?>
	<br />
 
	<b><?php echo CHtml::encode($data->getAttributeLabel('path_subtitle')); ?>:</b>
	<?php echo CHtml::encode($data->path_subtitle); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('path_images')); ?>:</b>
	<?php echo CHtml::encode($data->path_images); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('path_shared')); ?>:</b>
	<?php echo CHtml::encode($data->path_shared); ?>
	<br />

</div>

<?php 
echo CHtml::link('Update Setting Data',array('/setting/update','id'=>$data->Id));
?>