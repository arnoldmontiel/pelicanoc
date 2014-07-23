<?php
class ReadFolderHelper
{

	static public function cancelCopy($modelESData)
	{
		if(isset($modelESData))
		{
			$externalStoragePath = (isset($modelESData->currentExternalStorage))?$modelESData->currentExternalStorage->path:null;
			if(isset($externalStoragePath))
			{
				$source = escapeshellarg($externalStoragePath);

				$sys = strtoupper(PHP_OS);
				if(substr($sys,0,3) == "WIN")
				{
					$WshShell = new COM('WScript.Shell');
					$oExec = $WshShell->Run(dirname(__FILE__).'/../commands/shell/cancelCopying '. $source, 0, false);
				}
				else
				{
					exec(dirname(__FILE__).'/../commands/shell/cancelCopying.sh '.$source.' >/dev/null&');
				}
			}
		}
	}
	
	static public function processExternalStorage($idCurrentES)
	{
		$_COMMAND_NAME = "processExternalStorage";
		
		$modelCommandStatus = CommandStatus::model()->findByAttributes(array('command_name'=>$_COMMAND_NAME));
		
		if(isset($modelCommandStatus))
		{
			$sys = strtoupper(PHP_OS);
			
			$modelCurrentES = CurrentExternalStorage::model()->findByPk($idCurrentES);
			if(isset($modelCurrentES))
			{
				//grabo estado copiando..
				$modelCurrentES->state = 2;
				$modelCurrentES->save();
				
				if(substr($sys,0,3) == "WIN")
				{
					$WshShell = new COM('WScript.Shell');
					$oExec = $WshShell->Run(dirname(__FILE__).'/../commands/shell/processPeliFileES -idCurrentEs '. $idCurrentES, 0, false);
				}
				else
				{
					exec(dirname(__FILE__).'/../commands/shell/processPeliFileES.sh '.$idCurrentES.' >/dev/null&');
				}
			}
			
			if(!$modelCommandStatus->busy)
			{
				try 
				{
					$modelCommandStatus->setBusy(true);
					
					if(substr($sys,0,3) == "WIN")
					{
						$WshShell = new COM('WScript.Shell');
						$oExec = $WshShell->Run(dirname(__FILE__).'/../commands/shell/processExternalStorage', 0, false);
					}
					else
					{						
						exec(dirname(__FILE__).'/../commands/shell/processExternalStorage.sh >/dev/null&');
					}
					
				} catch (Exception $e) {
					$modelCommandStatus->setBusy(false);
				}
			}
		
		}
	}
	
	static public function generatePeliFilesES($idCurrentES)
	{
		try {
	
			$modelCurrentES = CurrentExternalStorage::model()->findByPk($idCurrentES);
			if(isset($modelCurrentES) && $modelCurrentES->state != 4 &&
			$modelCurrentES->hard_scan_ready == 0) // nunca fue escaneado y el estado no es escaneando
			{
				//grabo estado escaneando..
				$modelCurrentES->state = 4;
				$modelCurrentES->save();
	
				$sys = strtoupper(PHP_OS);
	
	
				if(substr($sys,0,3) == "WIN")
				{
					$WshShell = new COM('WScript.Shell');
					$oExec = $WshShell->Run(dirname(__FILE__).'/../commands/shell/generatePeliFilesES -idCurrentEs '. $idCurrentES, 0, false);
				}
				else
				{
					exec(dirname(__FILE__).'/../commands/shell/generatePeliFilesES.sh '.$idCurrentES.' >/dev/null&');
				}
			}
		} catch (Exception $e) {
	
		}
	
	}
	
	static public function scanExternalStorage($idCurrentES)
	{		
		try {			

			$modelCurrentES = CurrentExternalStorage::model()->findByPk($idCurrentES);
			if(isset($modelCurrentES)) 
			{
				
				$sys = strtoupper(PHP_OS);
	
	
				if(substr($sys,0,3) == "WIN")
				{
					$WshShell = new COM('WScript.Shell');						
					$oExec = $WshShell->Run(dirname(__FILE__).'/../commands/shell/scanExternalStorage -idCurrentEs '. $idCurrentES, 0, false);
				}
				else
				{
					exec(dirname(__FILE__).'/../commands/shell/scanExternalStorage.sh '.$idCurrentES.' >/dev/null&');
				}
			}
		} catch (Exception $e) {
						
		}
		
	}
	
	static public function scanDirectory()
	{		
		$path = '';
		$_COMMAND_NAME = "scanDirectory";
		
		$modelCommandStatus = CommandStatus::model()->findByAttributes(array('command_name'=>$_COMMAND_NAME));
		
		if(isset($modelCommandStatus))
		{
			if(!$modelCommandStatus->busy)
			{
				try {
					$modelCommandStatus->setBusy(true);
					
					$sys = strtoupper(PHP_OS);
					
					
					if(substr($sys,0,3) == "WIN")
					{
						$WshShell = new COM('WScript.Shell');
						$oExec = $WshShell->Run(dirname(__FILE__).'/../commands/shell/scanDirectory -path '. $path, 0, false);
					}
					else
					{
						//exec(dirname(__FILE__).'/../commands/shell/downloadNzbFiles >/dev/null&');
						exec(dirname(__FILE__).'/../commands/shell/scanDirectory.sh '.$path. ' >/dev/null&');
					}
				} catch (Exception $e) {
					$modelCommandStatus->setBusy(false);
				}
			}
		
		}
		
	}
	
	static public function addedExternalStorage($label,$path)
	{
		try {
			$currentExternalStorage =  new CurrentExternalStorage;
			$currentExternalStorage->is_in = 1;
			$currentExternalStorage->path = $path;
			$currentExternalStorage->label = "USB ".str_replace ("_"," ", $label);
			$currentExternalStorage->save();
				
		} catch (Exception $e) {
			var_dump($e);
		}
	}
	static public function removedExternalStorage()
	{
		$folders = glob("/media/*usb*");
		foreach ($folders as $folder)
		{
			if(is_dir($folder))
			{
				//echo "folder: ".$folder."\n";
				$files = glob($folder."/*");
				$isEmpty = empty($files);
				if($isEmpty)
				{
					$current = CurrentExternalStorage::model()->findByAttributes(array('is_in'=>1,'path'=>$folder));
					if(isset($current))
					{
						//TODO falta eliminar los registros de external_storage_data
						$criteria = new CDbCriteria();
						$criteria->join = "INNER JOIN current_external_storage ces ON (ces.Id = t.Id_current_external_storage)";
						$criteria->addCondition('t.Id_current_external_storage = '. $current->Id);
						$criteria->addCondition('ces.is_in = 1');
						$criteria->addCondition('t.copy = 1');
						$criteria->addCondition('t.Id_local_folder is not null');
						
						$modelESDatas = ExternalStorageData::model()->findAll($criteria);
						if(count($modelESDatas)>0)
						{
							foreach($modelESDatas as $modelESData)
							{
								if($modelESData->localFolder->ready == 0)
								{
									PelicanoHelper::eraseResource($modelESData->localFolder->path);
									LocalFolder::model()->deleteByPk($modelESData->Id_local_folder);
									$modelESData->Id_local_folder = null;
								}
								$modelESData->status = 4; //error on copy
								$modelESData->copy = 0;
								$modelESData->save();
							}
						}
						
						CurrentExternalStorage::model()->updateAll(array('is_in'=>0,'out_date'=>new CDbExpression('NOW()')),'is_in=1 and path="'.$folder.'"');
						
					}
				}				
			}
		}		
		
	}
	static public function checkExternalStorage()
	{
		$folders = glob("/media/*usb*");
		foreach ($folders as $folder)
		{
			if(is_dir($folder))
			{
				//echo "folder: ".$folder."\n";
				$files = glob($folder."/*");
				$isEmpty = empty($files);
				if(!$isEmpty)
				{
					$current = CurrentExternalStorage::model()->findByAttributes(array('is_in'=>1,'path'=>$folder));
					if(!isset($current))
					{
						//CurrentExternalStorage::model()->updateAll(array('is_in'=>0,'out_data'=>'now()'),'is_in=1 and path="'.$folder.'"');
						$currentExternalStorage =  new CurrentExternalStorage;
						$currentExternalStorage->is_in = 1;
						$currentExternalStorage->path = $folder;
						$currentExternalStorage->save();						
					}
				}
				else if($isEmpty)
				{
					$current = CurrentExternalStorage::model()->findByAttributes(array('is_in'=>1,'path'=>$folder));
					if(isset($current))
					{
						//TODO falta eliminar los registros de external_storage_data
						CurrentExternalStorage::model()->updateAll(array('is_in'=>0,'out_date'=>new CDbExpression('NOW()')),'is_in=1 and path="'.$folder.'"');						
					}
				}				
			}
		}		
	}
	
	static public function rebuildPeliFileES($modelESData)
	{
		if(isset($modelESData))
		{
			$path = $modelESData->currentExternalStorage->path;
			$path .= $modelESData->path;
			try {
				$fp = @fopen($path.'/pelicano.peli', 'w');
				if(isset($fp))
				{
					$content = 'imdb='.$modelESData->imdb.";\n";
					$content .= 'type='.$modelESData->type.";\n";
					$content .= 'name='.$modelESData->title.';';
					$content .= 'year='.$modelESData->year.';';
					$content .= 'poster=;';
			
					@fwrite($fp, $content);
					@fclose($fp);
				}
			} catch (Exception $e) {
				
			}
		}
	}
	
	static public function getVideoDirectoryList($dir,$recursive = FALSE)
	{
		if (is_dir($dir)) {
			for ($list = array(),$handle = opendir($dir); (FALSE !== ($file = readdir($handle)));) {
				if (($file != '.' && $file != '..') && (is_readable($dir.'/'.$file)) && (file_exists($path = $dir.'/'.$file))) {
					if (is_dir($path) && ($recursive))
					{
						if(strstr($file,'BDMV')!=false)
						{
							$entry = array('filename' => 'folder', 'dirpath' => $dir);
							$list[] = $entry;
						}
						else
						$list = array_merge($list, self::getVideoDirectoryList($path, TRUE));
					}
					else
					{
						$extension = strtoupper(pathinfo($dir.$file, PATHINFO_EXTENSION));
						if($extension == 'ISO' || $extension == 'MKV' || $extension == 'MP4' || $extension == 'AVI')
						{
							$entry = array('filename' => $file, 'dirpath' => $dir);
							$entry['modtime'] = filemtime($path);
							$list[] = $entry;
						}
					}
				}
			}
			closedir($handle);
			return $list;
		}
		else
		return false;
	}
	
	static public function getPeliDirectoryList($dir,$recursive = FALSE, $excluded = '')
	{
		if (is_dir($dir)) {
			for ($list = array(),$handle = opendir($dir); (FALSE !== ($file = readdir($handle)));) {
				if (($file != '.' && $file != '..') && (is_readable($dir.'/'.$file)) && (file_exists($path = $dir.'/'.$file))) {					
					if(!empty($excluded) && realpath($dir.'/'.$file) == realpath($excluded))
						continue;
					if (is_dir($path) && ($recursive))
					{
						$list = array_merge($list, self::getPeliDirectoryList($path, TRUE));
					}
					else
					{
						if((pathinfo($dir.$file, PATHINFO_EXTENSION) == 'peli'))
						{
							$entry = array('filename' => $file, 'dirpath' => $dir);
							$entry['modtime'] = filemtime($path);
							$list[] = $entry;
						}
					}
				}
			}
			closedir($handle);
			return $list;
		}
		else
		return FALSE;
	}
	
	static public function alreadyExists($modelESData)
	{
		$exists = false;
		
		$setting = Setting::getInstance();
		$localFolderPath = str_replace($modelESData->currentExternalStorage->path,'',$modelESData->path);
		$localFolderPath = $setting->path_shared_pelicano_root. $setting->path_shared_copied. $localFolderPath;
		
		if(!empty($modelESData->file))
			$localFolderPath = $localFolderPath.'/'.$modelESData->file;
			
		$modelLocalFolder = LocalFolder::model()->findByAttributes(array('path_original'=>$localFolderPath, 'ready'=>1));		
		
		if(isset($modelLocalFolder))
			$exists = true;
		
		return $exists;
	}
	
	static public function getTdAsocEnabled($modelESData)
	{
		$disabled = "disabled='disabled'";
		if(isset($modelESData))
		{
			if($modelESData->status != 6 && $modelESData->status != 1) //si no esta escaneando puedo saber el estado
			{
				if($modelESData->copy == 1)
				{
					$disabled = "disabled='disabled'";
				}
				else
				{
					$disabled = "";
				}
			}
		}
		return $disabled;
	}
	
	static public function getTdStatus($modelESData)
	{		
		$td = "<i class='fa fa-spinner fa-spin'></i> Analizando...";
		if(isset($modelESData))
		{
			if($modelESData->status != 6 && $modelESData->status != 1) //si no esta escaneando puedo saber el estado
			{
				if($modelESData->copy == 1)
				{
					if($modelESData->status == 3) //ya esta copiado listo para ver
						$td = "<i class='fa fa-check  fa-fw '></i> Importado";
					else
						$td = "<i class='fa fa-spinner fa-spin  fa-fw'></i> Importando...";
				}
				else 
				{
					if($modelESData->status == 4) //en el caso de error en el copiado
					{
						$td = "<i class='fa fa-ban fa-fw'></i> Error al copiar";
					}
					else
					{
						if($modelESData->already_exists == 1)
							$td = "<i class='fa fa-exclamation  fa-fw'></i> El archivo ya existe";
						else
							$td = "<i class='fa fa-circle-o  fa-fw'></i> Disponible";
					}
				}
			}			
		}
		return $td;
	}
	
	static public function getTdButton($modelESData)
	{
		$td = "<button type='button' class='btn btn-primary' disabled='disabled'>Analizando...</button>";
		if(isset($modelESData))
		{
			
			if($modelESData->status != 6 && $modelESData->status != 1) //si no esta escaneando puedo saber el estado
			{
				if($modelESData->copy == 1)
				{
					if($modelESData->status == 3) //ya esta copiado listo para ver
						$td = "<button type='button' onclick='playVideo(".$modelESData->Id.")' class='btn btn-default'><i class='fa fa-play fa-fw'></i> Ver Pel&iacute;cula</button>";
					else
						$td = "<button type='button' onclick='cancelCopy(".$modelESData->Id.")' class='btn btn-danger'><i class='fa fa-minus-circle fa-fw'></i> Cancelar</button>";					
				}
				else
				{					
					if($modelESData->status == 4) //en el caso de error en el copiado
					{
							$td = "<button type='button' alreadyexists=".$modelESData->already_exists." onclick='copyVideo(".$modelESData->Id.")' class='btn btn-default'><i class='fa fa-refresh fa-fw'></i> Reintentar</button>";
					}
					else 
					{
						if($modelESData->already_exists == 1)
							$td = "<button type='button' alreadyexists=".$modelESData->already_exists." onclick='copyVideo(".$modelESData->Id.")' class='btn btn-default'>Sobreescribir</button>";
						else
							$td = "<button type='button' alreadyexists=".$modelESData->already_exists." onclick='copyVideo(".$modelESData->Id.")' class='btn btn-primary'><i class='fa fa-download fa-fw'></i> Importar</button>";
					}
				}
			}
		}
		return $td;
	}
	
	static public function scapePath($path)
	{
		$scappedPath = str_replace(' ', '\ ', $path);
		$scappedPath = str_replace('(', '\(', $scappedPath);
		$scappedPath = str_replace(')', '\)', $scappedPath);
		$scappedPath = str_replace("'", "\'", $scappedPath);
		$scappedPath = str_replace(",", "\,", $scappedPath);
		
		return $scappedPath;
	}
}