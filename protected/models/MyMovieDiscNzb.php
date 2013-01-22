<?php

/**
 * This is the model class for table "my_movie_disc_nzb".
 *
 * The followings are the available columns in table 'my_movie_disc_nzb':
 * @property string $Id
 * @property string $name
 * @property string $Id_my_movie_nzb
 *
 * The followings are the available model relations:
 * @property MyMovieEpisode[] $myMovieEpisodes
 * @property MyMovieNzb $idMyMovieNzb
 * @property Nzb[] $nzbs
 */
class MyMovieDiscNzb extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return MyMovieDiscNzb the static model class
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
		return 'my_movie_disc_nzb';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Id, Id_my_movie_nzb', 'required'),
			array('Id, Id_my_movie_nzb, name', 'length', 'max'=>200),			
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('Id, name, Id_my_movie_nzb', 'safe', 'on'=>'search'),
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
			'myMovieEpisodes' => array(self::MANY_MANY, 'MyMovieEpisode', 'disc_episode_nzb(Id_my_movie_disc_nzb, Id_my_movie_episode)'),
			'myMovieNzb' => array(self::BELONGS_TO, 'MyMovieNzb', 'Id_my_movie_nzb'),
			'nzbs' => array(self::HAS_MANY, 'Nzb', 'Id_my_movie_disc_nzb'),
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
			'Id_my_movie_nzb' => 'Id My Movie Nzb',
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
		$criteria->compare('Id_my_movie_nzb',$this->Id_my_movie_nzb,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}