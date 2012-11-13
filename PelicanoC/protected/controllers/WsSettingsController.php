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
		$_COMMAND_NAME = "downloadAnydvdUpdate";
		
		$modelCommandStatus = CommandStatus::model()->findByAttributes(array('command_name'=>$_COMMAND_NAME));
		
		$settings = Setting::getInstance();
		if($version=="" || $settings->anydvd_version_installed == $version)
		{
			return false;
		}
		
		$anydvdVersion = AnydvdVersion::model()->findByAttributes(array('version'=>$version));
		if(!isset($anydvdVersion))
		{
			$anydvdVersion = new AnydvdVersion();
			$anydvdVersion->downloaded = false;
		}
		
		if(!$anydvdVersion->downloaded && isset($modelCommandStatus))
		{
			if(!$modelCommandStatus->busy)
			{
				$modelCommandStatus->setBusy(true);				
				try {
					if($anydvdVersion->getIsNewRecord())
					{
						$anydvdVersion->version = $version;
						$anydvdVersion->file_name = $file_name;
						$anydvdVersion->download_link = $download_link;
						$anydvdVersion->save();						
					}
					$sys = strtoupper(PHP_OS);
					if(substr($sys,0,3) == "WIN")
					{
						$WshShell = new COM('WScript.Shell');
						$oExec = $WshShell->Run(dirname(__FILE__).'/../commands/shell/updateAnydvd.bat', 0, false);
					}
					else
					{
						exec(dirname(__FILE__).'/../commands/shell/updateAnydvd >/dev/null&');
					}
		
				} catch (Exception $e) {
					$modelCommandStatus->setBusy(false);
				}
			}
		}
		
		return true;
	}

	/**
	 * Returns an AnydvdUpdateResponse with updates information
	 * @return AnydvdUpdateResponse response
	 * @soap
	 */
	public function checkForAnydvdUpdates()
	{
		$settings = Setting::getInstance();
		
		$response = new ServerAnydvdUpdateResponse();
		$wsSettings = new wsSettings();
		$response = $wsSettings->checkForUpdate($settings->Id_device);		
 		$this->updateAnydvd($response->version, $response->file_name, $response->download_link);
		
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
		RipperHelper::updateRipperSettings();
		
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
		}
		return $response;
	}
	
	/**
	* It gives a heartbeat to the Pelicano, just to get it alive.
	* @return boolean response
	* @soap
	*/
	
	public function HeartBeat()
	{
		PelicanoHelper::sendExternalIPAddressToServer();		
		PelicanoHelper::getCustomerSettings();
		return true;
	}
}
