
<div class="container" id="screenDescargas" >
   <div class="row">
    <div class="col-md-12">
    
    <?php

Yii::app()->clientScript->registerScript('sabnzbdstatus', "

// getRipp();
getNzbStatus();
   		
setInterval(function() {
   	updateFinished($('ul.nav-pills li.active a').attr('id'));
   	//updateExternal();comentado para version lite
	updateDownloads();   		   		
   	getNzbStatus();   		
}, 1000*15)

	$('ul.nav-pills li a').click(function(){
		updateFinished($(this).attr('id'));
	});
   		
	function updateFinished(filter)
	{
   		if(!$('#myModal').is(':visible'))
   		{
   			var currentIds = new Array;
   			$.each($('li a.aficheClickFinished'),function(){
   				currentIds.push({ sourcetype:$(this).attr('sourcetype'),idresource:$(this).attr('idresource'),idmovie:$(this).attr('idmovie')});
			});
   			$.post('" .SiteController::createUrl('AjaxUpdateDownloadFinished'). "',{ids:currentIds,idFilter:filter}
			).success(
			function(data){
				if(data.trim()!='')
   					$('#finished-area').html(data);
			});   		
   		
   		}
	}	
	function updateExternal()
	{
   		if(!$('#myModal').is(':visible'))
   		{
   			var currentIds = new Array;
   			$.each($('li a.aficheClickLocalFolder'),function(){
   				//currentIds.push({ idexternalstorage:$(this).attr('idexternalstorage'),sourcetype:$(this).attr('sourcetype'),idresource:$(this).attr('idresource'),idmovie:$(this).attr('idmovie')});
				currentIds.push($(this).attr('idexternalstorage'));
			});
   				
   			$.post('" .SiteController::createUrl('AjaxUpdateDownloadExternal'). "',{ids:currentIds}
			).success(
			function(data){
   				if(data.trim()!='')
   					$('#external-area').html(data);   				   						
			});   		
   		}
	}	
	function updateDownloads()
	{
   		if(!$('#myModal').is(':visible'))
   		{
   			var currentIds = new Array;
   			$.each($('li a.aficheClickNzb'),function(){
   				//currentIds.push({ idexternalstorage:$(this).attr('idexternalstorage'),sourcetype:$(this).attr('sourcetype'),idresource:$(this).attr('idresource'),idmovie:$(this).attr('idmovie')});
				currentIds.push($(this).attr('idresource'));
			});
   				
   			$.post('" .SiteController::createUrl('AjaxUpdateDownloads'). "',{ids:currentIds}
			).success(
			function(data){
   				if(data.trim()!='')
   					$('#market-area').html(data);
			});   		
   		}
	}	
						
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
						$('#btn-cancelRipp').removeAttr('disabled');	
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
	    		if(result[index].nzb_id!='0')
	    		{
	    			if(typeof result[index].status!='undefined')
	    				$('#'+result[index].nzb_id).parent().remove();
	    			else
						$('#'+result[index].nzb_id).val(result[index].nzb_porcent).trigger('change');
	    		}			
			}
		}
	);
}
");
?>
<div id="finished-area">
<?php
//Finalizada recientemente
$this->renderPartial("_downloadFinished",array("movies"=>$movies,"filter"=>$filter));
?>
</div>

<div id="market-area">
<?php
//desde marketplace 
$this->renderPartial("_downloadMarket",array("nzbDownloading"=>$nzbDownloading));
?>
</div>

<!-- Comentado para Pelicano Lite #####
<div id="external-area">
<?php
//desde USB 
//$this->renderPartial("_downloadExternal",array("externalStorageDataCopying"=>$externalStorageDataCopying));
?>
</div>
<div id="ripping-area">
<?php
//desde Discos Opticos 
//$this->renderPartial("_downloadRipping",array("modelMyMovie"=>$modelMyMovie));
?>
</div>
-->
 
 
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

<div id="ripping-area" style="display:none">
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
		<a id="btn-cancelRipp" class="btn">
			<i class="icon-th"></i>
				Cancelar
		</a>
	</div>

</div>
<script>
	$('#btn-cancelRipp').click(function(){
		$('#btn-cancelRipp').attr("disabled", "disabled");		
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
    		   		url: '<?php echo SiteController::createUrl('AjaxMovieShowFinishedDetail') ?>',
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
    $("a.aficheClickLocalFolder").click(
    		function()
    		{
    			var sourceType = $(this).attr("sourceType");
    			var id = $(this).attr("idMovie");
    			var idExternalStorage = $(this).attr("idExternalStorage");
    			var idResource = $(this).attr("idResource");		
    			var param = 'id='+id+'&sourcetype='+sourceType+'&idresource='+idResource+'&idExternalStorageData='+idExternalStorage; 
    			$.ajax({
    		   		type: 'POST',
    		   		url: '<?php echo SiteController::createUrl('AjaxMovieShowExternalStorageDownloadDetail') ?>',
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
