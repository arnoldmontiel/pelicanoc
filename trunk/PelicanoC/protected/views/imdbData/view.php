<?php
$this->breadcrumbs=array(
	'Imdbdatas'=>array('index'),
	$modelImdbdata->Title,
);

$this->menu=array(
	array('label'=>'List Imdbdata', 'url'=>array('index')),
	array('label'=>'Create Imdbdata', 'url'=>array('create')),
	array('label'=>'Update Imdbdata', 'url'=>array('update', 'id'=>$modelImdbdata->ID)),
	array('label'=>'Delete Imdbdata', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$modelImdbdata->ID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Imdbdata', 'url'=>array('admin')),
);
?>

<h1>View Imdbdata <?php echo $modelImdbdata->ID; ?></h1>
<div id="conteiner" style="display: inline-block;">

	<div class="left" style="display: inline-block;">

	<?php $this->widget('zii.widgets.CDetailView', array(
		'data'=>$modelImdbdata,
		'cssFile'=>Yii::app()->baseUrl . '/css/detail-view-blue.css',
		'attributes'=>array(
			'ID',
			'Title',
			'Year',
			'Rated',
			'Released',
			'Genre',
			'Director',
			'Writer',
			'Actors',
			'Plot',
			'Runtime',
			'Rating',
			'Votes',
			'Response',
		),
	)); ?>
	</div>
	<div class="right" style="display: inline-block; vertical-align: top;">
			<?php echo CHtml::image( $modelImdbdata->Poster, $modelImdbdata->Title,array('id'=>'Imdbdata_Poster_img', 'style'=>'height: 320px;width: 220px;')); ?>
	</div>
	<?php
		 $this->widget('zii.widgets.jui.CJuiButton',
			 array(
			 	'id'=>'downloadButton',
			 	'name'=>'download',
			 	'caption'=>'Download',
			 	'value'=>'Click to download movie',
			 	'onclick'=>'js:function(){
			 		if(confirm("Save button clicked"))
			 		{
						$.post("'.ImdbdataController::createUrl('AjaxStartDownload').'",
								{id_nzb: "'.$model->Id.'"}
						).success(
							function(data) 
							{
	 							$("#downloadButton").hide();
	 							$("#started-display").animate({opacity: "show"},"slow");
							}
						);
		 
			 		}
			 		return false;
				}',
				'htmlOptions'=>array('style'=>'display: none;')
		 	)
		 );
	 ?>	
	 <div id="started-display" style="display: none; ">
	 	<img alt="Download Started" src="images/download_started.png">
	 </div>
</div>
	<?php
Yii::app()->clientScript->registerScript(__CLASS__.'#Imdbdata', "
	ShowDownload();
	function ShowDownload()
	{
		if('".$model->downloaded."'=='1')
		{
			$('#started-display').show();
		}
		else
		{
			$('#downloadButton').show();
		}
		
	}	

");
?>
	
	