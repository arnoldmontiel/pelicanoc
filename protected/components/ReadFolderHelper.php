<?php
class ReadFolderHelper
{
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
						exec(dirname(__FILE__).'/../commands/shell/scanDirectory.sh -path '.$path);
					}
				} catch (Exception $e) {
					$modelCommandStatus->setBusy(false);
				}
			}
		
		}
		
	}
	
	
}