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
 * @property string $host_path
 * @property integer $Id_reseller
 * @property string $Id_device
 * @property string $ip_v4
 * @property string $ip_v6
 * @property integer $port_v4
 * @property integer $port_v6
 * @property string $path_anydvd_download
 * @property string $anydvd_version_installed
 * @property string $mymovies_username
 * @property string $mymovies_password
 * @property string $host_file_server
 * @property string $host_file_server_path
 * @property string $sabnzb_pwd_file_path
 * @property string $shared_online_path
 * @property string $path_shared_pelicano_root
 * @property string $path_shared_copied
 * @property string $path_shared_ripped
 * @property string $path_sabnzbd_download
 * @property string $host_file_server_name
 * @property integer $is_movie_tester
 * @property string $path_sabnzbd_temp
 * @property string $host_file_server_user
 * @property string $host_file_server_passwd
 * @property string $michael_jackson
 * @property integer $disc_min_size_warning
 * 
 * The followings are the available model relations:
 * @property Player[] $players 
 */
class Setting extends CActiveRecord
{
	private static $setting;
	private $_customer;
	
	public function beforeSave()
	{
		//Solo por ahora!!!
		$this->host_name = 'http://domasolutions.com';
		return parent::beforeSave();
	}
	
	public function setAttributesByArray($array)
	{
		$attributesArray = get_object_vars($array);
		while (($value = current($attributesArray)) !== false) {
			$this->setAttribute(key($attributesArray), $value);
			next($attributesArray);
		}
	}
	
// 	private function __construct()
// 	{
// 	}
	public function __construct()
	{
// 		$user = User::model()->findByPk(Yii::app()->user->Id);
// 		$this->_customer = $user->customer;		
	}
	
	public static function getInstance()
	{
		if(!isset(self::$instancia))
		{
			$settings = Setting::model()->findAll();
			if($settings!=null)
				Setting::$setting= $settings[0];
		}
		return self::$setting;		
	}
	public function getId_Customer()
	{
		return $this->Id_customer;		
	}
	public function getId_Device()
	{
		return $this->Id_device;
	}
	public function getCustomer()
	{
		return Customer::model()->findByPk($this->Id_customer);
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
			array('Id_customer, Id_reseller, port_v4, port_v6, disc_min_size_warning', 'numerical', 'integerOnly'=>true),
			array('path_pending, sabnzb_api_key, sabnzb_api_url, host_name, path_ready, path_subtitle, 
			path_images, path_shared, host_path, host_file_server, host_file_server_path, 
			sabnzb_pwd_file_path,shared_online_path,path_shared_pelicano_root, path_shared_copied, path_shared_ripped, host_file_server_user, host_file_server_passwd, host_file_server_name,michael_jackson, path_sabnzbd_download ', 'length', 'max'=>255),
			array('version', 'length', 'max'=>45),
				array('path_anydvd_download, mymovies_username, mymovies_password', 'length', 'max'=>256),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('Id, path_pending, Id_customer, sabnzb_api_key, sabnzb_api_url, host_name,host_name, 
			path_ready, path_subtitle, path_images, path_shared, host_path, Id_reseller, Id_device, ip_v4, ip_v6, port_v4, port_v6, path_anydvd_download, anydvd_version_installed, mymovies_username, mymovies_password, host_file_server, host_file_server_path, sabnzb_pwd_file_path,shared_online_path, path_shared_pelicano_root, path_shared_copied, path_shared_ripped, michael_jackson, host_file_server_user, path_sabnzbd_download, host_file_server_name, host_file_server_passwd,version, disc_min_size_warning', 'safe', 'on'=>'search'),
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
			'host_path' => 'Host Path',
			'Id_reseller' => 'Id Reseller',
			'Id_device' => 'Id Device',
			'ip_v4' => 'Ip V4',
			'ip_v6' => 'Ip V6',
			'port_v4' => 'Port V4',
			'port_v6' => 'Port V6',
			'path_anydvd_download' => 'Path Anydvd Download',
			'anydvd_version_installed' => 'Anydvd Version Installed',
			'mymovies_username' => 'Mymovies Username',
			'mymovies_password' => 'Mymovies Password',
			'host_file_server' => 'Host File Server',
			'host_file_server_path' => 'Host File Server Path',
			'sabnzb_pwd_file_path' => 'Sabnzb Pwd File Path',
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
		$criteria->compare('host_path',$this->host_path,true);
		$criteria->compare('Id_reseller',$this->Id_reseller);
		$criteria->compare('Id_device',$this->Id_device,true);
		$criteria->compare('ip_v4',$this->ip_v4,true);
		$criteria->compare('ip_v6',$this->ip_v6,true);
		$criteria->compare('port_v4',$this->port_v4);
		$criteria->compare('port_v6',$this->port_v6);
		$criteria->compare('path_anydvd_download',$this->path_anydvd_download,true);
		$criteria->compare('anydvd_version_installed',$this->anydvd_version_installed,true);
		$criteria->compare('mymovies_username',$this->mymovies_username,true);
		$criteria->compare('mymovies_password',$this->mymovies_password,true);
		$criteria->compare('host_file_server',$this->host_file_server,true);
		$criteria->compare('host_file_server_path',$this->host_file_server_path,true);
		$criteria->compare('sabnzb_pwd_file_path',$this->sabnzb_pwd_file_path,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
}