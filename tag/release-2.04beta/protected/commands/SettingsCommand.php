<?php
class SettingsCommand extends CConsoleCommand  {
	/*
	 * send heart beat to PelicanoM
	 */
	
	function actionHeartBeat() 
	{
		PelicanoHelper::heartBeat();
	}
	
	function actionUpdateCode()
	{
		exec("svn up", $output, $return_var);
		var_dump($return_var);
		var_dump($output);
	}
	
	function actionOpenConnections()
	{
	
		RipperHelper::setTunnelingPorts();
		return true;
	
	}
	
}
