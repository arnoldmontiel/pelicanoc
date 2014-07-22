
<div class="modal-dialog modalDetail modalSerie">
<div class="modal-content">
	<div class="modal-header">
     <button type="button" class="close" data-dismiss="modal" aria-hidden="true"> <i class="fa fa-times-circle fa-lg"></i></button>
    <h4 class="modal-title"><?php echo $model->original_title;?></h4>
    </div>
		
	<div class="modal-body"> 
    <div class="row">
    <div class="col-sm-12">
   <ul class="nav nav-tabs">
						<li class=""><a href="#tab1" data-toggle="tab">Informaci&oacute;n</a></li>
						<li class="active"><a href="#tab2" data-toggle="tab">Temp. 1</a></li>
						<li class=""><a href="#tab2" data-toggle="tab">Temp. 2</a></li>
						<li class=""><a href="#tab2" data-toggle="tab">Temp. 3</a></li>
						<li class=""><a href="#tab2" data-toggle="tab">Temp. 4</a></li>
						<li class=""><a href="#tab2" data-toggle="tab">Temp. 5</a></li>
	</ul>
	<div class="tab-content tableInfo">
	<div class="tab-pane tabInfo" id="tab1">
	<div class="row">
    <div class="col-sm-3 align-center">
	<img class="aficheDetail" src="images/<?php echo $model->big_poster;?>" width="100%" height="100%" border="0">
    </div>
    <div class="col-sm-9 tabInfoScroll">
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
    </div>
	</div>
    </div><!--/.tab-pane#1 -->
	<div class="tab-pane active" id="tab2">
	<div class="alert alert-info clearfix">
        <h4>Nuevo Pack de Cap&iacute;tulos disponible</h4>
        <ul class="fa-ul">
  <li><i class="fa-li fa fa-check-square"></i>Cap&iacute;tulo 1: Hank meets Walt</li>
  <li><i class="fa-li fa fa-check-square"></i>Cap&iacute;tulo 2: It's raining Drugs</li>
  <li><i class="fa-li fa fa-check-square"></i>Cap&iacute;tulo 3: They steal a train</li>
  <li><i class="fa-li fa fa-check-square"></i>Cap&iacute;tulo 4: Yo yo yo bomb</li>
	</ul>
     <p>
      <a href="/GreenCliente/index.php?r=budget" class="btn btn-primary pull-right"><i class="fa fa-download"></i> Descargar</a>
      </p>
    </div>
	<table class="table tablaIndividual table-striped">
	<thead>
	<tr>
	<th width="4%" class="align-center">#</th>
	<th width="60%">Cap&iacute;tulo</th>
	<th>Estado</th>
	<th></th>
	</tr>
	</thead>
	<tbody>
	<tr>
	<td class="align-center">1</td>
	<td class="bold">Pilot</td>
	<td><span class="label label-success">Visto</span></td>
	<td class="align-right"><button class="btn btn-primary btn-medium"><i class="fa fa-play-circle"></i> Ver Cap&iacute;tulo</button></td>
	</tr>
	<tr>
	<td class="align-center">2</td>
	<td class="bold">Walt meets Jesse</td>
	<td><span class="label label-primary">Nuevo</span></td>
	<td class="align-right"><button class="btn btn-primary btn-medium"><i class="fa fa-play-circle"></i> Ver Cap&iacute;tulo</button></td>
	</tr>
	<tr>
	<td class="align-center">3</td>
	<td class="bold">Jeese Yo bitch</td>
	<td><span class="label label-primary">Nuevo</span></td>
	<td class="align-right"><button class="btn btn-primary btn-medium"><i class="fa fa-play-circle"></i> Ver Cap&iacute;tulo</button></td>
	</tr>
	<tr>
	<td class="align-center">4</td>
	<td class="bold">Skyler has baby hello hello</td>
	<td><span class="label label-primary">Nuevo</span></td>
	<td class="align-right"><button class="btn btn-primary btn-medium"><i class="fa fa-play-circle"></i> Ver Cap&iacute;tulo</button></td>
	</tr>
	<tr>
	<td class="align-center">5</td>
	<td class="bold">Walt buys gun</td>
	<td><span class="label label-primary">Nuevo</span></td>
	<td class="align-right"><button class="btn btn-primary btn-medium"><i class="fa fa-play-circle"></i> Ver Cap&iacute;tulo</button></td>
	</tr>
	<tr>
	<td class="align-center">6</td>
	<td class="bold">Hank gets shot</td>
	<td><span class="label label-primary">Nuevo</span></td>
	<td class="align-right"><button class="btn btn-primary btn-medium"><i class="fa fa-play-circle"></i> Ver Cap&iacute;tulo</button></td>
	</tr>
	</tbody>
	</table>
    </div><!--/.tab-pane#2 -->	
					</div><!--/.tab-content -->
				</div><!--/.col-md-9PRINCIPAL -->
			</div><!--/.rowPRINCIPAL -->
		</div>
		<!--/.modal-body -->
		<div class="modal-footer">
			<button type="button" data-dismiss="modal"
				class="btn btn-default btn-large">Cerrar</button>
		</div>
		<!--/.modal-footer -->
	</div>
	<!--/.modal-content -->
</div>
<!--/.modal-dialog -->