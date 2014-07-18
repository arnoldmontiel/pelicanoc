<?php 
$mediaType = preg_replace('/\W/', '-',strtolower($data->myMovieDisc->myMovie->media_type));
$title = preg_replace('/\W/', '-',strtolower($data->myMovieDisc->myMovie->original_title));
?>

<div class="post item <?php echo $mediaType;?> <?php echo $title;?>" style="220px" title="<?php echo $title;?>">
    <div class="well" title="<?php echo $data->myMovieDisc->myMovie->original_title?>">
        <?php
		 echo CHtml::image("images/".$data->myMovieDisc->myMovie->poster,'details',
				array('id'=>'Imdbdata_Poster_button_'.$data->Id, 'style'=>'height: 260px;width: 185px;'));
		?>
    </div>
</div>
