<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times-circle fa-lg"></i></button>
			<h4 class="modal-title">Consumos</h4>
      	</div>
      	<div class="modal-body">
      	<div class="row">
      	<div class="col-sm-6"><h1 class="pageTitle"> mes <?php echo $month;?> </h1></div>
      	<div class="col-sm-6 align-right totalConsumosMes">Total <span class="label label-info label-lg"><?php echo Consumption::pointsAccumulated($month, $year);?></span></div>
      	</div>
      		<?php			
				$this->widget('zii.widgets.grid.CGridView', array(
							'id'=>'by-month-grid',
							'dataProvider'=>$modelConsumptions->searchByMonth(),
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
    	</div>
	</div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
