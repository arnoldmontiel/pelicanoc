
<?php 

if($data->source_type == 1)
{
	$model = MyMovieDiscNzb::model()->findByPk($data->Id_my_movie_disc_nzb);
	$model = $model->myMovieNzb;
} 
else 
{
	$model = MyMovieDisc::model()->findByPk($data->Id_my_movie_disc);
	$model = $model->myMovie;
}

//$modelTMDB =  $data->TMDBData;
$modelTMDB =  TMDBData::model()->findByPk($data->Id_TMDB_data);;
$moviePoster = $model->poster;	
if(isset($modelTMDB)&&$modelTMDB->poster!="")
{
	$moviePoster = $modelTMDB->poster;
}

$moviePoster = PelicanoHelper::getImageName($moviePoster);

$shortTitle = $model->original_title;
//$shortTitle = (strlen($shortTitle) > 24) ? substr($shortTitle,0,21).'...' : $shortTitle;


?>

<div class="item <?php echo PelicanoHelper::getFilters($data); ?> needsclick">
	<a onclick="openMovieShowDetail('<?php echo $model->Id;?>',<?php echo $data->source_type;?>,<?php echo $data->Id;?>)" class="needsclick">    
        <?php echo CHtml::image($moviePoster,'',array('class'=>'peliAfiche needsclick'));?>    
    </a>			
    <div id="<?php echo $data->Id;?>" class="peliTitulo needsclick"><?php echo $shortTitle;?></div>
    <?php if($data->is_new):?>
     <div class="ribbon ribNuevo needsclick">
        <div class="ribbonTxt needsclick">
            NUEVO
        </div>
    </div>
	<?php endif?>
</div>