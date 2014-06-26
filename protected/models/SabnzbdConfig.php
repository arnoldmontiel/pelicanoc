<?php

/**
 * This is the model class for table "sabnzbd_config".
 *
 * The followings are the available columns in table 'sabnzbd_config':
 * @property integer $Id
 * @property string $server_name
 * @property string $username
 * @property integer $enable
 * @property string $name
 * @property string $fill_server
 * @property integer $connections
 * @property integer $ssl
 * @property string $host
 * @property integer $timeout
 * @property string $password
 * @property integer $optional
 * @property integer $port
 * @property integer $retention
 */
class SabnzbdConfig extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'sabnzbd_config';
	}

	public function setAttributesByArray($array)
	{
		$attributesArray = get_object_vars($array);
		while (($value = current($attributesArray)) !== false) {
			$this->setAttribute(key($attributesArray), $value);
			next($attributesArray);
		}
	}
	
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Id', 'required'),
			array('Id, enable, connections, ssl, timeout, optional, port, retention', 'numerical', 'integerOnly'=>true),
			array('server_name, username, name, fill_server, host, password', 'length', 'max'=>128),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('Id, server_name, username, enable, name, fill_server, connections, ssl, host, timeout, password, optional, port, retention', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'Id' => 'ID',
			'server_name' => 'Server Name',
			'username' => 'Username',
			'enable' => 'Enable',
			'name' => 'Name',
			'fill_server' => 'Fill Server',
			'connections' => 'Connections',
			'ssl' => 'Ssl',
			'host' => 'Host',
			'timeout' => 'Timeout',
			'password' => 'Password',
			'optional' => 'Optional',
			'port' => 'Port',
			'retention' => 'Retention',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('Id',$this->Id);
		$criteria->compare('server_name',$this->server_name,true);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('enable',$this->enable);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('fill_server',$this->fill_server,true);
		$criteria->compare('connections',$this->connections);
		$criteria->compare('ssl',$this->ssl);
		$criteria->compare('host',$this->host,true);
		$criteria->compare('timeout',$this->timeout);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('optional',$this->optional);
		$criteria->compare('port',$this->port);
		$criteria->compare('retention',$this->retention);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return SabnzbdConfig the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
