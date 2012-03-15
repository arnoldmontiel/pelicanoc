<?php

/**
 * This is the model class for table "SABnzbdJob".
 *
 * The followings are the available columns in table 'resource':
 * @property array $attributes Attribute values indexed by attribute names.
 *  
 *
 */
class SABnzbdJob extends CModel
{
	private $_attributes = array();
	
	function __construct()
	{
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
				'id' => 'Id',
				'msgid' => 'msgid',
				'filename' => 'File Name',
				'mbleft' => 'MB Left',		
				'mb' => 'MB',		
		);
	}
	/**
	* Returns the list of all attribute names of the model.
	* This would return all column names of the table associated with this AR class.
	* @return array list of attribute names.
	*/
	public function attributeNames()
	{
		return array_key();
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