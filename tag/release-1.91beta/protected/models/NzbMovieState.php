<?php

/**
 * This is the model class for table "nzb_movie_state".
 *
 * The followings are the available columns in table 'nzb_movie_state':
 * @property integer $Id
 * @property integer $Id_nzb
 * @property integer $Id_movie_state
 * @property string $date
 * @property integer $sent
 * @property string $Id_device
 *
 * The followings are the available model relations:
 * @property MovieState $idMovieState
 * @property Nzb $idNzb
 */
class NzbMovieState extends CActiveRecord
{
	public function beforeSave()
	{
		$setting = Setting::getInstance();
		$this->Id_device = $setting->getId_Device();
		return parent::beforeSave();
	}
	
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return NzbMovieState the static model class
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
		return 'nzb_movie_state';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Id_nzb, Id_movie_state', 'required'),
			array('Id_nzb, Id_movie_state, sent', 'numerical', 'integerOnly'=>true),
			array('Id_device', 'length', 'max'=>45),
			array('date', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('Id, Id_nzb, Id_movie_state, date, sent, Id_device', 'safe', 'on'=>'search'),
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
			'movieState' => array(self::BELONGS_TO, 'MovieState', 'Id_movie_state'),
			'nzb' => array(self::BELONGS_TO, 'Nzb', 'Id_nzb'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'Id' => 'ID',
			'Id_nzb' => 'Id Nzb',
			'Id_movie_state' => 'Id Movie State',
			'date' => 'Date',
			'sent' => 'Sent',
			'Id_device' => 'Id Device',
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
		$criteria->compare('Id_nzb',$this->Id_nzb);
		$criteria->compare('Id_movie_state',$this->Id_movie_state);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('sent',$this->sent);
		$criteria->compare('Id_device',$this->Id_device,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function searchReady()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.
	
		$criteria=new CDbCriteria;
	
		$criteria->compare('Id',$this->Id);
		$criteria->compare('Id_nzb',$this->Id_nzb);
		$criteria->compare('Id_movie_state',$this->Id_movie_state);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('sent',$this->sent);
		$criteria->compare('Id_device',$this->Id_device,true);
		
		$criteria->with[]='nzb';
		$criteria->compare('nzb.ready',1);
	
		return new CActiveDataProvider($this, array(
				'criteria'=>$criteria,
		));
	}
}