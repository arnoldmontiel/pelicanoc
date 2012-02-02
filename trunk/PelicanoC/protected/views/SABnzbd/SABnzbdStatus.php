<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/detail-view-blue.css" />
<?php
$this->breadcrumbs=array(
	'SABnzbd'=>array('/sABnzbd'),
	'SABnzbdStatus',
);

Yii::app()->clientScript->registerScript('sabnzbdstatus', "
setInterval(function() {
    $.fn.yiiGridView.update('jobs-grid', {
			data: $(this).serialize()
		});
	
	$.get('".SABnzbdController::createUrl('RefreshHeader')."'
				).success(
					function(data) 
					{
						$('#headerData').html(data);
					}
				);
}, 55000)
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

	<div id="headerData"><?php echo $headerData ?></div>

	<?php
	$this->widget('zii.widgets.grid.CGridView', 
		array(
			'id'=>'jobs-grid',
			'dataProvider' => $arrayDataProvider,
			'afterAjaxUpdate'=>'function(id, data){
							createProgressBars();
						}',
			'columns' => array(
				array('name' => 'File Name','type' => 'raw','value' => 'CHtml::encode($data["filename"])'),
				array('name' => 'MB','type' => 'raw','value' => 'CHtml::encode(round($data["mb"],2))','htmlOptions'=>array('style'=>'text-align: right;')),
				array('name' => 'MB Left','type' => 'raw','value' => 'CHtml::encode(round($data["mbleft"],2))','htmlOptions'=>array('style'=>'text-align: right;')),
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
        	var mbleft = $($.fn.yiiGridView.getRow('jobs-grid',i.toString())[2]).text();
        	var mb = $($.fn.yiiGridView.getRow('jobs-grid',i.toString())[1]).text();
			$.fn.yiiGridView.getRow('jobs-grid',i.toString()).find('#progressbar').progressbar({'value': ((mb-mbleft)/mb)*100});
        });
	}	

");
	?>
	