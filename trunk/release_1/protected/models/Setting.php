<?php

/**
 * This is the model class for table "setting".
 *
 * The followings are the available columns in table 'setting':
 * @property integer $Id
 * @property string $path_pending
 * @property integer $Id_customer
 * @property string $sabnzb_api_key
 * @property string $sabnzb_api_url
 * @property string $host_name
 * @property string $path_ready
 * @property string $path_subtitle
 * @property string $path_images
 * @property string $path_shared
 *
 * The followings are the available model relations:
 * @property Player[] $players 
 */
class Setting extends CActiveRecord
{
	private static $setting = null;
		 
	public static function getInstance()
	{
		if(Setting::$setting==null)
		{
			$setings = Setting::model()->findAll();
			if($setings!=null)
				Setting::$setting= $setings[0];
		}
		return Setting::$setting;		
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
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'setting';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Id_customer', 'numerical', 'integerOnly'=>true),
			array('path_pending, sabnzb_api_key, sabnzb_api_url, host_name, path_ready, path_subtitle, path_images, path_shared', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('Id, path_pending, Id_customer, sabnzb_api_key, sabnzb_api_url, host_name,host_name, path_ready, path_subtitle, path_images, path_shared', 'safe', 'on'=>'search'),
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
			'players' => array(self::HAS_MANY, 'Player', 'Id_setting'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'Id' => 'ID',
			'path_pending' => 'Path Pending',
			'Id_customer' => 'Id Customer',
			'sabnzb_api_key' => 'Sabnzb Api Key',
			'sabnzb_api_url' => 'Sabnzb Api Url',
			'host_name' => 'Host Name',
			'path_ready' => 'Path Ready',
			'path_subtitle' => 'Path Subtitle',
			'path_images' => 'Path Images',
			'path_shared' => 'Path Shared',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('Id',$this->Id);
		$criteria->compare('path_pending',$this->path_pending,true);
		$criteria->compare('Id_customer',$this->Id_customer);
		$criteria->compare('sabnzb_api_key',$this->sabnzb_api_key,true);
		$criteria->compare('sabnzb_api_url',$this->sabnzb_api_url,true);
		$criteria->compare('host_name',$this->host_name,true);
		$criteria->compare('path_ready',$this->path_ready,true);
		$criteria->compare('path_subtitle',$this->path_subtitle,true);
		$criteria->compare('path_images',$this->path_images,true);
		$criteria->compare('path_shared',$this->path_shared,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}