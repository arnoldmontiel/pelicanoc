<div class="movie-title-index">
	Ripped
	
	<div class="index-searchbox">
		<input type="text" name="index_search" id="index_search" placeholder="<?php echo CHtml::decode("Search by title, actors, directors, genre...")?>" autocomplete="off">
	</div>	
</div>

<ul id="filters">
  <li><a href="#" data-filter="*">show all</a></li>
  <li><a href="#" data-filter=".Movie">Movie</a></li>
  <li><a href="#" data-filter=".Serie">Serie</a></li>
</ul>

<?php 
echo CHtml::submitButton('Shuffle', array('id'=>'btnShuffle'));
echo CHtml::hiddenField("isotope-filter","*",array('Id'=>'isotope-filter'));

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
  
  $('#wall .items').infinitescroll('retrieve');
  $('#wall .items').isotope({ filter: selector });
  $('#wall .items').isotope('shuffle');
  $('#isotope-filter').val(selector);
  return false;
});

$('#btnShuffle').click(function(){
  $('#wall .items').isotope('shuffle');
  return false;
});


$('#index_search').change(
					function(){
					var searchFilter = 'searchFilter=' + $(this).val();
					$.fn.yiiListView.update('listMovies-view',{data:searchFilter});
				});
");
?>
