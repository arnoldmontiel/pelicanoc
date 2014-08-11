<<script type="text/javascript">
function openConsumptionDetail(month, year)
{
	var param = 'month='+month + '&year='+year; 
	$.ajax({
		type: 'POST',
		url: "<?php echo SiteController::createUrl('AjaxConsumptionDetail')?>",
		data: param,
	}).success(function(data)
	{		
		$('#myModalConsumptionDetail').html(data);	
		$('#myModalConsumptionDetail').modal({
			show: true
		})		
	});
	return false;	
}
</script>

<div class="container" id="screenConsumos">
	<div class="wrapper clearfix">
		<div class="row pageTitleContainer">
			<div class="col-sm-12">
				<h1 class="pageTitle">Consumos</h1>
			</div>
			<!-- /col-sm-12 -->
		</div>
		<div class="row">
			<div class="col-sm-6">
				<ul class="nav nav-tabs">
					<li class="active"><a id="a-tab-uploading" href="#tabMesActual"
						data-toggle="tab">Consumos del Mes</a></li>
					<li><a id="a-tab-draft" href="#tabHistorial" data-toggle="tab">Historial</a></li>
				</ul>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<div class="tab-content">
					<div class="tab-pane active" id="tabMesActual">
						<?php echo $this->renderPartial('_tabCurrentMonth',array('modelConsumption'=>$modelConsumption)); ?>
					</div>
					<!-- /.tabMesActual -->

					<div class="tab-pane" id="tabHistorial">
						<?php echo $this->renderPartial('_tabHistory',array('modelConsumption'=>$modelConsumption)); ?>
					</div>
				</div>
				<!-- /.tab-content -->
			</div>
			<!-- /.col-sm-12 -->
		</div>
		<!-- /.row -->
	</div>
	<!-- /.wrapper -->
</div>
<!-- /.container -->
