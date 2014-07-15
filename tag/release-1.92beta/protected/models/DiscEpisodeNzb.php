<?php

/**
 * This is the model class for table "disc_episode_nzb".
 *
 * The followings are the available columns in table 'disc_episode_nzb':
 * @property string $Id_my_movie_disc_nzb
 * @property integer $Id_my_movie_episode
 */
class DiscEpisodeNzb extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return DiscEpisodeNzb the static model class
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
		return 'disc_episode_nzb';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Id_my_movie_disc_nzb, Id_my_movie_episode', 'required'),
			array('Id_my_movie_episode', 'numerical', 'integerOnly'=>true),
			array('Id_my_movie_disc_nzb', 'length', 'max'=>200),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('Id_my_movie_disc_nzb, Id_my_movie_episode', 'safe', 'on'=>'search'),
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
			'myMovieDiscNzb' => array(self::BELONGS_TO, 'MyMovieDiscNzb', 'Id_my_movie_disc_nzb'),
			'myMovieEpisode' => array(self::BELONGS_TO, 'MyMovieEpisode', 'Id_my_movie_episode'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'Id_my_movie_disc_nzb' => 'Id My Movie Disc Nzb',
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

		$criteria->compare('Id_my_movie_disc_nzb',$this->Id_my_movie_disc_nzb,true);
		$criteria->compare('Id_my_movie_episode',$this->Id_my_movie_episode);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}