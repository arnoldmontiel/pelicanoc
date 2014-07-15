<?php

/**
 * This is the model class for table "my_movie_disc".
 *
 * The followings are the available columns in table 'my_movie_disc':
 * @property string $Id
 * @property string $name
 * @property string $Id_my_movie
 *
 * The followings are the available model relations:
 * @property MyMovieEpisode[] $myMovieEpisodes
 * @property MyMovie $idMyMovie
 * @property RippedMovie[] $rippedMovies
 */
class MyMovieDisc extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return MyMovieDisc the static model class
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
		return 'my_movie_disc';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Id, Id_my_movie', 'required'),
			array('Id, Id_my_movie, name', 'length', 'max'=>200),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('Id, name, Id_my_movie', 'safe', 'on'=>'search'),
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
			'myMovieEpisodes' => array(self::MANY_MANY, 'MyMovieEpisode', 'disc_episode(Id_my_movie_disc, Id_my_movie_episode)'),
			'myMovie' => array(self::BELONGS_TO, 'MyMovie', 'Id_my_movie'),
			'rippedMovies' => array(self::HAS_MANY, 'RippedMovie', 'Id_my_movie_disc'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'Id' => 'ID',
			'name' => 'Name',
			'Id_my_movie' => 'Id My Movie',
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

		$criteria->compare('Id',$this->Id,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('Id_my_movie',$this->Id_my_movie,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}