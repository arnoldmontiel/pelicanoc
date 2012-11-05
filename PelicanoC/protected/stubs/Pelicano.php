<?php
/**
* Soap client Pelicano
*
* Autogenerated with the Yii extension wsdl2php.
*/

class InstallDataResponse
{
	public $Id_reseller; //integer;
	public $Id_device; //string;
}

class CustomerResponse
{
	public $Id; //integer;
	public $name; //string;
	public $last_name; //string;
	public $address; //string;
}

class CustomerRequest
{
	public $Id; //integer;
	public $Id_reseller; //integer;
	public $Id_device; //string;
	public $name; //string;
	public $last_name; //string;
	public $address; //string;
}

class LogResponse
{
	public $Id_log_customer; //integer;
}

class LogRequest extends SOAP2Array
{
	public $Id_customer; //integer;
	public $log_date; //date;
	public $username; //string;
	public $description; //string;
	public $Id_log_type; //integer;
	public $Id_log_customer; //integer;
}

class RippedResponse
{
	public $Id_device; //string;
	public $Id_my_movie_disc; //string;
}

class MyMovieSOAP
{
	function __construct()
	{
		$this->myMovieSerieHeader = new MyMovieSerieHeaderSOAP;
	}
	
	/**
	* Set model attributes
	* @param Nab $model
	*/
	public function setAttributes($model)
	{
		//set attributes
		$attributesArray = $model->attributes;
		while (($value = current($attributesArray)) !== false) {
			$this->setAttribute(key($attributesArray), $value);
			next($attributesArray);
		}
	}
	
	public function setAttribute($name,$value)
	{
		if(property_exists($this,$name))
			$this->$name=$value;
		else
			return false;
		return true;
	}
	
	public $Id; //string;
	public $type; //string;
	public $bar_code; //string;
	public $country; //string;
	public $local_title; //string;
	public $original_title; //string;
	public $sort_title; //string;
	public $aspect_ratio; //string;
	public $video_standard; //string;
	public $production_year; //string;
	public $release_date; //string;
	public $running_time; //string;
	public $description; //string;
	public $extra_features; //string;
	public $parental_rating_desc; //string;
	public $imdb; //string;
	public $rating; //string;
	public $data_changed; //string;
	public $covers_changed; //string;
	public $genre; //string;
	public $studio; //string;
	public $poster_original; //string;
	public $backdrop_original; //string;
	public $adult; //integer;
	public $Id_parental_control; //integer;
	public $is_serie; //integer;
	public $myMovieSerieHeader; //MyMovieSerieHeaderSOAP;
	public $Subtitle; //MyMovieSubtitleSOAP[];
	public $AudioTrack; //MyMovieAudioTrackSOAP[];
}

class MyMovieSubtitleSOAP
{
	/**
	* Set model attributes
	* @param Nab $model
	*/
	public function setAttributes($model)
	{
		//set attributes
		$attributesArray = $model->attributes;
		while (($value = current($attributesArray)) !== false) {
			$this->setAttribute(key($attributesArray), $value);
			next($attributesArray);
		}
	}
	
	public function setAttribute($name,$value)
	{
		if(property_exists($this,$name))
			$this->$name=$value;
		else
			return false;
		return true;
	}
	
	public $language; //string;
}

class MyMovieAudioTrackSOAP
{
	/**
	* Set model attributes
	* @param Nab $model
	*/
	public function setAttributes($model)
	{
		//set attributes
		$attributesArray = $model->attributes;
		while (($value = current($attributesArray)) !== false) {
			$this->setAttribute(key($attributesArray), $value);
			next($attributesArray);
		}
	}
	
	public function setAttribute($name,$value)
	{
		if(property_exists($this,$name))
			$this->$name=$value;
		else
			return false;
		return true;
	}
	
	public $language; //string;
	public $type; //string;
	public $chanel; //string;
}

class MyMovieSerieHeaderSOAP
{
	function __construct()
	{
		$this->myMovieSeason = new MyMovieSeasonSOAP;
	}
	
	/**
	* Set model attributes
	* @param Nab $model
	*/
	public function setAttributes($model)
	{
		//set attributes
		$attributesArray = $model->attributes;
		while (($value = current($attributesArray)) !== false) {
			$this->setAttribute(key($attributesArray), $value);
			next($attributesArray);
		}
	}
	
	public function setAttribute($name,$value)
	{
		if(property_exists($this,$name))
			$this->$name=$value;
		else
			return false;
		return true;
	}
	
	public $Id; //string;
	public $description; //string;
	public $poster_original;
	public $genre; //string;
	public $name; //string;
	public $sort_name; //string;
	public $rating; //string;
	public $original_network; //string;
	public $original_status; //string;
	public $myMovieSeason; //MyMovieSeasonSOAP;
}

class MyMovieSeasonSOAP
{
	/**
	* Set model attributes
	* @param Nab $model
	*/
	public function setAttributes($model)
	{
		//set attributes
		$attributesArray = $model->attributes;
		while (($value = current($attributesArray)) !== false) {
			$this->setAttribute(key($attributesArray), $value);
			next($attributesArray);
		}
	}
	
	public function setAttribute($name,$value)
	{
		if(property_exists($this,$name))
			$this->$name=$value;
		else
			return false;
		return true;
	}
	
	public $season_number; //integer;
	public $banner_original; //string;
	public $Episode; //MyMovieEpisodeSOAP[];
}

class MyMovieEpisodeSOAP
{
	/**
	* Set model attributes
	* @param Nab $model
	*/
	public function setAttributes($model)
	{
		//set attributes
		$attributesArray = $model->attributes;
		while (($value = current($attributesArray)) !== false) {
			$this->setAttribute(key($attributesArray), $value);
			next($attributesArray);
		}
	}
	
	public function setAttribute($name,$value)
	{
		if(property_exists($this,$name))
			$this->$name=$value;
		else
			return false;
		return true;
	}
	
	public $episode_number; //integer;
	public $description; //string;
	public $name; //string;
}

class MyMovieDiscSOAP
{
	/**
	* Set model attributes
	* @param Nab $model
	*/
	public function setAttributes($model)
	{
		//set attributes
		$attributesArray = $model->attributes;
		while (($value = current($attributesArray)) !== false) {
			$this->setAttribute(key($attributesArray), $value);
			next($attributesArray);
		}
	}
	
	public function setAttribute($name,$value)
	{
		if(property_exists($this,$name))
		$this->$name=$value;
		else
		return false;
		return true;
	}
	
	public $Id; //string;
	public $name; //string;
	public $Id_my_movie; //string;
	public $Id_my_movie_nzb; //string;
}

class RippedRequest extends SOAP2Array
{
	function __construct()
	{
		$this->myMovie = new MyMovieSOAP;
		$this->myMovieDisc = new MyMovieDiscSOAP;
	}
	
	public $myMovie; //MyMovieSOAP;
	public $myMovieDisc; //MyMovieDiscSOAP;
	public $ripped_date; //date;
	public $Id_device; //string;
}

class NzbResponse
{
	public $nzb; //NzbSOAP;
	public $myMovie; //MyMovieSOAP;
	public $myMovieDisc; //MyMovieDiscSOAP;
}

class MovieStateRequest extends SOAP2Array
{
	public $Id_device; //string;
	public $Id_nzb; //integer;
	public $Id_state; //integer;
	public $date; //integer;
}

class UserResponse
{
	public $username; //string;
	public $password; //string;
	public $email; //string;
	public $adult_section; //integer;
	public $deleted; //integer;
	public $birth_date; //date;
}

class UserStateRequest extends SOAP2Array
{
	public $username; //string;
	public $Id_customer; //integer;
	public $password; //string;
	public $email; //string;
	public $adult_section; //integer;
	public $deleted; //integer;
	public $birth_date; //date;
}

class SerieResponse
{
	public $Id; //integer;
	public $url; //string;
	public $file_name; //string;
	public $subt_url; //string;
	public $subt_file_name; //string;
	public $Id_resource_type; //integer;
	public $deleted; //integer;
	public $points; //integer;	
	public $ID; //string;
	public $Title; //string;
	public $Year; //string;
	public $Rated; //string;
	public $Released; //string;
	public $Genre; //string;
	public $Director; //string;
	public $Writer; //string;
	public $Actors; //string;
	public $Plot; //string;
	public $Poster; //string;
	public $Runtime; //string;
	public $Rating; //string;
	public $Votes; //string;
	public $Response; //string;
	public $Backdrop; //string;
	public $Season; //integer;
	public $Episode; //integer;
	public $Id_parent; //string;
	public $Deleted_serie; //integer;	
	public $arrSeason; //SeasonArray;
}
class SerieStateRequest extends SOAP2Array
{
	public $id_customer; //integer;
	public $id_serie_nzb; //integer;
	public $id_state; //integer;
	public $date; //integer;
	public $id_imdbdata_tv; //string;
}
class SeasonResponse extends SOAP2Array
{
	public $Id_imdbdata_tv; //string;
	public $season; //integer;
	public $episodes; //integer;
}
class TransactionResponse extends SOAP2Array
{
	public $Id; //integer;
	public $Id_customer; //integer;
	public $points; //integer;
	public $Id_transaction_type; //integer;
	public $description; //string;
}

/**
* The soap client proxy class
*/
class Pelicano 
 {
	public $soapClient;

	private static $classmap = array(
		'MovieResponse'=>'MovieResponse',
		'SerieResponse'=>'SerieResponse',
		'SeasonResponse'=>'SeasonResponse',
		'MovieStateRequest'=>'MovieStateRequest',
		'SerieStateRequest'=>'SerieStateRequest',
		'TransactionResponse'=>'TransactionResponse',
		'UserResponse'=>'UserResponse',
		'UserStateRequest'=>'UserStateRequest',
		'RippedResponse'=>'RippedResponse',
		'RippedRequest'=>'RippedRequest',
		'LogRequest'=>'LogRequest',
		'LogResponse'=>'LogResponse',

);

function __construct($url='/index.php?r=nzb/wsdl')
{
	ini_set ('soap.wsdl_cache_enabled',0);
	
	$url = Setting::getInstance()->host_name.Setting::getInstance()->host_path.$url;
	try {
		$this->soapClient = @new SoapClient($url,array("classmap"=>self::$classmap,"trace" => true,"exceptions" => true));		
	} catch (SoapFault $fault) {
		$var  = $fault;	
	} catch (Exception $e) {
		$var  = $e;
	}
}
function getInstallData($username, $password)
{
	$response = 0;
	if(isset($this->soapClient))
	{
		$response = $this->soapClient->getInstallData($username, $password);
	}
	return $response;
}
function getRipped($idDevice)
{
	$RippedResponseArray = array();
	if(isset($this->soapClient))
	{
		$RippedResponseArray = $this->soapClient->getRipped($idDevice);
	}
	return $RippedResponseArray;
}

function getNewUser($integer)
{
	$UserResponseArray = array();
	if(isset($this->soapClient))
	{
		$UserResponseArray = $this->soapClient->getNewUser($integer);
	}
	return $UserResponseArray;
}
function getNewNzbs($Id_device)
{
	$NzbResponseArray = array();
	if(isset($this->soapClient))
	{
		$NzbResponseArray = $this->soapClient->getNewNzbs($Id_device);
	}
	return $NzbResponseArray;		
}
function getNewSeries($Id_device)
{
	$SerieResponseArray = array();
	if(isset($this->soapClient))
	{
		$SerieResponseArray = $this->soapClient->getNewSeries($Id_device);
	}
	return $SerieResponseArray;
}
function updateCustomer($CustomerRequest)
{
	$result = false;
	if(isset($this->soapClient))
	{
		$result = $this->soapClient->updateCustomer($CustomerRequest);
	}
	return $result;
}
function useCustomer($code, $Id_device)
{
	$result = false;
	if(isset($this->soapClient))
	{
		$result = $this->soapClient->useCustomer($code, $Id_device);
	}
	return $result;
}
function setCustomer($CustomerRequest)
{
	$result = false;
	if(isset($this->soapClient))
	{
		$result = $this->soapClient->setCustomer($CustomerRequest);
	}
	return $result;
}
function setLog($LogRequestArray)
{
	$result = false;
	if(isset($this->soapClient))
	{
		$r = array();
		foreach ($LogRequestArray as $item)
		{
			$r[]=$item->toArray();
		}
		$result = $this->soapClient->setLog($r);
	}
	return $result;
}
function setRipped($RippedRequestArray)
{
	$result = false;
	if(isset($this->soapClient))
	{
		$r = array();
		foreach ($RippedRequestArray as $item)
		{
			$r[]=$item->toArray();
		}
		$result = $this->soapClient->setRipped($r);
	}
	return $result;
}
function setUserState($UserStateRequestArray)
{
	$result = false;
	if(isset($this->soapClient))
	{
		$r = array();
		foreach ($UserStateRequestArray as $item)
		{
			$r[]=$item->toArray();
		}
		$result = $this->soapClient->setUserState($r);
	}
	return $result;
}
function setMovieState($MovieStateRequestArray)
{
	$result = false;
	if(isset($this->soapClient))
	{
		$r = array();
		foreach ($MovieStateRequestArray as $item)
		{
			$r[]=$item->toArray();
		}
		$result = $this->soapClient->setMovieState($r);
	}
	return $result;
}

function setSerieState($SerieStateRequestArray)
{
	$result = false;
	if(isset($this->soapClient))
	{
		$r= array();
		foreach ($SerieStateRequestArray as $item)
		{
			$r[]=$item->toArray();
		}
		$result = $this->soapClient->setSerieState($r);
	}
	return $result;
	
}

function getPoints($Id_customer, $Id_transaction)
{
	$result = array();
	if(isset($this->soapClient))
	{
		
		$result = $this->soapClient->getPoints($Id_customer, $Id_transaction);
	}
	return $result;
}
}


