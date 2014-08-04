<div class="totalConsumos">Total Consumos: <span class="label label-info">60</span></div>
<?php			
	$this->widget('zii.widgets.grid.CGridView', array(
		'id'=>'current-month-grid',
		'dataProvider'=>$modelNzb->search(),
		'selectableRows' => 0,
		'summaryText'=>'',	
		'itemsCssClass' => 'table table-striped table-bordered tablaIndividual',
		'columns'=>array(				
				array(
						'header'=>'Pel&iacute;cula',
						'value'=>function($data){
							$title = 'No Identificado';
							
							if(isset($data->myMovieDiscNzb->myMovieNzb))
								$title = $data->myMovieDiscNzb->myMovieNzb->original_title;
							
							return $title;
						},
						'type'=>'raw',
				),
				array(
						'header'=>'Fecha',
						'value'=>function($data){
							return $data->change_state_date;
						},
						'type'=>'raw',
				),
				array(
						'name'=>'points',
						'value'=>function($data){
							return $data->points;
						},
						'type'=>'raw',
						'htmlOptions'=>array("class"=>"align-right"),
						'headerHtmlOptions'=>array("class"=>"align-right"),
				),
			),
		));		
?>