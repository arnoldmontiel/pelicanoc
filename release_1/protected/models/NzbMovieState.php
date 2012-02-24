<?php

/**
 * This is the model class for table "nzb_movie_state".
 *
 * The followings are the available columns in table 'nzb_movie_state':
 * @property integer $Id_nzb
 * @property integer $Id_movie_state
 * @property string $date
 * @property integer $Id_nzb_movie_state
 *
 * The followings are the available model relations:
 * @property MovieState $movieState
 * @property Nzb $nzb
 */
class NzbMovieState extends CActiveRecord
{
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
			array('Id_nzb, Id_movie_state', 'numerical', 'integerOnly'=>true),
			array('date', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('Id_nzb, Id_movie_state, date, Id_nzb_movie_state', 'safe', 'on'=>'search'),
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
			'Id_nzb' => 'Id Nzb',
			'Id_movie_state' => 'Id Movie State',
			'date' => 'Date',
			'Id_nzb_movie_state' => 'Id Nzb Movie State',
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

		$criteria->compare('Id_nzb',$this->Id_nzb);
		$criteria->compare('Id_movie_state',$this->Id_movie_state);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('Id_nzb_movie_state',$this->Id_nzb_movie_state);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}