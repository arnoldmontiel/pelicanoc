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

		PelicanoHelper::sincronizeWithServer();
		try {
			PelicanoHelper::setHeartBeat(2);//to PelicanoM					
		} catch (Exception $e) {
		}		
		PelicanoHelper::sendExternalIPAddressToServer();
		PelicanoHelper::getCustomerSettings();
		PelicanoHelper::updateNzbDataFromServer();
		return true;
		
	}
	function actionOpenConnections()
	{
	
		RipperHelper::setTunnelingPorts();
		return true;
	
	}
	
}
