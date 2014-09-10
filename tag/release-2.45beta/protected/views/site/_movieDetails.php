 <div class="modal-dialog modalDetail">
        <div class="modal-content">
   <?php
		$setting = Setting::getInstance();
   		$players =$setting->players;
    
   		$idResource = "";		
		$size = 0;
		$path = "";
		
		if(isset($modelNzb)){
			$idResource = $modelNzb->Id;			
			$folderPath = explode('.',$modelNzb->file_name);
			$path = $folderPath[0];
			$modelTMDB =  $modelNzb->TMDBData;
				
		}
		
		if(isset($modelRippedMovie)){
			$idResource = $modelRippedMovie->Id;
			$path = $modelRippedMovie->path;
 			$modelTMDB =  $modelRippedMovie->TMDBData;
		}
		
		if(isset($modelLocalFolder)){
			$idResource = $modelLocalFolder->Id;
			$path = $modelLocalFolder->path;
 			$modelTMDB =  $modelLocalFolder->TMDBData;
		}
		
 		if(!empty($path))
 		{
 			$setting = Setting::getInstance();
 			if(isset($modelNzb))
 			{
 				$path = $setting->path_sabnzbd_download .'/'. $path;
 			}
 			else
 			{
 				$path = $setting->path_shared . $path;
 			} 	
 			if(isset($modelNzb))
 			{
 				if($modelNzb->ready_to_play)
 				{
 					$size = PelicanoHelper::getDirectorySize($path,false);
 					$nzbs = $modelNzb->nzbs;
 					foreach ($nzbs as $nzb)
 					{
 						$pathChild = explode('.',$nzb->file_name);
 						$pathChild = $pathChild[0]; 							
 						$pathChild = $setting->path_sabnzbd_download . $pathChild;
 						$size += PelicanoHelper::getDirectorySize($pathChild,false);
 					}
 					$size = PelicanoHelper::format_bytes($size);
 				}
 				else if($setting->is_movie_tester&&isset($modelNzb->size))
 				{
 					$size = PelicanoHelper::format_bytes($modelNzb->size); 					
 				}
 			}
 			else
 			{
 				$size = PelicanoHelper::getDirectorySize($path);
 					
 			}
 			 			
 		}

 		$moviePoster = $model->big_poster;
 		if(isset($modelTMDB)&&$modelTMDB->big_poster!="")
 		{
 			$moviePoster = $modelTMDB->big_poster;
 		}
 		$moviePoster = PelicanoHelper::getImageName($moviePoster, "_big");
		?>	    
     <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true"> <i class="fa fa-times-circle fa-lg"></i></button>
    <h4 class="modal-title"><?php echo $model->original_title;?></h4>
    </div>
    <div class="modal-body"> 
    <div class="row">
    <div class="col-md-3 col-sm-3 align-center hidden-nexus-p">
    <img class="aficheDetail" src="<?php echo $moviePoster;?>" width="100%" height="100%" border="0">
    </div><!--/.col-md-3PRINCIPAL -->
        
    <div class="col-md-9 col-sm-9 col-nexus-12">
    <ul class="nav nav-tabs">
                <li class="active"><a href="#tab1" data-toggle="tab">Informaci&oacute;n</a></li>
                <?php if(!isset($fromControl)):?>
	                <?php if(isset($modelNzb)):?>
		                <?php if($modelNzb->ready_to_play||$setting->is_movie_tester):?>
	                		<li class=""><a href="#tab2" data-toggle="tab">Avanzado</a></li>
		                <?php endif?>
	                <?php else:?>
	                	<li class=""><a href="#tab2" data-toggle="tab">Avanzado</a></li>
	              	<?php endif?>                  
	             <?php endif?>                  
	              	
              <!-- <li class=""><a href="#tab3" data-toggle="tab">Bookmarks</a></li>-->
              <?php if(!isset($fromControl)):?>
              	<?php if(!isset($modelNzb)):?> 
              		<li class="pull-right"><button  id="btn-edit" type="button" class="btn btn-default"><i class='fa fa-pencil'></i> Editar Informaci&oacute;n</button></li>
              	<?php endif?>
              <?php endif?>
    </ul>
	<div class="tab-content tableInfo">
    <div class="tab-pane active" id="tab1">
    <div class="row detailSecondGroup">
    <div class="col-md-3 col-sm-3 align-left detailSecond detailSecondFirst">
    GENERO
    </div><!--/.col-md-3 -->
    <div class="col-md-9 col-sm-9 align-left detailSecond">
	<?php echo ($model->genre != '' ? $model->genre : '&nbsp;');	?>
    </div><!--/.col-md-9 -->
    </div><!--/.row -->
    
    <div class="row detailSecondGroup">
    <div class="col-md-3 col-sm-3 align-left detailSecond detailSecondFirst">
    PUBLICO
    </div><!--/.col-md-3 -->
    <div class="col-md-9 col-sm-9 align-left detailSecond">
	<?php
		//echo ($model->parentalControl->description != '' ? $model->parentalControl->description  : '&nbsp;');	
		echo ($model->certification != '' ? $model->certification  : 'UNRATED');
	?>
    </div><!--/.col-md-9 -->
    </div><!--/.row -->
    
    <div class="row detailSecondGroup">
    <div class="col-md-3 col-sm-3 align-left detailSecond detailSecondFirst">
    RATING
    </div><!--/.col-md-3 -->
    <div class="col-md-9 col-sm-9 align-left detailSecond">
    <div class="ratingStars">
    <?php    	
	$image = 'rate'.str_pad($model->rating, 2, "0", STR_PAD_LEFT).'.png';
	if ($model->rating == 1  ){
echo '<i class="fa fa-star-half-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i>';
}	else if ($model->rating == 2  ){
echo '<i class="fa fa-star"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i>';
}	else if ($model->rating == 3  ){
echo '<i class="fa fa-star"></i><i class="fa fa-star-half-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i>';
}	else if ($model->rating == 4  ){
echo '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i>';
}	else if ($model->rating == 5  ){
echo '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-half-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i>';
}	else if ($model->rating == 6  ){
echo '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i>';
}	else if ($model->rating == 7  ){
echo '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-half-o"></i><i class="fa fa-star-o"></i>';
}	else if ($model->rating == 8  ){
echo '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-o"></i>';
}	else if ($model->rating == 9  ){
echo '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-half-o"></i>';
}	else if ($model->rating == 10  ){
echo '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>';
}	
	?>
	</div>	
	
	<!--<img src="images/<?php //echo $image;?>" width="100" height="20" border="0"> -->
    </div><!--/.col-md-9 -->
    </div><!--/.row -->
    
    <div class="row detailSecondGroup">
    <div class="col-md-3 col-sm-3 align-left detailSecond detailSecondFirst">
    A&Ntilde;O
    </div><!--/.col-md-3 -->
    <div class="col-md-9 col-sm-9 align-left detailSecond">
    <?php echo ($model->production_year != '' ? $model->production_year : '&nbsp;');	?>
    </div><!--/.col-md-9 -->
    </div><!--/.row -->
    
    <div class="row detailSecondGroup">
    <div class="col-md-3 col-sm-3 align-left detailSecond detailSecondFirst">
    DIRECTOR
    </div><!--/.col-md-3 -->
    <div class="col-md-9 col-sm-9 align-left detailSecond">
	<?php echo ($casting['director'] != '' ? $casting['director'] : '&nbsp;');	?>
	</div><!--/.col-md-9 -->
    </div><!--/.row -->
    
    <div class="row detailSecondGroup">
    <div class="col-md-3 col-sm-3 align-left detailSecond detailSecondFirst">
    ACTORES
    </div><!--/.col-md-3 -->
    <div class="col-md-9 col-sm-9 align-left detailSecond">
	<?php echo ($casting['actors'] != '' ? $casting['actors'] : '&nbsp;');	?>
    </div><!--/.col-md-9 -->
    </div><!--/.row -->
    
    <div class="row detailSecondGroup">
    <div class="col-md-3 col-sm-3 align-left detailSecond detailSecondFirst">
    DURACI&Oacute;N
    </div><!--/.col-md-3 -->
    <div class="col-md-9 col-sm-9 align-left detailSecond">
	<?php echo ($model->running_time != '' ? $model->running_time.'mm' : '&nbsp;');	?>
    </div><!--/.col-md-9 -->
    </div><!--/.row -->
    
    <div class="row detailSecondGroup">
    <div class="col-md-3 col-sm-3 align-left detailSecond detailSecondFirst">
    SIN&Oacute;PSIS
    </div><!--/.col-md-3 -->
    <div class="col-md-9 col-sm-9 align-left detailSecond detailSummary">
	<?php echo ($model->description != '' ? nl2br($model->description) : '&nbsp;');	?>
    </div><!--/.col-md-9 -->
    </div><!--/.row -->
    </div><!--/.tab-pane#1 -->
    
	<div class="tab-pane removeOverflowTab" id="tab2">
    
    <?php 
    //el false va solo por la demo del 5 de junio
    if(isset($modelLocalFolder) && false):?>
    <div class="row detailSecondGroup">
    <div class="col-md-3 col-sm-3 align-left detailSecond detailSecondFirst">
    RUTA
	</div><!--/.col-md-4 -->
    <div class="col-md-9 col-sm-9 align-left detailSecond">	
	<div class="modalPath"><?php echo $modelLocalFolder->path;?></div>
	</div><!--/.col-md-8 -->
	</div><!--/.row -->
    <?php elseif(isset($modelNzb) && $setting->is_movie_tester):?>
    <div class="row detailSecondGroup">
    <div class="col-md-3 col-sm-3 align-left detailSecond detailSecondFirst">
    FILE NAME
	</div><!--/.col-md-4 -->
    <div class="col-md-9 col-sm-9 align-left detailSecond">	
	<div class="modalPath"><?php echo $modelNzb->mkv_file_name;?></div>
	</div><!--/.col-md-8 -->
	</div><!--/.row -->
    <?php endif;?>
    <div class="row detailSecondGroup">
    <div class="col-md-3 col-sm-3 align-left detailSecond detailSecondFirst">
    TAMA&Ntilde;O EN DISCO
	</div><!--/.col-md-4 -->
    <div class="col-md-9 col-sm-9 align-left detailSecond">
	<?php echo $size;?>
	</div><!--/.col-md-8 -->
	</div><!--/.row -->
	<?php if(!isset($modelNzb)||$modelNzb->ready_to_play):?>	    
    <div class="row detailSecondGroup">
    <div class="col-md-3 col-sm-3 align-left detailSecond detailSecondFirst">
    BORRAR
	</div><!--/.col-md-4 -->
    <div class="col-md-9 col-sm-8 align-left detailSecond">
	<!--<i id="btn-eraser" class="fa fa-eraser fa-lg"></i>-->
	<!--<button id="btn-eraser-popover" class="popover fade bottom in"><i class="fa fa-eraser fa-lg"></i></button>-->
	<a href="#" id="btn-eraser-popover" class="" ><i id="btn-eraser" class="fa fa-eraser fa-lg"></i></a>
	</div><!--/.col-md-8 -->
	</div><!--/.row -->
	<?php endif;?>		
	</div><!--/.tab-pane#2 -->
    
    <div class="tab-pane" id="tab3"><!--/.bookmarks -->
    
    <?php if(isset($modelBookmarks)):?>
    <?php foreach ($modelBookmarks as $bookmark){?>
	<div class="row detailSecondGroup">
    <div class="col-md-3 col-sm-3 align-left detailSecond detailSecondFirst">
	<?php echo $bookmark->description; ?>
    </div><!--/.col-md-3 -->
    <div class="col-md-9 col-sm-9 align-left detailSecond">
	<?php echo $bookmark->time_start." - ".$bookmark->time_end;?>
	<button id="btn-play-bookmark-<?php echo $bookmark->Id;?>" class="btn btn-default" style="float: right; margin-right: 30px;"><i class="fa fa-play fa-lg"></i></button>
    <div class="btn-group open" style="float: right; margin-right: 30px;">
					<a class="btn btn-default" href="#"><i class="icon-heart"></i> Agregar a...</a>
					<a class="btn btn-default dropdown-toggle" data-toggle="dropdown" href="#">
		    					<span class="icon-caret-down"></span></a>
					<ul class="dropdown-menu">
						<?php 
						$playLists = Playlist::model()->findAll();
						foreach ($playLists as $playList)
						{
							$playListBookmarks = PlaylistBookmark::model()->findAllByAttributes(array('Id_bookmark'=>$bookmark->Id,'Id_playlist'=>$playList->Id));
							if(!empty($playListBookmarks))
							{
							?>
							    <li><a class="check-playlist" id="<?php echo $playList->Id;?>" idBookmark="<?php echo $bookmark->Id;?>" href="#"><i class="icon-fixed-width icon-check"></i><i class="icon-fixed-width icon-bookmark"></i> <?php echo $playList->description;?></a></li>
							<?php }else{?>
							    <li><a class="check-playlist" id="<?php echo $playList->Id;?>" idBookmark="<?php echo $bookmark->Id;?>" href="#"><i class="icon-fixed-width icon-check-empty"></i><i class="icon-fixed-width icon-bookmark"></i> <?php echo $playList->description;?></a></li>
							<?php }?>
						<?php }?>
					 </ul>
				</div>
    </div><!--/.col-md-9 -->
	</div><!--/.row -->	    
	<?php }?>	    
	<?php endif;?>
	</div><!--/.tab-pane3 -->
	
	</div><!--/.tab-content --> 
    
    </div><!--/.col-md-9PRINCIPAL -->
    </div><!--/.rowPRINCIPAL -->
    
    
    </div><!--/.modal-body -->
    <div class="modal-footer">
    <?php if(isset($modelNzb)):?>    
    	<?php if(!$modelNzb->ready_to_play&&($modelNzb->downloaded||$modelNzb->downloading)):?>
    	<div class="labelDescargando pull-left"><i class="fa fa-spinner fa-spin"></i> Descargando...</div>
    	<?php else:?>
		    <div id="verifying-player" class="labelDescargando pull-left" style="display: none">
		    	<i class="fa fa-spinner fa-spin"></i> Verificando player...
		    </div>    	
    	<?php endif?>
    <?php else:?>
	    <div id="verifying-player" class="labelDescargando pull-left"  style="display: none">
	    	<i class="fa fa-spinner fa-spin"></i> Verificando player...
	    </div>    	
    <?php endif?>
    
  <!-- Single button -->
    <button type="button" data-dismiss="modal" class="btn btn-default btn-lg">Cerrar</button>
    <?php if(!isset($fromControl)):?>
	    <?php if(isset($modelNzb)):?>
	    	<?php if($modelNzb->ready_to_play):?>
	    		<button id="btn-play" type="button" class="btn btn-primary btn-lg" data-dismiss="modal"	data-toggle="modal" ><i class="fa fa-play-circle"></i> Ver Pel&iacute;cula</button>
	    	<?php else:?>
	    		<?php if($modelNzb->downloaded||$modelNzb->downloading):?>
	    			<?php if(isset($modelNzb->sabnzbd_id)):?>
		  				<button id="btn-cancel-popover" type="button" class="btn btn-primary btn-lg">
		    			<i class="fa fa-times-circle"></i> Cancelar</button>
	    			<?php else:?>
		  				<button id="btn-cancel-popover" type="button" class="btn btn-primary btn-lg" disabled="disabled">
		    			<i class="fa fa-spinner fa-spin"></i> Iniciando</button>
	    			<?php endif?>
	    		<?php else:?>
	    			<button id="btn-download" type="button" class="btn btn-primary btn-lg btnDescargar">
		    		<i class="fa fa-download"></i> Descargar 
		    		<div class="labelPointsGroup">	    		
		    		<?php if($modelNzb->already_downloaded == 0):?>
		    			<div class="labelPointsArrowLeft"></div><div class="labelPoints"><i class="fa fa-database"></i> <?php echo $modelNzb->points;?></div>
		    		<?php else:?>
		    			<div class="labelPointsArrowLeft"></div><div class="labelPoints"><i class="fa fa-cloud-download"></i></div>
		    		<?php endif?>
		    		</div>
		    		</button>
	    		<?php endif?>
	    	<?php endif?>    	    
	    <?php else:?>
	    <button id="btn-play" type="button" class="btn btn-primary btn-lg" data-dismiss="modal"	data-toggle="modal" ><i class="fa fa-play-circle"></i> Ver Pel&iacute;cula</button>
	    <?php endif?>    
    <?php else:?>
    	<button type="button" class="btn btn-primary btn-lg" disabled="disabled"><i class="fa fa-play-circle"></i> Reproduciendo</button>
    <?php endif?>
    
    </div><!--/.modal-footer -->
  </div><!--/.modal-content -->
    </div><!--/.modal-dialog -->

		  	
  <script>							
  
	$("#myModalElegirPlayer").on('hidden.bs.modal',
			function(e)
			{
				$("#btn-play").removeAttr("disabled");				
				$("#btn-play").html('<i class="fa fa-play-circle"></i> Ver Pel&iacute;cula');
				$("#myModal").modal('show');
				$("#myModalElegirPlayer").html('');
			}
		);						
	$("#myModalAlerta").on('hidden.bs.modal',
			function(e)
			{
				$("#btn-play").removeAttr("disabled");
				$("#myModal").modal('show');
			}
		);
	function verifyPlayer()
	{
		$("#verifying-player").html('<i class="fa fa-spinner fa-spin"></i> Verificando player...');
		$("#verifying-player").show();
		$("#btn-play").attr('disabled','disabled');
		$.post("<?php echo SiteController::createUrl('AjaxGetPlayerStatus'); ?>",
				{
					idPlayer:<?php echo $players[0]->Id; ?>
				}
				).success(
					function(data){
						obj = jQuery.parseJSON(data);
						if(obj.powerOff == "1")
						{
							$("#verifying-player").html("Player fuera de servicio.");
							setTimeout(		
						 			'verifyPlayer()'
						 		, 10000);	
												 
						}
						else
						{
							$("#verifying-player").hide();
							$("#btn-play").removeAttr('disabled');
						}
						 
				}).error(function(data){
						$("#verifying-player").html("Player fuera de servicio.");
						setTimeout(		
					 			'verifyPlayer()'
					 		, 10000);						 
				});
		
	}
  	<?php if(count($players)==1):?>

		<?php if(isset($modelNzb)):?>    
			<?php if($modelNzb->ready_to_play):?>
				verifyPlayer();
			<?php endif?>
		<?php else:?>
			verifyPlayer();
		<?php endif?>
	<?php endif;?>
	
  function borrar()
  {
	$.post("<?php echo SiteController::createUrl('AjaxRemoveMovie'); ?>",
			{
				idResource:<?php echo $idResource; ?>,
			    sourceType:<?php echo $sourceType; ?>
			 }
			).success(
				function(data){
					location.reload(); 
			});
  
  }
  function closeCancelPopover()
  {
	  $('#btn-cancel-popover').popover('hide');
  }
  function cancelar()
  {
	  $('#btn-eraser-popover').popover('hide');
  }
  $(function () {
	  var elem ='¿Seguro desea eliminar esta pelicula?<div class="popoverButtons"><button id="btn-remove-ok" class="btn btn-default" type="button" onclick="borrar()">Si</button>'+
	  '<button id="btn-remove-cancel" class="btn btn-primary noMargin" type="button" onclick="cancelar()">No</button></div>';
	  
	$('#btn-eraser-popover').popover({
        title: 'Confirmar',
        content: '¿Desea borrar esta pelicula?',
        placement: 'right',
        content:elem,
        html:true
    });
  });
  <?php if(isset($modelNzb)):?>
  $(function () {
	  var elem ='¿Seguro desea cancelar la descarga?<div class="popoverButtons"><button id="btn-cancel-ok" class="btn btn-default" type="button" onclick="cancelDownloading(<?php echo $modelNzb->Id;?>)">Si</button>'+
	  '<button id="btn-remove-cancel" class="btn btn-primary noMargin" type="button" onclick="closeCancelPopover()">No</button></div>';
	  
	$('#btn-cancel-popover').popover({
        title: 'Confirmar',
        content: '¿Desea cancelar la descarga?',
        placement: 'left',
        content:elem,
        html:true
    });
  });										
  										
	  function cancelDownloading(idNzb)
	  {
			$.post("<?php echo SiteController::createUrl('AjaxCancelDownload'); ?>",
					{Id_nzb: idNzb}
				).success(
					function(data) 
					{
						$("#downloaded_"+idNzb).hide();
						$("#downloading_"+idNzb).hide();
						$(".downloaded_"+idNzb).hide();
						$(".downloading_"+idNzb).hide();

						if(data == 1)
						{
							$("#already_downloaded_"+idNzb).show();
							$(".already_downloaded_"+idNzb).show();
						}
						else
						{
							$("#already_downloaded_"+idNzb).hide();
							$(".already_downloaded_"+idNzb).hide();
						}
						
						$("#myModal").html("");
						$("#myModal").modal("hide");
						return false;
					}
				);
				return false;
	  
	  }  
	$('#btn-download').click(function(){
		$(this).attr("disabled", "disabled");
		$.post("<?php echo SiteController::createUrl('AjaxStartDownload'); ?>",
			{Id_nzb: "<?php echo $modelNzb->Id; ?>"}
		).success(
			function(data) 
			{					
				$("#downloaded_<?php echo $modelNzb->Id; ?>").hide();
				$("#downloading_<?php echo $modelNzb->Id; ?>").show();
				$("#already_downloaded_<?php echo $modelNzb->Id; ?>").hide();
						
				$(".downloaded_<?php echo $modelNzb->Id; ?>").hide();
				$(".downloading_<?php echo $modelNzb->Id; ?>").show();				
				$(".already_downloaded_<?php echo $modelNzb->Id; ?>").hide();
				
				$("#myModal").html("");
				$("#myModal").modal("hide");
				return false;
			}
		);
		return false;
	});
	<?php endif?>
	$(".check-playlist").click(function(){
		var target = this;
		$.post("<?php echo SiteController::createUrl('AjaxAddOrRemovePlaylist'); ?>",
				{
					idBookmark:$(this).attr("idBookmark"),
				    idPlaylist:$(this).attr("id")
				 }
				).success(
					function(data){
						var empty =$(target).find("i.icon-fixed-width.icon-check-empty");
						var notEmpty =$(target).find("i.icon-fixed-width.icon-check");
						$(empty).removeClass( "icon-check-empty");
						$(empty).addClass( "icon-check");
						$(notEmpty).removeClass( "icon-check");
						$(notEmpty).addClass("icon-check-empty");		
					});			
		return false;
	});
	$('#btn-play').click(function(){
		$('#btn-play').attr("disabled", "disabled");
		$("#btn-play").html('<i class="fa fa-spinner fa-spin"></i> Ver Pel&iacute;cula');									
		<?php
		if(count($players)==1)
		{
		?>

		$.post("<?php echo SiteController::createUrl('AjaxCanStart'); ?>",
				{
					idResource:'<?php echo $idResource; ?>',
				    sourceType:'<?php echo $sourceType; ?>'
				}
				).success(
					function(data){
						if(data == "1")
						{
							var params = {
							    	id:'<?php echo $model->Id; ?>',
							    	idPlayer:<?php echo $setting->players[0]->Id?>,
							    	sourceType:'<?php echo $sourceType; ?>',
							    	idResource:'<?php echo $idResource; ?>'
								};
								window.location = "<?php echo SiteController::createUrl('site/startByPlayer'); ?>&"+$.param( params );
						}
						else
						{
							$("#myModal").modal("hide");
							$("#myModalAlerta").modal("show");
							$("#btn-play").html("disabled");	
							$("#btn-play").html('<i class="fa fa-play-circle"></i> Ver Pel&iacute;cula');
						}
					
				});
		<?php 
		}else{
		?>   
		
		$.post("<?php echo SiteController::createUrl('AjaxShowPalyerSelector'); ?>",
				{
					id:'<?php echo $model->Id; ?>',
					idResource:'<?php echo $idResource; ?>',
					sourceType:'<?php echo $sourceType; ?>'
					}
				).success(
					function(data){
						$("#myModalElegirPlayer").html( data);						
						$("#myModal").modal('hide');
						$("#myModalElegirPlayer").modal('show');						
					});
		<?php }?>
		return false;
	});
	
	$('#btn-erasera').click(function(){
		return false;		
		if (confirm("\u00bfSeguro desea eliminarlo?"))
		{
			$.post("<?php echo SiteController::createUrl('AjaxRemoveMovie'); ?>",
			{
				idResource:<?php echo $idResource; ?>,
			    sourceType:<?php echo $sourceType; ?>
			 }
			).success(
				function(data){
					window.location = <?php echo '"'. SiteController::createUrl('index') . '"'; ?>; 
			});
		}
		return false;
	});
	
	$('#btn-tmdb').click(function(){		
		window.location = <?php echo '"'. SiteController::createUrl('site/tmdb',array('idResource'=>$idResource,'sourceType'=>$sourceType)) . '"'; ?>; 
		return false;
	});
	$('#btn-tmdb-movie').click(function(){		
		window.location = <?php echo '"'. SiteController::createUrl('site/tmdbChangeMovie',array('idResource'=>$idResource,'sourceType'=>$sourceType)) . '"'; ?>; 
		return false;
	});
	$('#btn-edit-my-movie').click(function(){		
		window.location = <?php echo '"'. SiteController::createUrl('site/updateMyMovieInfo',array('idResource'=>$idResource,'sourceType'=>$sourceType)) . '"'; ?>; 
		return false;
	});	
	$('#btn-edit').click(function(){		
		window.location = <?php echo '"'. SiteController::createUrl('site/editMovie',array('idResource'=>$idResource,'sourceType'=>$sourceType)) . '"'; ?>; 
		return false;
	});	
	
	</script>
