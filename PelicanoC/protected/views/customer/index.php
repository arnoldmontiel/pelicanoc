
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
	$setting = Setting::getInstance();
	
	if(isset($setting->Id_reseller))
	{
		echo CHtml::link('Create Customer',array('/customer/create'));
	}
	else
	{
		echo '<p class="note">To create a customer you must first START INSTALLATION.</p>';
		echo '<br>';
		echo CHtml::link('Start Installation',array('/setting/startInstallation'));
	}
}
?>
