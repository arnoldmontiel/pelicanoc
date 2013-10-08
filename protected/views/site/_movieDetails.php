 <!--  <div id="myModal" class="modal modalDetail">-->   
   <div id="myModal" class="modal hide fade modalDetail in" style="display: block;" aria-hidden="false" aria-labelledby="myModalLabel" role="dialog" tabindex="-1">
   <?php 
   		$idResource = "";		
		$size = 0;
		$path = "";
		
		if(isset($modelNzb)){
			$idResource = $modelNzb->Id;			
			$folderPath = explode('.',$nzbModel->file_name);
			$path = $folderPath[0]; 
		}
		
		if(isset($modelRippedMovie)){
			$idResource = $modelRippedMovie->Id;
			$path = $modelRippedMovie->path;
		}
		
		if(isset($modelLocalFolder)){
			$idResource = $modelLocalFolder->Id;
			$path = $modelLocalFolder->path;
		}
		
 		if(!empty($path))
 			$size = PelicanoHelper::getDirectorySize($path);
		
		?>	    
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true"> <i class="icon-remove-sign icon-large"></i></button>
      <h3 id="myModalLabel"><?php echo $model->original_title;?></h3>
    </div>
    <div class="modal-body"> 
    <div class="row-fluid">
    <div class="span3 pagination-centered">
    <img class="aficheDetail" src="images/<?php echo $model->big_poster;?>" width="100%" height="100%" border="0">
    </div><!--/.span3PRINCIPAL -->
    
    <div class="span9 tableInfo">
     <div class="tabbable" style="margin-bottom: 18px;">
              <ul class="nav nav-tabs">
                <li class="active"><a href="#tab1" data-toggle="tab">Informaci&oacute;n</a></li>
                <li class=""><a href="#tab2" data-toggle="tab">Avanzado</a></li>
                <li class=""><a href="#tab3" data-toggle="tab">Bookmarks</a></li>
              </ul>
              <div class="tab-content" style="padding-bottom: 9px; border-bottom: 1px solid #ddd;  min-height: 300px;  ">
                <div class="tab-pane active" id="tab1">
                
				    <div class="row-fluid detailMainGroup">
				    <div class="span4 pagination-centered detailMain detailMainFirst">
				    <?php echo $model->genre;?>
				    </div><!--/.span4 -->
				    <div class="span4 pagination-centered detailMain">
				    <?php echo $model->parentalControl->description;?>
				    </div><!--/.span4 -->
				    <div class="span4 pagination-centered detailMain">
				    <?php    	
				    	$image = 'rate'.str_pad($model->rating, 2, "0", STR_PAD_LEFT).'.png';    	
					?>
				    <img src="images/<?php echo $image;?>" width="100" height="20" border="0">
				    </div><!--/.span4 -->
				    </div><!--/.row -->
    
				    <div class="row-fluid detailSecondGroup">
				    <div class="span3 pagination-left detailSecond detailSecondFirst">
				    A&Ntilde;O
				    </div><!--/.span4 -->
				    <div class="span9 pagination-left detailSecond">
				    <?php echo $model->production_year;?>
				    </div><!--/.span8 -->
				    </div><!--/.row -->
    
				    <div class="row-fluid detailSecondGroup">
				    <div class="span3 pagination-left detailSecond detailSecondFirst">
				    DIRECTOR
				    </div><!--/.span4 -->
				    <div class="span9 pagination-left detailSecond">
				    <?php echo $casting['director'];?>
				    </div><!--/.span8 -->
				    </div><!--/.row -->
    
				    <div class="row-fluid detailSecondGroup">
				    <div class="span3 pagination-left detailSecond detailSecondFirst">
				    ACTORES
				    </div><!--/.span4 -->
				    <div class="span9 pagination-left detailSecond">
				    <?php echo $casting['actors'];?>
				    </div><!--/.span8 -->
				    </div><!--/.row -->
				    
				    <div class="row-fluid detailSecondGroup">
				    <div class="span3 pagination-left detailSecond detailSecondFirst">
				    DURACI&Oacute;N
				    </div><!--/.span4 -->
				    <div class="span9 pagination-left detailSecond">
				    <?php echo $model->running_time;?>mm
				    </div><!--/.span8 -->
				    </div><!--/.row -->
				    
				    <div class="row-fluid detailSecondGroup">
				    <div class="span3 pagination-left detailSecond detailSecondFirst">
				    SIN&Oacute;PSIS
				    </div><!--/.span4 -->
				    <div class="span9 pagination-left detailSecond">
				   <?php echo $model->description;?>
				    </div><!--/.span9 -->
				    </div><!--/.row -->
    	</div><!--/.tab-pane --> 
    	<div class="tab-pane" id="tab2">
			<div class="row-fluid detailMainGroup">
		    <div class="span4 pagination-centered detailMain detailMainFirst">
		    <?php echo $model->genre;?>
		    </div><!--/.span4 -->
		    <div class="span4 pagination-centered detailMain">
		    <?php echo $model->parentalControl->description;?>
		    </div><!--/.span4 -->
		    <div class="span4 pagination-centered detailMain">
		     <?php    	
		    	$image = 'rate'.str_pad($model->rating, 2, "0", STR_PAD_LEFT).'.png';    	
			?>
		    <img src="images/<?php echo $image;?>" width="100" height="20" border="0">    
		    </div><!--/.span4 -->
		    </div><!--/.row -->
		    <div class="row-fluid detailSecondGroup">
			    <div class="span3 pagination-left detailSecond detailSecondFirst">
			    TAMA&Ntilde;O EN DISCO
			    </div><!--/.span4 -->
			    <div class="span9 pagination-left detailSecond">
			    <?php echo $size;?>
			    </div><!--/.span8 -->
		    </div><!--/.row -->
		    
		    <div class="row-fluid detailSecondGroup">
			    <div class="span3 pagination-left detailSecond detailSecondFirst">
			    	BORRAR PEL&Iacute;CULA
			    </div><!--/.span4 -->
			    <div class="span9 pagination-left detailSecond">
			    	<i id="btn-eraser" class="icon-eraser pointer"></i>
			    </div><!--/.span8 -->
		    </div><!--/.row -->
		    
    	 </div><!--/.tab-pane -->
    	<div class="tab-pane" id="tab3"><!--/.bookmarks -->
			<div class="row-fluid detailMainGroup">
		    <div class="span4 pagination-centered detailMain detailMainFirst">
		    <?php echo $model->genre;?>
		    </div><!--/.span4 -->
		    <div class="span4 pagination-centered detailMain">
		    <?php echo $model->parentalControl->description;?>
		    </div><!--/.span4 -->
		    <div class="span4 pagination-centered detailMain">
		     <?php    	
		    	$image = 'rate'.str_pad($model->rating, 2, "0", STR_PAD_LEFT).'.png';    	
			?>
		    <img src="images/<?php echo $image;?>" width="100" height="20" border="0">    
		    </div><!--/.span4 -->
		    </div><!--/.row -->
		    <?php foreach ($modelBookmarks as $bookmark){?>
		    
		    <div class="row-fluid detailSecondGroup">
			    <div class="span3 pagination-left detailSecond detailSecondFirst">
			    <?php echo $bookmark->description; ?>
			    </div><!--/.span4 -->
			    <div class="span9 pagination-left detailSecond">
			    <?php echo $bookmark->time_start." - ".$bookmark->time_end;?>
				
				<button id="btn-play-bookmark-<?php echo $bookmark->Id;?>" class="btn btn-primary btn" style="float: right; margin-right: 30px;"><i class="icon-play icon-large"></i></button>
				
			    <div class="btn-group open" style="float: right; margin-right: 30px;">
					<a class="btn btn-primary" href="#"><i class="icon-heart"></i> Agregar a...</a>
					<a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#">
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
				
			    </div><!--/.span8 -->
		    </div><!--/.row -->
			<?php }?>
		    
    	 </div><!--/.tab-pane -->
    	 </div><!--/.tababble -->  
    </div><!--/.span9PRINCIPAL -->
    </div><!--/.rowPRINCIPAL -->
    
    
    </div>
  </div>
	<div class="modal-footer">    	
    	<button id="btn-play" class="btn btn-primary btn-large"><span class="iconFontButton iconPlay"></span> Ver Pel&iacute;cula</button>
    </div>
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

	</script>
