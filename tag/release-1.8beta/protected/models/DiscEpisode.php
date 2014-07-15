<?php

/**
 * This is the model class for table "disc_episode".
 *
 * The followings are the available columns in table 'disc_episode':
 * @property string $Id_my_movie_disc
 * @property integer $Id_my_movie_episode
 */
class DiscEpisode extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return DiscEpisode the static model class
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
		return 'disc_episode';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Id_my_movie_disc, Id_my_movie_episode', 'required'),
			array('Id_my_movie_episode', 'numerical', 'integerOnly'=>true),
			array('Id_my_movie_disc', 'length', 'max'=>200),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('Id_my_movie_disc, Id_my_movie_episode', 'safe', 'on'=>'search'),
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
			'myMovieDisc' => array(self::BELONGS_TO, 'MyMovieDisc', 'Id_my_movie_disc'),
			'myMovieEpisode' => array(self::BELONGS_TO, 'MyMovieEpisode', 'Id_my_movie_episode'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'Id_my_movie_disc' => 'Id My Movie Disc',
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

		$criteria->compare('Id_my_movie_disc',$this->Id_my_movie_disc,true);
		$criteria->compare('Id_my_movie_episode',$this->Id_my_movie_episode);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}