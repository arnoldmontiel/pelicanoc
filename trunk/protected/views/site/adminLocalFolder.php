<?php
/* @var $this AutoRipperController */
/* @var $model AutoRipper */

Yii::app()->clientScript->registerScript('admin-local-folder', "

setInterval(function() {
   $.fn.yiiGridView.update('local-folder-grid');
}, 1000*90)

$('#btn-scan').click(function(){	
	$.post('".SiteController::createUrl('AjaxGetFilesFromPath')."',
	{ 
		path: $('#txt-path').val()
	}
	).success(
	function(data){

	});
});
");
?>
<h1>Administracion</h1>

<?php 

echo CHtml::textField('txt-path','',array('id'=>'txt-path'));
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
		    'value'=>'$data->sourceType->description',		    
		),
        'read_date',
        'path',
        'Id_lote',
		array(				
				'htmlOptions' => array('style'=>'width:100px;'),
			 	'type'=>'raw',
			 	'value'=>'CHtml::button("Ver Estado",array("id"=>$data->Id, "class"=>"btn-admin-state"))',			 			
			),
		array(
			'class'=>'CButtonColumn',
			'template'=>'{delete}',
		),
	),
)); ?>
