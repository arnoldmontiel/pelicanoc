<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/detail-view-blue.css" />
<?php

Yii::app()->clientScript->registerScript('sabnzbdstatus', "
setInterval(function() {
    $.fn.yiiGridView.update('jobs-grid', {
			data: $(this).serialize()
		});

	$.get('".SABnzbdController::createUrl('AjaxRefreshHeader')."').success(
		function(data) 
		{
			var result = JSON.parse(data);
			$('#sabnzb_timeleft').html(result.timeleft);
			$('#sabnzb_state').html(result.state);
			$('#sabnzb_speed').html(result.speed);
		}
	);
}, 5000)
");
?>
<?php 
	$this->widget('zii.widgets.jui.CJuiProgressBar', array(
		'value'=>(($modelStatus->mb-$modelStatus->mbleft)/($modelStatus->mb==0?1:$modelStatus->mb))*100,
		// additional javascript options for the progress bar plugin
		'options'=>array(
			'change'=>'js:function(event, ui) {}',
		),
		'htmlOptions'=>array(
			'style'=>'display:none;'
		),
	));
?>

	<div id="headerData">
		<div class="sabnzb-view">
			<div class="sabnzb-view-row">
				<div class="sabnzb-view-td">
					<div class="sabnzb-label">Time Left: </div>	<div id="sabnzb_timeleft" class="sabnzb-data"><?php echo $modelStatus->timeleft ?></div>
				</div>
				<div class="sabnzb-view-td">
					<div class="sabnzb-label">Speed: </div>	<div id="sabnzb_speed"  class="sabnzb-data"><?php echo $modelStatus->speed ?></div>
				</div>
				<div class="sabnzb-view-td">
					<div class="sabnzb-label">Status:</div>	<div id="sabnzb_state" class="sabnzb-data"><?php echo $modelStatus->state ?></div>
				</div>
			</div>
		</div>
	</div>

	<?php
	$this->widget('zii.widgets.grid.CGridView', 
		array(
			'id'=>'jobs-grid',
			'cssFile'=>Yii::app()->baseUrl.'/css/grid-view-custom.css',
			'dataProvider' => $arrayDataProvider,
			'summaryText' =>"",
			'afterAjaxUpdate'=>'function(id, data){
							createProgressBars();
						}',
			'columns' => array(
				array('name' => 'File Name','type' => 'raw','value' => 'CHtml::encode($data["filename"])'),
				array('name' => 'Down','type' => 'raw','value' => 'CHtml::encode(round($data["mb"]-$data["mbleft"],2))','htmlOptions'=>array('style'=>'text-align: right;')),
				array('name' => 'Total','type' => 'raw','value' => 'CHtml::encode(round($data["mb"],2))','htmlOptions'=>array('style'=>'text-align: right;')),
				array('name' => 'Status','type' => 'raw',
					'value' => 'CHtml::openTag("div",array("id"=>"progressbar"))')
							,		
		)
	));
	?>
	
	<?php
Yii::app()->clientScript->registerScript(__CLASS__.'#SABnzbdStatus', "
	createProgressBars();
	function createProgressBars()
	{
        $('#jobs-grid > table > tbody > tr').each(function(i)
        {
        	var mb = $($.fn.yiiGridView.getRow('jobs-grid',i.toString())[2]).text();
        	var mbleft = $($.fn.yiiGridView.getRow('jobs-grid',i.toString())[1]).text();
			$.fn.yiiGridView.getRow('jobs-grid',i.toString()).find('#progressbar').progressbar({'value': (mbleft/mb)*100});
        });
	}	

");
	?>
	