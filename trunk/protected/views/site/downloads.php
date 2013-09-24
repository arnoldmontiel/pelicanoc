<?php

Yii::app()->clientScript->registerScript('sabnzbdstatus', "

setInterval(function() {
	$.post('" .SiteController::createUrl('AjaxGetRipp'). "'
		).success(
			function(data){				
    			if(data != null)
	    		{        			
	    			var obj = jQuery.parseJSON(data);    			
	    			if(obj.id != 0)
	    			{    				
	    				var src = 'images/' + obj.poster;
	    				$('#ripp-image').attr('src', src);
	    				$('#ripping-area').show();	
					}
	    			else
	    				$('#ripping-area').hide();
	    		}
	    		else
	    		{		        		    				
					$('#ripping-area').hide();
	    		} 
			},'json');
}, 5000)
		
		
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
<div id="ripping-area">
	<h2 class="sliderTitle">Copiando</h2>
	<div class="peliDescargando">
		<img id="ripp-image" class="peliAfiche" src="<?php echo 'images/'. $modelMyMovie->poster ?>" border="0">
		<div class="peliDescargandoProgress">
			<div class="progress progress-striped active">
				<div id="percentage-bar" class="bar" style="width:45%;">45%</div>				
			</div>
		</div>
		<a id="btn-cancel" class="btn">
			<i class="icon-th"></i>
				Cancelar
		</a>
	</div>
</div>
<?php endif; ?>
<?php 
$this->beginWidget('bootstrap.widgets.TbModal', array('id' => 'myModal')); 

echo CHtml::openTag('div',array('id'=>'view-details'));
//place holder
echo CHtml::closeTag('div'); 

$this->endWidget(); ?>
<script>
	$('#btn-cancel').click(function(){
		$('#btn-cancel').attr("disabled", "disabled"); 
		$.post("<?php echo SiteController::createUrl('AjaxCancelRipp'); ?>"
			).success(
				function(data){
		});
	});
</script>
