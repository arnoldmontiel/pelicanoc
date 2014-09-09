
<div class="container needsclick" id="screenDescargas" >
<div class="wrapper needsclick">

    
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
			$('#downloadSpeed').html(result.speed+'B/s');
			if(!$('#myModalVelocidad').is(':visible'))
			{
				$('#setSpeedLimit').val(result.speedlimit);	    				
		    	if( typeof result.speedlimit=='undefined')
				{
					$('#setSpeedLimit').val('');
				}
			}
					
	    	
	    	if( typeof result.speed =='undefined')
	    		$('#downloadSpeed').html('0 B/s');
	    					    				
			result = result.jobs;
	    	var first = true;
			for(var index = 0; index < result.length; index++)
			{			
	    		if(result[index].nzb_id!='0')
	    		{
	    			if(typeof result[index].status!='undefined')
	    			{
	    				$('#knob_'+result[index].nzb_id).hide();
	    				if(typeof result[index].error!='undefined'&&result[index].error=='1')
	    				{
	    					$('#preparing_'+result[index].nzb_id).hide();
	    					$('#queued_'+result[index].nzb_id).hide();
	    					$('#error_'+result[index].nzb_id).show();	    				
	    				}
	    				else
	    				{
	    					$('#error_'+result[index].nzb_id).hide();
	    					$('#queued_'+result[index].nzb_id).hide();
	    					$('#preparing_'+result[index].nzb_id).show();
	    				}
					}
	    			else
	    			{
	    				$('#preparing_'+result[index].nzb_id).hide();
	    				$('#error_'+result[index].nzb_id).hide();
	    				if(!first)
	    				{
	    					$('#queued_'+result[index].nzb_id).show();
	    				}
	    				$('#knob_'+result[index].nzb_id).show();	    				
						$('#'+result[index].nzb_id).val(result[index].nzb_porcent).trigger('change');
	    			}
	    		}			
	    		first = false;
			}
		}
	);
}
");
?>
<div class="row rowBackground">
<div class="col-md-12">
<div id="finished-area">
<?php
//Finalizada recientemente
$this->renderPartial("_downloadFinished",array("movies"=>$movies,"filter"=>$filter));
?>
</div>
</div>
</div>    <div class="row rowBackground">
    <div class="col-md-12">
<div id="market-area">
<?php
//desde marketplace 
$this->renderPartial("_downloadMarket",array("nzbDownloading"=>$nzbDownloading,"sABnzbdStatus"=>$sABnzbdStatus));
?>
</div>
</div>
</div>
<!-- Comentado para Pelicano Lite #####
<div class="row rowBackground">
<div class="col-md-12">
<div id="external-area">
<?php
//desde USB 
//$this->renderPartial("_downloadExternal",array("externalStorageDataCopying"=>$externalStorageDataCopying));
?>
</div>
</div>
</div>
<div class="row rowBackground">
<div class="col-md-12">
<div id="ripping-area">
<?php
//desde Discos Opticos 
//$this->renderPartial("_downloadRipping",array("modelMyMovie"=>$modelMyMovie));
?>
</div>
</div>
</div>
-->
</div><!-- /wrapper -->
</div><!-- /container -->
<script>
	$('#btn-cancelRipp').click(function(){
		$('#btn-cancelRipp').attr("disabled", "disabled");		
		$.post("<?php echo SiteController::createUrl('AjaxCancelRipp'); ?>"
			).success(
				function(data){
		});
	});
    function retrytDownload(idNzb)
    {
		$.ajax({
	   		type: 'POST',
	   		url: '<?php echo SiteController::createUrl('AjaxRestartDownload') ?> ',
	   		data: {Id_nzb:idNzb},
	 	}).success(function(data)
	 	{	 	
			$('#restart_'+idNzb).attr('disabled','disabled');
		}
	 	);	
        
        return false;
    }
    function downloadFirst(idNzb,button)
    {
        $(button).attr("disabled","disabled");
		$.ajax({
	   		type: 'POST',
	   		url: '<?php echo SiteController::createUrl('AjaxDownloadFirst') ?> ',
	   		data: {Id_nzb:idNzb},
	 	}).success(function(data)
	 	{
	 		refreshDownloads();
		}
	 	);	
        
        return false;
    }
    function refreshDownloads()
    {
			$.post('<?php echo SiteController::createUrl('AjaxRefreshDownload') ?> ').success(
			function(data){
   				if(data.trim()!='')
   					$('#market-area').html(data);
			});   		
        
    }
    function showDownloading(idNzb)
    {
		var param = 'idNzb=' + idNzb; 
		$.ajax({
	   		type: 'POST',
	   		url: '<?php echo SiteController::createUrl('AjaxMarketShowDetail') ?> ',
	   		data: param,
	 	}).success(function(data)
	 	{	 	
			$('#myModal').html(data);
			$('#myModal').modal('show');
		}
	 	);	
    
    }
    
    function showFinished(object)
    {
		var sourceType = $(object).attr("sourceType");
		var id = $(object).attr("idMovie");
		var idResource = $(object).attr("idResource");		
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
    function saveSpeedlimit(object)
    {
		$.ajax({
	   		type: 'POST',
	   		url: '<?php echo SiteController::createUrl('AjaxSaveSpeedlimit') ?> ',
	   		data: {speed:$("#setSpeedLimit").val()},
	 	}).success(function(data)
	 	{
	 		$('#myModalVelocidad').modal('hide');
		}
	 	);	
        
        return false;
        
    }
    function showLocalFolder(object)
    {
		var sourceType = $(object).attr("sourceType");
		var id = $(object).attr("idMovie");
		var idExternalStorage = $(object).attr("idExternalStorage");
		var idResource = $(object).attr("idResource");		
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
    
</script>