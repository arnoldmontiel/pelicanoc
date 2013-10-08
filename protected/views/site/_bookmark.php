 <!--  <div id="myModal" class="modal modalDetail">-->   
   <div id="myModal" class="modal hide fade modalDetail in" style="display: block;" aria-hidden="false" aria-labelledby="myModalLabel" role="dialog" tabindex="-1">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true"> <i class="icon-remove-sign icon-large"></i></button>
      <h3 id="myModalLabel">Bookmark</h3>
    </div>
    <div class="modal-body"> 
    <div class="row-fluid">    
    
    <div class="span9">
    
    <div class="row-fluid detailMainGroup">
    Lista de bookmarks
    </div><!--/.row -->
    
    <div class="row-fluid detailSecondGroup tableInfoBookmark">
		<table class="table table-striped">
              <thead>
                <tr>
                  <th>Descripci&oacute;n</th>
                  <th>Inicio escena</th>
                  <th>Fin escena</th>
                  <th>Reproducir</th>
                  <th>Borrar</th>
                  <th></th>
                </tr>
              </thead>
              <tbody id="bookmark-table">
              <?php 
              	echo CHtml::openTag('tr',array('class'=>'bookmark-row'));
              	echo CHtml::closeTag('tr');
              	foreach($bookmarks as $item){
              		echo CHtml::openTag('tr',array('class'=>'bookmark-row', 'id'=>'id_'.$item->Id));
              			echo CHtml::openTag('td');
              				echo $item->description;
              			echo CHtml::closeTag('td');
              			echo CHtml::openTag('td');
              				echo $item->time_start;
              			echo CHtml::closeTag('td');
              			echo CHtml::openTag('td');
              				echo $item->time_end;
              			echo CHtml::closeTag('td');
              			echo CHtml::openTag('td');
              				echo "<button idrecord='".$item->Id."' class='btn btn-primary btn-medium btn-play-position'><i class='icon-play'></i></button>";
              			echo CHtml::closeTag('td');
              			echo CHtml::openTag('td');
              				echo "<i idrecord='".$item->Id."' class='icon-eraser pointer btn-eraser'></i>";
              			echo CHtml::closeTag('td');
              		echo CHtml::closeTag('tr');
              	}
              ?>                
              </tbody>
            </table>         
     </div>  
    
    </div><!--/.span9PRINCIPAL -->
    
    <div class="span3 pagination-centered">
	    <div class="row-fluid detailSecondGroup">	    
	    	Crear Bookmark	    
	    </div><!--/.row -->
	    
	    <br>
	    <button id="btn-scene-start" class='btn btn-primary btn-medium'>Inicio escena</button>
	    <input type="hidden" name="hidden-start" id="hidden-start">
	    <button id="btn-scene-end" disabled="disabled" class='btn btn-primary btn-medium'>Fin escena</button>
	    <input type="hidden" name="hidden-end" id="hidden-end">
	   
	   	<br>
	   	<br>
		<input id="txt-scene-name" disabled="disabled" type="text" class="form-control" placeholder="Escena..">
	    
	    
	   	<br>
		<button id="btn-scene-save" disabled="disabled" class='btn btn-primary btn-medium'>Guardar</button>
		<button id="btn-scene-cancel" class='btn btn-primary btn-medium'>Cancelar</button>
		
	</div><!--/.span3PRINCIPAL -->
    
   
    
    </div><!--/.rowPRINCIPAL -->
    
    
    </div>
    <div class="modal-footer">    
    </div>
  </div>
 
 <script>
 	$('#btn-scene-cancel').click();

 	$('.btn-play-position').click(function(){
 		$(this).attr("disabled","disabled");	
 		var id = $(this).attr('idrecord');	
 		$.post("<?php echo SiteController::createUrl('AjaxPlayFromPosition'); ?>",
 			{
 				id:id			    
 			}		
		).success(
			function(data) 
			{					
				$('#hidden-end-value').val(data);
				$('#modalBookmark').modal('hide');
			}
		);		
		return false; 	 	
 		
 	});
 	
 	$('.btn-eraser').click(function(){
 	 	var id = $(this).attr('idrecord');
 	 	if (confirm("\u00bfSeguro desea eliminarlo?"))
		{
			$.post("<?php echo SiteController::createUrl('AjaxRemoveBookmark'); ?>",
			{
				id:id			    
			}
			).success(
				function(data){
					if(data == "1")
						$('#bookmark-table').find('#id_'+id).remove(); 
			});
		}
		return false;
 	});
 	
	$('#btn-scene-start').click(function(){
		$(this).attr("disabled","disabled");		
		$.post("<?php echo SiteController::createUrl('AjaxGetDunePosition'); ?>"			
		).success(
			function(data) 
			{					
				if(data!=0)
					$('#hidden-start').val(data);
			}
		);
		$('#btn-scene-end').removeAttr("disabled");
		return false;
	});

	$('#btn-scene-end').click(function(){
		$(this).attr("disabled","disabled");		
		$.post("<?php echo SiteController::createUrl('AjaxGetDunePosition'); ?>"			
		).success(
			function(data) 
			{					
				if(data!=0)
					$('#hidden-end').val(data);
			}
		);
		$('#txt-scene-name').removeAttr("disabled");
		return false;
	});

	$('#txt-scene-name').keyup(function(){
		if($(this).val().length > 0)
			$('#btn-scene-save').removeAttr("disabled");
		else
			$('#btn-scene-save').attr("disabled","disabled");
		
		return false;
	});

	$('#btn-scene-save').click(function(){				
		$.post("<?php echo SiteController::createUrl('AjaxSaveScene'); ?>",
				{
					idResource:<?php echo $idResource; ?>,
				    sourceType:<?php echo $sourceType; ?>,
					sceneStart: $('#hidden-start').val(),
					sceneEnd: $('#hidden-end').val(),
					sceneText: $('#txt-scene-name').val()
				}
			).success(
				function(data) 
				{					
					$('.bookmark-row').first().before(data);
					$('#btn-scene-cancel').click();

					$('.bookmark-row').first().find('.btn-play-position').click(function(){
						$(this).attr("disabled","disabled");	
				 		var id = $(this).attr('idrecord');	
				 		$.post("<?php echo SiteController::createUrl('AjaxPlayFromPosition'); ?>",
				 			{
				 				id:id			    
				 			}		
						).success(
							function(data) 
							{				
								$('#hidden-end-value').val(data);	
								$('#modalBookmark').modal('hide');
							}
						);		
						return false; 	 	
					});
					
					$('.bookmark-row').first().find('.btn-eraser').click(function(){
						var id = $(this).attr('idrecord');
				 	 	if (confirm("\u00bfSeguro desea eliminarlo?"))
						{
							$.post("<?php echo SiteController::createUrl('AjaxRemoveBookmark'); ?>",
							{
								id:id			    
							}
							).success(
								function(data){
									if(data == "1")
										$('#bookmark-table').find('#id_'+id).remove(); 
							});
						}
						return false;
					});
				}
			);
		return false;
	});
	
	$('#btn-scene-cancel').click(function(){
		$('#hidden-start').val(null);
		$('#hidden-end').val(null);
		$('#btn-scene-start').removeAttr("disabled");
		$('#btn-scene-end').attr("disabled","disabled");
		$('#txt-scene-name').attr("disabled","disabled");
		$('#txt-scene-name').val('');
		$('#btn-scene-save').attr("disabled","disabled");		
		return false;
	});
  </script>