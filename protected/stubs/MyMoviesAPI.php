<?php
/**
* Soap client MyMoviesAPI
*
* Autogenerated with the Yii extension wsdl2php.
*/

class MyMovieBase
{
	public $UserName; //string;
	public $Password; //string;

	function __construct()
	{
		$settings = Setting::getInstance();
		$this->UserName = $settings->mymovies_username;
		$this->Password =  $settings->mymovies_password;
	}
}

class LoadEpisodeBySeriesIDRequest extends MyMovieBase
{
	public $HandShake; //string;
	public $Reference; //string;
	public $SerieGuid; //string;
	public $Seasonnumber; //int;
	public $Episodenumber; //int;
	public $LanguageCode; //string
	public $Country; //string;
	public $Locale; //int;
}

class LoadEpisodeBySeriesIDResponse
{
	public $LoadEpisodeBySeriesIDResult; //LoadEpisodeBySeriesIDResult;
}

class LoadEpisodeBySeriesIDResult
{
	public $any; //string;
}

class LoadSeasonBannersRequest extends MyMovieBase
{
	public $HandShake; //string;
	public $Reference; //string;
	public $Id; //string;
	public $Seasonnumber; //int;
	public $Locale; //int;
}

class LoadSeasonBannersResponse
{
	public $LoadSeasonBannersResult; //LoadSeasonBannersResult;
}

class LoadSeasonBannersResult
{
	public $any; //string;
}

class LoadSeriesRequest extends MyMovieBase
{
	public $Handshake; //string;
	public $Reference; //string;
	public $Id; //string;
	public $LanguageCode; //string;
	public $Country; //string;
	public $Locale; //int;
}

class LoadSeriesResponse
{
	public $LoadSeriesResult; //LoadSeriesResult;
}

class LoadSeriesResult
{
	public $any; //string;
}


class SearchDiscTitleByIMDBIdRequest extends MyMovieBase
{
	public $Handshake; //string;
	public $Reference; //string;
	public $IMDBId; //string;
	public $Country; //string;
	public $Type; //string;
	public $IncludeEnglish; //boolean;
	public $IncludeAdult; //boolean;
	public $Locale; //int;
}

class SearchDiscTitleByIMDBIdResponse
{
	public $SearchDiscTitleByIMDBIdResult; //SearchDiscTitleByIMDBIdResult;
}

class SearchDiscTitleByIMDBIdResult
{
	public $any; //string;
}

class SearchDiscTitleByDiscIdsRequest extends MyMovieBase
{
	public $Handshake; //string;
	public $Reference; //string;
	public $DiscId; //string;
	public $OnlineId; //string;
	public $Country; //string;
	public $IncludeEnglish; //boolean;
	public $IncludeAdult; //boolean;
	public $Locale; //int;
}

class SearchDiscTitleByDiscIdsResponse
{
	public $SearchDiscTitleByDiscIdsResult; //SearchDiscTitleByDiscIdsResult;
}

class SearchDiscTitleByDiscIdsResult
{
	public $any; //string;
}

class LoadDiscTitleByIdRequest extends MyMovieBase
{
	public $Handshake; //string;
	public $Reference; //string;
	public $TitleId; //string;
	public $Client; //string;
	public $Version; //string;
	public $Locale; //int;
}
	
class LoadDiscTitleByIdResponse
{
	public $LoadDiscTitleByIdResult; //LoadDiscTitleByIdResult;
}
	
class LoadDiscTitleByIdResult
{
	public $any; //string;
}
	
	
	/**
	* The soap client proxy class
	*/
	class MyMoviesAPI 
	 {
		public $soapClient;
	
		private static $classmap = array(
			'LoadDiscTitleByIdRequest'=>'LoadDiscTitleByIdRequest',
			'LoadDiscTitleByIdResponse'=>'LoadDiscTitleByIdResponse',
			'LoadDiscTitleByIdResult'=>'LoadDiscTitleByIdResult',
	
	); 
	
	function __construct($url='https://api.mymovies.dk/default.asmx?WSDL')
	{
		ini_set ('soap.wsdl_cache_enabled',0);
		$this->soapClient = new SoapClient($url,array("classmap"=>self::$classmap,"trace" => true,"exceptions" => false));
	}
	
	function LoadEpisodeBySeriesID($idSerie, $seasonNumber, $episodeNumber)
	{
		$modelRequest = new LoadEpisodeBySeriesIDRequest();
		$modelRequest->SerieGuid = $idSerie;
		$modelRequest->Seasonnumber = $seasonNumber;
		$modelRequest->Episodenumber = $episodeNumber;
		$modelRequest->LanguageCode = '';
		$modelRequest->Country = '';
		$modelRequest->Locale = 0;
		
		$response = $this->soapClient->LoadEpisodeBySeriesID($modelRequest);

		if(isset($response))
			return simplexml_load_string($response->LoadEpisodeBySeriesIDResult->any);
		
		return null;
	}
	
	function LoadSeasonBanners($idSerie, $seasonNumber)
	{
		$modelRequest = new LoadSeasonBannersRequest();
		$modelRequest->Id = $idSerie;
		$modelRequest->Seasonnumber = $seasonNumber;
		$modelRequest->Locale = 0;
		
		$response = $this->soapClient->LoadSeasonBanners($modelRequest);
		
		if(isset($response))
			return simplexml_load_string($response->LoadSeasonBannersResult->any);
		
		return null;
	}
	
	
	function LoadSeries($idSerie)
	{
		$modelRequest = new LoadSeriesRequest();
		$modelRequest->Id = $idSerie;
		$modelRequest->Locale = 0;
	
		$modelRequest->LanguageCode = '';
		$modelRequest->Country = '';
		
		$response = $this->soapClient->LoadSeries($modelRequest);
	
		if(isset($response))
			return simplexml_load_string($response->LoadSeriesResult->any);
			
		return null;
	}
	
	
	function LoadDiscTitleById($myMovieId)
	{
		$modelRequest = new LoadDiscTitleByIdRequest();
		$modelRequest->TitleId = $myMovieId;
		$modelRequest->Locale = 0;
		
		
		$response = $this->soapClient->LoadDiscTitleById($modelRequest);
		
		if(isset($response))
			return simplexml_load_string($response->LoadDiscTitleByIdResult->any);	
	
		return null;
	}
	
	function SearchDiscTitleByDiscIds($idDisc = '', $country = '')
	{
	
		$modelRequest = new SearchDiscTitleByDiscIdsRequest();
		$modelRequest->DiscId = $idDisc;
		$modelRequest->IncludeEnglish = true;
		$modelRequest->IncludeAdult = true;
		$modelRequest->Country = $country;
		$modelRequest->Locale = 0;
	
		$response = $this->soapClient->SearchDiscTitleByDiscIds($modelRequest);
	
		if(isset($response))
			return simplexml_load_string($response->SearchDiscTitleByDiscIdsResult->any);
	
		return null;
	
	}

	function SearchDiscTitleByIMDBId($idImdb = '', $country = '')
	{
		$modelRequest = new SearchDiscTitleByIMDBIdRequest();
		$modelRequest->IMDBId = $idImdb;
		$modelRequest->IncludeEnglish = true;
		$modelRequest->IncludeAdult = true;
		$modelRequest->Country = $country;
		$modelRequest->Locale = 0;
		
		$response = $this->soapClient->SearchDiscTitleByIMDBId($modelRequest);
		
		if(isset($response))
			return simplexml_load_string($response->SearchDiscTitleByIMDBIdResult->any);
		
		return null;
	}
}


