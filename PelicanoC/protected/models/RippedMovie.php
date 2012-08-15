<?php

/**
 * This is the model class for table "ripped_movie".
 *
 * The followings are the available columns in table 'ripped_movie':
 * @property integer $Id
 * @property string $path
 * @property string $Id_imdbdata
 * @property string $Id_my_movie
 * @property string $creation_date
 * @property integer $parental_control
 *
 * The followings are the available model relations:
 * @property Imdbdata $idImdbdata
 */
class RippedMovie extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return RippedMovie the static model class
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
		return 'ripped_movie';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Id_imdbdata', 'required'),
			array('path, Id_my_movie', 'length', 'max'=>255),
			array('parental_control', 'numerical', 'integerOnly'=>true),
			array('Id_imdbdata', 'length', 'max'=>45),
			array('creation_date', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('Id, path, Id_imdbdata, Id_my_movie, creation_date, parental_control', 'safe', 'on'=>'search'),
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
			'imdbdata' => array(self::BELONGS_TO, 'Imdbdata', 'Id_imdbdata'),
			'myMovie' => array(self::BELONGS_TO, 'MyMovie', 'Id_my_movie'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'Id' => 'ID',
			'path' => 'Path',
			'Id_imdbdata' => 'Id Imdbdata',
			'Id_my_movie' => 'Id My Movie',
			'creation_date' => 'Creation Date',
			'parental_control' => 'Parental Control',
		);
	}

	public function isBluray()
	{
		return $this->myMovie->type == "Blu-ray";
	}
	
	public function isDVD()
	{
		return $this->myMovie->type == "DVD";
	}
	
	public function hasDolbyDigital()
	{
		$mymovieAudioTracks = MyMovieAudioTrack::model()->findAllByAttributes(array('Id_my_movie'=>$this->Id_my_movie));
		foreach($mymovieAudioTracks as $item)
		{
			if($item->audioTrack->type == "Dolby Digital")
				return true;
		}
		return false;
	}
	
	public function hasDolbyTrueHD()
	{
		$mymovieAudioTracks = MyMovieAudioTrack::model()->findAllByAttributes(array('Id_my_movie'=>$this->Id_my_movie));
		foreach($mymovieAudioTracks as $item)
		{
			if($item->audioTrack->type == "Dolby TrueHD")
			return true;
		}
		return false;
	}
	
	public function hasDts()
	{
		$mymovieAudioTracks = MyMovieAudioTrack::model()->findAllByAttributes(array('Id_my_movie'=>$this->Id_my_movie));
		foreach($mymovieAudioTracks as $item)
		{
			if($item->audioTrack->type == "DTS-HD Master")
			return true;
		}
		return false;
	}
	
	public function hasDolbySurround()
	{
		$mymovieAudioTracks = MyMovieAudioTrack::model()->findAllByAttributes(array('Id_my_movie'=>$this->Id_my_movie));
		foreach($mymovieAudioTracks as $item)
		{
			if($item->audioTrack->type == "Dolby Digital Surround EX")
			return true;
		}
		return false;
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
		$criteria->compare('path',$this->path,true);
		$criteria->compare('Id_imdbdata',$this->Id_imdbdata,true);
		$criteria->compare('Id_my_movie',$this->Id_my_movie,true);
		$criteria->compare('creation_date',$this->creation_date,true);
		
		if(User::isUnderParentalControl())
			$criteria->addCondition('parental_control = 0','AND');
		
		$criteria->order = "t.creation_date DESC";
		
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function searchOn($expresion)
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.
	
		$criteria=new CDbCriteria;

		$criteria->with[]='imdbdata';
		$criteria->compare('imdbdata.Title',$expresion,true,'OR');
		$criteria->compare('imdbdata.Actors',$expresion,true,'OR');
		$criteria->compare('imdbdata.Director',$expresion,true,'OR');
		$criteria->compare('imdbdata.Year',$expresion,true,'OR');
		$criteria->compare('imdbdata.Writer',$expresion,true,'OR');
		$criteria->compare('imdbdata.Genre',$expresion,true,'OR');
		$criteria->compare('imdbdata.Plot',$expresion,true,'OR');
		
		
		if(User::isUnderParentalControl())
			$criteria->addCondition('parental_control = 0','AND');
		
		$criteria->order = "t.creation_date DESC";
	
	
		return new CActiveDataProvider($this, array(
								'criteria'=>$criteria,
		));
	}
}