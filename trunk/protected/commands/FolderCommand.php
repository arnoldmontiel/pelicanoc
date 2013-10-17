<?php
class FolderCommand extends CConsoleCommand  {

	function actionCheckExternalStorage() 
	{				
		include dirname(__FILE__).'../../components/ReadFolderHelper.php';
		ReadFolderHelper::checkExternalStorage();
	}

	function actionCopyExternalStorage()
	{
		include dirname(__FILE__).'../../components/ReadFolderHelper.php';
		$modelCurrentES = CurrentExternalStorage::model()->findByAttributes(array('is_in'=>1));
		
		if(isset($modelCurrentES))
		{
			self::generatePeliFiles($modelCurrentES->path);
		}
		
		$modelCommandStatus->setBusy(false);
	}	
	
// 	function actionCopyPeliFiles($path)
// 	{		
// 		$setting = Setting::getInstance();
// 		$iterator = ReadFolderHelper::process_dir_peli($path,true);
		
// 		foreach ($iterator as $file)
// 		{			
// 			$destination = $setting->path_shared . DIRECTORY_SEPARATOR . str_replace($path,'',$file['dirpath']);
// 			$source = $file['dirpath'];			
// 			self::copyDirectory($source,$destination);			
// 		}
// 	}
	
// 	private function copyDirectory($sourceDir, $targetDir)
// 	{
//     	if (!file_exists($sourceDir)) return false;
//     	if (!is_dir($sourceDir)) return copy($sourceDir, $targetDir);
//     	if (!mkdir($targetDir)) return false;    
//     	foreach (scandir($sourceDir) as $item) {
//       		if ($item == '.' || $item == '..') continue;
// 			if (!self::copyDirectory($sourceDir.DIRECTORY_SEPARATOR.$item, $targetDir.DIRECTORY_SEPARATOR.$item)) return false;
//     	}
//     	return true;
//   	}
	
	function actionScanDirectory($path) 
	{		
		$_COMMAND_NAME = "scanDirectory";		
	
		include dirname(__FILE__).'../../components/ReadFolderHelper.php';
		
		$modelCommandStatus = CommandStatus::model()->findByAttributes(array('command_name'=>$_COMMAND_NAME));
		
		if(isset($modelCommandStatus))
		{
			try 
			{				
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
					
				if(pathinfo($file['dirpath'].$file['filename'], PATHINFO_EXTENSION) == 'peli') {
						
					$handle = fopen($file['dirpath'].'/'.$file['filename'], 'rb');
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
								$source = strtoupper($value);
							}
						}
			
						$shortPath = str_replace($path,'',$file['dirpath']);
						if($type == 'ISO' || $type == 'MKV' || $type == 'MP4' || $type == 'AVI')
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
			
						if(empty($idDisc))
							$idDisc = uniqid();
			
						$modelLocalFolderDB = LocalFolder::model()->findByAttributes(array('path'=>$shortPath));
							
						if(!empty($imdb) && !isset($modelLocalFolderDB) && $imdb != 'tt0000000')
						{
							if(self::saveByImdb($imdb, $country, $type, $idDisc, $name, $season, $episodes))
							{
								$modelLocalFolder = new LocalFolder();
								$modelLocalFolder->Id_my_movie_disc = $idDisc;
								$modelLocalFolder->Id_file_type = self::getFileType($type);
								$modelLocalFolder->Id_source_type = self::getSoruceType($source);
								$modelLocalFolder->Id_lote = $modelLote->Id;
								$modelLocalFolder->path = $shortPath;
								$modelLocalFolder->save();
							}
						}
			
						flush();
					}
						
				}
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