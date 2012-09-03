
<h1 style="color:white">Customer</h1>

<?php 

if($dataProvider->itemCount>0)
{

	$this->widget('zii.widgets.CListView', array(
		'dataProvider'=>$dataProvider,
		'itemView'=>'_view',
		'summaryText'=>'',
	)); 
}
else
{
	echo CHtml::link('Create Customer',array('/customer/create'));
}
?>
