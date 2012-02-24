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
	<div class="row-movie-home" >
		<div class="left-movie-home" >
			<div class="movie-home-image" >
				<?php 
				echo CHtml::link( CHtml::image("images/stored.png",'stored',array('id'=>'stored_button', 'style'=>'height: 128px;width: 128px;')
				),array('/imdbdata/stored'));
				?>
			</div>
			<div class="movie-home-text" >
				Stored Movies
			</div>
		</div>
		<div class="right-movie-home" >
			<div class="movie-home-image" >
			</div>
			<div class="movie-home-text" >
			</div>
		</div>
	</div>
	
</div>
