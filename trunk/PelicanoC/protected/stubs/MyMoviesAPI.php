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
		$this->UserName = "pablopedraza";
		$this->Password = "pablo";
	}
}

class LoadSeries extends MyMovieBase
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

class LoadDiscTitleById extends MyMovieBase
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
			'LoadDiscTitleById'=>'LoadDiscTitleById',
			'LoadDiscTitleByIdResponse'=>'LoadDiscTitleByIdResponse',
			'LoadDiscTitleByIdResult'=>'LoadDiscTitleByIdResult',
	
	);
	
	function __construct($url='https://api.mymovies.dk/default.asmx?WSDL')
	{
		ini_set ('soap.wsdl_cache_enabled',0);
		$this->soapClient = new SoapClient($url,array("classmap"=>self::$classmap,"trace" => true,"exceptions" => false));
	}
	
	function LoadSeries($serieId)
	{
		$model = new LoadSeries();
		$model->Id = $serieId;
		$model->Locale = 0;
	
		$model->LanguageCode = '';
		$model->Country = '';
		
		$LoadSeriesResponse = $this->soapClient->LoadSeries($model);
	
		if(isset($LoadSeriesResponse))
		{
			return $this->saveSerieHeader(simplexml_load_string($LoadSeriesResponse->LoadSeriesResult->any));
		}
			
		return null;
	}
	
	private function saveSerieHeader($data)
	{
		if(!empty($data) && (string)$data['status'] == 'ok')
		{
			if(!empty($data->Serie))
				$data = $data->Serie;
			else
				return null;
			
			$modelMyMovieSerieHeaderDB = MyMovieSerieHeader::model()->findByPk((string)$data['Id']);
				
			if(!isset($modelMyMovieSerieHeaderDB))
			{
				$modelMyMovieSerieHeader = new MyMovieSerieHeader();
				$modelMyMovieSerieHeader->Id = (string)$data['Id'];
				$modelMyMovieSerieHeader->original_network = (string)$data['OriginalNetwork'];
				$modelMyMovieSerieHeader->original_status = (string)$data['OriginalStatus'];
				$modelMyMovieSerieHeader->rating = (string)$data['Rating'];
				$modelMyMovieSerieHeader->description = (string)$data->EnglishPart['Description'];
				$modelMyMovieSerieHeader->name = (string)$data->EnglishPart['Name'];
				$modelMyMovieSerieHeader->sort_name = (string)$data->EnglishPart['SortName'];
				$modelMyMovieSerieHeader->genre = $this->getSeasonGenre($data);
				
				//Poster
				$modelMyMovieSerieHeader->poster_original = $this->getPoster($data);
				
				$validator = new CUrlValidator();
				$setting = Setting::getInstance();
				
				if($modelMyMovieSerieHeader->poster_original!='' && $validator->validateValue($modelMyMovieSerieHeader->poster_original))
				{
					try {
						$content = @file_get_contents($modelMyMovieSerieHeader->poster_original);
						if ($content !== false) {
							$file = fopen($setting->path_images."/".$modelMyMovieSerieHeader->Id.".jpg", 'w');
							fwrite($file,$content);
							fclose($file);
							$modelMyMovieSerieHeader->poster = $modelMyMovieSerieHeader->Id.".jpg";
						} else {
							// an error happened
						}
					} catch (Exception $e) {
						throw $e;
						// an error happened
					}
				}
				else
				{
					$modelMyMovieSerieHeader->poster = 'no_poster.jpg';
				}
				
				$modelMyMovieSerieHeader->save();
			}
			return (string)$data['Id'];
		}
		return null;
	}
	
	function LoadDiscTitleById($myMovieId)
	{
		$model = new LoadDiscTitleById();
		$model->TitleId = $myMovieId;
		$model->Locale = 0;
		
		$LoadDiscTitleByIdResponse = $this->soapClient->LoadDiscTitleById($model);
		
		$idImdb = "";
		if(isset($LoadDiscTitleByIdResponse))
		{
			$idImdb = $this->saveMyMovie(simplexml_load_string($LoadDiscTitleByIdResponse->LoadDiscTitleByIdResult->any));
		}	
		 
		return $idImdb;
	}

	private function saveMyMovie($data)
	{
		$idImdb = "";
		if(!empty($data) && (string)$data['status'] == 'ok')
		{
			if(!empty($data->Title))
				$data = $data->Title;
			else
				return $idImdb;
			
			$modelMyMovieDB = MyMovie::model()->findByPk((string)$data->ID);
			
			if(!isset($modelMyMovieDB))
			{
				$modelMyMovie = new MyMovie();
				
				$modelMyMovie->Id = (string)$data->ID;
				$modelMyMovie->type = (string)$data->Type;
				$modelMyMovie->media_type = (string)$data->MediaType;
				$modelMyMovie->bar_code = (string)$data->Barcode;
				$modelMyMovie->country = (string)$data->Country;
				$modelMyMovie->local_title = (string)$data->LocalTitle;
				$modelMyMovie->original_title = (string)$data->OriginalTitle;
				$modelMyMovie->sort_title = (string)$data->SortTitle;
				$modelMyMovie->aspect_ratio = (string)$data->AspectRatio;
				$modelMyMovie->video_standard = (string)$data->VideoStandard;
				$modelMyMovie->production_year = (string)$data->ProductionYear;
				$modelMyMovie->release_date = (string)$data->ReleaseDate;
				$modelMyMovie->running_time = (string)$data->RunningTime;
				$modelMyMovie->description = (string)$data->Description;
				$modelMyMovie->extra_features = (string)$data->ExtraFeatures;
				
				$modelMyMovie->parental_rating_desc = (!empty($data->ParentalRating)?(string)$data->ParentalRating->Description:"");
				
				$modelMyMovie->Id_parental_control = $this->getParentalControlId($data);
				
				$modelMyMovie->adult = $this->getAdult($data);
				
				$modelMyMovie->imdb = (string)$data->IMDB;
				$modelMyMovie->rating = (string)$data->Rating;
				$modelMyMovie->data_changed = (string)$data->DataChanged;
				$modelMyMovie->covers_changed = (string)$data->CoversChanged;
				
				//Obtengo la lista de los generos
				$modelMyMovie->genre = implode(", ",$this->xmlToArray($data->Genres));
				
				//Obtengo la lista de los estudios
				$modelMyMovie->studio =  implode(", ",$this->xmlToArray($data->Studios));
		
				
				//Poster
				$modelMyMovie->poster_original = $this->getPoster($data->MovieData);
				
				$validator = new CUrlValidator();
				$setting = Setting::getInstance();
				
				if($modelMyMovie->poster_original!='' && $validator->validateValue($modelMyMovie->poster_original))
				{
					try {
						$content = @file_get_contents($modelMyMovie->poster_original);
						if ($content !== false) {
							$file = fopen($setting->path_images."/".$modelMyMovie->Id.".jpg", 'w');
							fwrite($file,$content);
							fclose($file);
							$modelMyMovie->poster = $modelMyMovie->Id.".jpg";
						} else {
							// an error happened
						}
					} catch (Exception $e) {
						throw $e;
						// an error happened
					}
				}
				else
				{
					$modelMyMovie->poster = 'no_poster.jpg';
				}
				
				//Backdrop
				$modelMyMovie->backdrop_original = $this->getBackdrop($data->MovieData);
				if($modelMyMovie->backdrop_original!='' && $validator->validateValue($modelMyMovie->backdrop_original))
				{
					try {
						$content = @file_get_contents($modelMyMovie->backdrop_original);
						if ($content !== false) {
							$file = fopen($setting->path_images."/".$modelMyMovie->Id."_bd.jpg", 'w');
							fwrite($file,$content);
							fclose($file);
							$modelMyMovie->backdrop = $modelMyMovie->Id."_bd.jpg";
						} else {
							// an error happened
						}
					} catch (Exception $e) {
						throw $e;
						// an error happened
					}
				}
				
				//check SerieID
				if(!empty($data->TVSeriesID))
					$modelMyMovie->Id_my_movie_serie_header = $this->LoadSeries((string)$data->TVSeriesID);
				
				if($modelMyMovie->save())
				{
					$this->saveAudioTrack($data);
					$this->saveSubtitle($data);
				}
			}
			$idImdb = (string)$data->IMDB;
		}
		return $idImdb;
	}
	
	private function xmlToArray($xml)
	{
		$xmlArr = array();
		$index = 0;
		foreach($xml->children() as $item)
		{
			$xmlArr[$index] = (string)$item;
			$index ++;
		}
		return $xmlArr;
	}

	private function getSeasonGenre($xml)
	{
		if(!empty($xml->Genres))
		{
			$xmlArr = array();
			$index = 0;
			foreach($xml->Genres->children() as $item)
			{
				$xmlArr[$index] = (string)$item['Name'];
				$index ++;
			}
			if(count($xmlArr) > 0 )
				return implode(',',$xmlArr);
		}
		return "";
	}
	
	private function getBackdrop($xml)
	{
		if(!empty($xml->Backdrops))
		{
			foreach($xml->Backdrops->children() as $item)
			{
				return (string)$item['File720P'];
			}
		
		}
		return "";
	}
	
	private function getParentalControlId($xml)
	{
		if(!empty($xml->ParentalRating))
		{
			$model = ParentalControl::model()->findByAttributes(array('value'=>$xml->ParentalRating->Value));
			
			if(isset($model))
			{
				return $model->Id;
			}
	
		}
		return 1;
	}
	
	private function getAdult($xml)
	{
		if(!empty($xml->ParentalRating))
		{
			if($xml->ParentalRating['Adult'] == 'True')
				return 1;
		}
		return 0;
	}
	
	private function getPoster($xml)
	{
		if(!empty($xml->Posters))
		{
			foreach($xml->Posters->children() as $item)
			{
				return (string)$item['File'];
			}
	
		}
		return "";
	}
	
	private function saveAudioTrack($xml)
	{
		
		$idMyMovie = (string)$xml->ID;
		
		foreach($xml->AudioTracks->children() as $item)
		{
			$language = (string)$item['Language'];
			$type = (string)$item['Type'];
			$chanels = (string)$item['Channels'];
			
			$modelAudioTrackDB = AudioTrack::model()->findByAttributes(array(
													'language'=>$language,
													'type'=>$type,
													'chanel'=>$chanels,));
			
			$modelMyMovieAudioTrack = new MyMovieAudioTrack();
			$modelMyMovieAudioTrack->Id_my_movie = $idMyMovie;
			
			if(isset($modelAudioTrackDB))
			{
				$modelMyMovieAudioTrack->Id_audio_track = $modelAudioTrackDB->Id;
			}
			else
			{
				$modelAudioTrack = new AudioTrack();
				$modelAudioTrack->language = $language;
				$modelAudioTrack->type = $type;
				$modelAudioTrack->chanel = $chanels;
				$modelAudioTrack->save();
				
				$modelMyMovieAudioTrack->Id_audio_track = $modelAudioTrack->Id;
			}
			
			$model = MyMovieAudioTrack::model()->findByAttributes(array(
													'Id_my_movie'=>$idMyMovie, 
													'Id_audio_track'=>$modelMyMovieAudioTrack->Id_audio_track));
			if(!isset($model))
				$modelMyMovieAudioTrack->save();

		}
	}
	
	private function saveSubtitle($xml)
	{
	
		$idMyMovie = (string)$xml->ID;
	
		foreach($xml->Subtitles->children() as $item)
		{
			$language = (string)$item['Language'];
				
			$modelSubtitleDB = Subtitle::model()->findByAttributes(array(
														'language'=>$language,
														));
				
			$modelMyMovieSubtitle = new MyMovieSubtitle();
			$modelMyMovieSubtitle->Id_my_movie = $idMyMovie;
				
			if(isset($modelSubtitleDB))
			{
				$modelMyMovieSubtitle->Id_subtitle = $modelSubtitleDB->Id;
			}
			else
			{
				$modelSubtitle = new Subtitle();
				$modelSubtitle->language = $language;
				$modelSubtitle->save();
	
				$modelMyMovieSubtitle->Id_subtitle = $modelSubtitle->Id;
			}
				
			$model = MyMovieSubtitle::model()->findByAttributes(array(
														'Id_my_movie'=>$idMyMovie, 
														'Id_subtitle'=>$modelMyMovieSubtitle->Id_subtitle));
			if(!isset($model))
				$modelMyMovieSubtitle->save();
	
		}
	}
}


