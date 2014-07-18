<?php
/**
* Soap client WsMonitor
*
* Autogenerated with the Yii extension wsdl2php.
*/

/**
* The soap client proxy class
*/
class WsMonitor 
 {
	public $soapClient;
	public $token;
	
	private static $classmap = array(

		);

	function __construct()
	{
		ini_set ('soap.wsdl_cache_enabled',0);
		$model = ExternalWsdl::model()->findByAttributes(array('description'=>'Monitor'));
		$url = $model->url;
		try {
			$this->soapClient = new SoapClient($url,array("classmap"=>self::$classmap,"trace" => true,"exception" => true));				
			$this->token = $this->login($model->username, $model->password);
		} catch (Exception $e) {
			$this->soapClient = null;
		}
	}


	function login($username,$password)
	{
		return $this->soapClient->login($username, $password);		
	}
	
	public function setHeartBeat($heartBeat)
	{
		$result = false;
		if(isset($this->soapClient))
		{
			$result = $this->soapClient->setHeartBeat($this->token, $heartBeat);
		}
		return $result;
	}
}


