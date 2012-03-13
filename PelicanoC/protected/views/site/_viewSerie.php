<?php 
Yii::app()->clientScript->registerScript(__CLASS__.'#site_view'.$data->Id, "
	$('#Imdbdata_tv_Poster_button_$data->Id').click(function(){
		//CloseCurtains();
		
		$('.leftcurtain').removeClass('hideClass');
		$('.rightcurtain').removeClass('hideClass');
		
		$('.leftcurtain').stop().animate({width:'50%'}, 2000 );
		$('.rightcurtain').stop().animate({width:'51%'}, 2000 ,
			function(){
			window.location = '".ImdbdataController::CreateUrl('imdbdataTv/viewEpisode',array('id'=>$data->Id))."';
			OpenCurtains(20000);
			return false;
		}
		);

		
});

");
?>
<div class="single-serie-index-view" >
	<div class="single-serie-view" >
		<?php
		 echo CHtml::image("images/".$data->imdbdataTv->Poster,'details',
				array('id'=>'Imdbdata_tv_Poster_button_'.$data->Id, 'style'=>'height: 260px;width: 185px;'));
		?>	
		<p class="single-serie-view-title">
		<?php echo CHtml::encode($data->imdbdataTv->Title); ?>
		</p>  
		<p class="single-serie-view-title">
		S<?php echo CHtml::encode($data->imdbdataTv->Season);?>
		/E<?php echo CHtml::encode($data->imdbdataTv->Episode);?>
		</p>  
		
	</div>

</div>

