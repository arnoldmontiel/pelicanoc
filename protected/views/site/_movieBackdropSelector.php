
<div class="modal-dialog ">
        <div class="modal-content"> <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true"> <i class="fa fa-times-circle fa-lg"></i></button>
    <h4 class="modal-title">Cambiar Fondo</h4>
    </div>
    <div class="modal-body"> 
    <div class="modal-scroll">
        <div>
    <div>Sube tu imagen</div>
    <input type="file" name="fileUpload1" id="fileUpload1" class="fileUpload" />
</div>
<div>
    o Elige una de la lista    
       <select class="image-picker">
       <?php
       $urls = array();
       foreach ($backdrops as $backdrop)
		{
			$urls[]=$backdrop->file_path;
        	echo "<option data-img-src='".$backdrop->file_path."' value='".$backdrop->file_path."'></option>";
		}
       ?>
      </select>
</div>
      </div>
    </div><!--/.modal-body -->
    <div class="modal-footer">
    <button id="btn-cancel" type="button" data-dismiss="modal" class="btn btn-default btn-large">Cancelar</button>
    <button id="btn-acept" type="button" class="btn btn-primary btn-large"><i class="fa fa-save "></i> Guardar</button>
    </div><!--/.modal-footer -->
  </div><!--/.modal-content -->
    </div><!--/.modal-dialog -->
      <script type="text/javascript">

    $("select.image-picker").imagepicker({
      hide_select:  true,
    });
    $("#btn-acept").click(function(){
		$("#btn-acept").attr("disabled", "disabled");
		$("#btn-cancel").attr("disabled", "disabled");
		$("#btn-acept i").removeClass();
		$("#btn-acept i").addClass("fa fa-spinner fa-spin");
        
    	if($("select.image-picker").val()!="")
    	{
			$.ajax({
		   		type: 'POST',
		   		url: '<?php echo SiteController::createUrl('ajaxSaveSelectedBackdrop') ?>',
		   		data: {idResource:<?php echo $idResource;?>,sourceType:<?php echo $sourceType;?>,TMDB_id:<?php echo $movie->id;?>,backdrop:$("select.image-picker").val()},
		   		dataType:'json'
		 	}).success(function(data)
		 	{
			 	var date = new Date;	 	
			 	ChangeBG('images/',data.backdrop+"?" + date.valueOf());
				$('#myModalCambiarBackdrop').modal('hide');	   						   				
			}
		 	);
	 	}			
        }
    	);
	    var urls = <?php echo json_encode($urls);?>;
		$('.fileUpload').liteUploader(
			{
				script: '<?php echo SiteController::createUrl('ajaxUploadImage')?>',
				allowedFileTypes: 'image/jpeg,image/png,image/gif',
				maxSizeInBytes: 30000000,
				customParams: {
					'custom': 'tester',
					'urls':urls,
					'id_tmdbdata':<?php echo $movie->id;?>
				},
				before: function (files)
				{
					$('#details, #previews').empty();
					$('#response').html('Uploading ' + files.length + ' file(s)...');
				},
				each: function (file, errors)
				{
					var i, errorsDisp = '';

					if (errors.length > 0)
					{
						$('#response').html('One or more files did not pass validation');

						$.each(errors, function(i, error)
						{
							errorsDisp += '<br /><span class="error">' + error.type + ' error - Rule: ' + error.rule + '</span>';
						});
					}

					$('#details').append('<p>name: ' + file.name + ', type: ' + file.type + ', size:' + file.size + errorsDisp + '</p>');
				},
				success: function (response)
				{
					var response = $.parseJSON(response);
					$.each(response.urls, function(i, url)
					{
						if(i==0)
						{
							//$('.image_picker_selector').html("");
							$('.image-picker').html("<select class='image-picker'></select>");							
						}
						//$('.image_picker_selector').append('<li><div class="thumbnail selected"><img class="image_picker_image" src="'+url+'"></div></li>');
						//$('.image_picker_selector').append('<option data-img-src='+url+' value='+url+'></option>');
						$('select.image-picker').append('<option data-img-src='+url+' value='+url+'></option>');
											
					});
					$("select.image-picker").imagepicker({
					      hide_select:  true,
					});				

					$('#response').html(response.message);
				}
			});
    
  </script>