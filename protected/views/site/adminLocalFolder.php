<?php
/* @var $this AutoRipperController */
/* @var $model AutoRipper */

Yii::app()->clientScript->registerScript('admin-local-folder', "

setInterval(function() {
   $.fn.yiiGridView.update('local-folder-grid');
   getScanStatus();
}, 100*90)

function getScanStatus()
{
$.post('".SiteController::createUrl('AjaxGetScanStatus')."'
	).success(
	function(data){
		if(data == 0)
			$('#btn-scan').removeAttr('disabled');
	});
}
$('#btn-scan').click(function(){	
	$('#btn-scan').attr('disabled','disabled');
	$.post('".SiteController::createUrl('AjaxGetFilesFromPath')."',
	{ 
		path: 'a'
	}
	).success(
	function(data){

	});
});
");
?>
<h1>Administracion</h1>

<?php 

echo CHtml::button('Escanear',array('id'=>'btn-scan'));

$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'local-folder-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'cssFile'=>false,
	'columns'=>array(		        
		array(
		    'name'=>'fileType_description',
		    'value'=>'$data->fileType->description',		    
		),
		array(
		    'name'=>'title',
		    'value'=>'$data->myMovieDisc->myMovie->original_title',		    
		),
		array(
		    'name'=>'sourceType_description',
		    'value'=>'isset($data->sourceType)?$data->sourceType->description:""',		    
		),
        'read_date',
        'path',
        'Id_lote',
		array(				
				'htmlOptions' => array('style'=>'width:100px;'),
			 	'type'=>'raw',			 			
				'value'=>'CHtml::link("Reproducir",Yii::app()->createUrl("'.Yii::app()->getController()->getId().'/start",array("idResource"=>$data->Id, "sourceType"=>3, "id"=>$data->myMovieDisc->Id_my_movie)),array("target"=>"_blank"))',
			),
		array(
			'class'=>'CButtonColumn',
			'template'=>'{delete}',
			'deleteConfirmation'=>'�Esta seguro de eliminar el registro?',
			'buttons'=>array(
				'delete' => array
				(
					'url'=>'Yii::app()->controller->createUrl("site/AjaxDeleteScan",array("id"=>$data->Id))',
				)
			),
		),
	),
)); ?>
