
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
    
   	function downloadFirst(idNzb,button)
    {
        $(button).attr('disabled','disabled');
		$.ajax({
	   		type: 'POST',
	   		url: '<?php echo SiteController::createUrl('AjaxDownloadFirst') ?> ',
	   		data: {Id_nzb:idNzb},
	 	}).success(function(data)
	 	{
	 		updateDownloads();	 	
		}
	 	);	
        
        return false;
    }
   		
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
	    			{
	    				$('#knob_'+result[index].nzb_id).hide();
	    				if(typeof result[index].error!='undefined'&&result[index].error=='1')
	    				{
	    					$('#preparing_'+result[index].nzb_id).hide();
	    					$('#error_'+result[index].nzb_id).show();
	    				}
	    				else
	    				{
	    					$('#error_'+result[index].nzb_id).hide();
	    					$('#preparing_'+result[index].nzb_id).show();
	    				}
					}
	    			else
	    			{
	    				$('#preparing_'+result[index].nzb_id).hide();
	    				$('#error_'+result[index].nzb_id).hide();
	    				$('#knob_'+result[index].nzb_id).show();	    				
						$('#'+result[index].nzb_id).val(result[index].nzb_porcent).trigger('change');
	    			}
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
$this->renderPartial("_downloadMarket",array("nzbDownloading"=>$nzbDownloading,"sABnzbdStatus"=>$sABnzbdStatus));
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
    </div> <!-- /col-md-12 -->
  </div><!-- /row -->
</div><!-- /container -->
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
    function showDownloading(object)
    {
		var id = $(object).attr('idMovie');
		var idNzb = $(object).attr('idResource');
		var param = 'id='+id + '&idNzb=' + idNzb; 
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
    
    
</script>