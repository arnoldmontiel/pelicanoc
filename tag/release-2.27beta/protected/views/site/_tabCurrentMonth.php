<?php 
$criteria=new CDbCriteria;

$criteria->select = 'SUM(t.points) as total_points';
$criteria->addCondition('MONTH(t.date) = MONTH(NOW())');
$model = Consumption::model()->find($criteria);
$total = 0;
if(isset($model) && $model->total_points > 0)
	$total = $model->total_points;
?>
<div class="totalConsumos">Total Consumos: <span class="label label-info"><?php echo $total;?></span></div>
<?php			
	$this->widget('zii.widgets.grid.CGridView', array(
		'id'=>'current-month-grid',
		'dataProvider'=>$modelConsumption->searchCurrentMonth(),
		'selectableRows' => 0,
		'summaryText'=>'',	
		'itemsCssClass' => 'table table-striped table-bordered tablaIndividual',
		'columns'=>array(				
				array(
						'header'=>'Pel&iacute;cula',
						'value'=>function($data){
							$title = 'No Identificado';
							
							if(isset($data->nzb->myMovieDiscNzb->myMovieNzb))
								$title = $data->nzb->myMovieDiscNzb->myMovieNzb->original_title;
							
							return $title;
						},
						'type'=>'raw',
				),
				array(
						'header'=>'Fecha',
						'value'=>function($data){
							return $data->date;
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