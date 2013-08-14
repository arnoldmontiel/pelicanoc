<?php
class ReadFolderHelper
{
	
	static public function process_dir($dir,$recursive = FALSE) 
	{
		if (is_dir($dir)) {
			for ($list = array(),$handle = opendir($dir); (FALSE !== ($file = readdir($handle)));) {
				if (($file != '.' && $file != '..') && (is_readable($dir.'/'.$file)) && (file_exists($path = $dir.'/'.$file))) {
					if (is_dir($path) && ($recursive)) {
						$list = array_merge($list, self::process_dir($path, TRUE));
					} else {
						$entry = array('filename' => $file, 'dirpath' => $dir);
	
						//---------------------------------------------------------//
						//                     - SECTION 1 -                       //
						//          Actions to be performed on ALL ITEMS           //
						//-----------------    Begin Editable    ------------------//
	
						$entry['modtime'] = filemtime($path);
	
						//-----------------     End Editable     ------------------//
						do if (!is_dir($path)) {
							//---------------------------------------------------------//
							//                     - SECTION 2 -                       //
							//         Actions to be performed on FILES ONLY           //
							//-----------------    Begin Editable    ------------------//
	
							$entry['size'] = filesize($path);
							if (strstr(pathinfo($path,PATHINFO_BASENAME),'log')) {
								if (!$entry['handle'] = fopen($path,r)) $entry['handle'] = "FAIL";
							}
	
							//-----------------     End Editable     ------------------//
							break;
						} else {
							//---------------------------------------------------------//
							//                     - SECTION 3 -                       //
							//       Actions to be performed on DIRECTORIES ONLY       //
							//-----------------    Begin Editable    ------------------//
	
							//-----------------     End Editable     ------------------//
							break;
						} while (FALSE);
						$list[] = $entry;
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