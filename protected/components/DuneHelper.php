<?php
class DuneHelper
{

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
			$modelDune->playback_state = (string)$param[0]->attributes()->value;
			
			$param = $xml->xpath("//param[@name = 'playback_position']");
			$modelDune->playback_position = (string)$param[0]->attributes()->value;
				
			$param = $xml->xpath("//param[@name = 'playback_duration']");
			$modelDune->playback_duration = (string)$param[0]->attributes()->value;
			
			$param = $xml->xpath("//param[@name = 'playback_url']");
			$modelDune->playback_url = (string)$param[0]->attributes()->value;
			
			$param = $xml->xpath("//param[@name = 'playback_speed']");
			$modelDune->playback_speed = (string)$param[0]->attributes()->value;
			
			$param = $xml->xpath("//param[@name = 'playback_volume']");
			$modelDune->playback_volume = (string)$param[0]->attributes()->value;
		}	
		
		return $modelDune;
	}
	
}