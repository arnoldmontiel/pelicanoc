<div  >
	<div class="row-movie-home" >
		<div class="right-movie-home" >
			<div class="movie-home-image" >
			<?php 
			echo CHtml::link( CHtml::image("images/movies.png",'movies',array('id'=>'movie_button', 'style'=>'height: 128px;width: 128px;')
			),array('/imdbdata'));
			?>
			</div>
			<div class="movie-home-text" >
				Movies
			</div>
		</div>
		<div class="left-movie-home" >
			<div class="movie-home-image" >
				<?php 
				echo CHtml::link( CHtml::image("images/news.png",'news',array('id'=>'news_button', 'style'=>'height: 128px;width: 128px;')
				),array('/imdbdata/news'));
				?>
			</div>
			<div class="movie-home-text" >
				News
			</div>
		</div>
	</div>
	<div class="row-movie-home" >
		<div class="left-movie-home" >
			<div class="movie-home-image" >
				<?php 
				echo CHtml::link( CHtml::image("images/music.png",'music',array('id'=>'music_button', 'style'=>'height: 128px;width: 128px;')
				),array('/site/music'));
				?>
			</div>
			<div class="movie-home-text" >
				Music
			</div>
		</div>
		<div class="right-movie-home" >
			<div class="movie-home-image" >
				<?php 
				echo CHtml::link( CHtml::image("images/downloading-menu.png",'downloading',array('id'=>'downloading_button', 'style'=>'height: 128px;width: 128px;')
				),array('/SABnzbd'));
				?>
			</div>
			<div class="movie-home-text" >
				Downloads
			</div>
		</div>
	</div>
</div>

		<?php
		Yii::app()->clientScript->registerScript('main', "
			$('#movie_button').hover(
			function () {
				$(this).attr('src','images/movies-light.png');
				//$(this).addClass('menu-hover');
			  },
			  function () {
				$(this).attr('src','images/movies.png');
				//$(this).removeClass('menu-hover');
				}
			);
			$('#news_button').hover(
			function () {
				$(this).attr('src','images/news-light.png');
			  },
			  function () {
				$(this).attr('src','images/news.png');
			  }
			);
			$('#downloading_button').hover(
			function () {
				$(this).attr('src','images/downloading-menu-light.png');
			  },
			  function () {
				$(this).attr('src','images/downloading-menu.png');
			  }
			);
			$('#home_button').hover(
			function () {
				$(this).attr('src','images/home-light.png');
			  },
			  function () {
				$(this).attr('src','images/home.png');
			  }
			);
			$('#music_button').hover(
			function () {
				$(this).attr('src','images/music-light.png');
			  },
			  function () {
				$(this).attr('src','images/music.png');
			  }
			);
		
		");
		?>
