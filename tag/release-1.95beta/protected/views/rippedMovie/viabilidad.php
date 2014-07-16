<div class="movie-title-index">
	Ripped
	
	<div class="index-searchbox">
		<input type="text" name="index_search" id="index_search" placeholder="<?php echo CHtml::decode("Search by title, actors, directors, genre...")?>" autocomplete="off">
	</div>	
</div>

<ul id="filters">
  <li><a href="#" data-filter="*">show all</a></li>
  <li><a href="#" data-filter=".movie">Movie</a></li>
  <li><a href="#" data-filter=".tv-serie">Serie</a></li>
</ul>

<?php 
echo CHtml::hiddenField("media-type-filter","*",array('Id'=>'media-type-filter'));
echo CHtml::hiddenField("current-filter","*",array('Id'=>'current-filter'));
echo CHtml::hiddenField("search-filter","",array('Id'=>'search-filter'));

$this->widget('ext.isotope.Isotope',array(
    'dataProvider'=>$dataProvider,
    'itemView'=>'_viewViabilidad',
    'itemSelectorClass'=>'item',
    'options'=>array(), // options for the isotope jquery
    'infiniteScroll'=>true, // default to true
    'infiniteOptions'=>array(), // javascript options for infinite scroller
    'id'=>'wall',
));

?>
<?php 
Yii::app()->clientScript->registerScript(__CLASS__.'#RippedMovie_index', "

$('#filters a').click(function(){
  var selector = $(this).attr('data-filter');  
  $('#media-type-filter').val(selector);
  $('#current-filter').val(selector);
  
  //clean search filter
  $('#search-filter').val(null);
  $('#index_search').val(null);

  $('#wall .items').infinitescroll('retrieve');  
  $('#wall .items').isotope({ filter: selector });
  $('#wall .items').isotope('shuffle');
  return false;
});


$('#index_search').change(function(){	
 	var searchFilter = $(this).val().toLowerCase().trim().replace(/ /gi,'-');
 	$('#search-filter').val(searchFilter); 	 	
	$('#wall .items').infinitescroll('filterText');  
});
");
?>
