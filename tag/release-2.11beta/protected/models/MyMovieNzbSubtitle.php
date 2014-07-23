<?php

/**
 * This is the model class for table "my_movie_nzb_subtitle".
 *
 * The followings are the available columns in table 'my_movie_nzb_subtitle':
 * @property string $Id_my_movie_nzb
 * @property integer $Id_subtitle
 */
class MyMovieNzbSubtitle extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return MyMovieNzbSubtitle the static model class
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
		return 'my_movie_nzb_subtitle';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Id_my_movie_nzb, Id_subtitle', 'required'),
			array('Id_subtitle', 'numerical', 'integerOnly'=>true),
			array('Id_my_movie_nzb', 'length', 'max'=>200),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('Id_my_movie_nzb, Id_subtitle', 'safe', 'on'=>'search'),
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
			'myMovieNzb' => array(self::BELONGS_TO, 'MyMovieNzb', 'Id_my_movie_nzb'),
			'subtitle' => array(self::BELONGS_TO, 'Subtitle', 'Id_subtitle'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'Id_my_movie_nzb' => 'Id My Movie Nzb',
			'Id_subtitle' => 'Id Subtitle',
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

		$criteria->compare('Id_my_movie_nzb',$this->Id_my_movie_nzb,true);
		$criteria->compare('Id_subtitle',$this->Id_subtitle);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}