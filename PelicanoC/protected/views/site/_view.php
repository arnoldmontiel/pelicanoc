<?php 
Yii::app()->clientScript->registerScript(__CLASS__.'#site_view'.$data->Id, "
	$('#MyMovieNzb_Poster_button_$data->Id').click(function(){
		//CloseCurtains();
		
		//set top scroll position
		$('.leftcurtain').css('top',$(document).scrollTop());
		$('.rightcurtain').css('top',$(document).scrollTop());
		
		//hidde scroll
		$(document.body).attr('style','overflow:hidden');
		
		$('.leftcurtain').removeClass('hideClass');
		$('.rightcurtain').removeClass('hideClass');
		
		$('.leftcurtain').stop().animate({width:'50%'}, 2000 );
		$('.rightcurtain').stop().animate({width:'51%'}, 2000 ,
			function(){
			window.location = '".MyMovieNzbController::CreateUrl('myMovieNzb/view',array('id'=>$data->Id))."';
			OpenCurtains(10000);
			//show scroll			
			$(document.body).attr('style','overflow:auto');
			return false;
		}
		);

		
});

");

?>
<div class="single-movie-index-view" >
	<div class="single-movie-view" >
		<?php
		 echo CHtml::image("images/".$data->myMovieDiscNzb->myMovieNzb->poster,'details',
				array('id'=>'MyMovieNzb_Poster_button_'.$data->Id, 'style'=>'height: 260px;width: 185px;'));
		?>
		<p class="single-movie-view-title">
		<?php echo CHtml::encode($data->myMovieDiscNzb->myMovieNzb->original_title); ?>
		</p>  
		
	</div>

</div>

