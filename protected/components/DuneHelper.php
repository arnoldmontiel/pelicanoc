<?php
class DuneHelper
{

	static public function playDune($id)
	{
		$modelMyMovieDiscNzb = MyMovieDiscNzb::model()->findByAttributes(array('Id_my_movie_nzb'=>$id));
		
		$model = Nzb::model()->findByAttributes(array('Id_my_movie_disc_nzb'=>$modelMyMovieDiscNzb->Id));
		
		$setting = Setting::getInstance();
	
// 		if($model->isBluray())
// 		{
// 			$cmd = 'start_bluray_playback';
// 		}
// 		else
// 		{
// 			$cmd = 'start_dvd_playback';
// 		}

		$cmd = 'launch_media_url';
		$path = str_replace(' ', '%20', $model->path);
		$folderPath = explode('.',$model->file_name);
		$url = $setting->players[0]->url . '/cgi-bin/do?cmd='.$cmd.'&media_url='.$setting->players[0]->file_protocol.':';
		$url = $url . '//'. $setting->host_file_server . $setting->host_file_server_path .'/'.$folderPath[0].'/' .$path;
		//TODO: analizar el resultado e indicar si la reproducci�n se a concretado.
		@file_get_contents($url);
		return true;
	}
	
	static public function getProgressBar()
	{
		$current_progress_bar = 0;
		
		$modelDune = self::getState();
		
		if(isset($modelDune))
		{
			if($modelDune->playback_state == "playing" && (int)$modelDune->playback_duration > 0)
			{
				$value = ((int)$modelDune->playback_position/(int)$modelDune->playback_duration) * 100;
				$current_progress_bar = round($value); 
			}	
		}
		
		return $current_progress_bar;
	}
	
	static public function getPlaybackUrl()
	{
		$modelDune = self::getState();
		
		$playbackUrl = null;
		if(isset($modelDune))
		{
			if($modelDune->playback_state == "playing")
			{
				$playbackUrl = $modelDune->playback_url;
			}
		}
		return $playbackUrl;
	}
	
	static public function setBlackScreen()
	{
		$setting = Setting::getInstance();		
		echo file_get_contents( $setting->players[0]->url .'/cgi-bin/do?cmd=black_screen');
	}
	
	
	
	static public function useRemote($irCode)
	{
		$setting = Setting::getInstance();
		echo file_get_contents( $setting->players[0]->url .'/cgi-bin/do?cmd=ir_code&ir_code='.$irCode);
	}
	
	private function getState()
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
		}	
		
		return $modelDune;
	}
	
}