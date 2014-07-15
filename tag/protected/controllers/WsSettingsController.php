<?php
require_once(dirname(__FILE__) . "/../stubs/wsSettings.php");

class WsSettingsController extends Controller
{

	public function actions()
	{
		return array(
		            'wsdl'=>array(
		                'class'=>'CWebServiceAction',
		),
		);
	}

	/**
	 * Returns if was successful
	 * @param string version
	 * @param string file_name
	 * @param string download_link
	 * @return boolean response
	 * @soap
	 */
	public function updateAnydvd($version,$file_name,$download_link)
	{
		RipperHelper::updateAnydvd($version, $file_name, $download_link);
	}

	/**
	 * Returns an AnydvdUpdateResponse with updates information
	 * @return AnydvdUpdateResponse response
	 * @soap
	 */
	public function checkForAnydvdUpdates()
	{
		$settings = Setting::getInstance();
				
		$result = new AnydvdUpdateResponse() ;
		$result->version = '0';
		$result->action = 0; 
		$criteria = new CDbCriteria();
		$criteria->order = 'Id DESC'; 
		$anydvdVersion = AnydvdVersion::model()->findByAttributes(array('downloaded'=>1,'installed'=>0),$criteria);
		if(isset($anydvdVersion))
		{
			$result->action = 1; 
			$result->version = $anydvdVersion->version;
			$result->file_name = $anydvdVersion->file_name;
			$result->url = Yii::app()->request->getHostInfo().'/'.Yii::app()->baseUrl.'/'.$settings->path_anydvd_download.$anydvdVersion->file_name;
		}
		return $result;
	}
	/**
	* Set version just installed
	* @param string version
	* @return bool response
	* @soap
	*/
	public function setInstalledAnydvdVersion($version)
	{	
		$settings = Setting::getInstance();
		$settings->anydvd_version_installed = $version;
		$anydvdVersion = AnydvdVersion::model()->findByAttributes(array('version'=>$version));
		if(isset($anydvdVersion))
		{
			$settings->save();
			$anydvdVersion->installed = true;
			$anydvdVersion->save();
			$serverSettings = new wsSettings;
			$serverSettings->setAnydvdVersionInstalled($settings->Id_device, $version);
		}		
		return true;
	}
	/**
	* returns all configuration to the ripper
	* @return SettingsRipperResponse response
	* @soap
	*/
	
	public function getSettings()
	{
		
		$response = new SettingsRipperResponse();
		$settingsRipper = SettingsRipper::model()->findAll();
		if(isset($settingsRipper[0]))
		{
			$response->drive_letter = $settingsRipper[0]->drive_letter; 
			$response->final_folder_ripping = $settingsRipper[0]->final_folder_ripping; 
			$response->temp_folder_ripping = $settingsRipper[0]->temp_folder_ripping; 
			$response->time_from_reboot = $settingsRipper[0]->time_from_reboot; 
			$response->time_to_reboot = $settingsRipper[0]->time_to_reboot; 
			$response->mymovies_password = $settingsRipper[0]->mymovies_password; 
			$response->mymovies_username = $settingsRipper[0]->mymovies_username; 
			$response->id_device = Setting::getInstance()->Id_device; 
		}
		return $response;
	}
	
	/**
	* It gives a heartbeat to the Pelicano, just to get it alive.
	* This function should call PelicanoM to inform that ripper is alive and not PelicanoC. 
	* @return boolean response
	* @soap
	*/
	
	public function HeartBeat()
	{
// 		PelicanoHelper::sendExternalIPAddressToServer();		
// 		PelicanoHelper::getCustomerSettings();
// 		PelicanoHelper::updateNzbDataFromServer();
// 
		return true;
	}
}
