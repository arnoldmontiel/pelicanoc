<?php
class NzbCommand extends CConsoleCommand  {
	/*
	 * @param file_name 
	 * @return 0: It was an error, 1:It was success
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
