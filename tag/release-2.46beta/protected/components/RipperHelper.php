<?php
class RipperHelper
{
	static public function checkForAnyDvdUpdate()
	{
		$settings = Setting::getInstance();
	
		$response = new ServerAnydvdUpdateResponse();
		$wsSettings = new wsSettings();
		$response = $wsSettings->checkForUpdate($settings->Id_device);
		RipperHelper::updateAnydvd($response->version, $response->file_name, $response->download_link);
	}
	static public function setTunnelingPorts()
	{		
		$settings = Setting::getInstance();
	
		$wsSettings = new wsSettings();
		$response = $wsSettings->getDeviceTunnelPort($settings->Id_device);
		$result = array();
		foreach($response as $item)
		{
			try {
				exec(dirname(__FILE__).'/../commands/shell/tunnelKiller.sh '.$item->external_port.' >/dev/null');
				if($item->open)
					exec(dirname(__FILE__).'/../commands/shell/tunnelCreator.sh '.$item->external_port.' '.$item->internal_port.' gruposmartliving.com pelicano >/dev/null');
				$result[]=$item;
			} catch (Exception $e) {
			}
			$wsSettings->ackDeviceTunnelPort($settings->Id_device,$result);				
		}
		//RipperHelper::updateAnydvd($response->version, $response->file_name, $response->download_link);
	}
	
	static public function updateAnydvd($version,$file_name,$download_link)
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
	
	static public function updateRipperSettings()
	{
		$wsSettings = new wsSettings;
		$settings = Setting::getInstance();
		$response = $wsSettings->getRipperSettings($settings->Id_device);
		if($response->drive_letter!="")
		{
			$settingsRippers = SettingsRipper::model()->findAll();
			
			if(empty($settingsRippers))
			{
				$settingsRipper = new SettingsRipper;
			}else {
				$settingsRipper =$settingsRippers[0];
			}
			$settingsRipper->drive_letter = $response->drive_letter;
			$settingsRipper->temp_folder_ripping = $response->temp_folder_ripping;
			$settingsRipper->final_folder_ripping = $response->final_folder_ripping;
			$settingsRipper->time_from_reboot = $response->time_from_reboot;
			$settingsRipper->time_to_reboot = $response->time_to_reboot;
			$settingsRipper->mymovies_username = $response->mymovies_username;
			$settingsRipper->mymovies_password = $response->mymovies_password;
			$settingsRipper->save();
			$settings->mymovies_username = $response->mymovies_username;
			$settings->mymovies_password = $response->mymovies_password;
			$settings->save();
				
		}
		
	}
	static public function saveRipped($idMyMovie, $path, $parentalControl, $idDisc)
	{
		if(self::getMyMovieData($idMyMovie, $idDisc))
			return self::saveRippedMovie($idDisc, $path, $parentalControl);
		return false;
	}
	
	private function saveRippedMovie($idDisc, $path, $parentalControl)
	{
	
		$modelRippedMovieDB = RippedMovie::model()->findByAttributes(array('Id_my_movie_disc'=>$idDisc));
		if(!isset($modelRippedMovieDB))
		{
			$modelRippedMovie = new RippedMovie();
			$modelRippedMovie->path = $path;
			$modelRippedMovie->Id_my_movie_disc = $idDisc;
			$modelRippedMovie->parental_control = (int)$parentalControl;
			if($modelRippedMovie->save())
				return true;
		}
		else
		{
			$modelRippedMovieDB->path = $path;
			$modelRippedMovieDB->parental_control = (int)$parentalControl;
			$modelRippedMovieDB->was_sent = 0;
			$modelRippedMovieDB->creation_date = new CDbExpression('NOW()');
			if($modelRippedMovieDB->save())
				return true;
		}
		return false;
	
	}
	
	static public function saveCurrentDiscData($idDisc)
	{	
		$modelMyMovieDisc = MyMovieDisc::model()->findByAttributes(array('Id'=>$idDisc));
		if(!isset($modelMyMovieDisc))
		{
			$rawData = array();
			$rawData = self::searchTitlesByDiscId($idDisc,'');
			if(!empty($rawData))
			{				
				if(MyMovieHelper::saveMyMovieData($rawData[0]->id))
				{
					$modelMyMovieDiscDB = new MyMovieDisc();
					$modelMyMovieDiscDB->Id = $idDisc;
					$modelMyMovieDiscDB->Id_my_movie = $rawData[0]->id;
					
					$modelMyMovieDiscDB->name = $rawData[0]->title;
					$modelMyMovieDiscDB->save();
				}
			}
		}
		
	}
	
	static public function searchTitlesByDiscId($idDisc, $country)
	{
		$titlesResponse = array();
	
		$myMoviesAPI = new MyMoviesAPI();
		$response = $myMoviesAPI->SearchDiscTitleByDiscIds($idDisc, $country);
		if(!empty($response) && (string)$response['status'] == 'ok')
		{
			$titles = $response->Titles;
	
			foreach($titles->children() as $title)
			{
				$model = new SearchDiscResponse();
				$model->setAttributes($title);
				$titlesResponse[] = $model;
			}
		}
		return $titlesResponse;
	}
	
	private function getMyMovieData($idMyMovie, $idDisc)
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
				
				$modelMyMovieDB = MyMovie::model()->findByPk($idMyMovie);
					
				if(!isset($modelMyMovieDB))
				{
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
					
					//BigPoster
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
				
				$modelMyMovieDiscDB = MyMovieDisc::model()->findByPk($idDisc);
				
				if(!isset($modelMyMovieDiscDB))
					self::saveDisc($data, $idDisc, $idMyMovie);
				
				if(!empty($idSerie))
					self::createSerieTree($data, $idDisc, $idSerie, $idMyMovie);
				
			}
		} catch (Exception $e) {
			return false;
		}
		return true;		
	}

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
			$modelEpisodeDB->Id;
		
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
					fwrite($file,$content);
					fclose($file);
					$name = $newFileName.".jpg";
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