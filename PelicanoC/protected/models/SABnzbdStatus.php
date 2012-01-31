<?php

/**
 * This is the model class for table "SABnzbdStatus".
 *
 * The followings are the available columns in table 'resource':
 * @property SABnzbdQueue $queue
 * @property SABnzbdJob $jobs
 * @property array $attributes Attribute values indexed by attribute names.
 * @property string $have_warnings
 *  
 *
 */
class SABnzbdStatus extends CModel
{
	public $setting; 
	public $urlXml;
	public $urlJson;
	private $_attributes = array();
	private $_jobs = array();
	
	function __construct()
	{
		$this->setting = Setting::getInstance();
		$this->urlXml =  $this->setting->sabnzb_api_url."mode=qstatus&output=xml&apikey=".$this->setting->sabnzb_api_key;
		$this->urlJson = $this->setting->sabnzb_api_url."mode=qstatus&output=json&apikey=".$this->setting->sabnzb_api_key;
	}
	
	public function getStatus()
	{
		$jsonData = file_get_contents($this->urlJson);
		$this->_attributes = CJSON::decode($jsonData,true);
		foreach ($this->_attributes as $job)
		{
			$this->_jobs[]=$job;
		}		
	}
	/**
	* Returns the static model of the specified AR class.
	* @param string $className active record class name.
	* @return Setting the static model class
	*/
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	/**
	* @return array customized attribute labels (name=>label)
	*/
	public function attributeLabels()
	{
		return array(
				'have_warnings' => 'Have Warnings',
				'timeleft' => 'Time Left',
				'mb' => 'MB',		
				'noofslots' => 'Noof Slots',		
				'paused' => 'Paused',		
				'pause_int' => 'Pause Int',		
				'state' => 'State',		
				'loadavg' => 'Loadavg',		
				'mbleft' => 'MB Left',
				'diskspace2' => 'Disk Space',
				'diskspace1' => 'Disk Space',
				'kbpersec' => 'KB/s',
		
		);
	}
	/**
	* Returns the list of all attribute names of the model.
	* This would return all column names of the table associated with this AR class.
	* @return array list of attribute names.
	*/
	public function attributeNames()
	{
		return array_key('have_warnings');
	}
	/**
	* PHP getter magic method.
	* This method is overridden so that AR attributes can be accessed like properties.
	* @param string $name property name
	* @return mixed property value
	* @see getAttribute
	*/
	public function __get($name)
	{
		if(isset($this->_attributes[$name]))
		return $this->_attributes[$name];
		return parent::__get($name);
	}
	
	/**
	 * PHP setter magic method.
	 * This method is overridden so that AR attributes can be accessed like properties.
	 * @param string $name property name
	 * @param mixed $value property value
	 */
	public function __set($name,$value)
	{
		if($this->setAttribute($name,$value)===false)
		{
			parent::__set($name,$value);
		}
	}
	/**
	* Sets the named attribute value.
	* You may also use $this->AttributeName to set the attribute value.
	* @param string $name the attribute name
	* @param mixed $value the attribute value.
	* @return boolean whether the attribute exists and the assignment is conducted successfully
	* @see hasAttribute
	*/
	public function setAttribute($name,$value)
	{
		if(property_exists($this,$name))
			$this->$name=$value;
		else if(isset($this->_attributes[$name]))
			$this->_attributes[$name]=$value;
		else
			return false;
		return true;
	}
	
}