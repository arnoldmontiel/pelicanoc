<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('Id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->Id), array('view', 'id'=>$data->Id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('shared_path')); ?>:</b>
	<?php echo CHtml::encode($data->shared_path); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Id_customer')); ?>:</b>
	<?php echo CHtml::encode($data->Id_customer); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sabnzb_api_key')); ?>:</b>
	<?php echo CHtml::encode($data->sabnzb_api_key); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sabnzb_api_url')); ?>:</b>
	<?php echo CHtml::encode($data->sabnzb_api_url); ?>
	<br />


</div>