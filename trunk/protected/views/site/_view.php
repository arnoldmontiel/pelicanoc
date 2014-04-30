
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

$genre = preg_replace('/\W/', ' ',strtolower($model->genre));
$title = preg_replace('/\W/', '-',strtolower($model->original_title));

$shortTitle = $model->original_title;
$shortTitle = (strlen($shortTitle) > 24) ? substr($shortTitle,0,21).'...' : $shortTitle;
?>

<div class="item <?php echo $genre;?>" title="<?php echo $title;?>">
	<a onclick="openMovieShowDetail('<?php echo $model->Id;?>',<?php echo $data->source_type;?>,<?php echo $data->Id;?>)">    
        <?php echo CHtml::image($moviePoster,'',array('class'=>'peliAfiche'));?>    
    </a>			
    <div id="<?php echo $data->Id;?>" class="peliTitulo"><?php echo $shortTitle;?></div>
    
    <?php
    $currentPlays=array();
    switch ($data->source_type) {
    	case 1:
    		$currentPlays= CurrentPlay::model()->findByAttributes(array('Id_nzb'=>$data->Id));
    		break;
    	case 2:
    		$currentPlays= CurrentPlay::model()->findByAttributes(array('Id_ripped_movie'=>$data->Id));
    		break;
    	case 3:
    		$currentPlays= CurrentPlay::model()->findByAttributes(array('Id_local_folder'=>$data->Id));
    		break;
    	default:
    		$currentPlays=array();
    		break;
    }
    
    ?>
    <?php if(empty($currentPlays)):?>
     <div class="ribbon ribNuevo">
        <div class="ribbonTxt">
            NUEVO
        </div>
    </div>
	<?php endif?>
</div>