<?php
$this->breadcrumbs=array(
	'SABnzbd'=>array('/sABnzbd'),
	'SABnzbdStatus',
);?>
<?php 
	$this->createWidget('zii.widgets.jui.CJuiProgressBar', array(
		'value'=>($modelStatus->mbleft/$modelStatus->mb)*100,
		// additional javascript options for the progress bar plugin
		'options'=>array(
			'change'=>'js:function(event, ui) {}',
		),
		'htmlOptions'=>array(
			'style'=>'height:20px;'
		),
	));
?>
	<?php $this->widget('zii.widgets.CDetailView', array(
		'data'=>$modelStatus,
		'attributes'=>array(
			'have_warnings',
			'timeleft',
			'mb',
			'mbleft',
			'noofslots',
			'paused',
			'pause_int',
			'state',
		),
	)); ?>

	
	<?php
	
	$this->widget('zii.widgets.grid.CGridView', 
		array(
			'dataProvider' => $arrayDataProvider,
			'columns' => array(
				array('name' => 'File Name','type' => 'raw','value' => 'CHtml::encode($data["filename"])'),
				array('name' => 'MB','type' => 'raw','value' => 'CHtml::encode($data["mb"])'),
				array('name' => 'MB Left','type' => 'raw','value' => 'CHtml::encode($data["mbleft"])'),
				array('name' => 'MB Left',
					'value' => '$this->widget("zii.widgets.jui.CJuiProgressBar", array(
								"value"=>(20),
								),
							)')
							,		
		)
	));
	?>


	<?php
	$this->beginWidget("zii.widgets.jui.CJuiProgressBar", array(
									"value"=>(20),
	)
	);
	//$this->endWidget();
	$this->widget('zii.widgets.grid.CGridView', 
		array(
			'dataProvider' => $arrayDataProvider,
			'columns' => array(
				array('name' => 'File Name','type' => 'raw','value' => 'CHtml::encode($data["filename"])'),
				array('name' => 'MB','type' => 'raw','value' => 'CHtml::encode($data["mb"])'),
				array('name' => 'MB Left','type' => 'raw','value' => 'CHtml::encode($data["mbleft"])'),
				array('name' => 'MB Left',
					'value' => $this->endWidget())
							,		
		)
	));
	?>
	