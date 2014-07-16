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


Yii::app()->clientScript->registerScript(__CLASS__.'#site_view_serie'.$data->Id, "
	$('#link-serie-$model->Id-$data->Id-$data->source_type').click(function(){
		var target = $(this).attr('href');
		var sourceType = '$data->source_type';
		var id = '$model->Id';
		var param = 'id='+id+'&sourceType='+sourceType; 
		$.ajax({
	   		type: 'POST',
	   		url: '". SiteController::createUrl('AjaxSerieShowDetail') . "',
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
	<a id="link-serie-<?php echo $model->Id;?>-<?php echo $data->Id;?>-<?php echo $data->source_type;?>" style="position:relative;" data-target="#myModal" data-toggle="modal" href="#myModal" class="">    
        <?php
		 echo CHtml::image("images/".$moviePoster,'details',
				array('imgId'=>$model->Id, 'sourceType'=>$data->source_type, 'class'=>'peliAfiche'));
		?>    
    </a>
    <div id="<?php echo $data->Id;?>" class="peliTitulo"><?php echo $title;?></div>
</div>
