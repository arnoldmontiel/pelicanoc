<?php
/**
* Soap client Pelicano
*
* Autogenerated with the Yii extension wsdl2php.
*/

class SOAP2Arrya
{
	public function toArray()
	{
		return json_decode(json_encode($this), true);
	}
}

class RippedResponse
{
	public $Id_customer; //integer;
	public $Id_my_movie; //string;
}

class RippedRequest extends SOAP2Arrya
{
	public $Id_customer; //integer;
	public $Id_my_movie; //string;
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
	public $poster; //string;
	public $backdrop; //string;
}

class MovieResponse
{
	public $Id; //integer;
	public $url; //string;
	public $file_name; //string;
	public $subt_url; //string;
	public $subt_file_name; //string;
	public $Id_resource_type; //string;//integer;
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
}

class MovieStateRequest extends SOAP2Arrya
{
	public $id_customer; //integer;
	public $id_movie; //integer;
	public $id_state; //integer;
	public $date; //integer;
}

class UserResponse
{
	public $username; //string;
	public $password; //string;
	public $email; //string;
	public $parental_control; //integer;
	public $deleted; //integer;
}

class UserStateRequest extends SOAP2Arrya
{
	public $username; //string;
	public $password; //string;
	public $email; //string;
	public $parental_control; //integer;
	public $deleted; //integer;
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
class SerieStateRequest extends SOAP2Arrya
{
	public $id_customer; //integer;
	public $id_serie_nzb; //integer;
	public $id_state; //integer;
	public $date; //integer;
	public $id_imdbdata_tv; //string;
}
class SeasonResponse extends SOAP2Arrya
{
	public $Id_imdbdata_tv; //string;
	public $season; //integer;
	public $episodes; //integer;
}
class TransactionResponse extends SOAP2Arrya
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

function getRipped($integer)
{
	$RippedResponseArray = array();
	if(isset($this->soapClient))
	{
		$RippedResponseArray = $this->soapClient->getRipped($integer);
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
function getNewMovies($integer)
{
	$MovieResponseArray = array();
	if(isset($this->soapClient))
	{
		$MovieResponseArray = $this->soapClient->getNewMovies($integer);
	}
	return $MovieResponseArray;		
}
function getNewSeries($integer)
{
	$SerieResponseArray = array();
	if(isset($this->soapClient))
	{
		$SerieResponseArray = $this->soapClient->getNewSeries($integer);
	}
	return $SerieResponseArray;
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


