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
//$('.element').wookmark();
 (function ($){
      $('#tiles').imagesLoaded(function() {
        // Prepare layout options.
        var options = {
          autoResize: true, // This will auto-update the layout when the browser window is resized.
          container: $('#main'), // Optional, used for some extra CSS styling
          offset: 2, // Optional, the distance between grid items
          itemWidth: 210, // Optional, the width of a grid item
          align: 'center',
          fillEmptySpace: true // Optional, fill the bottom of each column with widths of flexible height
        };

        // Get a reference to your grid items.
        var handler = $('#tiles li'),
            filters = $('#filters li');

        // Call the layout function.
        handler.wookmark(options);

        /**
* When a filter is clicked, toggle it's active state and refresh.
*/
        function onClickFilter(e) {
          var $item = $(e.currentTarget),
              activeFilters = [],
              filterType = $item.data('filter');
			
          if (filterType === 'all') {
            filters.removeClass('active');
          } else {
            $item.toggleClass('active');

            // Collect active filter strings
            filters.filter('.active').each(function() {
              activeFilters.push($(this).data('filter'));
            });
          }

          handler.wookmarkInstance.filter(activeFilters, 'or');
        }

        // Capture filter click events.
        $('#filters').on('click.wookmark-filter', 'li', onClickFilter);
      });
    })(jQuery);
</script>
    
<div id="main" role="main">
	<ul id="tiles">
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
	echo CHtml::openTag('li',array('data-filter-class'=>'["'.$model->production_year.'", "art"]'));
	echo '<img src="'.$moviePoster.'" height="283" width="200">';
	echo '<p>'.$model->production_year.'</p>';	
	echo CHtml::closeTag('li');
}
?>
	</ul>

</div>

    </div> <!-- /col-md-12 -->
  </div><!-- /row -->
</div><!-- /container -->
