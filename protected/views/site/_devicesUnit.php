<ul class="nav nav-pills nav-stacked" >
	<?php
    	if(count($modelCurrentESs)>0)
		{
			foreach($modelCurrentESs as $modelCurrentES)
			{
// 				$paths = explode('/', $modelCurrentES->path);
// 				$size = count($paths);
// 				$nameES = "";
// 				if($size>0)
// 					$nameES = $paths[$size-1];
				$nameES = "USB 2";
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
		$('#hidden-first-scan-working').val(1);		
		$.post("<?php echo SiteController::createUrl('AjaxExploreExternalStorage'); ?>",
			{
				id:id			    
			}
		).success(
			function(data){	
				$('#wizardDispositivos').html(data);							
		});
				
		return false;
	});

  </script>