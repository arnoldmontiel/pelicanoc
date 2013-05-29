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
	$('#link-serie-$model->Id').click(function(){
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
	 	
			$('#view-details').html(data);

			//$('#view-details').html('putooooooooooooooooo');
		}
	 	);	
		
});

");

?>

        
<div class="element post item <?php echo $genre;?> <?php echo $title;?>" title="<?php echo $title;?>">
	<a id="link-serie-<?php echo $model->Id;?>" style="position:relative;" data-target="#myModalSerie" data-toggle="modal" href="#myModalSerie" class="">    
        <?php
		 echo CHtml::image("images/".$moviePoster,'details',
				array('imgId'=>$model->Id, 'sourceType'=>$data->source_type, 'class'=>'peliAfiche'));
		?>    
    </a>
    <div id="<?php echo $data->Id;?>" class="peliTitulo"><?php echo $title;?></div>
</div>
