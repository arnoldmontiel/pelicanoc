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
class SABnzbdHistory extends CModel
{
	public $setting; 
	public $urlXml;
	public $urlJson;
	private $_attributes = array();
	private $_slots = array();
	
	function __construct()
	{
		$this->setting = Setting::getInstance();
		$this->urlXml =  $this->setting->sabnzb_api_url."mode=history&start=START&limit=LIMIT&output=xml&apikey=".$this->setting->sabnzb_api_key;
		$this->urlJson = $this->setting->sabnzb_api_url."mode=history&start=START&limit=LIMIT&output=json&apikey=".$this->setting->sabnzb_api_key;
	}
	
	public function getHistory()
	{
		try {
			$jsonData = @file_get_contents($this->urlJson);
			$this->_attributes = CJSON::decode($jsonData,true);
			if(isset($this->_attributes)&&is_array($this->_attributes)&&isset($this->_attributes['history']['slots']))
			{
				foreach ($this->_attributes['history']['slots'] as $slot)
				{
					$nzb = Nzb::model()->findByAttributes(array('ready'=>1,'sabnzbd_id'=>$slot['nzo_id'],'ready_to_play'=>0));
					$parentSlot = $slot;
					if(isset($nzb))
					{
						$parentSlot['nzb_id_original']=$nzb->Id;
						$parentSlot['nzb_id']=$nzb->Id;
						if(isset($nzb->Id_nzb))
						{
							$parentSlot['nzb_id']=$nzb->Id_nzb;
						}						
						$this->_slots[]=$parentSlot;
					}
				}
				$this->_attributes['slots']=$this->_slots;
			}
		} catch (Exception $e) {
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
	
	/**
	 * 
	 * @see CModel::getAttributes()
	 * @return attributes array
	 */
	public function getAttributes($name=null)
	{
		return $this->_attributes;
	}
	
}