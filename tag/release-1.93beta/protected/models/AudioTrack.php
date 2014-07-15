<?php

/**
 * This is the model class for table "audio_track".
 *
 * The followings are the available columns in table 'audio_track':
 * @property integer $Id
 * @property string $language
 * @property string $type
 * @property string $chanel
 *
 * The followings are the available model relations:
 * @property MyMovie[] $myMovies
 */
class AudioTrack extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return AudioTrack the static model class
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
		return 'audio_track';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('language, type', 'length', 'max'=>45),
			array('chanel', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('Id, language, type, chanel', 'safe', 'on'=>'search'),
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
			'myMovies' => array(self::MANY_MANY, 'MyMovie', 'my_movie_audio_track(Id_audio_track, Id_my_movie)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'Id' => 'ID',
			'language' => 'Language',
			'type' => 'Type',
			'chanel' => 'Chanel',
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
		$criteria->compare('language',$this->language,true);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('chanel',$this->chanel,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}