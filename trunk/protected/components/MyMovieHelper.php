<?php
class MyMovieHelper
{
	static public function saveUnknownMyMovieData($title)
	{
		$modelMyMovie = new MyMovie();
		
		$modelMyMovie->Id = uniqid();
		$modelMyMovie->type = "Blu-ray";
		$modelMyMovie->local_title = $title;
		$modelMyMovie->original_title = $title;
		$modelMyMovie->sort_title = $title;
		$modelMyMovie->Id_parental_control = 1;
		$modelMyMovie->certification = "UNRATED";
		
		$modelMyMovie->poster = "noImage.jpg";
		
		//TODO agregar backdrop para pelicula desconocida
		$modelMyMovie->big_poster = "noImage.jpg";
		
		$modelMyMovie->save();
		return $modelMyMovie->Id;
	}
	
	static public function saveMyMovieData($idMyMovie)
	{
		$modelMyMovieDB = MyMovie::model()->findByPk($idMyMovie);
		if(!isset($modelMyMovieDB))
		{
			try {
					
				$myMoviesAPI = new MyMoviesAPI();
					
				$response = $myMoviesAPI->LoadDiscTitleById($idMyMovie);
					
				if(!empty($response) && (string)$response['status'] == 'ok')
				{
					if(!empty($response->Title))
						$data = $response->Title;
					else
						return false;
		
					$idMyMovie = (string)$data->ID;
					$idSerie = !empty($data->TVSeriesID)?(string)$data->TVSeriesID:'';
		
			
					$modelMyMovie = new MyMovie();
						
					$modelMyMovie->Id = $idMyMovie;
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
					$modelMyMovie->imdb = (string)$data->IMDB;
					$modelMyMovie->rating = (string)$data->Rating;
					$modelMyMovie->data_changed = (string)$data->DataChanged;
					$modelMyMovie->covers_changed = (string)$data->CoversChanged;
						
					$modelMyMovie->parental_rating_desc = (!empty($data->ParentalRating)?(string)$data->ParentalRating->Description:"");
						
					$modelMyMovie->Id_parental_control = self::getParentalControlId($data);
						
					$modelMyMovie->adult = self::getAdult($data);
						
					//Obtengo la lista de los generos
					$modelMyMovie->genre = implode(", ",self::xmlToArray($data->Genres));
						
					//Obtengo la lista de los estudios
					$modelMyMovie->studio =  implode(", ",self::xmlToArray($data->Studios));
						
					//Poster
					$modelMyMovie->poster_original = self::getPoster($data->MovieData);
					if($modelMyMovie->poster_original=="")
					{
						$modelMyMovie->poster_original = self::getCovers($data);
							
					}
					$modelMyMovie->poster = self::getImage($modelMyMovie->poster_original, $idMyMovie);
					//Big Poster
					$modelMyMovie->big_poster_original = self::getBigPoster($data->MovieData);
					if($modelMyMovie->big_poster_original=="")
					{
						$modelMyMovie->big_poster_original = self::getCovers($data);
							
					}
					$modelMyMovie->big_poster = self::getImage($modelMyMovie->big_poster_original, $idMyMovie."_big");
						
					//Backdrop
					$modelMyMovie->backdrop_original = self::getBackdrop($data->MovieData);
					$modelMyMovie->backdrop = self::getImage($modelMyMovie->backdrop_original, $idMyMovie . '_bd');
						
					//check idSerie
					if(!empty($idSerie))
					{
						$modelMyMovie->Id_my_movie_serie_header = self::getSerieHeader($idSerie);
					}
						
					if($modelMyMovie->save())
					{
						self::saveAudioTrack($data);
						self::saveSubtitle($data);
						self::savePerson($data);
					}
		
				}
				else 
				{
					return false;
				}
			} catch (Exception $e) {
				return false;
			}
		}
		return true;
	}
	
	static public function createSerieTreeByFolder($idSerie, $season, $episodes, $idDisc)
	{
		$arrEpisodes = explode(',',$episodes);
		$idSeason = self::getSeason($idSerie, $season);
		
		if(isset($idSeason))
		{
			foreach($arrEpisodes as $episode)
			{
				$idEpisode = self::getEpisode($idSerie, $idSeason, $season, $episode);
				if(isset($idEpisode))
				{
					$modelDiscEpisode = new DiscEpisode();
					$modelDiscEpisode->Id_my_movie_disc = $idDisc;
					$modelDiscEpisode->Id_my_movie_episode = $idEpisode;
					$modelDiscEpisode->save();
				}
			}
		}
	}
	
	
	//PRIVATE FUNCTIONS-------------------------------------------------------------------------------
	
	private function createSerieTree($xml, $idDisc, $idSerie, $idMyMovie)
	{
		foreach($xml->Discs->children() as $item)
		{
			if((string)$item->DiscIdSideA == $idDisc)
			{
				if(isset($item->TitlesSideA))
				{
					foreach($item->TitlesSideA->children() as $title)
					{
						if((string)$title['ContainsEpisode'] == "True")
						{
								
							$idSeason = self::getSeason($idSerie, (string)$title['TVSeason']);
							if(isset($idSeason))
							{
								$idEpisode = self::getEpisode($idSerie, $idSeason, (string)$title['TVSeason'], (string)$title['TVEpisode']);
								if(isset($idEpisode))
								{
									$modelDiscEpisode = new DiscEpisode();
									$modelDiscEpisode->Id_my_movie_disc = $idDisc;
									$modelDiscEpisode->Id_my_movie_episode = $idEpisode;
									$modelDiscEpisode->save();
								}
							}
	
						}
					}
				}
			}
		}
	
	}
	
	private function saveDisc($xml, $idDisc, $idMyMovie)
	{
		foreach($xml->Discs->children() as $item)
		{
			if(strtoupper((string)$item->DiscIdSideA) == strtoupper($idDisc))
			{
				$modelMyMovieDisc = new MyMovieDisc;
				$modelMyMovieDisc->Id = $idDisc;
				$modelMyMovieDisc->Id_my_movie = $idMyMovie;
				$modelMyMovieDisc->name = (string)$item->Name;
				$modelMyMovieDisc->save();
			}
		}
	}
	
	/*
	 * Primero se fija si ya existe en la BD, caso contrario, consume
	* la API de MyMovies para traer info del Episodio
	* @param string $idSerie es el Id de serie de MyMovie
	* @param integer $idSeason es el Id de season
	* @param integer $seasonNumber es el numero de season
	* @param integer $episodeNumber es el numero de episodio
	*/
	private function getEpisode($idSerie, $idSeason, $seasonNumber, $episodeNumber)
	{
		$modelEpisodeDB = MyMovieEpisode::model()->findByAttributes(array(
												'Id_my_movie_season'=>$idSeason,
												'episode_number'=>$episodeNumber,
		));
	
		if(!isset($modelEpisodeDB))
		{
			$myMoviesAPI = new MyMoviesAPI();
			$response = $myMoviesAPI->LoadEpisodeBySeriesID($idSerie, $seasonNumber, $episodeNumber);
				
			if(!empty($response) && (string)$response['status'] == 'ok')
			{
				if(!empty($response->Episode))
				$data = $response->Episode;
				else
				return null;
	
				$description = (string)$data['Description'];
				$name = (string)$data['EpisodeName'];
	
				$modelMyMovieEpisode = new MyMovieEpisode;
				$modelMyMovieEpisode->description = (!empty($description)) ? $description :(string)$data->EnglishPart['Description'];
				$modelMyMovieEpisode->name = (!empty($name)) ? $name : (string)$data->EnglishPart['Name'];
				$modelMyMovieEpisode->episode_number = (string)$data['EpisodeNumber'];
				$modelMyMovieEpisode->Id_my_movie_season = $idSeason;
	
				if($modelMyMovieEpisode->save())
					return $modelMyMovieEpisode->Id;
			}
		}
		else
			return $modelEpisodeDB->Id;
	
		return null;
	}
	
	/*
	 * A partir de un idSerie y seasonNumber, primero se fija si ya existe en la BD, caso contrario, consume
	* la API de MyMovies para traer info de la Season
	* @param string $idSerie es el Id de serie de MyMovie
	* @param integer $seasonNumber es el numero de season
	*/
	private function getSeason($idSerie, $seasonNumber)
	{
		$modelSeasonDB = MyMovieSeason::model()->findByAttributes(array(
											'Id_my_movie_serie_header'=>$idSerie,
											'season_number'=>$seasonNumber,
		));
	
		if(!isset($modelSeasonDB))
		{
			$myMoviesAPI = new MyMoviesAPI();
			$response = $myMoviesAPI->LoadSeasonBanners($idSerie, $seasonNumber);
				
			if(!empty($response) && (string)$response['status'] == 'ok')
			{
				foreach($response->Banners->children() as $item)
				{
					if((string)$item['Number'] == "1")
					{
						$modelMyMovieSeason = new MyMovieSeason;
						$modelMyMovieSeason->Id_my_movie_serie_header =  $idSerie;
						$modelMyMovieSeason->season_number = (string)$item['SeasonNumber'];
	
						//banner
						$modelMyMovieSeason->banner_original = (string)$item['File'];
						$newFileName = $idSerie .'_'.$seasonNumber;
						$modelMyMovieSeason->banner = self::getImage($modelMyMovieSeason->banner_original, $newFileName);
	
						if($modelMyMovieSeason->save())
							return $modelMyMovieSeason->Id;
					}
				}
			}
		}
		else
			return $modelSeasonDB->Id;
	
		return null;
	}
	
	/*
	 * A partir de un idSerie, primero se fija si ya existe en la BD, caso contrario, consume
	* la API de MyMovies para traer info de la Serie
	* @param string $idSerie es el Id de serie de MyMovie
	*/
	private function getSerieHeader($idSerie)
	{
		$modelMyMovieSerieHeaderDB = MyMovieSerieHeader::model()->findByPk($idSerie);
	
		if(!isset($modelMyMovieSerieHeaderDB))
		{
			$myMoviesAPI = new MyMoviesAPI();
			$response = $myMoviesAPI->LoadSeries($idSerie);
				
			if(!empty($response) && (string)$response['status'] == 'ok')
			{
				if(!empty($response->Serie))
					$data = $response->Serie;
				else
					return null;
	
				$description = (string)$data['Description'];
				$name = (string)$data['EpisodeName'];
	
				$modelMyMovieSerieHeader = new MyMovieSerieHeader();
				$modelMyMovieSerieHeader->Id = (string)$data['Id'];
				$modelMyMovieSerieHeader->original_network = (string)$data['OriginalNetwork'];
				$modelMyMovieSerieHeader->original_status = (string)$data['OriginalStatus'];
				$modelMyMovieSerieHeader->rating = (string)$data['Rating'];
				$modelMyMovieSerieHeader->description = (!empty($description)) ? $description :(string)$data->EnglishPart['Description'];
				$modelMyMovieSerieHeader->name = (!empty($name)) ? $name : (string)$data->EnglishPart['Name'];
				$modelMyMovieSerieHeader->sort_name = (string)$data->EnglishPart['SortName'];
				$modelMyMovieSerieHeader->genre = self::getSerieGenre($data);
	
				//Poster
				$modelMyMovieSerieHeader->poster_original = self::getPoster($data);
				$modelMyMovieSerieHeader->poster = self::getImage($modelMyMovieSerieHeader->poster_original, $modelMyMovieSerieHeader->Id);
				$modelMyMovieSerieHeader->big_poster_original = self::getBigPoster($data);
				$modelMyMovieSerieHeader->big_poster = self::getImage($modelMyMovieSerieHeader->big_poster_original, $modelMyMovieSerieHeader->Id."_big");
				
				if(!$modelMyMovieSerieHeader->save())
					return null;
			}
		}
	
		return $idSerie;
	}
	
	/*
	 * Obtiene la lista de generos de la serie
	* @param xml $xml es la estructura que devuelve la API de MyMovies (LoadSeries->Serie)
	*/
	private function getSerieGenre($xml)
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
	
	private function getCovers($xml)
	{
		if(!empty($xml->Covers))
		{
			return (string)$xml->Covers->Front['Medium'];
		}
		return "";
	}
	
	private function getPoster($xml)
	{
		if(!empty($xml->Posters))
		{
			foreach($xml->Posters->children() as $item)
			{
				return (string)$item['FileThumb'];
			}
	
		}
		return "";
	}
	private function getBigPoster($xml)
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
	
	private function getImage($original, $newFileName)
	{
		$validator = new CUrlValidator();
		$setting = Setting::getInstance();
	
		$name = 'no_poster.jpg';
		if($original!='' && $validator->validateValue($original))
		{
			try {
				$content = @file_get_contents($original);
				if ($content !== false) {
					$file = fopen($setting->path_images."/".$newFileName.".jpg", 'w');
					if($file !== false)
					{
						if (@fwrite($file, $content) !== FALSE) {
							$name = $newFileName.".jpg";
						}
						fclose($file);
					}
				} else {
					// an error happened
				}
			} catch (Exception $e) {
				throw $e;
				// an error happened
			}
		}
		return $name;
	
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
	
	private function savePerson($xml)
	{
	
		$idMyMovie = (string)$xml->ID;
	
		foreach($xml->Persons->children() as $item)
		{
			$name = (string)$item->Name;
			$type = (string)$item->Type;
			$role = preg_replace('/[^a-zA-Z0-9_ %\[().\]\\/-]/s', '', (string)$item->Role);
			$photo_original = (string)$item->Photo;
	
			$modelPersonDB = Person::model()->findByAttributes(array(
																'name'=>$name,
																'type'=>$type,
																'role'=>$role,));
	
			$modelMyMoviePerson = new MyMoviePerson();
			$modelMyMoviePerson->Id_my_movie = $idMyMovie;
	
			if(isset($modelPersonDB))
			{
				$modelMyMoviePerson->Id_person = $modelPersonDB->Id;
			}
			else
			{
				$modelPerson = new Person();
				$modelPerson->name = $name;
				$modelPerson->type = $type;
				$modelPerson->role = $role;
				$modelPerson->photo_original = $photo_original;
				$modelPerson->save();
	
				$modelMyMoviePerson->Id_person = $modelPerson->Id;
			}
	
			$model = MyMoviePerson::model()->findByAttributes(array(
																'Id_my_movie'=>$idMyMovie, 
																'Id_person'=>$modelMyMoviePerson->Id_person));
			if(!isset($model))
			$modelMyMoviePerson->save();
	
		}
	}
}