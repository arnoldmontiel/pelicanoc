<?php
Yii::app()->clientScript->registerScript(__CLASS__.'#update-auto-ripper', "


");
?>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'auto-ripper-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); 

echo CHtml::hiddenField("hiddenTitleId",'',array('id'=>'hiddenTitleId'));
?>

<div id="search-movie-data">
	
	<div id="div-searchResult" style=" width:100%">
		<?php
		
		$this->widget('ext.processingDialog.processingDialog', array(
					'buttons'=>array('none'),
					'idDialog'=>'wating',
		));
		
		$this->widget('zii.widgets.grid.CGridView', array(
		    'dataProvider' => $arrayDataProvider,
		    'id'=>'search-result-grid',
			'summaryText'=>'',
		
			'selectionChanged'=>'js:function(){
						var titleId = $.fn.yiiGridView.getSelection("search-result-grid")
						if(titleId!=""){
							$("#hiddenTitleId").val(titleId);
							$("#saveButton").removeAttr("disabled");
						}
						else
						{
							$("#hiddenTitleId").val("");
							$("#saveButton").attr("disabled","disabled");
						}
					}',
		    'columns' => array(
		        array(
		            'name' => 'Title',
		            'type' => 'raw',
		            'value' => '$data->title'
		        ),
		        array(
		            'name' => 'country',
		            'type' => 'raw',
		            'value' => '$data->country'
		        ),
				array(
		            'name' => 'year',
		            'type' => 'raw',
		            'value' => '$data->year'
				),
				array(
		            'name' => 'edition',
		            'type' => 'raw',
		            'value' => '$data->edition'
				),
				array(
		            'name' => 'disc name',
		            'type' => 'raw',
		            'value' => '$data->discname'
				),
				array(
		            'name' => 'type',
		            'type' => 'raw',
		            'value' => '$data->type'
				),
				array(
					'name'=>'',
					'value'=>'CHtml::link("more info",
												"#",
												array(
														"id"=>$data->id,
														"class"=>"lnkMoreInfo",
														"style"=>"width:50px;text-align:right;",
													)
											)',
	
					'type'=>'raw',					
					'htmlOptions'=>array("style"=>"text-align:right;"),
				),
				array(
							'name'=>'',
							'value'=>'CHtml::image($data->thumbnail,"",array())',
							'type'=>'raw',					
							'htmlOptions'=>array("style"=>"text-align:right;"),
				),
		    ),
		));
		?>
	</div>
</div>

<div class="row buttons">
	<?php echo CHtml::submitButton('Save', array('id'=>'saveButton','disabled'=>'disabled')); 
		echo CHtml::submitButton('Cancel', array('id'=>'cancelButton'));
	?>
</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
