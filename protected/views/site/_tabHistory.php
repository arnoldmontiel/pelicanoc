<?php			
	$this->widget('zii.widgets.grid.CGridView', array(
		'id'=>'history-grid',
		'dataProvider'=>$modelConsumption->searchHistory(),
		'selectableRows' => 0,
		'summaryText'=>'',	
		'itemsCssClass' => 'table table-striped table-bordered tablaIndividual',
		'columns'=>array(				
				array(
						'header'=>'Mes',
						'value'=>function($data){
							return strftime('%B', mktime(0, 0, 0, $data->month)).' '. $data->year;;
						},
						'type'=>'raw',
				),
				array(
						'header'=>'',
						'value'=>function($data){
							$value = '';
							if($data->has_paid > 0)
								$value = '<i class="fa fa-check-circle"></i>';
							return $value;
						},
						'type'=>'raw',
				),
				array(
						'header'=>'Total',
						'value'=>function($data){
							return $data->total_points;
						},
						'type'=>'raw',
						'htmlOptions'=>array("class"=>"align-right"),
						'headerHtmlOptions'=>array("class"=>"align-right"),
				),
				array(
						'name'=>'Acciones',
						'value'=>function($data){
							return '<a onclick="openConsumptionDetail('.$data->month.', '.$data->year.');" data-toggle="modal" class="btn btn-primary"><i class="fa fa-eye"></i> Ver Detalle</a>';
						},
						'type'=>'raw',
						'htmlOptions'=>array("class"=>"align-right"),
						'headerHtmlOptions'=>array("class"=>"align-right"),
				),
			),
		));		
?>