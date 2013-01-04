<div class="post item <?php echo $data->myMovieDisc->myMovie->media_type?>" style="220px">
    <div class="well">
        <?php
		 echo CHtml::image("images/".$data->myMovieDisc->myMovie->poster,'details',
				array('id'=>'Imdbdata_Poster_button_'.$data->Id, 'style'=>'height: 260px;width: 185px;'));
		?>
    </div>
</div>
