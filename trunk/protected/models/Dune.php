<?php
class Dune
{
	function __construct()
	{
	}
	
	/**
	* Set model attributes
	* @param Nab $model
	*/
	public function setAttributes($model)
	{
		//set attributes
		$attributesArray = $model->attributes;
		while (($value = current($attributesArray)) !== false) {
			$this->setAttribute(key($attributesArray), $value);
			next($attributesArray);
		}
	}
	
	public function setAttribute($name,$value)
	{
		if(property_exists($this,$name))
			$this->$name=$value;
		else
			return false;
		return true;
	}
	
	public $playback_state;
	public $playback_url;
	public $playback_speed;
	public $playback_duration;
	public $playback_position;
	public $playback_volume;
	public $player_state;
}