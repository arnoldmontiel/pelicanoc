<?php
class ReadFolderHelper
{

	static public function processExternalStorage($idCurrentES)
	{
		$_COMMAND_NAME = "processExternalStorage";
		
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
						$oExec = $WshShell->Run(dirname(__FILE__).'/../commands/shell/processExternalStorage -id '. $idCurrentES, 0, false);
					}
					else
					{						
						exec(dirname(__FILE__).'/../commands/shell/processExternalStorage.sh '.$idCurrentES.' >/dev/null&');
					}
				} catch (Exception $e) {
					$modelCommandStatus->setBusy(false);
				}
			}
		
		}
	}
	
	static public function scanExternalStorage($idCurrentES)
	{		
		try {			

			$modelCurrentES = CurrentExternalStorage::model()->findByPk($idCurrentES);
			if(isset($modelCurrentES) && $modelCurrentES->state != 4) // distinto de "on scan"
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
	
	static public function scanDirectory($path)
	{		
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
}