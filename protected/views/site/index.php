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
  <button data-filter=".alkali, .alkaline-earth">alkali & alkaline-earth</button>
  <button data-filter=":not(.transition)">not transition</button>
  <button data-filter=".metal:not(.transition)">metal but not transition</button>
</div>
<script type="text/javascript">
docReady( function() {
  var container = document.querySelector('#itemsContainer');
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
//    imagesLoaded( container, function() {
//  	  iso.layout();
//  	});

  var options = document.querySelector('#filters');

  eventie.bind( options, 'click', function( event ) {
    var value = event.target.getAttribute('data-filter');
    iso.options[ 'filter' ] = value;
    iso.arrange();
  });

});

function openMovieShowDetail(id, sourceType, idResource)
{
	var param = 'id='+id+'&sourcetype='+sourceType+'&idresource='+idResource; 
	$.ajax({
		type: 'POST',
		url: "<?php echo SiteController::createUrl('AjaxMovieShowDetail')?>",
		data: param,
	}).success(function(data)
	{	
		$('#myModal').html(data);	
		$('#myModal').modal({
			show: true
		})		
	});
	return false;	
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
	
	echo '<div class="item comedy '.$model->production_year.' ">';
	$id = "'$model->Id'";
	echo '<a onclick="openMovieShowDetail('.$id.', '.$data->source_type.', '.$data->Id.')">';
	echo '<img src="'.$moviePoster.'" class="peliAfiche">';
	echo '</a>';
	echo '<div id="'.$data->Id.'" class="peliTitulo">'.$shortTitle.'</div>';
	echo '</div>';	
}
?>	

</div>

    </div> <!-- /col-md-12 -->
  </div><!-- /row -->
</div><!-- /container -->