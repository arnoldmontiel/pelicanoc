 <!--  <div id="myModal" class="modal modalDetail">-->   
 <!--   <div id="myModal" class="modal hide fade modalDetail in" style="display: block;" aria-hidden="false" aria-labelledby="myModalLabel" role="dialog" tabindex="-1"> -->
 <!--  <div id="myModal" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false"  style="display: none;">--> 
   <div class="modal-dialog modalDetail">
        <div class="modal-content">
   <?php 
   		$idResource = "";		
		$size = 0;
		$path = "";
		
		if(isset($modelNzb)){
			$idResource = $modelNzb->Id;			
			$folderPath = explode('.',$nzbModel->file_name);
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
 			$size = PelicanoHelper::getDirectorySize($path);

 		if(isset($modelTMDB))
 		{
 			$moviePoster = $modelTMDB->big_poster;
 		}
 		else
 		{
 			$moviePoster = $model->big_poster;
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
    <div class="row detailMainGroup">
    <div class="col-md-4 align-center detailMain detailMainFirst">
	<?php echo $model->genre;?>
    </div><!--/.col-md-4 -->
    <div class="col-md-4 align-center detailMain">
    <?php echo $model->parentalControl->description;?>
    </div><!--/.col-md-4 -->
    <div class="col-md-4 align-center detailMain">
 	<?php    	
	$image = 'rate'.str_pad($model->rating, 2, "0", STR_PAD_LEFT).'.png';    	
	?>
	<img src="images/<?php echo $image;?>" width="100" height="20" border="0">
    </div><!--/.col-md-4 -->
    </div><!--/.row -->
    
    <div class="row detailSecondGroup">
    <div class="col-md-3 align-left detailSecond detailSecondFirst">
    A&Ntilde;O
    </div><!--/.col-md-3 -->
    <div class="col-md-9 align-left detailSecond">
    <?php echo $model->production_year;?>
    </div><!--/.col-md-9 -->
    </div><!--/.row -->
    
    <div class="row detailSecondGroup">
    <div class="col-md-3 align-left detailSecond detailSecondFirst">
    DIRECTOR
    </div><!--/.col-md-3 -->
    <div class="col-md-9 align-left detailSecond">
    <?php echo $casting['director'];?>
    </div><!--/.col-md-9 -->
    </div><!--/.row -->
    
    <div class="row detailSecondGroup">
    <div class="col-md-3 align-left detailSecond detailSecondFirst">
    ACTORES
    </div><!--/.col-md-3 -->
    <div class="col-md-9 align-left detailSecond">
    <?php echo $casting['actors'];?>
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
    <?php echo $model->description;?>
    </div><!--/.col-md-9 -->
    </div><!--/.row -->
    </div><!--/.tab-pane#1 -->
    
	<div class="tab-pane" id="tab2">
    <div class="row detailMainGroup">
    <div class="col-md-4 align-center detailMain detailMainFirst">
	<?php echo $model->genre;?>
    </div><!--/.col-md-4 -->
    <div class="col-md-4 align-center detailMain">
    <?php echo $model->parentalControl->description;?>
    </div><!--/.col-md-4 -->
    <div class="col-md-4 align-center detailMain">
 	<?php    	
	$image = 'rate'.str_pad($model->rating, 2, "0", STR_PAD_LEFT).'.png';    	
	?>
	<img src="images/<?php echo $image;?>" width="100" height="20" border="0">
    </div><!--/.col-md-4 -->
    </div><!--/.row -->
    <div class="row detailSecondGroup">
    <div class="col-md-3 align-left detailSecond detailSecondFirst">
    TAMA&Ntilde;O EN DISCO
	</div><!--/.col-md-3 -->
    <div class="col-md-9 align-left detailSecond">
	<?php echo $size;?>
	</div><!--/.col-md-9 -->
	</div><!--/.row -->
		    
    <div class="row detailSecondGroup">
    <div class="col-md-3 align-left detailSecond detailSecondFirst">
    BORRAR PEL&Iacute;CULA
	</div><!--/.col-md-3 -->
    <div class="col-md-9 align-left detailSecond">
	<i id="btn-eraser" class="fa fa-eraser fa-lg"></i>
	</div><!--/.col-md-9 -->
	</div><!--/.row -->
	
    <div class="row detailSecondGroup">
    <div class="col-md-3 align-left detailSecond detailSecondFirst">
    TMDB
	</div><!--/.col-md-3 -->
    <div class="col-md-9 align-left detailSecond">
	<i id="btn-tmdb" class="fa fa-pencil fa-lg"></i>
	</div><!--/.col-md-9 -->
	</div><!--/.row -->
    </div><!--/.tab-pane#2 -->
    
    <div class="tab-pane" id="tab3"><!--/.bookmarks -->
    <div class="row detailMainGroup">
    <div class="col-md-4 align-center detailMain detailMainFirst">
	<?php echo $model->genre;?>
    </div><!--/.col-md-4 -->
    <div class="col-md-4 align-center detailMain">
    <?php echo $model->parentalControl->description;?>
    </div><!--/.col-md-4 -->
    <div class="col-md-4 align-center detailMain">
 	<?php    	
	$image = 'rate'.str_pad($model->rating, 2, "0", STR_PAD_LEFT).'.png';    	
	?>
	<img src="images/<?php echo $image;?>" width="100" height="20" border="0">
    </div><!--/.col-md-4 -->
    </div><!--/.row -->
    
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
    <button id="btn-play" type="button" class="btn btn-default btn-large"><i class="fa fa-play"></i> Ver Pel&iacute;cula</button>
    </div><!--/.modal-footer -->
  </div><!--/.modal-content -->
    </div><!--/.modal-dialog -->
   <!-- </div>/.modal -->
	
  <script>

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

	$('#btn-eraser').click(function(){		
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
	
	</script>
