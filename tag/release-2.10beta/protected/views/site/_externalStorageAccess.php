<?php 
	if(count($modelCurrentESs)>0)
	{
		foreach($modelCurrentESs as $modelCurrentES)
		{
			echo CHtml::imageButton('img/usb_black.png',array('id'=>$modelCurrentES->Id, 'class'=>'usb-button-scan'));
		}
	}
	else 
	{
		echo CHtml::openTag('p');
			echo "No hay unidades externas conectadas..";
		echo CHtml::closeTag('p');
	}
?>		

<script>

	$('.usb-button-scan').click(function(){
		var id = $(this).attr("id");
		$('#hidden-unit').val(id);
		$('#hidden-working').val(1);		
		$.post("<?php echo SiteController::createUrl('AjaxExploreExternalStorage'); ?>",
			{
				id:id			    
			}
		).success(
			function(data){	
				$('#explorer-unit').html(data);							
		});
				
		return false;
	});

  </script>
