<?php 
Yii::app()->clientScript->registerScript(__CLASS__.'#Imdbdata_view', "

");

?>

<div class="single-movie-index-view" >
	<div class="single-movie-view" >
		<?php
		echo CHtml::link( CHtml::image("images/".$data->imdbdata->Poster,'details',array('id'=>'Imdbdata_Poster_button', 'style'=>'height: 260px;width: 185px;')
                            ),array('view', 'id'=>$data->Id));
		?>
		<?php echo CHtml::encode($data->imdbdata->Title); ?>
	</div>

</div>