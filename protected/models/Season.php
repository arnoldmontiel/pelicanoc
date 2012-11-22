<?php

/**
 * This is the model class for table "season".
 *
 * The followings are the available columns in table 'season':
 * @property integer $season
 * @property integer $episodes
 * @property string $Id_imdbdata_tv
 *
 * The followings are the available model relations:
 * @property ImdbdataTv $idImdbdataTv
 */
class Season extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Season the static model class
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
		return 'season';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Id_imdbdata_tv, season', 'required'),
			array('season, episodes', 'numerical', 'integerOnly'=>true),
			array('Id_imdbdata_tv', 'length', 'max'=>45),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('season, episodes, Id_imdbdata_tv', 'safe', 'on'=>'search'),
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
			'idImdbdataTv' => array(self::BELONGS_TO, 'ImdbdataTv', 'Id_imdbdata_tv'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'season' => 'Season',
			'episodes' => 'Episodes',
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

		$criteria->compare('season',$this->season);
		$criteria->compare('episodes',$this->episodes);
		$criteria->compare('Id_imdbdata_tv',$this->Id_imdbdata_tv,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}