<?php

class WsSettingsController extends Controller
{

	public function actions()
	{
		return array(
		            'wsdl'=>array(
		                'class'=>'CWebServiceAction',
		),
		);
	}

	/**
	 * Returns if was successful
	 * @param string version
	 * @param string file_name
	 * @param string download_link
	 * @return boolean result
	 * @soap
	 */
	public function updateAnydvd($version,$file_name,$download_link)
	{
		$_COMMAND_NAME = "downloadNzbFiles";
		
		$modelCommandStatus = CommandStatus::model()->findByAttributes(array('command_name'=>$_COMMAND_NAME));
		
		if(isset($modelCommandStatus))
		{
			if(!$modelCommandStatus->busy)
			{
		
				try {
					
					$anydvdVersion = new AnydvdVersion();
					$anydvdVersion->version = $version;
					$anydvdVersion->file_name = $file_name;
					$anydvdVersion->download_link = $download_link;
					$settings = Setting::getInstance();
					$anydvdVersion->save();
					if(substr($sys,0,3) == "WIN")
					{
						$WshShell = new COM('WScript.Shell');
						$oExec = $WshShell->Run(dirname(__FILE__).'/../commands/shell/updateAnydvd', 0, false);
					}
					else
					{
						exec(dirname(__FILE__).'/../commands/shell/updateAnydvd >/dev/null&');
					}
		
				} catch (Exception $e) {
					$modelCommandStatus->setBusy(false);
				}
			}
		}
		
		return true;
	}
	
}
