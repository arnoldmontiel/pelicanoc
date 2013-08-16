
<?php

$hola = ReadFolderHelper::process_dir('/srv/storage', true);

foreach ($hola as $file)
{
echo $file['dirpath']. '<br>';	
}

$this->widget('ext.isotope.Isotope',array(
    'dataProvider'=>$dataProvider,
    'itemView'=>'_view',
    'itemSelectorClass'=>'item',
	'summaryText' =>"",
	'onClickLocation'=>SiteController::createUrl('AjaxMovieShowDetail'),
	'onClickLocationParam'=>array('id','idResource','sourceType'),
    'options'=>array(), // options for the isotope jquery
    'infiniteScroll'=>true, // default to true
    'infiniteOptions'=>array(), // javascript options for infinite scroller
    'id'=>'wall',
));
?>

<?php 
$this->beginWidget('bootstrap.widgets.TbModal', array('id' => 'myModal')); 

echo CHtml::openTag('div',array('id'=>'view-details'));
//place holder
echo CHtml::closeTag('div'); 

$this->endWidget(); ?>
