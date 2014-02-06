<div class="devicesHeader clearfix"><div class="dropdown deviceDropdown pull-left">
          <a class="deviceDropdownName" id="drop" role="button" data-toggle="dropdown" href="#"><?php echo $label;?> <i class="fa fa-caret-down"></i></a>
           <ul id="menu1" class="dropdown-menu" role="menu" aria-labelledby="drop">
				<?php
					$modelCurrentESs = CurrentExternalStorage::model()->findAllByAttributes(array('is_in'=>1));
			    	if(count($modelCurrentESs)>0)
					{
						foreach($modelCurrentESs as $modelCurrentES)
						{
							$nameES = $modelCurrentES->label;
							if($idCurrentES != $modelCurrentES->Id)
								echo "<li id=".$modelCurrentES->Id." ><a onclick='changeDevice(".$modelCurrentES->Id.")'>".$nameES."</a></li>";
						}
					}
				?>        		
		 </ul>
        </div>
  <div class="pull-right justtext"><p>Indique si alguno de estos archivos es un video personal, luego proceda a analizar el disco para encontrar las peliculas</p></div>
        </div>
  <div class="table-responsive">
	<table class="table tablaIndividual ">
    	<thead>
        	<tr>
              <th width="5%" class="align-center">#</th>
              <th>Archivo</th>
              <th width="35%">T&iacute;tulo</th>
              <th width="35%">
              	<div class="checkbox">
  					<label>
    					<input type="checkbox" class="chkAllPersonal" value=""> Es Video personal? 
  					</label>
				</div>
			  </th>
            </tr>
		</thead>
		<tbody id="tbodyStep1">        	
        	<?php
        	$index = 0;
        	foreach($modelESDataDBs as $modelESDataDB)
        	{
        		$index++;
        		echo CHtml::openTag("tr");
	        		echo CHtml::openTag("td  class='align-center'");
	        			echo $index;
	        		echo CHtml::closeTag("td");
	        		echo CHtml::openTag("td class='small'");
        				if(empty($modelESDataDB->file))
        				{
        					$paths = explode('/', $modelESDataDB->path);
        					$size = count($paths);
        					if($size>0)
        						echo $paths[$size-1];
        				}
        				else
        					echo $modelESDataDB->file;
	        		echo CHtml::closeTag("td");
	        		echo CHtml::openTag("td class='bold'");
	        			echo $modelESDataDB->title;
	        		echo CHtml::closeTag("td");
	        		echo CHtml::openTag("td");
	        			if($modelESDataDB->is_personal == 1)
	        				$checked = "checked";
	        			else
	        				$checked = "";	        		
	        			echo "<div class='checkbox'>
	  							<label>
	    							<input idData='".$modelESDataDB->Id."' class='chkPersonal' ".$checked." type='checkbox' value=''>
	  							</label>
							</div>";
	        		echo CHtml::closeTag("td");
	        	echo CHtml::closeTag("tr");
        	}
        	?>            
		</tbody>
	</table>
    <div class="buttonGroup">
    	<button type="button" id="btnScanDisc" class="btn btn-primary">Analizar Disco</button>
    </div>
    </div>
    
<script>

	$('.chkAllPersonal').unbind('click');
	$('.chkAllPersonal').click(function(){
		var id = $('#hidden-unit').val();
		var isPersonal = 0;
		if($(this).is(':checked'))
			isPersonal = 1;
		$.post("<?php echo SiteController::createUrl('AjaxSetAllAsPersonal'); ?>",
				{
					idCurrentES:id,
					isPersonal:isPersonal			    
				}
			).success(
				function(data){	
					var checkboxes = $("#tbodyStep1").find(':checkbox');
				    if(isPersonal == 1) {
				        checkboxes.attr('checked', 'checked');
				    } else {
				        checkboxes.removeAttr('checked');
				    }
			});
	});

	$('.chkPersonal').unbind('click');
	$('.chkPersonal').click(function(){
		var id = $(this).attr("idData");
		var isPersonal = 0;
		if($(this).is(':checked'))
			isPersonal = 1;
		
		$.post("<?php echo SiteController::createUrl('AjaxSetAsPersonal'); ?>",
				{
					id:id,
					isPersonal:isPersonal			    
				}
			).success(
				function(data){	
			});
	});

	$('#btnScanDisc').unbind('click');
	$('#btnScanDisc').click(function(){		
		var id = $('#hidden-unit').val();
		
		$.post("<?php echo SiteController::createUrl('AjaxHardScanES'); ?>",
				{
					id:id
				}
			).success(
				function(data){	
					$('#wizardDispositivos').html(data);
					$('#hidden-second-scan-working').val(1);	
			});
	});	

  </script>  