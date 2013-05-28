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

$genre = preg_replace('/\W/', ' ',strtolower($model->genre));
$title = preg_replace('/\W/', '-',strtolower($model->original_title));
$moviePoster = $model->poster;


Yii::app()->clientScript->registerScript(__CLASS__.'#site_view'.$data->Id, "
	$('#MyMovieNzb_Poster_button_$data->Id').click(function(){
			window.location = '".MyMovieNzbController::CreateUrl('myMovieNzb/view',array('id'=>$data->Id))."';
			return false;
		
});

");

?>

        
<div class="element post item <?php echo $genre;?> <?php echo $title;?>" title="<?php echo $title;?>">
	<a style="position:relative;" data-toggle="modal" href="#myModal" class="">    
        <?php
		 echo CHtml::image("images/".$moviePoster,'details',
				array('id'=>'MyMovieNzb_Poster_button_'.$data->Id, 'imgId'=>$data->Id, 'class'=>'peliAfiche'));
		?>    
    </a>
    <div id="<?php echo $data->Id;?>" class="peliTitulo"><?php echo $title;?></div>
</div>
