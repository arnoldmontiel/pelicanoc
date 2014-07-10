<script type="text/javascript">
function openMovieShowDetail(id, sourceType, idResource)
{
	var param = 'id='+id+'&sourcetype='+sourceType+'&idNzb='+idResource; 
	$.ajax({
		type: 'POST',
		url: "<?php echo SiteController::createUrl('AjaxMarketShowDetail')?>",
		data: param,
	}).success(function(data)
	{	
	
		
		$('#myModal').html(data);	
		$('#myModal').modal({
			show: true
		})		
	});
	return false;	
}

</script>
<div class="container" id="screenHome" >
	<div class="wrapper">
		<div id="market-area">

		<?php 
			foreach($dataProvider->getData() as $data) 
			{		
				$nzbs= $data->nzbs;
				if(count($nzbs)>0)
				{
					echo $this->renderPartial('_viewMarketCategory',array('data'=>$data));
				} 
			}
		?>	
		</div>
	</div><!-- /wrapper -->
</div><!-- /container -->