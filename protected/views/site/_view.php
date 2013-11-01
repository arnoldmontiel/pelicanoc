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
if(isset($modelTMDB))
{
	$moviePoster = $modelTMDB->poster;
}
else
{
	$moviePoster = $model->poster;	
}

//$moviePoster = $data->TMDBData->poster;

$genre = preg_replace('/\W/', ' ',strtolower($model->genre));
$title = preg_replace('/\W/', '-',strtolower($model->original_title));


Yii::app()->clientScript->registerScript(__CLASS__.'#site_view'.$data->Id, "
	$('#link-movie-$model->Id-$data->Id-$data->source_type').click(function(){
		var target = $(this).attr('href');
		var sourceType = '$data->source_type';
		var id = '$model->Id';
		var idResource = '$data->Id';		
		var param = 'id='+id+'&sourcetype='+sourceType+'&idresource='+idResource; 
		$.ajax({
	   		type: 'POST',
	   		url: '". SiteController::createUrl('AjaxMovieShowDetail') . "',
	   		data: param,
	 	}).success(function(data)
	 	{
	 	
			$('#myModal').html(data);
			
		}
	 	);	
		
});

");

?>

        
<div class="element post item <?php echo $genre;?> <?php echo $title;?>" title="<?php echo $title;?>">
	<a id="link-movie-<?php echo $model->Id;?>-<?php echo $data->Id;?>-<?php echo $data->source_type;?>" style="position:relative;" data-target="#myModal" data-toggle="modal" href="#myModal" class="">    
        <?php
		 echo CHtml::image("images/".$moviePoster,'details',
				array('id'=>$model->Id, 'idResource'=>$data->Id, 'sourceType'=>$data->source_type, 'class'=>'peliAfiche'));
		?>    
    </a>			
    <div id="<?php echo $data->Id;?>" class="peliTitulo">
		<?php 
    		echo CHtml::openTag("p",array("class"=>PelicanoHelper::setAnimationClass($model->original_title)));
    	    							
    	echo $model->original_title;
    	echo CHtml::closeTag("p");
		?>
    </div>
</div>
