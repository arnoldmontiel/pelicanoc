<?php
class SettingsCommand extends CConsoleCommand  {
	/*
	 * send heart beat to PelicanoM
	 */
	
	function actionHeartBeat() 
	{
		$settings = Setting::getInstance();

		RipperHelper::updateRipperSettings();		
		RipperHelper::checkForAnyDvdUpdate();
		RipperHelper::sincronizeWithServer();
		
		PelicanoHelper::setHeartBeat(2);//to PelicanoM
		PelicanoHelper::sendExternalIPAddressToServer();
		PelicanoHelper::getCustomerSettings();
		PelicanoHelper::updateNzbDataFromServer();
		return true;
		
	}
}
