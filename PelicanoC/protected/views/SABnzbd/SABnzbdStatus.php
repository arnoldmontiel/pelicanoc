<?php
$this->breadcrumbs=array(
	'SABnzbd'=>array('/sABnzbd'),
	'SABnzbdStatus',
);?>
<?php 
	$this->widget('zii.widgets.jui.CJuiProgressBar', array(
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
	foreach($modelStatus->jobs as $job)
	{
		 $this->widget('zii.widgets.CDetailView', array(
			'data'=>$job,
			'attributes'=>array(
				'filename',
				'mb',
				'mbleft',
			),
		)); 
	}?>

	