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

function hideReg(hide, idLocalFolder)
{
	$.post("<?php echo SiteController::createUrl('AjaxHideScanedVideo'); ?>",
			{
				idLocalFolder:idLocalFolder,
				hide:hide 
			}
	).success(
		function(data){
			$.fn.yiiGridView.update('local-folder-grid');
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
        'read_date',
        'path',
        'Id_lote',		
		array(
			'header'=>'Oculto',
			'value'=>function($data){
				$value = 'No';
				if($data->hide == 1)
					$value = 'Si';		
				return $value;
			},
			'type'=>'raw',
		),
		array(
				'htmlOptions' => array('style'=>'width:100px;'),
				'type'=>'raw',
				'value'=>'CHtml::link("Reproducir",Yii::app()->createUrl("'.Yii::app()->getController()->getId().'/start",array("idResource"=>$data->Id, "sourceType"=>3, "id"=>$data->myMovieDisc->Id_my_movie)),array("target"=>"_blank"))',
		),
		array(
			'header'=>'Acciones',
				'value'=>function($data){
					$value = '<button onclick="hideReg(1,'.$data->Id.');" type="button" class="btn btn-default btn-sm" ><i class="fa fa-cog"></i> Ocultar</button>';
					if($data->hide == 1)
						$value = '<button onclick="hideReg(0,'.$data->Id.');" type="button" class="btn btn-default btn-sm" ><i class="fa fa-cog"></i> Mostrar</button>';
					return $value;
				},
				'type'=>'raw',
		),
	),
)); ?>

    	</div>
    </div>
</div>
