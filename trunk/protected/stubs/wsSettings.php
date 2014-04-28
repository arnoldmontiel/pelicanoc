<?php
/**
* Soap client wsSettings
*
* Autogenerated with the Yii extension wsdl2php.
*/

class UserSOAP
{
	public $username; //string;
	public $password; //string;
	public $email; //string;
	public $adult_section; //integer;
	public $deleted; //integer;
	public $birth_date; //date;
}

class CustomerSettingsResponse
{
	public $Id_customer; //integer;
	public $Id_reseller; //integer;
	public $Id_device; //string;
	public $name; //string;
	public $last_name; //string;
	public $address; //string;
	public $Users; //UserSOAP[];
}

class ClientSettingsRequest extends SOAP2Array
{
	public $Id_device; //string;
	public $ip_v4; //string;
	public $port_v4; //integer;
	public $ip_v6; //string;
	public $port_v6; //integer;
	public $is_nas_alive; //integer;
	public $disc_used_space; //string;
	public $disc_total_space; //string;
}

class ServerAnydvdUpdateResponse
{
	public $version; //string;
	public $file_name; //string;
	public $download_link; //string;
}

class ServerSettingsRipperResponse
{
	public $drive_letter; //string;
	public $temp_folder_ripping; //string;
	public $final_folder_ripping; //string;
	public $time_from_reboot; //time;
	public $time_to_reboot; //time;
	public $mymovies_username; //string;
	public $mymovies_password; //string;
	
}

/**
* The soap client proxy class
*/
class wsSettings 
 {
	public $soapClient;

	private static $classmap = array(
		'ClientSettingsRequest'=>'ClientSettingsRequest',
		'ServerAnydvdUpdateResponse'=>'ServerAnydvdUpdateResponse',
		'CustomerSettingsResponse'=>'CustomerSettingsResponse',
	);

function __construct($url='http://localhost/workspace/PelicanoS')
{
	ini_set ('soap.wsdl_cache_enabled',0);
	
	$url = Setting::getInstance()->host_name.Setting::getInstance()->host_path."/index.php?r=WSSettings/wsdl";
	$this->soapClient = new SoapClient($url,array("classmap"=>self::$classmap,"trace" => true,"exceptions" => true));
}


	function setClientSettings($ClientSettingsRequest)
	{
		$boolean = $this->soapClient->setClientSettings($ClientSettingsRequest);
		return $boolean;
	}
	function setAnydvdVersionDownloaded($idDevice,$version)
	{
		return $this->soapClient->setAnydvdVersionDownloaded($idDevice,$version);
	}
	public function setAnydvdVersionInstalled($idDevice,$version)
	{
		return $this->soapClient->setAnydvdVersionInstalled($idDevice,$version);
		
	}
	function checkForUpdate($idDevice)
	{
		$ServerAnydvdUpdateResponse = $this->soapClient->checkForUpdate($idDevice);
		return $ServerAnydvdUpdateResponse;
	}
 	function getDeviceTunnelPort($idDevice)
	{
		$TunnelingPortResponse = $this->soapClient->getDeviceTunnelPort($idDevice);
		return $TunnelingPortResponse;
	}	
  	function ackDeviceTunnelPort($idDevice, $ports)
	{
		$TunnelingPortResponse = $this->soapClient->ackDeviceTunnelPort($idDevice, $ports);
	}		
	
	function getRipperSettings($idDevice)
	{
		$serverSettingsRipperResponse = $this->soapClient->getRipperSettings($idDevice);
		return $serverSettingsRipperResponse;
	}
	function getCustomerSettings($idDevice)
	{
		$result = false;
		if(isset($this->soapClient))
		{
			$result = $this->soapClient->getCustomerSettings($idDevice);
		}
		return $result;
	}
	function ackCustomerSettings($idDevice)
	{
		$result = false;
		if(isset($this->soapClient))
		{
			$result = $this->soapClient->ackCustomerSettings($idDevice);
		}
		return $result;
	}
}


