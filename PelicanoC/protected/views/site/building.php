	<div class="row-movie-home" >
		<div class="movie-index-view" >
			<div class="movie-home-image" >
				<?php 
				echo CHtml::link( CHtml::image("images/building.png",'movies',array('id'=>'building_button', 'style'=>'height: 128px;width: 128px;')
				),array('site/index'));
				?>
			</div>
			<div class="movie-home-text" >
				Under Construction
			</div>
		</div>
	</div>
		<?php
		Yii::app()->clientScript->registerScript('main', "
			$('#building').hover(
			function () {
				$(this).attr('src','images/building-light.png');
			  },
			  function () {
				$(this).attr('src','images/building.png');
				}
			);
		
		");
		?>
		