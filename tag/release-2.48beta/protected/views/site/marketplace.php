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
<div class="container needsclick" id="screenMarketplace" >
	<div class="wrapper needsclick">
		<div id="market-area" class="needsclick">

		<?php 
			foreach($dataProvider->getData() as $data) 
			{
				$nzbs = $data->nzbs;
				if(count($nzbs)>0)
				{
					foreach ($nzbs as $nzb)
					{
						//si al menos un nzb esta ready, muestro la categoria
						//y salgo del loop para pasar a la siguente
						if($nzb->ready&&$nzb->deleted!=1)
						{
							echo $this->renderPartial('_viewMarketCategory',array('data'=>$data));
							break;						
						}
					}
					
				} 
			}
		?>	
		</div>
	</div><!-- /wrapper -->
</div><!-- /container -->