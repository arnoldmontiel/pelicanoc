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
		$sharedPath=explode('/', trim($setting->host_file_server_path, '/'));
		
		//pruebo darle play de una
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
	
		$params['path'] = "/mnt/cifs1/".$completePath;
		$params['extraNetPath'] = rtrim($setting->host_file_server, '/');
		$params['index'] = 0;
		$params['type'] = 1;
		$params['appDeviceType'] = 7;
		
		$url = trim($player->url, '/') .":436/playnormalfile?".json_encode($params);
		$url = str_replace('&', '%26', $url);
		$url = str_replace(' ', '%20', $url);
		
		$response = file_get_contents($url);
		$response = json_decode($response);
		if(isset($response)&&$response->success==true)
			return true;
		
		//si no pude darle play de una hago los tres pasos (login - montar - play)
		//login to samba server
		$params= array();
		$params['serverName'] = $setting->host_file_server_name;
		$params['userName'] = $setting->host_file_server_user;
		$params['psssword'] = $setting->host_file_server_passwd;
		$params['bRememberID'] = 1;
		$retry = 0;
		do
		{
			$url = trim($player->url, '/') .":436/loginSambaWithID?".json_encode($params);
			$url = str_replace('&', '%26', $url);
			$url = str_replace(' ', '%20', $url);				
			$response = @file_get_contents($url);
			$retry++;
			$response = json_decode($response);
			if(isset($response)&&$response->success==false)
				sleep ( 1 );
				
		}while(isset($response)&&$response->success==false&&$retry<10);		
		if(!isset($response)||!is_object($response)||$response->success!=true)
		{
			return false;
		}
		//sleep ( 2 );
		
		//mounting samba path				
		$params= array();
		
		$params['folder'] = $sharedPath[0];
		
		$params['userName'] = $setting->host_file_server_user;
		$params['server'] = $setting->host_file_server_name;
		
		$params['bRememberID'] = 1;
		$params['bWithID'] = 1;				
		$params['password'] = $setting->host_file_server_passwd;
		$url = trim($player->url, '/') .":436/mountSharedFolder?".json_encode($params);
		$retry = 0;
		do
		{
			$url = str_replace('&', '%26', $url);
			$url = str_replace(' ', '%20', $url);				
			$response = @file_get_contents($url);
			$response = json_decode($response);
			$retry++;
			if(isset($response)&&$response->success==false)
				sleep ( 1 );
				
		}while(isset($response)&&$response->success==false&&$retry<10);

		if(!isset($response)||!is_object($response)||$response->success!=true)
		{
			return false;
		}		
		//sleep ( 4 );
				
		//start movie				
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
		
		$params['path'] = $response->cifsMntPath."/".$completePath;
		$params['extraNetPath'] = rtrim($setting->host_file_server, '/');
		$params['index'] = 0;
		$params['type'] = 1;
		$params['appDeviceType'] = 7;
		$url = trim($player->url, '/') .":436/playnormalfile?".json_encode($params);
		$url = str_replace('&', '%26', $url);
		$url = str_replace(' ', '%20', $url);
		$retry = 0;
		do
		{
			$response = file_get_contents($url);
			$retry++;
			$response = json_decode($response);				
			if(isset($response)&&$response->success==false)
				sleep ( 1 );
		}while(isset($response)&&$response->success==false&$retry<10);
		if(!isset($response)||!is_object($response)||$response->success!=true)
		{
			return false;
		}		
		
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
		$url = trim($player->url, '/') .":436/getplayingtime";
		
		$response = @file_get_contents($url);
		$response = json_decode($response);
		
		$progressBar = array('currentProgress'=>-1,
				'currentTime'=>gmdate("H:i:s",0),
				'totalTime'=>gmdate("H:i:s",0));
	
	
		if(isset($response) && is_object($response)&&$response->total_time!=0)
		{
			$value = ((int)$response->cur_time/(int)$response->total_time) * 100;
			$progressBar['currentProgress'] = round($value);
			$progressBar['currentTime'] = gmdate("H:i:s",$response->cur_time);
			$progressBar['totalTime'] = gmdate("H:i:s",$response->total_time);
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
	
	
	static public function useRemote($code,$Id_player)
	{
		$modelPlayer = Player::model()->findByPk($Id_player);
		if(isset($modelPlayer))
		{
			echo file_get_contents( trim($modelPlayer->url, '/') .':436/sendremotekey?{"key":"'.$code.'"}');
		}
	}
	
	static public function initializeOppo($player)
	{
		//Send broascast message.
		$service_port = 7624;
		$address = "255.255.255.255";
		$socket = socket_create(AF_INET, SOCK_DGRAM, SOL_UDP);
		socket_set_option($socket, SOL_SOCKET, SO_BROADCAST, 1);
		if ($socket === false) {
			//echo "socket_create() failed: reason: " . socket_strerror(socket_last_error()) . "\n";
		} else {
			//echo "OK.\n";
		}
		$in = "NOTIFY OREMOTE LOGIN";
		//@file_get_contents($address.":".$service_port."?".$in);
		socket_sendto($socket, $in, strlen($in), 0, $address, $service_port);
		socket_close($socket);
		
		
		$service_port = 19999;
		//$address = "192.168.1.183";
		
		//probar esto para limpiar el http
		$address = $player->url;
		$address = preg_replace('#^http?://#', '', rtrim($address,'/'));
		
		$socket = socket_create(AF_INET, SOCK_DGRAM, SOL_UDP);
		if ($socket === false) {
			//echo "socket_create() failed: reason: " . socket_strerror(socket_last_error()) . "\n";
		} else {
			//echo "OK.\n";
		}
		$in = "oppoConnectPlayerByIPDirect";
		sleep(1);
		socket_sendto($socket, $in, strlen($in), 0, $address, $service_port);
		sleep(1);
		socket_sendto($socket, $in, strlen($in), 0, $address, $service_port);
		sleep(1);
		socket_sendto($socket, $in, strlen($in), 0, $address, $service_port);
		
		socket_close($socket);		
		
		sleep(1);
		@file_get_contents( trim($player->url, '/') .':436/getmainfirmwareversion');
		sleep(1);		
		@file_get_contents( trim($player->url, '/') .':436/getdevicelist');		
	}
	static public function isPlayerAlive($player)
	{
				
		$url = trim($player->url, '/') .":436/getglobalinfo";
		try {
			$response = json_decode(@file_get_contents($url));
			if(isset($response)&&$response->success==true)
			{
				return true;
			}
				
		} catch (Exception $e) {
			self::initializeOppo($player);
			return false;
		}
		self::initializeOppo($player);
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
		$url = trim($player->url, '/') .":436/getglobalinfo";
		$response = json_decode(@file_get_contents($url));
		if(isset($response)&&$response->is_video_playing==true)
		{
			if($response->cur_media_type == 2 && $response->is_pic_playing == true)
				return false;
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
		$response = @file_get_contents( trim($player->url, '/') .'/cgi-bin/do?cmd=status');
	
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
	
	static public function setBackgroundImage($player)
	{
	
		$setting = Setting::getInstance();
		$sharedPath=explode('/', trim($setting->host_file_server_path, '/'));
	
		//pruebo poner la imagen de una
		$completePath="";
		if(count($sharedPath)>1)
		{
			for($i=1;$i<count($sharedPath);$i++)
			{
			$completePath.="/".$sharedPath[$i];
			}
	
			}
	
			$completePath ='/Video/Movies/Bluray/PelicanoBGBlack.jpg';
		$params= array();
	
			$params['path'] = "/mnt/cifs1/".$completePath;
			$params['extraNetPath'] = rtrim($setting->host_file_server, '/');
			$params['index'] = 95;
			$params['type'] = 2;
			$params['appDeviceType'] = 7;
						
			$url = trim($player->url, '/') .":436/playnormalfile?".json_encode($params);
			$url = str_replace('&', '%26', $url);
					$url = str_replace(' ', '%20', $url);
	
					$response = file_get_contents($url);
					$response = json_decode($response);
					if(isset($response)&&$response->success==true)
						return true;
					return false;
		}
	
}