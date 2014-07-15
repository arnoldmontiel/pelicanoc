<?php

/**
 * This is the model class for table "my_movie_nzb_audio_track".
 *
 * The followings are the available columns in table 'my_movie_nzb_audio_track':
 * @property string $Id_my_movie_nzb
 * @property integer $Id_audio_track
 */
class MyMovieNzbAudioTrack extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return MyMovieNzbAudioTrack the static model class
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
		return 'my_movie_nzb_audio_track';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Id_my_movie_nzb, Id_audio_track', 'required'),
			array('Id_audio_track', 'numerical', 'integerOnly'=>true),
			array('Id_my_movie_nzb', 'length', 'max'=>200),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('Id_my_movie_nzb, Id_audio_track', 'safe', 'on'=>'search'),
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
			'audioTrack' => array(self::BELONGS_TO, 'AudioTrack', 'Id_audio_track'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'Id_my_movie_nzb' => 'Id My Movie Nzb',
			'Id_audio_track' => 'Id Audio Track',
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
		$criteria->compare('Id_audio_track',$this->Id_audio_track);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}