<?php

Yii::app()->clientScript->registerScript('sabnzbdstatus', "
setInterval(function() {
	$.get('".SiteController::createUrl('AjaxRefreshSabNzbStatus')."').success(
		function(data) 
		{
			var result = JSON.parse(data);
			for(var index = 0; index < result.length; index++)
			{							
				var total = Math.round(result[index].mb);
				var current = Math.round(result[index].mb - result[index].mbleft);
				var percentage = Math.round((current * 100)/ total);
				var name = result[index].filename.replace(/\//g, '');
				name = name.replace(/ /g,'');				
				
				$('#percentage-bar_'+name).width(percentage+'%');
				$('#percentage-bar_'+name).html(percentage+'%');
			
			}
		}
	);
}, 5000)
");
?>
<h2 class="sliderTitle">Descargando</h2>
<div class="pelisDescargadas">
<!--      empieza peli finalizada-->
<?php
foreach($dataProvider->getData() as $record) 
{
	$data = $record->myMovieDiscNzb->myMovieNzb;
	
	$percentage = 0;	
	$fileName = explode('.',$record->file_name);
	$fileName = $fileName[0];
	
	foreach($sABnzbdStatus->jobs as $job)
	{
		if(strpos($job['filename'], $fileName) !== false)
		{			
			$total = round($job['mb']);
			$current = round($job["mb"]-$job["mbleft"]);
			
			if($total > 0)
				$percentage = round(($current * 100) / $total);
			
			break;
		}		
	}	
	
	
 ?>
	<div class="peliDescargando"><img class="peliAfiche" src="<?php echo 'images/'. $data->poster ?>" border="0">
		<div class="peliDescargandoProgress">
			<div class="progress progress-striped active">
  				<div id="percentage-bar_<?php echo $fileName ?>" class="bar" style="width: <?php echo $percentage ?>%;"><?php echo $percentage ?>%</div>
			</div>
		</div>
	</div>
<?php } ?>
<!--      termina peli finalizada-->
</div>
<?php if(isset($modelMyMovie)): ?>
<h2 class="sliderTitle">Copiando</h2>
<div class="peliDescargando">
	<img class="peliAfiche" src="<?php echo 'images/'. $modelMyMovie->poster ?>" border="0">
	<div class="peliDescargandoProgress">
		<div class="progress progress-striped active">
			<div id="percentage-bar" class="bar" style="width:5%;">5%</div>
		</div>
	</div>
</div>
<?php endif; ?>
