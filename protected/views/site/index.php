<div class="container" id="screenHome" >

<?php if (isset($this->showFilter) && $this->showFilter): ?>
 <div class="row">
 <div class="col-md-6">
 <ul id="filtroGenero" class="nav nav-pills">
  				<li class="generoItem active"><a data-toggle="tab" href="#" data-filter="*">Todas</a></li>
  				<li class="generoItem"><a href="#" data-toggle="tab" data-filter="*" data-filter=".comedy">Comedia</a></li>
  				<li class="generoItem"><a href="#" data-toggle="tab" data-filter="*" data-filter=".drama">Drama</a></li>
  				<li class="generoItem"><a href="#" data-toggle="tab" data-filter="*" data-filter=".romance">Romance</a></li>
  				<li class="generoItem"><a href="#" data-toggle="tab" data-filter="*" data-filter=".fantasia">Fantasia</a></li>
			</ul>
 </div>
 <div class="col-md-6"> 
<div class="searchMainMovie pull-right">
 <form role="search">
      <div class="form-group">
      <input type="text" class="form-control" placeholder=" Buscar Pel&iacute;cula">
      </div>
    </form>
    </div>
 </div>
<?php endif; ?>

   <div class="row">
    <div class="col-md-12">
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

<?php 
// $this->beginWidget('bootstrap.widgets.TbModal', array('id' => 'myModal')); 

// echo CHtml::openTag('div',array('id'=>'view-details'));
// //place holder
// echo CHtml::closeTag('div'); 

// $this->endWidget(); 
?>

    </div> <!-- /col-md-12 -->
  </div><!-- /row -->
</div><!-- /container -->