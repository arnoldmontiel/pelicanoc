<?php 

$mediaType = preg_replace('/\W/', '-',strtolower($data->myMovieDiscNzb->myMovieNzb->media_type));
$title = preg_replace('/\W/', '-',strtolower($data->myMovieDiscNzb->myMovieNzb->original_title));

Yii::app()->clientScript->registerScript(__CLASS__.'#site_view'.$data->Id, "
	$('#MyMovieNzb_Poster_button_$data->Id').click(function(){
			window.location = '".MyMovieNzbController::CreateUrl('myMovieNzb/view',array('id'=>$data->Id))."';
			return false;
		
});

");

?>

<div class="post item <?php echo $mediaType;?> <?php echo $title;?>" style="220px" title="<?php echo $title;?>">
    <div class="well" title="<?php echo $data->myMovieDiscNzb->myMovieNzb->original_title?>">
        <?php
		 echo CHtml::image("images/".$data->myMovieDiscNzb->myMovieNzb->poster,'details',
				array('id'=>'MyMovieNzb_Poster_button_'.$data->Id, 'imgId'=>$data->Id, 'style'=>'height: 260px;width: 185px;'));
		?>
    </div>
</div>
