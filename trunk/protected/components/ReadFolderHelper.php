<?php
class ReadFolderHelper
{

	static public function process_dir_video($dir,$recursive = FALSE)
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
							$list = array_merge($list, self::process_dir_video($path, TRUE));
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
	
	static public function process_dir_peli($dir,$recursive = FALSE) 
	{
		if (is_dir($dir)) {
			for ($list = array(),$handle = opendir($dir); (FALSE !== ($file = readdir($handle)));) {
				if (($file != '.' && $file != '..') && (is_readable($dir.'/'.$file)) && (file_exists($path = $dir.'/'.$file))) {
					if (is_dir($path) && ($recursive)) {
						$list = array_merge($list, self::process_dir_peli($path, TRUE));
					} else {
						
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
	
	static public function scanDirectory($path)
	{
		//C:\Users\Wensel\Desktop\PelicanoStorage
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
	
	
}