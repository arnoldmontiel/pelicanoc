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
<script type="text/javascript">
docReady( function() {
  var container = document.querySelector('#itemsContainer');
  var iso = window.iso = new Isotope( container, {
    layoutMode: 'fitRows',
    transitionDuration: '0.8s',
    getSortData: {
      number: '.number parseInt',
      symbol: '.symbol',
      name: '.name',
      category: '[data-category]',
    }

	// layout Isotope again after all images have loaded
 /* imagesLoaded( container, function() {
	  iso.layout();
	});*/

  });

  
  var options = document.querySelector('#options');

  eventie.bind( options, 'click', function( event ) {
    if ( !matchesSelector( event.target, 'button' ) ) {
      return;
    }

    // var opt = {};
    var key = event.target.parentNode.getAttribute('data-isotope-key');
    var value = event.target.getAttribute('data-isotope-value');

    if ( key === 'filter' && value === 'number-greater-than-50' ) {
      value = function( elem ) {
        var numberText = getText( elem.querySelector('.number') );
        return parseInt( numberText, 10 ) > 40;
      };
    }
    console.log( key, value );
    iso.options[ key ] = value;
    iso.arrange();
  });

});

function getText( elem ) {
  return elem.textContent || elem.innerText;
}

</script>
    
<div id="itemsContainer" role="main">
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
	
	echo '<div class="item '.$model->production_year.' ">';
	echo '<img src="'.$moviePoster.'" class="peliAfiche">';
	echo '<div id="'.$data->Id.'" class="peliTitulo">'.$shortTitle.'</div>';
	echo '</div>';
	
	
}
?>	

</div>

    </div> <!-- /col-md-12 -->
  </div><!-- /row -->
</div><!-- /container -->
