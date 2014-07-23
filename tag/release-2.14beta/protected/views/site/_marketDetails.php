 <div class="modal-dialog modalDetail">
        <div class="modal-content">
          <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true"> <i class="fa fa-times-circle fa-lg"></i></button>
    <h4 class="modal-title"><?php echo $model->original_title;?></h4>
    </div>
    <div class="modal-body"> 
    <div class="row">
    <div class="col-md-3 col-sm-3 align-center">
    <img class="aficheDetail" src="images/<?php echo $model->big_poster;?>" width="100%" height="100%" border="0">
    </div><!--/.col-md-3PRINCIPAL -->
    
    <div class="col-md-9 col-sm-9">
    <ul class="nav nav-tabs">
                <li class="active"><a href="#tab1" data-toggle="tab">Informaci&oacute;n</a></li></ul>
	<div class="tab-content tableInfo">
    <div class="tab-pane active" id="tab1">
    <div class="row detailSecondGroup">
    <div class="col-md-3 col-sm-3 align-left detailSecond detailSecondFirst">
    GENERO
    </div><!--/.col-md-3 -->
    <div class="col-md-9 col-sm-9 align-left detailSecond">
	&nbsp;<?php echo $model->genre;?>
    </div><!--/.col-md-9 -->
    </div><!--/.row -->
    
    <div class="row detailSecondGroup">
    <div class="col-md-3 col-sm-3 align-left detailSecond detailSecondFirst">
    PUBLICO
    </div><!--/.col-md-3 -->
    <div class="col-md-9 col-sm-9 align-left detailSecond">
    <?php echo $model->parentalControl->description;?>
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
    &nbsp;<?php echo $model->production_year;?>
    </div><!--/.col-md-9 -->
    </div><!--/.row -->
    
    <div class="row detailSecondGroup">
    <div class="col-md-3 col-sm-3 align-left detailSecond detailSecondFirst">
    DIRECTOR
    </div><!--/.col-md-3 -->
    <div class="col-md-9 col-sm-9 align-left detailSecond">
    &nbsp;<?php echo $casting['director'];?>
    </div><!--/.col-md-9 -->
    </div><!--/.row -->
    
    <div class="row detailSecondGroup">
    <div class="col-md-3 col-sm-3 align-left detailSecond detailSecondFirst">
    ACTORES
    </div><!--/.col-md-3 -->
    <div class="col-md-9 col-sm-9 align-left detailSecond">
    &nbsp;<?php echo $casting['actors'];?>
    </div><!--/.col-md-9 -->
    </div><!--/.row -->
    
    <div class="row detailSecondGroup">
    <div class="col-md-3 col-sm-3 align-left detailSecond detailSecondFirst">
    DURACI&Oacute;N
    </div><!--/.col-md-3 -->
    <div class="col-md-9 col-sm-9 align-left detailSecond">
    <?php echo $model->running_time;?>mm
    </div><!--/.col-md-9 -->
    </div><!--/.row -->
    
    <div class="row detailSecondGroup">
    <div class="col-md-3 col-sm-3 align-left detailSecond detailSecondFirst">
    SIN&Oacute;PSIS
    </div><!--/.col-md-3 -->
    <div class="col-md-9 col-sm-9 align-left detailSecond detailSummary">
    &nbsp;<?php echo $model->description;?>
    </div><!--/.col-md-9 -->
    </div><!--/.row -->
    
    </div><!--/.tab-pane#1 -->
	
	</div><!--/.tab-content --> 
    
    </div><!--/.col-md-9PRINCIPAL -->
    </div><!--/.rowPRINCIPAL -->
    
    
    </div><!--/.modal-body -->
        
    <div class="modal-footer">
    <button type="button" data-dismiss="modal" class="btn btn-default btn-lg">Cerrar</button>
    <button id="btn-download" type="button" class="btn btn-primary btn-lg" <?php if($modelNzb->downloaded||$modelNzb->downloading)	echo 'disabled="disabled"'; ?>>
    	<i class="fa fa-download"></i> <?php echo ($modelNzb->downloaded||$modelNzb->downloading)?"Descargando":"Descargar";?></button>
    </div><!--/.modal-footer -->
  </div><!--/.modal-content -->
    </div><!--/.modal-dialog -->
  <script>
	$('#btn-download').click(function(){
		$(this).attr("disabled", "disabled");
		$.post("<?php echo SiteController::createUrl('AjaxStartDownload'); ?>",
			{Id_nzb: "<?php echo $modelNzb->Id; ?>"}
		).success(
			function(data) 
			{					
				$("#myModal").html("");
				$("#myModal").modal("hide");
				return false;
			}
		);
		return false;
	});
  </script>
