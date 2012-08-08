<?php
/**
* Soap client MyMovies
*
* Autogenerated with the Yii extension wsdl2php.
*/



class LoadMovieById
{
public $Handshake; //string;
public $UserName; //string;
public $Password; //string;
public $Reference; //string;
public $TitleId; //string;
public $PrimaryLanguage; //string;
public $Client; //string;
public $Version; //string;
public $MaxTrailerBitrate; //int;
public $Locale; //int;
}

class LoadMovieByIdResponse
{
public $LoadMovieByIdResult; //LoadMovieByIdResult;
}

class LoadMovieByIdResult
{
public $any; //string;
}


/**
* The soap client proxy class
*/
class MyMovies 
 {
	public $soapClient;

	private static $classmap = array(
		'LoadMovieById'=>'LoadMovieById',
		'LoadMovieByIdResponse'=>'LoadMovieByIdResponse',
		'LoadMovieByIdResult'=>'LoadMovieByIdResult',

);

function __construct($url='https://api.mymovies.dk/default.asmx?WSDL')
{
	ini_set ('soap.wsdl_cache_enabled',0);
	$this->soapClient = new SoapClient($url,array("classmap"=>self::$classmap,"trace" => true,"exceptions" => false));
}


function LoadMovieById($LoadMovieById)
{
	$model = new LoadMovieById();
	$model->UserName = "arnoldMontiel";
	$model->Password = "Arnold";
	$model->MaxTrailerBitrate = 2000;
	$model->TitleId = $LoadMovieById;
	$model->Locale = 0;
	
	$LoadMovieByIdResponse = $this->soapClient->LoadMovieById($model);
	
	$idImdb = "";
	if(isset($LoadMovieByIdResponse))
		$idImdb = (string)simplexml_load_string($LoadMovieByIdResponse->LoadMovieByIdResult->any)->Title->IMDB;
	 
	return $idImdb;
}

}


