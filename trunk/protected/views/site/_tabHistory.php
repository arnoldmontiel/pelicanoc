<?php			
	$this->widget('zii.widgets.grid.CGridView', array(
		'id'=>'history-grid',
		'dataProvider'=>$modelNzb->search(),
		'selectableRows' => 0,
		'summaryText'=>'',	
		'itemsCssClass' => 'table table-striped table-bordered tablaIndividual',
		'columns'=>array(				
				array(
						'header'=>'Mes',
						'value'=>function($data){
							$title = 'No Identificado';
							
							if(isset($data->myMovieDiscNzb->myMovieNzb))
								$title = $data->myMovieDiscNzb->myMovieNzb->original_title;
							
							return $title;
						},
						'type'=>'raw',
				),
				array(
						'header'=>'',
						'value'=>function($data){
							return '<i class="fa fa-check-circle"></i>';
						},
						'type'=>'raw',
				),
				array(
						'header'=>'Consumo',
						'value'=>function($data){
							return $data->change_state_date;
						},
						'type'=>'raw',
						'htmlOptions'=>array("class"=>"align-right"),
						'headerHtmlOptions'=>array("class"=>"align-right"),
				),
				array(
						'name'=>'Acciones',
						'value'=>function($data){
							return '<a data-toggle="modal" class="btn btn-primary"><i class="fa fa-list"></i> Ver Detalle</a>';
						},
						'type'=>'raw',
						'htmlOptions'=>array("class"=>"align-right"),
						'headerHtmlOptions'=>array("class"=>"align-right"),
				),
			),
		));		
?>