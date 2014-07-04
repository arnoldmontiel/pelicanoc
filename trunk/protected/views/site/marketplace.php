<script type="text/javascript">

</script>
<div class="container" id="screenDescargas" >
	<div class="wrapper">
		<div id="market-area">

		<?php 
			foreach($dataProvider->getData() as $data) 
			{					
				echo $this->renderPartial('_viewMarketCategory',array('data'=>$data)); 
			}
		?>	
		</div>
	</div><!-- /wrapper -->
</div><!-- /container -->