<?php 
Yii::app()->clientScript->registerScript(__CLASS__.'#siteImdb_view_ripped'.$data->Id, "
$('#Imdbdata_Poster_button_$data->Id').click(function(){
		//CloseCurtains();
		
		//set top scroll position
// 		$('.leftcurtain').css('top',$(document).scrollTop());
// 		$('.rightcurtain').css('top',$(document).scrollTop());
		
// 		//hidde scroll
// 		$(document.body).attr('style','overflow:hidden');
		
// 		$('.leftcurtain').removeClass('hideClass');
// 		$('.rightcurtain').removeClass('hideClass');
		
// 		$('.leftcurtain').stop().animate({width:'50%'}, 2000 );
// 		$('.rightcurtain').stop().animate({width:'51%'}, 2000 ,
// 			function(){
			window.location = '".RippedMovieController::CreateUrl('rippedMovie/viewSeason',array('id'=>$data->Id))."';
// 			OpenCurtains(10000);
// 			//show scroll			
// 			$(document.body).attr('style','overflow:auto');
			return false;
// 		}
// 		);

		
});
");

?>
<div class="single-season-index-view" >
	<div class="single-season-view" >
		<?php
		 echo CHtml::image("images/".$data->banner,'details',
				array('id'=>'Imdbdata_Poster_button_'.$data->Id, 'style'=>'height: 200px;width: 90%;'));
		?>
		<?php echo CHtml::hiddenField('id_rippedMovie',$data->Id,array('class'=>'id_rippedMovie','style'=>'display:none')); ?>
	</div>

</div>