<?php

/**
 * This is the model class for table "my_movie_episode_my_movie".
 *
 * The followings are the available columns in table 'my_movie_episode_my_movie':
 * @property string $Id_my_movie
 * @property integer $Id_my_movie_episode
 */
class MyMovieEpisodeMyMovie extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return MyMovieEpisodeMyMovie the static model class
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
		return 'my_movie_episode_my_movie';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Id_my_movie, Id_my_movie_episode', 'required'),
			array('Id_my_movie_episode', 'numerical', 'integerOnly'=>true),
			array('Id_my_movie', 'length', 'max'=>200),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('Id_my_movie, Id_my_movie_episode', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'Id_my_movie' => 'Id My Movie',
			'Id_my_movie_episode' => 'Id My Movie Episode',
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

		$criteria->compare('Id_my_movie',$this->Id_my_movie,true);
		$criteria->compare('Id_my_movie_episode',$this->Id_my_movie_episode);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}