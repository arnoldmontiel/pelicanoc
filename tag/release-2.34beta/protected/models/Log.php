<?php

/**
 * This is the model class for table "log".
 *
 * The followings are the available columns in table 'log':
 * @property integer $Id
 * @property string $username
 * @property string $log_date
 * @property string $description
 * @property integer $was_sent
 * @property integer $Id_log_type
 *
 * The followings are the available model relations:
 * @property LogType $idLogType
 */
class Log extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Log the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public static function saveLog($description, $type)
	{
		$modelUser = User::getCurrentUser();
		
		$model = new Log();
		$model->description = $description;
		$model->Id_log_type = $type;
		$model->username = $modelUser->username;
		$model->save();
	}
	
	public static function logger($description)
	{
		$model = new Log();
		$model->description = $description;
		$model->Id_log_type = 1;		
		$model->save();
	}
	
	public static function sendLog()
	{
		$requests = array();
		$pelicanoCliente = new Pelicano;
		$idCustomer = null;
		$modelUser = User::getCurrentUser();
		$idCustomer = (isset($modelUser))?$modelUser->Id_customer:null;
		
		if(isset($idCustomer))
		{
			$logs = Log::model()->findAllByAttributes(array('was_sent'=>0));
			foreach($logs as $item)
			{
				$request= new LogRequest;
				$request->Id_customer = $idCustomer;
				$request->username = $item->username;
				$request->log_date = $item->log_date;
				$request->description = $item->description;
				$request->Id_log_type = $item->Id_log_type;
				$request->Id_log_customer = $item->Id;
				$requests[]=$request;
			}
			
			$LogResponseArray = $pelicanoCliente->setLog($requests);
			
			foreach($LogResponseArray as $item)
			{
				$model = Log::model()->findByAttributes(array('Id'=>$item->Id_log_customer));
				if(isset($model))
				{
					$model->was_sent = 1;
					$model->save();
				}
			}
			
		}
	}
	
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'log';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Id_log_type', 'required'),
			array('was_sent, Id_log_type', 'numerical', 'integerOnly'=>true),
			array('username', 'length', 'max'=>45),
			array('log_date, description', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('Id, username, log_date, description, was_sent, Id_log_type', 'safe', 'on'=>'search'),
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
			'idLogType' => array(self::BELONGS_TO, 'LogType', 'Id_log_type'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'Id' => 'ID',
			'username' => 'Username',
			'log_date' => 'Log Date',
			'description' => 'Description',
			'was_sent' => 'Was Sent',
			'Id_log_type' => 'Id Log Type',
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
		$criteria->compare('username',$this->username,true);
		$criteria->compare('log_date',$this->log_date,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('was_sent',$this->was_sent);
		$criteria->compare('Id_log_type',$this->Id_log_type);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}