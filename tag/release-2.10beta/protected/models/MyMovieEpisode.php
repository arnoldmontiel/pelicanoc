<?php

/**
 * This is the model class for table "my_movie_episode".
 *
 * The followings are the available columns in table 'my_movie_episode':
 * @property integer $Id
 * @property integer $Id_my_movie_season
 * @property integer $episode_number
 * @property string $description
 * @property string $name
 *
 * The followings are the available model relations:
 * @property MyMovieSeason $idMyMovieSeason
 * @property MyMovie[] $myMovies
 */
class MyMovieEpisode extends CActiveRecord
{
	public $season_number;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return MyMovieEpisode the static model class
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
		return 'my_movie_episode';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Id_my_movie_season', 'required'),
			array('Id_my_movie_season, episode_number', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>255),
			array('description', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('Id, Id_my_movie_season, episode_number, description, name', 'safe', 'on'=>'search'),
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
			'myMovieSeason' => array(self::BELONGS_TO, 'MyMovieSeason', 'Id_my_movie_season'),
			'myMovies' => array(self::MANY_MANY, 'MyMovie', 'my_movie_episode_my_movie(Id_my_movie_episode, Id_my_movie)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'Id' => 'ID',
			'Id_my_movie_season' => 'Id My Movie Season',
			'episode_number' => 'Episode Number',
			'description' => 'Description',
			'name' => 'Name',
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
		$criteria->compare('Id_my_movie_season',$this->Id_my_movie_season);
		$criteria->compare('episode_number',$this->episode_number);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('name',$this->name,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}