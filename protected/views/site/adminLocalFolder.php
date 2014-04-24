<script type="text/javascript">

setInterval(function() {
	   $.fn.yiiGridView.update('local-folder-grid');
	   getScanStatus();
	}, 100*90)

getScanStatus();
function getScanStatus()
{
	$.post("<?php echo SiteController::createUrl('AjaxGetScanStatus'); ?>"
	).success(
		function(data){
			if(data == 0)
				$('#btn-scan').removeAttr('disabled');
	});
}

function scanDirectory()
{
	$('#btn-scan').attr('disabled','disabled');
	$.post("<?php echo SiteController::createUrl('AjaxGetFilesFromPath'); ?>"
	).success(
		function(data){
	});
	return false;	
}


</script>

<div class="container" id="screenEscaneo">
	<div class="row pageTitleContainer">
    	<div class="col-md-6">
   	 		<h1 class="pageTitle">Escaneo Inicial</h1>
   	 	</div>
    	<div class="col-md-6 align-right">
   	 		<button id="btn-scan" onclick="scanDirectory();" class="btn btn-primary"><i class="fa fa-refresh"></i> Escanear</button>
   	 	</div>
   	 </div>
	<div class="row">
    	<div class="col-md-12">

<?php 
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'local-folder-grid',
	'itemsCssClass' => 'table table-striped table-bordered tablaIndividual',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'cssFile'=>false,
	'columns'=>array(		        
		array(
		    'name'=>'fileType_description',
		    'value'=>'$data->fileType->description',	
			'headerHtmlOptions'=>array("width"=>"5%"),	    
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

    	</div>
    </div>
</div>
