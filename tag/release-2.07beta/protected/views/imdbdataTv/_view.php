<?php 
Yii::app()->clientScript->registerScript(__CLASS__.'#ImdbdataTv_view', "

");

?>

<div class="single-serie-index-view" >
	<div class="single-serie-view" >
		<?php
		echo CHtml::link( CHtml::image("images/".$data->Poster,'details',array('id'=>'ImdbdataTv_Poster_button', 'style'=>'height: 260px;width: 185px;')
                            ),array('view', 'id'=>$data->ID));
		?>
		<?php echo CHtml::encode($data->Title); ?>
	</div>

</div>