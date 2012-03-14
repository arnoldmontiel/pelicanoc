<?php 
Yii::app()->clientScript->registerScript(__CLASS__.'#siteImdb_view'.$data->Id, "
$('#Imdbdata_Poster_button_$data->Id').click(function(){
		//CloseCurtains();
		
		//set top scroll position
		$('.leftcurtain').css('top',$(document).scrollTop());
		$('.rightcurtain').css('top',$(document).scrollTop());
		
		$('.leftcurtain').removeClass('hideClass');
		$('.rightcurtain').removeClass('hideClass');
		
		$('.leftcurtain').stop().animate({width:'50%'}, 2000 );
		$('.rightcurtain').stop().animate({width:'51%'}, 2000 ,
			function(){
			window.location = '".ImdbdataController::CreateUrl('imdbdata/view',array('id'=>$data->Id))."';
			OpenCurtains(20000);
			return false;
		}
		);

		
});
");

?>

<div class="single-movie-index-view" >
	<div class="single-movie-view" >
		<?php
		 echo CHtml::image("images/".$data->imdbdata->Poster,'details',
				array('id'=>'Imdbdata_Poster_button_'.$data->Id, 'style'=>'height: 260px;width: 185px;'));
		?>
		<?php echo CHtml::encode($data->imdbdata->Title); ?>
	</div>

</div>