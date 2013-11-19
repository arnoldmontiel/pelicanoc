<?php
class FolderCommand extends CConsoleCommand  {

	function actionCheckExternalStorage() 
	{				
		include dirname(__FILE__).'../../components/ReadFolderHelper.php';
		ReadFolderHelper::checkExternalStorage();
	}
	function actionAddedExternalStorage($label,$path)
	{
		include dirname(__FILE__).'../../components/ReadFolderHelper.php';
		ReadFolderHelper::addedExternalStorage($label,$path);
	}
	function actionRemovedExternalStorage()
	{
		include dirname(__FILE__).'../../components/ReadFolderHelper.php';
		ReadFolderHelper::removedExternalStorage();
	}
	
	function actionProcessExternalStorage()
	{
		include dirname(__FILE__).'../../components/ReadFolderHelper.php';
		include dirname(__FILE__).'../../components/PelicanoHelper.php';
		
		$_COMMAND_NAME = "processExternalStorage";
		
		$modelCommandStatus = CommandStatus::model()->findByAttributes(array('command_name'=>$_COMMAND_NAME));
		
		if(isset($modelCommandStatus))
		{
			$modelCurrentES = CurrentExternalStorage::model()->findByAttributes(array('state'=>2,
																						'is_in'=>1));
			if(isset($modelCurrentES)) //solo si algún CurrentES esta en modo copiando
			{
				self::processES();
				$modelCommandStatus->setBusy(false);
				$modelCurrentES->state = 3; //finish scan
				$modelCurrentES->save();
			}
		}
	}
	
	function actionProcessPeliFileES($idCurrentES)
	{
		include dirname(__FILE__).'../../components/ReadFolderHelper.php';
		include dirname(__FILE__).'../../components/PelicanoHelper.php';
			
		$modelCurrentES = CurrentExternalStorage::model()->findByAttributes(array('state'=>2,
																					'Id'=>$idCurrentES,
																						'is_in'=>1));
		if(isset($modelCurrentES)) //solo si algún CurrentES esta en modo copiando
		{
			$criteria = new CDbCriteria();
			$criteria->join = 'INNER JOIN current_external_storage ces ON (ces.Id = t.Id_current_external_storage)';
			$criteria->addCondition('t.status <> 3');
			$criteria->addCondition('t.copy = 1');
			$criteria->addCondition('t.Id_local_folder is null');
			$criteria->addCondition('ces.Id = '.$idCurrentES);
			$criteria->addCondition('ces.is_in = 1');
			
			$modelESDatas = ExternalStorageData::model()->findAll($criteria);
			
			foreach($modelESDatas as $modelESData)
				self::processPeliFileES($modelESData);			
		}
	}
	
	function actionGeneratePeliFilesES($idCurrentES)
	{
	
		include dirname(__FILE__).'../../components/ReadFolderHelper.php';
	
		try
		{
			$modelCurrentES = CurrentExternalStorage::model()->findByAttributes(array('Id'=>$idCurrentES,
																							'state'=>4,
																							'hard_scan_ready'=>0, 
																							'is_in'=>1));
	
			if(isset($modelCurrentES)) //solo si esta en modo scan
			{		
				self::generatePeliFilesES($modelCurrentES->path, $modelCurrentES->Id);
				$modelCurrentES->hard_scan_ready = 1;
				$modelCurrentES->state = 5;
				$modelCurrentES->save();
			}
		}
		catch (Exception $e)
		{
			Log::logger("ERROR GeneratePeliFilesES: ".$e->getMessage());
		}
	
	}
	
	function actionScanExternalStorage($idCurrentES)
	{
		
		include dirname(__FILE__).'../../components/ReadFolderHelper.php';
				
		try
		{
			$modelCurrentES = CurrentExternalStorage::model()->findByAttributes(array('Id'=>$idCurrentES,
																						'soft_scan_ready'=>0, 
																						'is_in'=>1));
				
			if(isset($modelCurrentES))
			{				
				self::scanES($modelCurrentES->path, $modelCurrentES->Id);
				$modelCurrentES->soft_scan_ready = 1;
				$modelCurrentES->save();
			}		
		}
		catch (Exception $e)
		{
			Log::logger("ERROR ScanExternalStorage: ".$e->getMessage());
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
	
	private function processES()
	{
		
		$criteria = new CDbCriteria();
		$criteria->join = 'INNER JOIN current_external_storage ces ON (ces.Id = t.Id_current_external_storage)';
		$criteria->addCondition('t.status <> 3');
		$criteria->addCondition('t.copy = 1');
		$criteria->addCondition('ces.is_in = 1');
		
		$modelESData = ExternalStorageData::model()->find($criteria);

		if(isset($modelESData))
		{
			$modelESData->status = 2; //start copy
			$modelESData->save();
			
			$idLocalFolder = $modelESData->Id_local_folder;
			$modelLocalFolder = LocalFolder::model()->findByPk($idLocalFolder);

			if(isset($modelLocalFolder))
			{
				if(self::copyExternalStorage($modelESData))
				{
					$modelESDataDB = ExternalStorageData::model()->findByPk($modelESData->Id);
					if(isset($modelESDataDB))
					{
						if($modelESDataDB->status == 5) //canceled copy
						{
							if($modelESDataDB->already_exists == 1)
							{
								$modelLocalFolder->ready = 1;
								$modelLocalFolder->save();
							}
							else
							{
								PelicanoHelper::eraseResource($modelLocalFolder->path);
								LocalFolder::model()->deleteByPk($modelLocalFolder->Id);
							}
							
							
							$modelESData->status = 7;
							$modelESData->copy = 0;
							$modelESData->save();
						}
						else //termino todo bien!
						{
							$modelLocalFolder->ready = 1;
							$modelLocalFolder->save();
						
							$modelESData->status = 3; //finish copy
							$modelESData->save();
						}
					}
				}
				else 
				{
					PelicanoHelper::eraseResource($modelLocalFolder->path);
					LocalFolder::model()->deleteByPk($modelLocalFolder->Id);
					
					$modelESData->status = 4; //error on copy
					$modelESData->copy = 0;
					$modelESData->save();
				}
					
				self::processES();
			}
		}
	}
	
	private function copyExternalStorage($modelESData)
	{		
		$success = false;
		if(isset($modelESData))
		{
			$externalStoragePath = (isset($modelESData->currentExternalStorage))?$modelESData->currentExternalStorage->path:null;
			if(isset($externalStoragePath))
			{
				
				$setting = Setting::getInstance();
				$destinationPath = $setting->path_shared.$setting->path_shared_pelicano_root. $setting->path_shared_copied.'/';
				
				$finalPath = $setting->path_shared_pelicano_root. $setting->path_shared_copied;
				
				$copiedPath = self::getCopiedPath($modelESData);
				$localFolderPath = $finalPath .$copiedPath; 
				
				
				$source = $externalStoragePath . $modelESData->path;
				
				$source = ReadFolderHelper::scapePath($source);
				$destinationPath = ReadFolderHelper::scapePath($destinationPath);
				
				$sys = strtoupper(PHP_OS);
				
				if(substr($sys,0,3) == "WIN")
				{
					$destinationPath = $setting->path_shared.$setting->path_shared_pelicano_root. $setting->path_shared_copied .$modelESData->path."\\";
					$destinationPath = str_replace('/','\\',$destinationPath);	
					$source = $externalStoragePath . $modelESData->path;
					$source = str_replace('/','\\',$source);
					exec('xcopy "'.$source.'" "'.$destinationPath.'" /y/s/r');
					$success = true;
				}
				else
				{
					exec("cp -fr ".$source . " " .$destinationPath, $output, $return_var);
					if($return_var == 0)
						$success = true;
				}
				
				
			}
		}
		return $success;
	}
	
	private function processPeliFileES($modelESData)
	{
		$idLocalFolder = 0;
		try
		{
			if(isset($modelESData))
			{
				$externalStoragePath = (isset($modelESData->currentExternalStorage))?$modelESData->currentExternalStorage->path:null;
				if(isset($externalStoragePath))
				{
					$setting = Setting::getInstance();					
					$modelLote = new Lote();
					
					//genero un nuevo lote
					$modelLote->save();
					
					$modelPeliFile = new PeliFile();
					$modelPeliFile->idDisc = uniqid();
					$modelPeliFile->imdb = $modelESData->imdb;
					$modelPeliFile->type = $modelESData->type;

					$finalPath = $setting->path_shared_pelicano_root. $setting->path_shared_copied;
					$localFolderPath = $finalPath . self::getCopiedPath($modelESData);
						
					$modelLocalFolderDB = LocalFolder::model()->findByAttributes(array('path_original'=>$localFolderPath));
					
					if(!isset($modelLocalFolderDB))
					{
						if(self::saveByImdb($modelPeliFile))
						{
							$paths = explode('/',$modelESData->path); 
							$newPath = $paths[count($paths)-1];
							
							$modelLocalFolder = new LocalFolder();
							$modelLocalFolder->Id_my_movie_disc = $modelPeliFile->idDisc;
							$modelLocalFolder->Id_file_type = self::getFileType($modelPeliFile->type);
							$modelLocalFolder->Id_source_type = self::getSoruceType($modelPeliFile->source);
							$modelLocalFolder->Id_lote = $modelLote->Id;							
							$modelLocalFolder->ready = 0;
							$modelLocalFolder->path = $finalPath.'/'.$newPath;
							$modelLocalFolder->path_original = $localFolderPath;
							if($modelLocalFolder->save())
								$idLocalFolder = $modelLocalFolder->Id;
						}
					}
					else
					{
						if(self::saveByImdb($modelPeliFile))
						{
							$modelLocalFolderDB->Id_my_movie_disc = $modelPeliFile->idDisc;
							$modelLocalFolderDB->Id_file_type = self::getFileType($modelPeliFile->type);
							$modelLocalFolderDB->Id_source_type = self::getSoruceType($modelPeliFile->source);
							$modelLocalFolderDB->Id_lote = $modelLote->Id;
							$modelLocalFolderDB->ready = 0;
							if($modelLocalFolderDB->save())
								$idLocalFolder = $modelLocalFolderDB->Id; 
						}
					}
					
					if($idLocalFolder != 0)
					{
						$modelESData->Id_local_folder = $idLocalFolder;
						$modelESData->save();
					}
					
					$modelLote->description = 'Successfull';
					$modelLote->save();
					
					return $idLocalFolder;
				}
				$modelLote = new Lote();
				$modelLote->description = 'Error - NO External Storage';
				$modelLote->save();
				return 0;
			}			
			$modelLote = new Lote();
			$modelLote->description = 'Error - Model External Storage Data is NULL';
			$modelLote->save();
			return 0;
		}
		catch (Exception $e)
		{
			if(isset($modelLote))
			{
				$modelLote->description = 'Error: ' . $e->getMessage();
				$modelLote->save();
			}
			return 0;
		}
	
		return $idLocalFolder;
	
	}
	
	private function processPeliFile($path)
	{		
		try 
		{
			$setting = Setting::getInstance();
						
			$modelLote = new Lote();
			$iterator = ReadFolderHelper::getPeliDirectoryList($path, true, $path.$setting->path_shared_pelicano_root);
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
						
						if(strtoupper($key) == 'POSTER')
							$modelPeliFile->poster = strtoupper($value);
						
						if(strtoupper($key) == 'YEAR')
							$modelPeliFile->year = strtoupper($value);
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
		
		$videoIterator = ReadFolderHelper::getVideoDirectoryList($path,true);
		
		if($videoIterator)
		{
			foreach ($videoIterator as $file)
			{
				$subIterator = ReadFolderHelper::getPeliDirectoryList($file['dirpath'], true);
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
	
	private function generatePeliFilesES($pathES, $idCurrentES)
	{
		$modelESDatas = ExternalStorageData::model()->findAllByAttributes(array('Id_current_external_storage'=>$idCurrentES));
		
		foreach($modelESDatas as $modelESData)
		{
			//set status SCANING
			$modelESData->status = 6;
			$modelESData->save();
			
			$modelPeliFile = null;
			$workingPath = $pathES. $modelESData->path;
			$subIterator = ReadFolderHelper::getPeliDirectoryList($workingPath, true);
			$hasPeliFile = false;
			$folderName = basename($modelESData->path);
			
			foreach ($subIterator as $fileSubIterator)
			{
				if(pathinfo($fileSubIterator['dirpath'].$fileSubIterator['filename'], PATHINFO_EXTENSION) == 'peli')
				{
					$modelPeliFile = self::getPeliFile($fileSubIterator);
					$hasPeliFile = true;
					break;
				}
			}
						
			if(!$hasPeliFile)
			{
				if($modelESData->is_personal == 1)
					$modelPeliFile = self::buildPersonalPeliFileES($folderName, $workingPath, $modelESData->type);
				else
					$modelPeliFile = self::buildPeliFileES($folderName, $workingPath, $modelESData->type);
			}
			
			if(isset($modelPeliFile))
			{
				$modelESData->title = $modelPeliFile->name;
				$modelESData->year = $modelPeliFile->year;
				$modelESData->poster = $modelPeliFile->poster;
				$modelESData->imdb = $modelPeliFile->imdb;
				$modelESData->status = 7; // FINISH SCANING
				$modelESData->save();
			}
			
		}
		
	}
	
	private function scanES($pathES, $idCurrentES)
	{
	
		$videoIterator = ReadFolderHelper::getVideoDirectoryList($pathES,true);
	
		if($videoIterator)
		{
			foreach ($videoIterator as $file)
			{
				$modelPeliFile = null;
				$subIterator = ReadFolderHelper::getPeliDirectoryList($file['dirpath'], true);
				foreach ($subIterator as $fileSubIterator)
				{
					if(pathinfo($fileSubIterator['dirpath'].$fileSubIterator['filename'], PATHINFO_EXTENSION) == 'peli')
					{
						$modelPeliFile = self::getPeliFile($fileSubIterator);
						break;
					}
				}
	
				$type = ($file['filename']=='folder')?'folder':pathinfo($file['dirpath'].$file['filename'], PATHINFO_EXTENSION);
					
				$modelESData = new ExternalStorageData();					
				$modelESData->path = str_replace($pathES, '', $file['dirpath']);
				$modelESData->file = ($file['filename']=='folder')?'':$file['filename'];
				$modelESData->type = $type;
				$modelESData->Id_current_external_storage = $idCurrentES;
												
				$modelESDataDB = ExternalStorageData::model()->findByAttributes(array('path'=>$modelESData->path, 
																		'Id_current_external_storage'=>$idCurrentES));
				if(!isset($modelESDataDB))
				{
					if(isset($modelPeliFile))
					{						
						$modelESData->title = $modelPeliFile->name;
						$modelESData->year = $modelPeliFile->year;
						$modelESData->poster = $modelPeliFile->poster;
						$modelESData->imdb = $modelPeliFile->imdb;
						
						$exists = ReadFolderHelper::alreadyExists($modelESData);
						$alreadyExists = ($exists)?1:0;
						$modelESData->already_exists = $alreadyExists;
						
						if(empty($modelESData->imdb))
							$modelESData->is_personal = 1;
					}
					
					$modelESData->save();
					
				}				
				else //si ya existe en la base ese path tengo q fijarme cual archivo es mas grande
				{
					if(!empty($modelESData->file) && !empty($modelESDataDB->file))
					{
						$basePath = $modelESDataDB->currentExternalStorage->path;
						$basePath .= $modelESDataDB->path;
						$sizeDB = self::getFileSize($basePath.'/'.$modelESDataDB->file);
						$sizeNew = self::getFileSize($basePath.'/'.$modelESData->file);
						
						if($sizeNew > $sizeDB)
						{
							$exists = ReadFolderHelper::alreadyExists($modelESData);
							$alreadyExists = ($exists)?1:0;
							
							$modelESDataDB->already_exists = $alreadyExists;							
							$modelESDataDB->file = $modelESData->file;
							$modelESDataDB->save();
						}
					}
				}
				
			}
		}
	}
	
	private function getFileSize($path)
	{
		$size = 0;
		
		$path = str_replace(' ', '\ ', $path);
		$path = str_replace('(', '\(', $path);
		$path = str_replace(')', '\)', $path);
		
		$output = exec('du -sk ' . $path);
		
		$size = trim(str_replace($path, '', $output)) * 1024;
		return $size;
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
	
	private function buildPeliFileES($folderName, $path, $type)
	{
		$modelPeliFile = new PeliFile();		
		
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
				$year = (string)$title['year'];
				$poster = (string)$title['bigthumbnail'];
				
				$modelPeliFile->name = $originalTitle;
				$modelPeliFile->imdb = $idImdb;
				$modelPeliFile->year = $year; 
				$modelPeliFile->poster = $poster; 
				try {
					
				
					$handle = @fopen($path.'/pelicano.peli', 'w');
					if($handle === false)
					{
						//error opening
						$modelPeliFile = null;
					}
					else
					{
						$content = 'imdb='.$idImdb.";\n";
						$content .= 'type='.$type.";\n";
						$content .= 'name='.$originalTitle.';';
						$content .= 'year='.$year.';';
						$content .= 'poster='.$poster.';';
						
						if (@fwrite($handle, $content) === FALSE) {
							$modelPeliFile = null;
						}
						
						@fclose($handle);
						
					}
					
				} catch (Exception $e) {
					$modelPeliFile = null;
					break;
				}
				break;
			}
		}
		else
		{
			$modelPeliFile->name = "Desconocido";
			$modelPeliFile->imdb = 'tt0000000';
			$modelPeliFile->year = "";
			$modelPeliFile->poster = "";
			try {
					
				$handle = @fopen($path.'/pelicano.peli', 'w');
				if($handle === false)
				{
					//error opening
					$modelPeliFile = null;
				}
				else
				{
					$content = 'imdb='.$modelPeliFile->imdb.";\n";
					$content .= 'type='.$type.";\n";
					$content .= 'name='.$modelPeliFile->name.';';
					$content .= 'year='.$modelPeliFile->year.';';
					$content .= 'poster='.$modelPeliFile->poster.';';
					
					if (@fwrite($handle, $content) === FALSE) {
						$modelPeliFile = null;
					}
					
					@fclose($handle);
				}
				
			} catch (Exception $e) {
				$modelPeliFile = null;
				break;
			}
		}
		return $modelPeliFile;
	}
	
	private function buildPersonalPeliFileES($folderName, $path, $type)
	{
		$modelPeliFile = new PeliFile();
			
		$modelPeliFile->name = $folderName;
		$modelPeliFile->imdb = "";
		$modelPeliFile->year = "";
		$modelPeliFile->poster = "";
		try {
				
			$handle = @fopen($path.'/pelicano.peli', 'w');
			if($handle === false)
			{
				//error opening
				$modelPeliFile = null;
			}
			else 
			{
				$content = 'imdb='.$modelPeliFile->imdb.";\n";
				$content .= 'type='.$type.";\n";
				$content .= 'name='.$modelPeliFile->name.';';
				$content .= 'year='.$modelPeliFile->year.';';
				$content .= 'poster='.$modelPeliFile->poster.';';
									
				
				if (@fwrite($handle, $content) === FALSE) {
					$modelPeliFile = null;
				}
				
				@fclose($handle);
			}
		} catch (Exception $e) {
			$modelPeliFile = null;
		}
		
		return $modelPeliFile;
	}
	
	private function saveByImdb($modelPeliFile)
	{
		if(empty($modelPeliFile->imdb) ||  $modelPeliFile->imdb == 'tt0000000') //me fijo si es personal o  tt0000000
		{
			$name = "Desconocido";
			if(empty($modelPeliFile->imdb))
				$name = $modelPeliFile->name;			
							
			$idMyMovie = MyMovieHelper::saveUnknownMyMovieData($name);
			
			$modelMyMovieDiscDB = MyMovieDisc::model()->findByPk($modelPeliFile->idDisc);
			if(!isset($modelMyMovieDiscDB))
			{
				$modelMyMovieDiscDB = new MyMovieDisc();
				$modelMyMovieDiscDB->Id = $modelPeliFile->idDisc;
			}
			
			$modelMyMovieDiscDB->Id_my_movie = $idMyMovie;
			$modelMyMovieDiscDB->name = $modelPeliFile->name;
			if($modelMyMovieDiscDB->save())
			{
		
				return true;
			}
		}
		else 
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
		}
		
		return false;
	}
	
	private function getCopiedPath($modelESData)
	{
		$path = "";
		if(isset($modelESData))
		{
			$path = $modelESData->path;
			if(!empty($modelESData->file))
				$path .= '/'.$modelESData->file;
		}
		return $path;
	}
}