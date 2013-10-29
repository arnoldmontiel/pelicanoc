<?php 
	if(count($modelCurrentESs)>0)
	{
		foreach($modelCurrentESs as $modelCurrentES)
		{
			echo CHtml::imageButton('img/usb_black.png',array('id'=>$modelCurrentES->Id, 'class'=>'usb-button-scan'));
		}
	}
	else 
	{
		echo CHtml::openTag('p');
			echo "No hay unidades externas conectadas..";
		echo CHtml::closeTag('p');
	}
?>		
