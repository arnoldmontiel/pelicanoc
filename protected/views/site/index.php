
<?php

// $hola = ReadFolderHelper::process_dir('/srv/storage', true);

// foreach ($hola as $file)
// {
// 	//if(pathinfo($file['filename'], PATHINFO_EXTENSION) == 'peli') {
// 		echo $file['dirpath']. '<br>';	
// }

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
));
?>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<?php 
echo CHtml::openTag('div',array('id'=>'view-details'));
//place holder
echo CHtml::closeTag('div'); 
?>
</div><!-- /.modal -->
<?php 
// $this->beginWidget('bootstrap.widgets.TbModal', array('id' => 'myModal')); 

// echo CHtml::openTag('div',array('id'=>'view-details'));
// //place holder
// echo CHtml::closeTag('div'); 

// $this->endWidget(); 
?>
