<?php
class TMDBHelper
{
	/**
	 * A partir del parseo del objeto PeliFile con el nombre y el año, busca la pelicula correspondiente
	 * @param PeliFile $modelPeliFile - objeto pelifile
	 * @return Ambigous <NULL, TMDBMovie> el objeto movie de TMDB
	 */
	static public function getInfoByPeliFile($modelPeliFile)
	{
		$idMyMovie = null;
		
		$db = TMDBApi::getInstance();
		$db->adult = true;  // return adult content
		$db->paged = false; // merges all paged results into a single result automatically
		$results = $db->search('movie', array('query'=>$modelPeliFile->name, 'year'=>$modelPeliFile->year));
		$idMovie = null;
		
		foreach($results as $item)
		{
			$idMovie = $item->id;
			break;
		}
		
		$movie = null;
		if(isset($idMovie))
			$movie = new TMDBMovie($idMovie);
		
		return $movie;
	}
	
	
	/**
	 * A partir del parseo del nombre del directorio que contiene el video, busca la pelicula correspondiente
	 * @param string $folderName - Nombre del directorio
	 * @return Ambigous <NULL, TMDBMovie> el objeto movie de TMDB
	 */
	static public function getInfoByFolderName($folderName)
	{
		//limpio el nombre. Reemplazo . por espacios y parentesis por vacio
		$name = str_replace('.',' ',$folderName);
		$name = preg_replace('/\(|\)/', '', $name);
		
		//limpio del nombre los 1080p y 720p que ensucian la busqueda
		$name = str_replace('1080p', '', $name);
		$name = str_replace('720p', '', $name);
		
		//encuentro el año
		$year = '';
		$regex = "/\b\d{4}\b/";
		preg_match($regex, $name, $match);
		if(isset($match[0])) //si encuentra el año, corta del año para la izquierda para obtener el titulo
		{
			$year = $match[0];
			$yearPos = strpos($name, $year);
			$name = substr($name, 0, $yearPos);
			if(trim($name) == "")
				$name = $year;
		}
		else //si no encuentra el año, genera el titulo con la primer palabra. En el caso que el temaño de la primera sea menor a 3 letras, toma las dos primeras.
		{
			$words = explode(' ', $name);
			if(count($words) >= 2)
			{
				if(strlen($words[0]) > 3)
					$name = $words[0];
				else
					$name = $words[0]. ' ' .$words[1];
			}
			else
				$name = $words[0];
		}
		
		//busco en la api
		$db = TMDBApi::getInstance();
		$db->adult = true;  // return adult content
		$db->paged = false; // merges all paged results into a single result automatically
		$results = $db->search('movie', array('query'=>$name, 'year'=>$year));
		$idMovie = null;
		
		foreach($results as $item)
		{
			$idMovie = $item->id;
			break;
		}
		
		$movie = null;
		if(isset($idMovie))
			$movie = new TMDBMovie($idMovie);
		
		return $movie;
	}
	
	/**
	 * Salva toda la metadata devuelta por TMDB en my_movie y genera un my_movie_disc (este metodo no guarda las imagenes)
	 * @param TMDB movie $movie
	 * @return Ambigous <NULL, string> Si pudo guardar toda la metadata, duevelve el Id de disco correspondiente al Id de my_movie_disc
	 */
	static public function saveMetaData($movie)
	{
		$idDisc = null;
		if(isset($movie))
		{
			$transaction=Yii::app()->db->beginTransaction();
			try
			{
				$persons = $movie->casts();
				$poster = $movie->poster('342');
				$bigPoster = $movie->poster('500');
				$backdrop = $movie->backdrop('original');
	
				$myMovie = new MyMovie();
	
				$idMyMovie = uniqid ("cust_");
	
				$myMovie->Id = $idMyMovie;
				$myMovie->Id_parental_control = 1; //UNRATED
				
				$releases = $movie->releases();				
				$myMovie->certification = "UNRATED";
				foreach($releases->countries as $countries)
				{
					if(($countries->iso_3166_1=="US" || $countries->iso_3166_1=="GB") && $countries->certification!="")
					{
						$myMovie->certification = $countries->certification;
						break;
					}
				}								
				$myMovie->original_title = $movie->original_title;
				$myMovie->adult = $movie->adult?1:0;
				$myMovie->release_date = $movie->release_date;
				$date = date_parse($movie->release_date);
				$myMovie->production_year = $date['year'];
				$myMovie->running_time = $movie->runtime;
				$myMovie->description = $movie->overview;
				$myMovie->local_title = $movie->title;
				$myMovie->sort_title= $movie->title;
				$myMovie->imdb= $movie->imdb_id;
				$myMovie->rating= (int)$movie->vote_average;
	
				$myMovie->poster_original = $poster;
				$myMovie->big_poster_original = $bigPoster;
				$myMovie->backdrop_original = $backdrop;
	
				$genres = $movie->genres;
				$myMovie->genre="";
				$first = true;
				foreach($genres as $genre)
				{
					if($first)
					{
						$first = false;
						$myMovie->genre = $genre->name;
					}
					else
					{
						$myMovie->genre = $myMovie->genre.", ".$genre->name;
					}
				}
	
				$companies = $movie->production_companies;
				$myMovie->studio = "";
				$first = true;
				foreach($companies as $companie)
				{
					if($first)
					{
						$first = false;
						$myMovie->studio = $companie->name;
					}
					else
					{
						$myMovie->studio = $myMovie->studio.", ".$companie->name;
					}
				}
	
				if($myMovie->save())
				{
					$casts =isset($persons['cast'])?$persons['cast']:array();
	
					$relations = MyMoviePerson::model()->findAllByAttributes(array('Id_my_movie'=>$idMyMovie));
					$personsToDelete = array();
					foreach ($relations as $relation)
					{
						$personsToDelete[] = $relation->person;
					}
					MyMoviePerson::model()->deleteAllByAttributes(array('Id_my_movie'=>$idMyMovie));
					foreach ($personsToDelete as $toDelete)
					{
						$toDelete->delete();
					}
					foreach($casts as $cast)
					{
						$person = new Person();
						$person->name= $cast->name;
						$person->type = "Actor";
						$person->role = $cast->character;
						$person->photo_original = $cast->profile();
						if($person->save())
						{
							$myMoviePerson = new MyMoviePerson();
							$myMoviePerson->Id_my_movie = $idMyMovie;
							$myMoviePerson->Id_person = $person->Id;
							$myMoviePerson->save();
						}
					}
					$crews =isset($persons['crew'])?$persons['crew']:array();
					foreach($crews as $crew)
					{
						$person = new Person();
						$person->name= $crew->name;
						$person->type = $crew->job;
						$person->photo_original = $crew->profile();
						if($person->save())
						{
							$myMoviePerson =  new MyMoviePerson();
							$myMoviePerson->Id_my_movie = $idMyMovie;
							$myMoviePerson->Id_person = $person->Id;
							$myMoviePerson->save();
						}
					}
						
					//genero un nuevo disco
					$myMovieDisc = new MyMovieDisc();
					$idDisc = uniqid();
					$myMovieDisc->Id = $idDisc;
					$myMovieDisc->name = $movie->original_title;
					$myMovieDisc->Id_my_movie = $idMyMovie;
	
					$myMovieDisc->save();
						
					$transaction->commit();
						
				}
			}
			catch (Exception $e) {
				$transaction->rollBack();
				//var_dump($e);
			}
				
		}
		else //no hay info Seteo todo vacio
		{
			$transaction=Yii::app()->db->beginTransaction();
			try
			{				
				$poster = 'no_image.jpg';
				$bigPoster = 'no_image_big.jpg';
				$backdrop = 'no_image_bd.jpg';
			
				$myMovie = new MyMovie();
			
				$idMyMovie = uniqid ("cust_");
			
				$myMovie->Id = $idMyMovie;
				$myMovie->Id_parental_control = 1; //UNRATED
				$myMovie->original_title = 'Desconocido';
				$myMovie->adult = 0;
				$myMovie->description = 'Video No reconocido';
				$myMovie->local_title = 'Desconocido';				
			
				$myMovie->poster_original = $poster;
				$myMovie->big_poster_original = $bigPoster;
				$myMovie->backdrop_original = $backdrop;
			
				$myMovie->genre="";
			
				if($myMovie->save())
				{
					//genero un nuevo disco
					$myMovieDisc = new MyMovieDisc();
					$idDisc = uniqid();
					$myMovieDisc->Id = $idDisc;
					$myMovieDisc->name = 'Desconocido';
					$myMovieDisc->Id_my_movie = $idMyMovie;
			
					$myMovieDisc->save();
			
					$transaction->commit();
			
				}
			}
			catch (Exception $e) {
				$transaction->rollBack();
				//var_dump($e);
			}
		}
			
		return $idDisc;
	}
	

	static public function downloadAndLinkImagesByModel($movie,$idResource)
	{
		if(isset($movie))
		{
			$poster = $movie->poster('342');
			$bigPoster = $movie->poster('500');
			$backdrop = $movie->backdrop('original');
			
			try {
				$modelResource = LocalFolder::model()->findByPk($idResource);
				$model = (isset($modelResource->TMDBData))?$modelResource->TMDBData:null;
			
				if(!isset($model))
					$model = new TMDBData();
					
// 				$model->poster = 'no_image.jpg';
// 				$model->big_poster = 'no_image_big.jpg';
// 				$model->backdrop = 'no_image_bd.jpg';
				$date = new DateTime();
				if($poster!="")
					$model->poster = self::getImage("", $poster, $movie->id, true)."?".$date->getTimestamp();
				if($bigPoster!="")
					$model->big_poster = self::getImage("_big", $bigPoster, $movie->id."_big")."?".$date->getTimestamp();
				if($backdrop!="")
					$model->backdrop = self::getImage("_bd", $backdrop, $movie->id."_bd")."?".$date->getTimestamp();
					
				$model->TMDB_id = $movie->id;
					
				$model->save();
				$modelResource->Id_TMDB_data = $model->Id;
				$modelResource->save();
				$modelResource->refresh();
				return $modelResource;
					
			} catch (Exception $e) {
				var_dump($e);
			}
		}
		else //no hay info Seteo las imagenes por defecto
		{
			try {
				$modelResource = LocalFolder::model()->findByPk($idResource);
				$model = (isset($modelResource->TMDBData))?$modelResource->TMDBData:null;
					
				if(!isset($model))
					$model = new TMDBData();
					
				$model->poster = 'no_image.jpg';
				$model->big_poster = 'no_image_big.jpg';
				$model->backdrop = 'no_image_bd.jpg';
				$model->TMDB_id = 1;					
				$model->save();
				$modelResource->Id_TMDB_data = $model->Id;
				$modelResource->save();
				$modelResource->refresh();
				return $modelResource;
					
			} catch (Exception $e) {
				var_dump($e);
			}
		}
	}
	
	static public function downloadAndLinkImages($TMDBId,$idResource,$sourceType,$poster,$bigPoster,$backdrop)
	{
		try {
			if($sourceType == 1)
			{
				$modelResource = Nzb::model()->findByPk($idResource);
				$model = (isset($modelResource->TMDBData))?$modelResource->TMDBData:null;
			}
			else if($sourceType == 2)
			{
				$modelResource = RippedMovie::model()->findByPk($idResource);
				$model = (isset($modelResource->TMDBData))?$modelResource->TMDBData:null;
			}
			else
			{
				$modelResource = LocalFolder::model()->findByPk($idResource);
				$model = (isset($modelResource->TMDBData))?$modelResource->TMDBData:null;
			}
			
			if(!isset($model))
			{
				$model = new TMDBData();
			}
			
// 			$model->poster = 'no_image.jpg';
// 			$model->big_poster = 'no_image_big.jpg';
// 			$model->backdrop = 'no_image_bd.jpg';
			$date = new DateTime();
			if($poster!="")
				$model->poster = self::getImage("", $poster, $TMDBId,true)."?".$date->getTimestamp();
			if($bigPoster!="")
				$model->big_poster = self::getImage("_big", $bigPoster, $TMDBId."_big")."?".$date->getTimestamp();
			if($backdrop!="")
				$model->backdrop = self::getImage("_bd", $backdrop, $TMDBId."_bd")."?".$date->getTimestamp();
			
			$model->TMDB_id = $TMDBId;
			
			$model->save();
			$modelResource->Id_TMDB_data = $model->Id;
			$modelResource->save();
			$modelResource->refresh();
			return $modelResource;
			
		} catch (Exception $e) {
			var_dump($e);
		}
	}
	static public function getImage($posFix, $original, $newFileName, $copy = false)
	{
		$validator = new CUrlValidator();
		$setting = Setting::getInstance();
		
		$name = 'no_image'.$posFix.'.jpg';
		
		if(strstr ( $original, "_temp" ))
		{
			if($copy)
			{				
				if(copy($original , $setting->path_images."/".$newFileName.".jpg" ))
					$name = $newFileName.".jpg";
			}else {
				if(rename ( $original , $setting->path_images."/".$newFileName.".jpg" ))
					$name = $newFileName.".jpg";
			}
			return $name;
		}
				
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
	
}