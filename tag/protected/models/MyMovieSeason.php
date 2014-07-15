<?php

/**
 * This is the model class for table "my_movie_season".
 *
 * The followings are the available columns in table 'my_movie_season':
 * @property integer $Id
 * @property string $Id_my_movie_serie_header
 * @property integer $season_number
 * @property string $banner
 * @property string $banner_original
 *
 * The followings are the available model relations:
 * @property MyMovieEpisode[] $myMovieEpisodes
 * @property MyMovieSerieHeader $idMyMovieSerieHeader
 */
class MyMovieSeason extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return MyMovieSeason the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
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
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'my_movie_season';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Id_my_movie_serie_header', 'required'),
			array('season_number', 'numerical', 'integerOnly'=>true),
			array('Id_my_movie_serie_header', 'length', 'max'=>200),
			array('banner, banner_original', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('Id, Id_my_movie_serie_header, season_number, banner, banner_original', 'safe', 'on'=>'search'),
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
			'myMovieEpisodes' => array(self::HAS_MANY, 'MyMovieEpisode', 'Id_my_movie_season'),
			'myMovieSerieHeader' => array(self::BELONGS_TO, 'MyMovieSerieHeader', 'Id_my_movie_serie_header'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'Id' => 'ID',
			'Id_my_movie_serie_header' => 'Id My Movie Serie Header',
			'season_number' => 'Season Number',
			'banner' => 'Banner',
			'banner_original' => 'Banner Original',
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
		$criteria->compare('Id_my_movie_serie_header',$this->Id_my_movie_serie_header,true);
		$criteria->compare('season_number',$this->season_number);
		$criteria->compare('banner',$this->banner,true);
		$criteria->compare('banner_original',$this->banner_original,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}