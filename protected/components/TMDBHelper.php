<?php
class TMDBHelper
{
	static public function saveInfo($name, $year, $idDisc)
	{
		$idMyMovie = null;
		
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
		
		if(isset($idMovie))
		{
			$transaction=Yii::app()->db->beginTransaction();
			try
			{
				$movie = new TMDBMovie($idMovie);
				$persons = $movie->casts();
				$poster = $movie->poster('342');
				$bigPoster = $movie->poster('500');
				$backdrop = $movie->backdrop('original');
				
				$myMovie = new MyMovie();
				
				$idMyMovie = uniqid ("cust_");
				
				var_dump(TMDBHelper::downloadAndLinkImages($movie->id,$idMyMovie,$poster,$bigPoster,$backdrop));
				
				$myMovie->Id = $idMyMovie;
				$myMovie->Id_parental_control = 1; //UNRATED
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
					
					$myMovieDisc = MyMovieDisc::model()->findByPk($idDisc);
					if(!isset($myMovieDisc))
					{
						$myMovieDisc = new MyMovieDisc();
						$myMovieDisc->Id = $idDisc;
					}
					$myMovieDisc->name = $name;
					$myMovieDisc->Id_my_movie = $idMyMovie;
				
					$myMovieDisc->save();
					
					$transaction->commit();
					
				}
			}
			catch (Exception $e) {
				$transaction->rollBack();
				var_dump($e);
			}
			
		}
		return $idMyMovie;
	}
	
	static public function downloadAndLinkImages($TMDBId,$idResource,$sourceType,$poster,$bigPoster,$backdrop)
	{
		try {
			if($sourceType == 1)
			{
				$modelResource = Nzb::model()->findByPk($idResource);
				$model = $modelResource->TMDBData;
			}
			else if($sourceType == 2)
			{
				$modelResource = RippedMovie::model()->findByPk($idResource);
				$model = $modelResource->TMDBData;
			}
			else
			{
				$modelResource = LocalFolder::model()->findByPk($idResource);
				$model = $modelResource->TMDBData;
			}
			
			if(!isset($model))
			{
				$model = new TMDBData();
			}
			
			if($poster!="")
				$model->poster = self::getImage($poster, $TMDBId,true);
			if($bigPoster!="")
				$model->big_poster = self::getImage($bigPoster, $TMDBId."_big");
			if($backdrop!="")
				$model->backdrop = self::getImage($backdrop, $TMDBId."_bd");
			
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
	private function getImage($original, $newFileName, $copy = false)
	{
		$validator = new CUrlValidator();
		$setting = Setting::getInstance();
		$name = 'no_poster.jpg';
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