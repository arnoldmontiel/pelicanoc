<div class="container" id="screenDescargas" >
   <div class="row">
    <div class="col-md-12">
    
    <?php

Yii::app()->clientScript->registerScript('sabnzbdstatus', "

getRipp();
getNzbStatus();

setInterval(function() {
	getRipp();
}, 5000)
		
function getRipp()
{
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
	    				$('#percentage-bar').width(obj.percentage+'%');
						$('#percentage-bar').html(obj.percentage+'%');
						$('#btn-cancel').removeAttr('disabled');	
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
}

function getNzbStatus()
{
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
}
setInterval(function() {
	getNzbStatus();
}, 5000)
");
?>
<?php
//Finalizada recientemente
$this->renderPartial("_downloadFinished",array("movies"=>$movies));
?>
<?php
//desde marketplace 
$this->renderPartial("_downloadMarket",array("nzbDownloading"=>$nzbDownloading));
?>
<?php
//desde USB 
$this->renderPartial("_downloadExternal",array("externalStorageDataCopying"=>$externalStorageDataCopying));
?>
<?php
//desde Discos Opticos 
$this->renderPartial("_downloadRipping",array("modelMyMovie"=>$modelMyMovie));
?>

<div class="pelisDescargadas" style="display:none">
<!--      empieza peli finalizada-->
<?php
foreach($dataProvider->getData() as $record) 
{
	$data = $record->myMovieDiscNzb->myMovieNzb;
	
	$percentage = 0;	
	$fileName = explode('.',$record->file_name);
	$fileName = $fileName[0];
	if(isset($sABnzbdStatus->jobs))
	{
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

<div id="ripping-area">
	<h2 class="sliderTitle">Copiando</h2>
	<div class="peliDescargando">
	<?php if(isset($modelMyMovie)): ?>
		<img id="ripp-image" class="peliAfiche" src="<?php echo 'images/'. $modelMyMovie->poster ?>" border="0">
	<?php else: ?>
		<img id="ripp-image" class="peliAfiche" src="" border="0">
	<?php endif; ?>		
		<div class="peliDescargandoProgress">
			<div class="progress progress-striped active">
				<div id="percentage-bar" class="bar" style="width:0%;">0%</div>				
			</div>
		</div>
		<a id="btn-cancel" class="btn">
			<i class="icon-th"></i>
				Cancelar
		</a>
	</div>

</div>
<script>
	$('#btn-cancel').click(function(){
		$('#btn-cancel').attr("disabled", "disabled");		
		$.post("<?php echo SiteController::createUrl('AjaxCancelRipp'); ?>"
			).success(
				function(data){
		});
	});
    $("a.aficheClickFinished").click(
    		function()
    		{
    			var sourceType = $(this).attr("sourceType");
    			var id = $(this).attr("idMovie");
    			var idResource = $(this).attr("idResource");		
    			var param = 'id='+id+'&sourcetype='+sourceType+'&idresource='+idResource; 
    			$.ajax({
    		   		type: 'POST',
    		   		url: '<?php echo SiteController::createUrl('AjaxMovieShowDetail') ?>',
    		   		data: param,
    		 	}).success(function(data)
    		 	{
    		 	
    				$('#myModal').html(data);	
    		   		$('#myModal').modal({
    	  				show: true
    				});		
    			}
    		 	);
    		   	return false;	
    			
    		}
       );
    	
</script>


    </div> <!-- /col-md-12 -->
  </div><!-- /row -->
</div><!-- /container -->
