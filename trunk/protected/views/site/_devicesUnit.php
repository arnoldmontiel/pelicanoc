<ul class="nav nav-pills nav-stacked" >
	<?php
    	if(count($modelCurrentESs)>0)
		{
			foreach($modelCurrentESs as $modelCurrentES)
			{
				$nameES = $modelCurrentES->label;
				if($idSelected == $modelCurrentES->Id)
					echo "<li id=".$modelCurrentES->Id." class='usb-button-scan active'><a href='#'>".$nameES."</a><a type='button' class='ejectBTN btn btn-default'><i class='fa fa-eject'></i></a></li>";
				else							
					echo "<li id=".$modelCurrentES->Id." class='usb-button-scan'><a href='#'>".$nameES."</a><a type='button' class='ejectBTN btn btn-default'><i class='fa fa-eject'></i></a></li>";
			}
		}
	?>        		
</ul>

<script>

	$('.usb-button-scan').unbind('click');
	$('.usb-button-scan').click(function(){
		var id = $(this).attr("id");
		$(this).parent().find('.usb-button-scan').removeClass('active');
		$(this).addClass('active');
		$('#hidden-unit').val(id);
		$.post("<?php echo SiteController::createUrl('AjaxExploreExternalStorage'); ?>",
			{
				id:id			    
			}
		).success(
				function(data){						
					var obj = jQuery.parseJSON(data);					
					if(obj.workingFirstScan == 1)
					{
						if(obj.msg != null)
							$('#wizardDispositivos').html(obj.msg);
						
						$('#hidden-first-scan-working').val(1);
					}
					else
					{
						$.post("<?php echo SiteController::createUrl('AjaxHardScanES'); ?>",
								{
									id:id
								}
							).success(
								function(data){	
									$('#wizardDispositivos').html(data);
							});
					}							
		});
				
		return false;
	});

  </script>