<?php 

$model = MyMovieDiscNzb::model()->findByPk($data->Id_my_movie_disc_nzb);
$model = $model->myMovieNzb;

$modelTMDB =  TMDBData::model()->findByPk($data->Id_TMDB_data);;

$moviePoster = $model->poster;
if(isset($modelTMDB)&&$modelTMDB->poster!="")
{
	$moviePoster = $modelTMDB->poster;
}
$moviePoster = PelicanoHelper::getImageName($moviePoster);

$shortTitle = $model->original_title;
$shortTitle = (strlen($shortTitle) > 24) ? substr($shortTitle,0,21).'...' : $shortTitle;
?>

<div class="item <?php echo PelicanoHelper::getFiltersMarketplace($data); ?> needsclick">
	<a onclick="openMovieShowDetail('<?php echo $model->Id;?>',<?php echo $data->source_type;?>,<?php echo $data->Id;?>)" class="needsclick">    
        <?php echo CHtml::image($moviePoster,'',array('class'=>'peliAfiche needsclick'));?>    
    </a>			
    <div id="<?php echo $data->Id;?>" class="peliTitulo needsclick"><?php echo $shortTitle;?></div>
	<div class="ribMisPeliculas needsclick" id="downloaded_<?php echo $data->Id; ?>" <?php echo ($data->downloaded)?"":"style='display:none'";?>><i class="fa fa-check-circle"></i></div>
	<div class="ribDescargando needsclick" id="downloading_<?php echo $data->Id; ?>" <?php echo ($data->downloading)?"":"style='display:none'";?>><i class="fa fa-spinner fa-spin fa-sm" ></i> <i class="fa fa-download" ></i></div>
</div>
