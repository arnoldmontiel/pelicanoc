<?php

Yii::app()->clientScript->registerScript('sabnzbdstatus', "
setInterval(function() {
	$.get('".SABnzbdController::createUrl('AjaxRefreshSabNzbStatus')."').success(
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
	$fileName = "";
	foreach($sABnzbdStatus->jobs as $job)
	{
		if(strpos($job['filename'], $record->file_name) !== false)
		{
			$fileName = str_replace(" ","",$job['filename']); 
			$fileName = str_replace("/","",$fileName);
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
