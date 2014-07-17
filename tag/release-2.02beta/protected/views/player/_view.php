<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('Id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->Id), array('view', 'id'=>$data->Id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('url')); ?>:</b>
	<?php echo CHtml::encode($data->url); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('file_protocol')); ?>:</b>
	<?php echo CHtml::encode($data->file_protocol); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Id_setting')); ?>:</b>
	<?php echo CHtml::encode($data->Id_setting); ?>
	<br />


</div>