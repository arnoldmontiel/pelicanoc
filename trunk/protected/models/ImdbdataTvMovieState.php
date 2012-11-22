<?php

/**
 * This is the model class for table "imdbdata_tv_movie_state".
 *
 * The followings are the available columns in table 'imdbdata_tv_movie_state':
 * @property integer $Id
 * @property string $date
 * @property integer $sent
 * @property integer $Id_movie_state
 * @property integer $Id_customer
 * @property string $Id_imdbdata_tv
 *
 * The followings are the available model relations:
 * @property MovieState $idMovieState
 * @property Customer $idCustomer
 * @property ImdbdataTv $idImdbdataTv
 */
class ImdbdataTvMovieState extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ImdbdataTvMovieState the static model class
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
		return 'imdbdata_tv_movie_state';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Id_movie_state, Id_customer, Id_imdbdata_tv', 'required'),
			array('Id, sent, Id_movie_state, Id_customer', 'numerical', 'integerOnly'=>true),
			array('Id_imdbdata_tv', 'length', 'max'=>45),
			array('date', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('Id, date, sent, Id_movie_state, Id_customer, Id_imdbdata_tv', 'safe', 'on'=>'search'),
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
			'idMovieState' => array(self::BELONGS_TO, 'MovieState', 'Id_movie_state'),
			'idCustomer' => array(self::BELONGS_TO, 'Customer', 'Id_customer'),
			'idImdbdataTv' => array(self::BELONGS_TO, 'ImdbdataTv', 'Id_imdbdata_tv'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'Id' => 'ID',
			'date' => 'Date',
			'sent' => 'Sent',
			'Id_movie_state' => 'Id Movie State',
			'Id_customer' => 'Id Customer',
			'Id_imdbdata_tv' => 'Id Imdbdata Tv',
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
		$criteria->compare('date',$this->date,true);
		$criteria->compare('sent',$this->sent);
		$criteria->compare('Id_movie_state',$this->Id_movie_state);
		$criteria->compare('Id_customer',$this->Id_customer);
		$criteria->compare('Id_imdbdata_tv',$this->Id_imdbdata_tv,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}