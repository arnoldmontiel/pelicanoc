<?php

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
	 * @return boolean result
	 * @soap
	 */
	public function updateAnydvd($version,$file_name,$download_link)
	{
		try {
			$anydvdVersion = new AnydvdVersion();
			$anydvdVersion->version = $version;
			$anydvdVersion->file_name = $file_name;
			$anydvdVersion->download_link = $download_link;
			$settings = Setting::getInstance();
			$url = $settings->host_name.$settings->host_path; 
			$anydvdVersion->save();
			return true; 
		} catch (Exception $e) {
			return false;
		}
		
		return false;
	}
	
}
