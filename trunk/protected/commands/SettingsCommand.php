<?php
class NzbCommand extends CConsoleCommand  {
	/*
	 * send heart beat to PelicanoM
	 */
	
	function actionHeartBeat() 
	{
		$settings = Setting::getInstance();
		
		PelicanoHelper::setHeartBeat(2);
		PelicanoHelper::sendExternalIPAddressToServer();
		PelicanoHelper::getCustomerSettings();
		PelicanoHelper::updateNzbDataFromServer();
		return true;
		
	}
}
