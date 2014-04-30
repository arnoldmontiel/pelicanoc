<div class="container" id="screenHome" >

   <div class="row">
    <div class="col-md-12">
<?php

// $hola = ReadFolderHelper::process_dir('/srv/storage', true);

// foreach ($hola as $file)
// {
// 	//if(pathinfo($file['filename'], PATHINFO_EXTENSION) == 'peli') {
// 		echo $file['dirpath']. '<br>';	
// }
/*
$this->widget('ext.isotope.Isotope',array(
    'dataProvider'=>$dataProvider,
    'itemView'=>'_view',
    'itemSelectorClass'=>'item',
	'summaryText' =>"",
	'onClickLocation'=>SiteController::createUrl('AjaxMovieShowDetail'),
	'onClickLocationParam'=>array('id','idresource','sourcetype'),
    'options'=>array(), // options for the isotope jquery
    'infiniteScroll'=>true, // default to true
    'infiniteOptions'=>array(), // javascript options for infinite scroller
    'id'=>'wall',
));*/
?>
<div id="filters" class="button-group">
  <button data-filter="*">show all</button>
  <button data-filter=".comedy">comedy</button>
  <button data-filter=".romance">romance</button>
</div>
<script type="text/javascript">
docReady( function() {
  var container = ('#itemsContainer');
  var iso = window.iso = new Isotope( container, {
    transitionDuration: '0.8s',
  itemSelector: '.item',
  masonry: {
    columnWidth: '.grid-sizer',
    isFitWidth: true,
    gutter: 10
  },
 });
  
	// layout Isotope again after all images have loaded
   imagesLoaded( container, function() {
 	  iso.layout();
 	});


   $('#filters').on( 'click', 'button', function() {
	   var filterValue = $(this).attr('data-filter');
	   $container.isotope({ filter: filterValue });
	 });
     
 
	
});

function hola(obj){

	   var filterValue = $(obj).attr('data-filter');
	   alert(filterValue);
	   var container = document.querySelector('#itemsContainer');
	   $container.isotope({ filter: filterValue });

}



</script>
    
<div id="itemsContainer" role="main">
<div class="grid-sizer"></div>

<?php 
$modelMovies = Movies::model()->findAll();
foreach($modelMovies as $data)
{
	if($data->source_type == 1)
	{
		$model = MyMovieDiscNzb::model()->findByPk($data->Id_my_movie_disc_nzb);
		$model = $model->myMovieNzb;
	}
	else
	{
		$model = MyMovieDisc::model()->findByPk($data->Id_my_movie_disc);
		$model = $model->myMovie;
	}

	//$modelTMDB =  $data->TMDBData;
	$modelTMDB =  TMDBData::model()->findByPk($data->Id_TMDB_data);;
	$moviePoster = $model->poster;
	if(isset($modelTMDB)&&$modelTMDB->poster!="")
	{
		$moviePoster = $modelTMDB->poster;
	}
	
	$moviePoster = PelicanoHelper::getImageName($moviePoster);
	
	$genre = preg_replace('/\W/', ' ',strtolower($model->genre));
	$title = preg_replace('/\W/', '-',strtolower($model->original_title));
	$shortTitle = $model->original_title;
	$shortTitle = (strlen($shortTitle) > 24) ? substr($shortTitle,0,21).'...' : $shortTitle;
			
	
	//echo CHtml::openTag('li',array('data-filter-class'=>'["london", "art"]'));
// 	echo CHtml::openTag('li',array('data-filter-class'=>'["'.$model->production_year.'", "art"]'));
// 	echo '<img src="'.$moviePoster.'" height="283" width="200">';
// 	echo '<p>'.$model->production_year.'</p>';	
// 	echo CHtml::closeTag('li');
	
	echo '<div class="item comedy '.$model->production_year.' '.$title.'" title="'.$title.'">';
	echo '<a id="link-movie-'.$model->Id.'-'.$data->Id.'-'.$data->source_type.'" href="#myModal" data-toggle="modal">';  
	echo '<img id="'.$model->Id.'" idResource="'.$data->Id.'" sourceType="'.$data->source_type.'" src="'.$moviePoster.'" class="peliAfiche">';
	echo '</a>';
	echo '<div id="'.$data->Id.'" class="peliTitulo">'.$shortTitle.'</div>';
	echo '</div>';
	
	//ejemplo romance
	echo '<div class="item romance '.$model->production_year.' '.$title.'" title="'.$title.'">';
	echo '<a id="link-movie-'.$model->Id.'-'.$data->Id.'-'.$data->source_type.'" href="#myModal" data-toggle="modal">';  
	echo '<img id="'.$model->Id.'" idResource="'.$data->Id.'" sourceType="'.$data->source_type.'" src="'.$moviePoster.'" class="peliAfiche">';
	echo '</a>';
	echo '<div id="'.$data->Id.'" class="peliTitulo">'.$shortTitle.'</div>';
	echo '</div>';
	
	
}
?>	

</div>

    </div> <!-- /col-md-12 -->
  </div><!-- /row -->
</div><!-- /container -->