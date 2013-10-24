<?php
class FolderCommand extends CConsoleCommand  {

	function actionCheckExternalStorage() 
	{				
		include dirname(__FILE__).'../../components/ReadFolderHelper.php';
		ReadFolderHelper::checkExternalStorage();
	}

	function actionProcessExternalStorage()
	{
		include dirname(__FILE__).'../../components/ReadFolderHelper.php';
		
		$_COMMAND_NAME = "processExternalStorage";		
		
		$modelCommandStatus = CommandStatus::model()->findByAttributes(array('command_name'=>$_COMMAND_NAME));
		
		if(isset($modelCommandStatus))
		{
			$modelCurrentES = CurrentExternalStorage::model()->findByAttributes(array('is_in'=>1));
			
			if(isset($modelCurrentES))
			{
				$modelCurrentES->state = 2;
				$modelCurrentES->save();
				
				self::generatePeliFiles($modelCurrentES->path);				
				self::copyExternalStorage($modelCurrentES->path);
				
				$setting = Setting::getInstance();
				$path = $setting->path_shared;
				$path = $path.'/pelicano/copied/';
				
				self::processPeliFileES($path);
				
				$modelCurrentES->state = 3;
				$modelCurrentES->save();
			}
		
			$modelCommandStatus->setBusy(false);
		}
	}	
	
	function actionScanDirectory($path) 
	{		
		$_COMMAND_NAME = "scanDirectory";		
	
		include dirname(__FILE__).'../../components/ReadFolderHelper.php';
		
		$modelCommandStatus = CommandStatus::model()->findByAttributes(array('command_name'=>$_COMMAND_NAME));
				
		if(isset($modelCommandStatus))
		{
			try 
			{
				$setting = Setting::getInstance();
				$path = $setting->path_shared;
				
				self::generatePeliFiles($path);				
				self::processPeliFile($path);				
				
				$modelCommandStatus->setBusy(false);				
			} 
			catch (Exception $e) 
			{				
				$modelCommandStatus->setBusy(false);
			}
		}
	}
	
	private function copyExternalStorage($sourcePath)
	{
		$setting = Setting::getInstance();
		$iterator = ReadFolderHelper::process_dir_peli($sourcePath,true);
		
		foreach ($iterator as $file)
		{
			$destination = $setting->path_shared;
			$source = $file['dirpath'];
			
			$source = str_replace(' ', '\ ', $source);
			$source = str_replace('(', '\(', $source);
			$source = str_replace(')', '\)', $source);
			
			$destination = str_replace(' ', '\ ', $destination);
			$destination = str_replace('(', '\(', $destination);
			$destination = str_replace(')', '\)', $destination);
			
			$modelPeliFile = self::getPeliFile($file);
			if(isset($modelPeliFile))
			{				
				$shortPath = self::getShortPath($destination, $file, $modelPeliFile);
			
				$modelLocalFolderDB = LocalFolder::model()->findByAttributes(array('path'=>$shortPath));
			
				if(!empty($modelPeliFile->imdb) && !isset($modelLocalFolderDB) && $modelPeliFile->imdb != 'tt0000000')
				{
					$destination = $destination.'/pelicano/copied/';
					exec("cp -fr ".$source . " " .$destination);
				}
			}			
		}
	}
	
	private function processPeliFileES($path)
	{
		try
		{
			$modelLote = new Lote();
			$iterator = ReadFolderHelper::process_dir_peli($path,true);
			$chunksize = 1*(1024*1024); // how many bytes per chunk
	
			//genero un nuevo lote
			$modelLote->save();
				
			foreach ($iterator as $file)
			{
					
				$modelPeliFile = self::getPeliFile($file);
				if(isset($modelPeliFile))
				{
						
					$shortPath = self::getShortPath($path, $file, $modelPeliFile);
					$shortPath = '/pelicano/copied/'.$shortPath;
					
					$modelLocalFolderDB = LocalFolder::model()->findByAttributes(array('path'=>$shortPath));
	
					if(!empty($modelPeliFile->imdb) && !isset($modelLocalFolderDB) && $modelPeliFile->imdb != 'tt0000000')
					{
						if(self::saveByImdb($modelPeliFile))
						{
							$modelLocalFolder = new LocalFolder();
							$modelLocalFolder->Id_my_movie_disc = $modelPeliFile->idDisc;
							$modelLocalFolder->Id_file_type = self::getFileType($modelPeliFile->type);
							$modelLocalFolder->Id_source_type = self::getSoruceType($modelPeliFile->source);
							$modelLocalFolder->Id_lote = $modelLote->Id;
							$modelLocalFolder->path = $shortPath;
							$modelLocalFolder->save();
						}
					}
	
				} //end if null
			}
			$modelLote->description = 'Successfull';
			$modelLote->save();
			return true;
		}
		catch (Exception $e)
		{
			$modelLote->description = 'Error: ' . $e->getMessage();
			$modelLote->save();
			return false;
		}
	
		return true;
	
	}
	
	private function processPeliFile($path)
	{		
		try 
		{
			$modelLote = new Lote();
			$iterator = ReadFolderHelper::process_dir_peli($path,true);
			$chunksize = 1*(1024*1024); // how many bytes per chunk
				
			//genero un nuevo lote
			$modelLote->save();
			
			foreach ($iterator as $file)
			{
					
				$modelPeliFile = self::getPeliFile($file);
				if(isset($modelPeliFile)) 
				{
			
					$shortPath = self::getShortPath($path, $file, $modelPeliFile);
		
					$modelLocalFolderDB = LocalFolder::model()->findByAttributes(array('path'=>$shortPath));
						
					if(!empty($modelPeliFile->imdb) && !isset($modelLocalFolderDB) && $modelPeliFile->imdb != 'tt0000000')
					{
						if(self::saveByImdb($modelPeliFile))
						{
							$modelLocalFolder = new LocalFolder();
							$modelLocalFolder->Id_my_movie_disc = $modelPeliFile->idDisc;
							$modelLocalFolder->Id_file_type = self::getFileType($modelPeliFile->type);
							$modelLocalFolder->Id_source_type = self::getSoruceType($modelPeliFile->source);
							$modelLocalFolder->Id_lote = $modelLote->Id;
							$modelLocalFolder->path = $shortPath;
							$modelLocalFolder->save();
						}
					}
						
				} //end if null
			}			
			$modelLote->description = 'Successfull';
			$modelLote->save();
			return true;			
		} 
		catch (Exception $e) 
		{
			$modelLote->description = 'Error: ' . $e->getMessage();
			$modelLote->save();
			return false;			
		}
		
		return true;
		
	}
	
	private function getShortPath($path, $file, $modelPeliFile)
	{		
		$shortPath = str_replace($path,'',$file['dirpath']);
		if($modelPeliFile->type == 'ISO' || 
			$modelPeliFile->type == 'MKV' || 
			$modelPeliFile->type == 'MP4' || 
			$modelPeliFile->type == 'AVI')
		{
			foreach (new DirectoryIterator($file['dirpath']) as $fileInfo) {
				if(!$fileInfo->isDir() && (pathinfo($fileInfo->getFilename(), PATHINFO_EXTENSION) == 'iso' ||
				pathinfo($fileInfo->getFilename(), PATHINFO_EXTENSION) == 'mkv' ||
				pathinfo($fileInfo->getFilename(), PATHINFO_EXTENSION) == 'mp4' ||
				pathinfo($fileInfo->getFilename(), PATHINFO_EXTENSION) == 'avi'))
				{
					$shortPath .= '/'. $fileInfo->getFilename();
					break;
				}
			}
		}
		return $shortPath;	
	}
	
	private function getPeliFile($file)
	{
		$modelPeliFile = null;
			
		if(pathinfo($file['dirpath'].$file['filename'], PATHINFO_EXTENSION) == 'peli') 
		{		
			$handle = fopen($file['dirpath'].'/'.$file['filename'], 'rb');
			if ($handle === false) {
				return $modelPeliFile;
			}
			
			$chunksize = 1*(1024*1024); // how many bytes per chunk
			while (!feof($handle)) 
			{
				$buffer = fread($handle, $chunksize);
				$arrayData = explode(';',$buffer);
				
				$modelPeliFile = new PeliFile();
				
				foreach($arrayData as $data)
				{
					$currentData = explode('=',$data);
						
					if(count($currentData) == 2)
					{
						$key = trim($currentData[0]);
						$value = trim($currentData[1]);
							
						if(strtoupper($key) == 'IMDB')
							$modelPeliFile->imdb = $value;
							
						if(strtoupper($key) == 'TYPE')
							$modelPeliFile->type = strtoupper($value);
							
						if(strtoupper($key) == 'COUNTRY')
							$modelPeliFile->country = $value;
							
						if(strtoupper($key) == 'NAME')
							$modelPeliFile->name = $value;
							
						if(strtoupper($key) == 'SEASON')
							$modelPeliFile->season = (int)$value;
							
						if(strtoupper($key) == 'EPISODE')
							$modelPeliFile->episodes = $value;
							
						if(strtoupper($key) == 'SOURCE')
							$modelPeliFile->source = strtoupper($value);
					}
				}
				flush();
			}
		}
		
		if(empty($modelPeliFile->idDisc))
			$modelPeliFile->idDisc = uniqid();
		
		return $modelPeliFile;
	}
	
	private function generatePeliFiles($path)
	{
		
		$videoIterator = ReadFolderHelper::process_dir_video($path,true);
		
		if($videoIterator)
		{
			foreach ($videoIterator as $file)
			{
				$subIterator = ReadFolderHelper::process_dir_peli($file['dirpath'], true);
				$hasPeliFile = false;
				foreach ($subIterator as $fileSubIterator)
				{
					if(pathinfo($fileSubIterator['dirpath'].$fileSubIterator['filename'], PATHINFO_EXTENSION) == 'peli')
					{
						$hasPeliFile = true;
						break;
					}
				}
				$folderName = basename(dirname($file['dirpath'].'/'.$file['filename']));
		
				$type = ($file['filename']=='folder')?'folder':pathinfo($file['dirpath'].$file['filename'], PATHINFO_EXTENSION);
		
				if(!$hasPeliFile)
					self::buildPeliFile($folderName, $file['dirpath'], $type);
			}
		}
	}
	
	private function getFileType($type)
	{
		$idFileType = 1;
		
		switch ($type) {
			case "FOLDER":
				$idFileType = 1;
				break;
			case "ISO":
				$idFileType = 2;
				break;
			case "MKV":
				$idFileType = 3;
				break;
		}
		return $idFileType;		
	}
	
	private function getSoruceType($source)
	{
		$idSourceType = null;
		switch ($source) {
			case "BLU-RAY":
				$idSourceType = 1;
				break;
			case "DVD":
				$idSourceType = 2;
				break;
			default:
				$idSourceType = null;
			break;
		}
		
		return $idSourceType;
	}
	
	
	private function buildPeliFile($folderName, $path, $type)
	{
		
		$myMoviesAPI = new MyMoviesAPI();
		$response = $myMoviesAPI->SearchDiscTitleByTitle($folderName);
		if(!empty($response) && (string)$response['status'] == 'ok')
		{
			$titles = $response->Titles;		
			foreach($titles->children() as $title)
			{
				$idImdb = (string)$title['imdb'];
				if($idImdb == 'tt0000000')
					continue;
				
				$originalTitle = (string)$title['originalTitle'];
				try {
					
				
					$fp = @fopen($path.'/pelicano.peli', 'w');
					if(isset($fp))
					{
						$content = 'imdb='.$idImdb.";\n";
						$content .= 'type='.$type.";\n";
						$content .= 'name='.$originalTitle.';';
						
						@fwrite($fp, $content);
						@fclose($fp);
					}
				} catch (Exception $e) {
					break;
				}
				break;
			}
		}
	}
	
	private function saveByImdb($modelPeliFile)
	{
		$modelMyMovieDB = MyMovie::model()->findByAttributes(array('imdb'=>$modelPeliFile->imdb, 'type'=>'Blu-ray'));
		
		if(!isset($modelMyMovieDB))
		{
			$myMoviesAPI = new MyMoviesAPI();
			$response = $myMoviesAPI->SearchDiscTitleByIMDBId($modelPeliFile->imdb, $modelPeliFile->country);
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
					
					$modelMyMovieDiscDB = MyMovieDisc::model()->findByPk($modelPeliFile->idDisc);
					
					if(!isset($modelMyMovieDiscDB))
					{
						$modelMyMovieDiscDB = new MyMovieDisc();
						$modelMyMovieDiscDB->Id = $modelPeliFile->idDisc;
						$modelMyMovieDiscDB->Id_my_movie = $idMyMovie;
						$modelMyMovieDiscDB->name = $modelPeliFile->name;
						if($modelMyMovieDiscDB->save())
						{
							$modelMyMovieDB = MyMovie::model()->findByPk($idMyMovie);
								
							if(isset($modelMyMovieDB->Id_my_movie_serie_header) && !empty($modelPeliFile->season) && !empty($modelPeliFile->episodes))
								MyMovieHelper::createSerieTreeByFolder($modelMyMovieDB->Id_my_movie_serie_header, $modelPeliFile->season, $modelPeliFile->episodes, $modelMyMovieDiscDB->Id);
							
							return true;
						}
					}
						
				}		    
			}
		}
		else
		{
			$modelMyMovieDiscDB = MyMovieDisc::model()->findByPk($modelPeliFile->idDisc);
				
			if(!isset($modelMyMovieDiscDB))
			{
				$modelMyMovieDiscDB = new MyMovieDisc();
				$modelMyMovieDiscDB->Id = $modelPeliFile->idDisc;
				$modelMyMovieDiscDB->Id_my_movie = $modelMyMovieDB->Id;
				$modelMyMovieDiscDB->name = $modelPeliFile->name;
				if($modelMyMovieDiscDB->save())
				{
					if(isset($modelMyMovieDB->Id_my_movie_serie_header) && !empty($modelPeliFile->season) && !empty($modelPeliFile->episodes))
						MyMovieHelper::createSerieTreeByFolder($modelMyMovieDB->Id_my_movie_serie_header, $modelPeliFile->season, $modelPeliFile->episodes, $modelMyMovieDiscDB->Id);
					
					return true;
				}
			}
		}
		
		return false;
	}
}