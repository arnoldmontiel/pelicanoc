<?php
class ReadFolderHelper
{
	static public function scanDirectory()
	{
// 		$setting = Setting::getInstance();		
// 		$filesFolder = $setting->host_file_server . $setting->host_file_server_path; 
		
// 		$iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($filesFolder),
// 		RecursiveIteratorIterator::SELF_FIRST);
		
		$iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator('C:/Users/Wensel/Desktop/PelicanoStorage'),
		RecursiveIteratorIterator::SELF_FIRST);
			
		$chunksize = 1*(1024*1024); // how many bytes per chunk
	
		foreach ($iterator as $file) {
			if(!$file->isDir())
			{
				if(pathinfo($file->getFilename(), PATHINFO_EXTENSION) == 'txt') {
						
					$handle = fopen($file, 'rb');
					if ($handle === false) {
						return false;
					}
						
					while (!feof($handle)) {
						$buffer = fread($handle, $chunksize);
						$arrayData = explode(';',$buffer);
						$imdb = '';
						$country = 'United States';
						$idDisc = '';
						$type = 'FOLDER';
						$idDisc = '';
						$name = '';
						$season = '';
						$episodes = '';
						$source = '';
						foreach($arrayData as $data)
						{
							$currentData = explode('=',$data);
	
							if(count($currentData) == 2)
							{
								$key = trim($currentData[0]);
								$value = trim($currentData[1]);
									
								if(strtoupper($key) == 'IMDB')
									$imdb = $value;
	
								if(strtoupper($key) == 'TYPE')
									$type = strtoupper($value);
	
								if(strtoupper($key) == 'COUNTRY')
									$country = $value;
	
								if(strtoupper($key) == 'NAME')
									$name = $value;
								
								if(strtoupper($key) == 'SEASON')
									$season = (int)$value;
								
								if(strtoupper($key) == 'EPISODE')
									$episodes = $value;
								
								if(strtoupper($key) == 'SOURCE')
									$source = $value;
							}
						}
	
						$path = $file->getPath();
						if($type == 'ISO')
						{
							foreach (new DirectoryIterator($file->getPath()) as $fileInfo) {
								if(!$fileInfo->isDir() && pathinfo($fileInfo->getFilename(), PATHINFO_EXTENSION) == 'iso')
								{
									$path .= '/'. $fileInfo->getFilename();
									break;
								}
							}
						}
	
						if(empty($idDisc))
							$idDisc = uniqid();
											
						$modelLocalFolderDB = LocalFolder::model()->findByAttributes(array('path'=>$path));
						
						if(!empty($imdb) && !isset($modelLocalFolderDB))
						{
							if(self::saveByImdb($imdb, $country, $type, $idDisc, $name, $season, $episodes))
							{								
								$modelLocalFolder = new LocalFolder();
								$modelLocalFolder->Id_my_movie_disc = $idDisc;
								switch ($type) {
									case "FOLDER":
										$modelLocalFolder->Id_file_type = 1;
										break;
									case "ISO":
										$modelLocalFolder->Id_file_type = 2;
										break;
									case "MKV":
										$modelLocalFolder->Id_file_type = 3;
										break;
								}
								
								switch ($source) {
									case "BLU-RAY":
										$modelLocalFolder->Id_source_type = 1;
										break;
									case "DVD":
										$modelLocalFolder->Id_source_type = 2;
										break;
									default:
										$modelLocalFolder->Id_source_type = null;
										break;
								}
																
								$modelLocalFolder->path = $path;
								$modelLocalFolder->save();
							}
						}
	
						ob_flush();
						flush();
					}
						
				}
			}			
		}
	}
	
	private function saveByImdb($imdb, $country, $type, $idDisc, $name, $season, $episodes)
	{
		$modelMyMovieDB = MyMovie::model()->findByAttributes(array('imdb'=>$imdb, 'type'=>'Blu-ray'));
		
		if(!isset($modelMyMovieDB))
		{
			$myMoviesAPI = new MyMoviesAPI();
			$response = $myMoviesAPI->SearchDiscTitleByIMDBId($imdb, $country);
			if(!empty($response) && (string)$response['status'] == 'ok')
			{
				$titles = $response->Titles;
				$idMyMovie = '';
				foreach($titles->children() as $title)
				{
					$idMyMovie = (string)$title['id'];
					if((string)$title['type'] == "Blu-ray")
						break;				
				}
			    		
				if(MyMovieHelper::saveMyMovieData($idMyMovie))
				{					
					
					$modelMyMovieDiscDB = MyMovieDisc::model()->findByPk($idDisc);
					
					if(!isset($modelMyMovieDiscDB))
					{
						$modelMyMovieDiscDB = new MyMovieDisc();
						$modelMyMovieDiscDB->Id = $idDisc;
						$modelMyMovieDiscDB->Id_my_movie = $idMyMovie;
						$modelMyMovieDiscDB->name = $name;
						if($modelMyMovieDiscDB->save())
						{
							$modelMyMovieDB = MyMovie::model()->findByPk($idMyMovie);
								
							if(isset($modelMyMovieDB->Id_my_movie_serie_header) && !empty($season) && !empty($episodes))
								MyMovieHelper::createSerieTreeByFolder($modelMyMovieDB->Id_my_movie_serie_header, $season, $episodes, $modelMyMovieDiscDB->Id);
							
							return true;
						}
					}
						
				}		    
			}
		}
		else
		{
			$modelMyMovieDiscDB = MyMovieDisc::model()->findByPk($idDisc);
				
			if(!isset($modelMyMovieDiscDB))
			{
				$modelMyMovieDiscDB = new MyMovieDisc();
				$modelMyMovieDiscDB->Id = $idDisc;
				$modelMyMovieDiscDB->Id_my_movie = $modelMyMovieDB->Id;
				$modelMyMovieDiscDB->name = $name;
				if($modelMyMovieDiscDB->save())
				{
					if(isset($modelMyMovieDB->Id_my_movie_serie_header) && !empty($season) && !empty($episodes))
						MyMovieHelper::createSerieTreeByFolder($modelMyMovieDB->Id_my_movie_serie_header, $season, $episodes, $modelMyMovieDiscDB->Id);
					
					return true;
				}
			}
		}
		
		return false;
	}
	
}