<div class="movie-title-index">
	Ripped Movies
	
	<div class="index-searchbox">
		<input type="text" name="index_search" id="index_search" placeholder="<?php echo CHtml::decode("Search by title, actors, directors, genre...")?>" autocomplete="off">
	</div>	
</div>

<div id="imdb_index" class="movie-index">
<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
	'id'=>'listMovies-view',
	'summaryText' =>"",
	'pager'=>array('cssFile'=>Yii::app()->baseUrl.'/css/pager-custom.css','header'=>''),
	'afterAjaxUpdate'=>'js:function(id, data){
					$("#" + id).find(".id_rippedMovie").each(
						function(index, item){
							$("#Imdbdata_Poster_button_" + $(item).val()).click(function(){
								//CloseCurtains();
								
								//set top scroll position
								$(".leftcurtain").css("top",$(document).scrollTop());
								$(".rightcurtain").css("top",$(document).scrollTop());
								
								//hidde scroll
								$(document.body).attr("style","overflow:hidden");
		
								$(".leftcurtain").removeClass("hideClass");
								$(".rightcurtain").removeClass("hideClass");
								
								$(".leftcurtain").stop().animate({width:"50%"}, 2000 );
								$(".rightcurtain").stop().animate({width:"51%"}, 2000 ,
									function(){
										var url = "'.RippedMovieController::CreateUrl('rippedMovie/viewAdult') .'";
										var param = "&id="+$(item).val();
										window.location = url + param;
										OpenCurtains(10000);
										//show scroll			
										$(document.body).attr("style","overflow:auto");
										return false;
									}
								);
							}
							)
						}
					)
				}',
)); ?>
</div>
<?php 
Yii::app()->clientScript->registerScript(__CLASS__.'#RippedMovie_index', "
$('#index_search').change(
					function(){
					var searchFilter = 'searchFilter=' + $(this).val();
					$.fn.yiiListView.update('listMovies-view',{data:searchFilter});
				});
");
?>

	<?php 
	$this->widget('ext.processingDialog.processingDialog', array(
			'buttons'=>array('ok'),
			'idDialog'=>'wating',
	));
	$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
			'id'=>'parentalControl',
			// additional javascript options for the dialog plugin
			'options'=>array(
					'title'=>'Contraseña',
					'autoOpen'=>false,
					'modal'=>true,
					'width'=> '300',
					'buttons'=>	array(
							'Cancelar'=>'js:function(){jQuery("#CreateUser").dialog( "close" );}',
							'Aceptar'=>'js:function()
							{
							jQuery("#wating").dialog("open");
							jQuery.post("'.Yii::app()->createUrl("AjaxVerifyParentalControlPassw").'", $("#customer-users-form").serialize(),
							function(data) {
								if(data!=null && data!="")
								{
									$.fn.yiiGridView.update("customer-users-grid", {
										data: $(this).serialize()
									});
									jQuery("#CreateUser").dialog( "close" );
								}
								jQuery("#wating").dialog("close");
							}
					);

				}'),
			),
	));
	?>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'parental-control-passwd-form',
	'enableAjaxValidation'=>false,
));
$modelCustomer = new Customer; 
?>


	<div class="row">
		<?php echo $form->labelEx($modelCustomer,'adult_password'); ?>
		<?php echo $form->passwordField($modelCustomer,'adult_password',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($modelCustomer,'adult_password'); ?>
	</div>

</div>
	
	<?php 

	$this->endWidget();//form
	
	$this->endWidget('zii.widgets.jui.CJuiDialog');
?>
