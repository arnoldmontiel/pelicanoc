 <div class="modal-dialog modalDetail">
        <div class="modal-content">
   <?php 
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
 				$path = $setting->path_sabnzbd_download . $path;
 			}
 			else
 			{
 				$path = $setting->path_shared . $path;
 			
 			}
 			
 			$size = PelicanoHelper::getDirectorySize($path);
 		}

 		$moviePoster = $model->big_poster;
 		if(isset($modelTMDB)&&$modelTMDB->big_poster!="")
 		{
 			$moviePoster = $modelTMDB->big_poster;
 		}
 			
		?>	    
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true"> <i class="fa fa-times-circle fa-lg"></i></button>
    <h4 class="modal-title"><?php echo $model->original_title;?></h4>
    </div>
    <div class="modal-body"> 
    <div class="row">
    <div class="col-md-3 align-center">
    <img class="aficheDetail" src="images/<?php echo $moviePoster;?>" width="100%" height="100%" border="0">
    </div><!--/.col-md-3PRINCIPAL -->
        
    <div class="col-md-9">
    <ul class="nav nav-tabs">
                <li class="active"><a href="#tab1" data-toggle="tab">Informaci&oacute;n</a></li>
                <li class=""><a href="#tab2" data-toggle="tab">Avanzado</a></li>
              <!-- <li class=""><a href="#tab3" data-toggle="tab">Bookmarks</a></li>--> 
    </ul>
	<div class="tab-content tableInfo">
    <div class="tab-pane active" id="tab1">
    <div class="row detailSecondGroup">
    <div class="col-md-3 align-left detailSecond detailSecondFirst">
    GENERO
    </div><!--/.col-md-3 -->
    <div class="col-md-9 align-left detailSecond">
	&nbsp;<?php echo $model->genre;?>
    </div><!--/.col-md-9 -->
    </div><!--/.row -->
    
    <div class="row detailSecondGroup">
    <div class="col-md-3 align-left detailSecond detailSecondFirst">
    PUBLICO
    </div><!--/.col-md-3 -->
    <div class="col-md-9 align-left detailSecond">
    <?php echo $model->parentalControl->description;?>
    </div><!--/.col-md-9 -->
    </div><!--/.row -->
    
    <div class="row detailSecondGroup">
    <div class="col-md-3 align-left detailSecond detailSecondFirst">
    RATING
    </div><!--/.col-md-3 -->
    <div class="col-md-9 align-left detailSecond">
    <?php    	
	$image = 'rate'.str_pad($model->rating, 2, "0", STR_PAD_LEFT).'.png';    	
	?>
	<img src="images/<?php echo $image;?>" width="100" height="20" border="0">
    </div><!--/.col-md-9 -->
    </div><!--/.row -->
    
    <div class="row detailSecondGroup">
    <div class="col-md-3 align-left detailSecond detailSecondFirst">
    A&Ntilde;O
    </div><!--/.col-md-3 -->
    <div class="col-md-9 align-left detailSecond">
    &nbsp;<?php echo $model->production_year;?>
    </div><!--/.col-md-9 -->
    </div><!--/.row -->
    
    <div class="row detailSecondGroup">
    <div class="col-md-3 align-left detailSecond detailSecondFirst">
    DIRECTOR
    </div><!--/.col-md-3 -->
    <div class="col-md-9 align-left detailSecond">
    &nbsp;<?php echo $casting['director'];?>
    </div><!--/.col-md-9 -->
    </div><!--/.row -->
    
    <div class="row detailSecondGroup">
    <div class="col-md-3 align-left detailSecond detailSecondFirst">
    ACTORES
    </div><!--/.col-md-3 -->
    <div class="col-md-9 align-left detailSecond">
    &nbsp;<?php echo $casting['actors'];?>
    </div><!--/.col-md-9 -->
    </div><!--/.row -->
    
    <div class="row detailSecondGroup">
    <div class="col-md-3 align-left detailSecond detailSecondFirst">
    DURACI&Oacute;N
    </div><!--/.col-md-3 -->
    <div class="col-md-9 align-left detailSecond">
    <?php echo $model->running_time;?>mm
    </div><!--/.col-md-9 -->
    </div><!--/.row -->
    
    <div class="row detailSecondGroup">
    <div class="col-md-3 align-left detailSecond detailSecondFirst">
    SIN&Oacute;PSIS
    </div><!--/.col-md-3 -->
    <div class="col-md-9 align-left detailSecond detailSummary">
    &nbsp;<?php echo $model->description;?>
    </div><!--/.col-md-9 -->
    </div><!--/.row -->
    </div><!--/.tab-pane#1 -->
    
	<div class="tab-pane" id="tab2">
    
    <div class="row detailSecondGroup">
    <div class="col-md-3 align-left detailSecond detailSecondFirst">
    TAMA&Ntilde;O EN DISCO
	</div><!--/.col-md-3 -->
    <div class="col-md-9 align-left detailSecond">
	<?php echo $size;?>
	</div><!--/.col-md-9 -->
	</div><!--/.row -->
		    
	
	</div><!--/.tab-pane#2 -->
    
    <div class="tab-pane" id="tab3"><!--/.bookmarks -->
    
    <?php foreach ($modelBookmarks as $bookmark){?>
	<div class="row detailSecondGroup">
    <div class="col-md-3 align-left detailSecond detailSecondFirst">
	<?php echo $bookmark->description; ?>
    </div><!--/.col-md-3 -->
    <div class="col-md-9 align-left detailSecond">
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
	</div><!--/.tab-pane3 -->
	
	</div><!--/.tab-content --> 
    
    </div><!--/.col-md-9PRINCIPAL -->
    </div><!--/.rowPRINCIPAL -->
    
    
    </div><!--/.modal-body -->
    <div class="modal-footer">
    <button type="button" data-dismiss="modal" class="btn btn-default btn-large">Cerrar</button>
    <button id="btn-play" type="button" class="btn btn-primary btn-large"><i class="fa fa-play"></i> Ver Pel&iacute;cula</button>
    </div><!--/.modal-footer -->
  </div><!--/.modal-content -->
    </div><!--/.modal-dialog -->
    <div id="popover-borrar" class="popover fade bottom in">
    	<div class="arrow">
    		</div>
    			<h3 class="popover-title" style=""></h3>
    			<div class="popover-content">Confirmar
    				<div class="popoverDisTitle">Borrar Pelicula
    			</div>
    		<div class="popoverDisButtons">
    		<button type="button" class="btn btn-default">No</button>
    		<button type="button" class="btn btn-primary noMargin">Si</button>
		</div>
	</div>
	</div>
		  	
  <script>
  function borrar()
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
  function cancelar()
  {
	  $('#btn-eraser-popover').popover('hide');
  }
  $(function () {
	  var elem ='<p>¿Seguro desea eliminar esta pelicula?</p><button id="btn-remove-ok" class="btn btn-primary noMargin" type="button" onclick="borrar()">Si</button>'+
	  '<button id="btn-remove-cancel" class="btn btn-primary noMargin" type="button" onclick="cancelar()">No</button>';
	  
	$('#btn-eraser-popover').popover({
        title: 'Confirmar',
        content: '¿Desea borrar esta pelicula?',
        placement: 'right',
        content:elem,
        html:true
    });
  });										
	
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
		 
		window.location = <?php echo '"'. SiteController::createUrl('site/start',array('id'=>$model->Id,'sourceType'=>$sourceType,'idResource'=>$idResource)) . '"'; ?>;    
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
