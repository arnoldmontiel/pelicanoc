<?php
class OppoHelper
{

	static public function playFromPosition($position)
	{
		$modelDune = self::getState();
		
		if(isset($modelDune))
		{
			if($modelDune->playback_speed == 0)
				self::playBySpeed(); //play			
			
			$setting = Setting::getInstance();
			$cmd = 'set_playback_state&position='.$position;
			
			$url = $setting->players[0]->url . '/cgi-bin/do?cmd='.$cmd;
			@file_get_contents($url);
		}
		
		
		return true;
	}
	
	static public function playBySpeed()
	{
		$setting = Setting::getInstance();
		$cmd = 'set_playback_state&speed=256';
		
		$url = $setting->players[0]->url . '/cgi-bin/do?cmd='.$cmd;
		@file_get_contents($url);
		
		return true;
	}
	
	static public function pause()
	{
		$setting = Setting::getInstance();
		$cmd = 'set_playback_state&speed=0';
	
		$url = $setting->players[0]->url . '/cgi-bin/do?cmd='.$cmd;
		@file_get_contents($url);
	
		return true;
	}
	
	static public function playOppo($id,$path,$player)
	{
				
		$setting = Setting::getInstance();
		//login to samba server
		$params= array();
		$params['serverName'] = $setting->host_file_server;
		$params['userName'] = $setting->host_file_server_user;
		$params['psssword'] = $setting->host_file_server_passwd;
		$params['bRememberID'] = 1;		
		$url = $player->url .":436/loginSambaWithID?".json_encode($params);		
		@file_get_contents($url);
		
		//mounting samba path				
		$sharedPath = $setting->host_file_server_path;
		$sharedPath[]= explode('/', $setting->host_file_server_path);	
		$params= array();
		$params['folder'] = $sharedPath[0];
		$params['serverName'] = $setting->host_file_server;
		$params['userName'] = $setting->host_file_server_user;
		$params['psssword'] = $setting->host_file_server_passwd;
		$params['bRememberID'] = 1;
		$params['bWithID'] = 1;				
		$url = $player->url .":436/mountSharedFolder?".json_encode($params);
		@file_get_contents($url);
		
		//star movie				
		$sharedPath = $setting->host_file_server_path;
		$sharedPath[]= explode('/', $setting->host_file_server_path);
		$completePath="";
		if(count($sharedPath)>1)
		{
			for($i=1;$i<count($sharedPath);$i++)
			{
				$completePath.="/".$sharedPath[$i];				
			}
			
		}		
		$completePath.=$path;
		$params= array();
		$params['path'] = $completePath;
		$params['extraNetPath'] = $setting->host_file_server;
		$params['index'] = 0;
		$params['type'] = 1;
		$params['appDeviceType'] = 7;
		$url = $player->url .":436/playnormalfile?".json_encode($params);
		@file_get_contents($url);
		return true;
	}
	
	static public function playDuneOnline($id,$player)
	{
	
		$setting = Setting::getInstance();
	
		$cmd = 'launch_media_url';

		$url = $player->url . '/cgi-bin/do?cmd='.$cmd.'&media_url='.$player->file_protocol.':';
		$url = $url . '//'. $setting->shared_online_path;
		
		//TODO: analizar el resultado e indicar si la reproducción se ha concretado.
		@file_get_contents($url);
		return true;
	}
	
	static public function getProgressBar()
	{
		$progressBar = array('currentProgress'=>-1,
							'currentTime'=>gmdate("H:i:s",0),
							'totalTime'=>gmdate("H:i:s",0));		
		
		$modelDune = self::getState();
		
		if(isset($modelDune))
		{
			if(($modelDune->playback_state == "playing" || $modelDune->player_state == "bluray_playback")
				&& (int)$modelDune->playback_duration > 0)
			{
				$value = ((int)$modelDune->playback_position/(int)$modelDune->playback_duration) * 100;
				$progressBar['currentProgress'] = round($value);
				$progressBar['currentTime'] = gmdate("H:i:s",$modelDune->playback_position);
				$progressBar['totalTime'] = gmdate("H:i:s",$modelDune->playback_duration);
			}
		}
		
		return $progressBar;
	}
	static public function getProgressBarByPlayer($player)
	{
		$progressBar = array('currentProgress'=>-1,
				'currentTime'=>gmdate("H:i:s",0),
				'totalTime'=>gmdate("H:i:s",0));
	
		$modelDune = self::getStateByPlayer($player);
	
		if(isset($modelDune))
		{
			if(($modelDune->playback_state == "playing" || $modelDune->player_state == "bluray_playback")
			&& (int)$modelDune->playback_duration > 0)
			{
				$value = ((int)$modelDune->playback_position/(int)$modelDune->playback_duration) * 100;
				$progressBar['currentProgress'] = round($value);
				$progressBar['currentTime'] = gmdate("H:i:s",$modelDune->playback_position);
				$progressBar['totalTime'] = gmdate("H:i:s",$modelDune->playback_duration);
			}
		}
		return $progressBar;
	}
	
	static public function getPlaybackUrl()
	{
		$modelDune = self::getState();
		
		$playbackUrl = null;
		if(isset($modelDune))
		{
			if($modelDune->player_state == "file_playback" || 
			$modelDune->player_state == "dvd_playback" ||
			$modelDune->player_state == "bluray_playback")
			{
				$playbackUrl = $modelDune->playback_url;
			}
		}
		return $playbackUrl;
	}
	
	static public function setBlackScreen()
	{
		$setting = Setting::getInstance();		
		//echo file_get_contents( $setting->players[0]->url .'/cgi-bin/do?cmd=black_screen');
		echo file_get_contents( $setting->players[0]->url .'/cgi-bin/do?cmd=ir_code&ir_code=E619BF00');
	}
	
	
	
	static public function useRemote($irCode)
	{
		$setting = Setting::getInstance();
		echo file_get_contents( $setting->players[0]->url .'/cgi-bin/do?cmd=ir_code&ir_code='.$irCode);
	}
	
	static public function isPlayerAlive($player)
	{
		$url = $player->url .":436/getglobalinfo";
		$response = json_decode(file_get_contents($url));
		if(isset($response['success'])&&$response['success']==true)
		{
			return true;
		}
		return false;
		
	}
	static public function isPlaying()
	{
	}
	static public function isPlayingByPlayer($player)
	{		
		if(self::isPlayerAlive($player))
		{
			$player->has_error = 0;
			$player->save();
			PelicanoHelper::saveSystemStatus(1,0);		
		}
		else
		{
			$player->has_error = 1;
			$player->save();
			PelicanoHelper::saveSystemStatus(1,1);				
		}
		$url = $player->url .":436/getglobalinfo";
		$response = json_decode(file_get_contents($url));
		if(isset($response['is_video_playing'])&&$response['is_video_playing']==true)
		{
			return true;
		}
		return false;
	}
	
	static public function getState()
	{
		$modelDune = null;
		
		$setting = Setting::getInstance();
		$response = file_get_contents( $setting->players[0]->url .'/cgi-bin/do?cmd=status');
		$xml = simplexml_load_string($response);
		
		if(isset($xml))
		{
			$modelDune = new Dune();
			
			$param = $xml->xpath("//param[@name = 'playback_state']");
			if(!empty($param))
				$modelDune->playback_state = (string)$param[0]->attributes()->value;
			
			$param = $xml->xpath("//param[@name = 'playback_position']");
			
			if(!empty($param))
				$modelDune->playback_position = (string)$param[0]->attributes()->value;
				
			$param = $xml->xpath("//param[@name = 'playback_duration']");
			if(!empty($param))
				$modelDune->playback_duration = (string)$param[0]->attributes()->value;
			
			$param = $xml->xpath("//param[@name = 'playback_url']");
			if(!empty($param))
				$modelDune->playback_url = (string)$param[0]->attributes()->value;
			
			$param = $xml->xpath("//param[@name = 'playback_speed']");
			if(!empty($param))
				$modelDune->playback_speed = (string)$param[0]->attributes()->value;
			
			$param = $xml->xpath("//param[@name = 'playback_volume']");
			if(!empty($param))
				$modelDune->playback_volume = (string)$param[0]->attributes()->value;
			
			$param = $xml->xpath("//param[@name = 'player_state']");
			if(!empty($param))
				$modelDune->player_state = (string)$param[0]->attributes()->value;
		}	
		
		return $modelDune;
	}
	static public function getStateByPlayer($player)
	{
		$modelDune = null;
		$response = @file_get_contents( $player->url .'/cgi-bin/do?cmd=status');
	
		if($response===false)	return null;
		if($response=="")	return null;
		
		$xml = simplexml_load_string($response);
	
		if(isset($xml))
		{
			$modelDune = new Dune();
				
			$param = $xml->xpath("//param[@name = 'playback_state']");
			if(!empty($param))
				$modelDune->playback_state = (string)$param[0]->attributes()->value;
				
			$param = $xml->xpath("//param[@name = 'playback_position']");
				
			if(!empty($param))
				$modelDune->playback_position = (string)$param[0]->attributes()->value;
	
			$param = $xml->xpath("//param[@name = 'playback_duration']");
			if(!empty($param))
				$modelDune->playback_duration = (string)$param[0]->attributes()->value;
				
			$param = $xml->xpath("//param[@name = 'playback_url']");
			if(!empty($param))
				$modelDune->playback_url = (string)$param[0]->attributes()->value;
				
			$param = $xml->xpath("//param[@name = 'playback_speed']");
			if(!empty($param))
				$modelDune->playback_speed = (string)$param[0]->attributes()->value;
				
			$param = $xml->xpath("//param[@name = 'playback_volume']");
			if(!empty($param))
				$modelDune->playback_volume = (string)$param[0]->attributes()->value;
				
			$param = $xml->xpath("//param[@name = 'player_state']");
			if(!empty($param))
				$modelDune->player_state = (string)$param[0]->attributes()->value;
		}
	
		return $modelDune;
	}
	
	
}