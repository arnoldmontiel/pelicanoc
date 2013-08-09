<?php
class ReadFolderHelper
{
	static public function scanDirectory($path)
	{
		//C:\Users\Wensel\Desktop\PelicanoStorage
		$sys = strtoupper(PHP_OS);
		
		
		if(substr($sys,0,3) == "WIN")
		{
			$WshShell = new COM('WScript.Shell');
			$oExec = $WshShell->Run(dirname(__FILE__).'/../commands/shell/scanDirectory -path '. $path, 0, false);
		}
		else
		{
			//exec(dirname(__FILE__).'/../commands/shell/downloadNzbFiles >/dev/null&');
			exec(dirname(__FILE__).'/../commands/shell/scanDirectory.sh -path '.$path);
		}
				
		
// 		$setting = Setting::getInstance();		
// 		$filesFolder = $setting->host_file_server . $setting->host_file_server_path; 
		
// 		$iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($filesFolder),
// 		RecursiveIteratorIterator::SELF_FIRST);
		
		
	}
	
	
}