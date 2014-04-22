<?php 

$model = MyMovieDiscNzb::model()->findByPk($data->Id_my_movie_disc_nzb);
$model = $model->myMovieNzb;


$genre = preg_replace('/\W/', ' ',strtolower($model->genre));
$title = preg_replace('/\W/', '-',strtolower($model->original_title));
$modelTMDB =  TMDBData::model()->findByPk($data->Id_TMDB_data);;

$moviePoster = $model->poster;
if(isset($modelTMDB)&&$modelTMDB->poster!="")
{
	$moviePoster = $modelTMDB->poster;
}


Yii::app()->clientScript->registerScript(__CLASS__.'#site_view'.$data->Id, "
	$('#link-movie-$model->Id').click(function(){
		var target = $(this).attr('href');
		var id = '$model->Id';
		var idNzb = '$data->Id';
		var param = 'id='+id + '&idNzb=' + idNzb; 
		$.ajax({
	   		type: 'POST',
	   		url: '". SiteController::createUrl('AjaxMarketShowDetail') . "',
	   		data: param,
	 	}).success(function(data)
	 	{
	 	
			$('#myModal').html(data);
			
		}
	 	);	
		
});

");

$shortTitle = $model->original_title;
$shortTitle = (strlen($shortTitle) > 24) ? substr($shortTitle,0,21).'...' : $shortTitle;
?>

        
<div class="element post item <?php echo $genre;?> <?php echo $title;?>" title="<?php echo $title;?>">
	<a id="link-movie-<?php echo $model->Id;?>" style="position:relative;" data-target="#myModal" data-toggle="modal" href="#myModal" class="">    
        <?php
		 echo CHtml::image("images/".$moviePoster,'details',
				array('id'=>$model->Id, 'idNzb'=>$data->Id, 'class'=>'peliAfiche'));
		?>    
    </a>
    <div id="<?php echo $data->Id;?>" class="peliTitulo"><?php echo $shortTitle;?></div>
    
     <div class="ribbon ribMisPeliculas">
        <div class="ribbonTxt">
            MIS PELICULAS
        </div>
    </div>
</div>
