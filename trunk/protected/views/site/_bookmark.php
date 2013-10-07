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
    
    <div class="row-fluid detailSecondGroup">
		<table class="table table-striped">
              <thead>
                <tr>
                  <th>Descripci&oacute;n</th>
                  <th>Inicio escena</th>
                  <th>Fin escena</th>
                  <th>Reproducir</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
              <?php 
              	foreach($bookmarks as $item){
              		echo CHtml::openTag('tr');
              			echo CHtml::openTag('td');
              				echo $item->description;
              			echo CHtml::closeTag('td');
              			echo CHtml::openTag('td');
              				echo $item->start;
              			echo CHtml::closeTag('td');
              			echo CHtml::openTag('td');
              				echo $item->end;
              			echo CHtml::closeTag('td');
              			echo CHtml::openTag('td');
              				echo "<button class='btn btn-primary btn-medium'><i class='icon-play-circle'></i></button>";
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
	    <input type="hidden" name="hiden-start" id="hidden-start">
	    <button id="btn-scene-end" disabled="disabled" class='btn btn-primary btn-medium'>Fin escena</button>
	    <input type="hidden" name="hiden-end" id="hidden-end">
	   
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
 	
	$('#btn-scene-start').click(function(){
		$(this).attr("disabled","disabled");		
		$.post("<?php echo SiteController::createUrl('AjaxStartDownloadsdfdf'); ?>",
			{Id_nzb: "<?php echo "aa"; ?>"}
		).success(
			function(data) 
			{					
				//save start
			}
		);
		$('#btn-scene-end').removeAttr("disabled");
		return false;
	});

	$('#btn-scene-end').click(function(){
		$(this).attr("disabled","disabled");		
		$.post("<?php echo SiteController::createUrl('AjaxStartDownloadsdfdf'); ?>",
			{Id_nzb: "<?php echo "aa"; ?>"}
		).success(
			function(data) 
			{					
				//save start
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
		$('#hidden-start').val(2);
		$('#hidden-end').val(22);
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
					//save start
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