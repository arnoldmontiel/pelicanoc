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
 * @property integer $was_sent
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
			array('parental_control, was_sent', 'numerical', 'integerOnly'=>true),
			array('Id_imdbdata', 'length', 'max'=>45),
			array('creation_date', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('Id, path, Id_imdbdata, Id_my_movie, creation_date, parental_control, was_sent', 'safe', 'on'=>'search'),
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
			'was_sent' => 'Was Sent',
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
	
	public static function sincronizeWithServer()
	{	
		$requests = array();
		$pelicanoCliente = new Pelicano;
		$idCustomer = null;
		$modelUser = User::getCurrentUser();
		$idCustomer = (isset($modelUser))?$modelUser->Id_customer:null; 
		
		if(isset($idCustomer))
		{
			$rippedMovies = RippedMovie::model()->findAllByAttributes(array('was_sent'=>0));
			foreach($rippedMovies as $item)
			{
				$request= new RippedRequest;
				
				$request->Id_customer = $idCustomer;
				$request->ripped_date = $item->creation_date;
				$request->Id_my_movie = $item->myMovie->Id;
				$request->type = $item->myMovie->type;
				$request->bar_code = $item->myMovie->bar_code;
				$request->country = $item->myMovie->country;
				$request->local_title = $item->myMovie->local_title;
				$request->original_title = $item->myMovie->original_title;
				$request->sort_title = $item->myMovie->sort_title;
				$request->aspect_ratio = $item->myMovie->aspect_ratio;
				$request->video_standard = $item->myMovie->video_standard;
				$request->production_year = $item->myMovie->production_year;
				$request->release_date = $item->myMovie->release_date;
				$request->running_time = $item->myMovie->running_time;
				$request->description = $item->myMovie->description;
				$request->extra_features = $item->myMovie->extra_features;
				$request->parental_rating_desc = $item->myMovie->parental_rating_desc;
				$request->imdb = $item->myMovie->imdb;
				$request->rating = $item->myMovie->rating;
				$request->data_changed = $item->myMovie->data_changed;
				$request->covers_changed = $item->myMovie->covers_changed;
				$request->genre = $item->myMovie->genre;
				$request->studio =  $item->myMovie->studio;
				$request->poster = $item->myMovie->poster_original;
				$request->backdrop = $item->myMovie->backdrop_original;
				$request->adult = $item->myMovie->adult;
				$request->Id_parental_control = $item->myMovie->Id_parental_control;
				$requests[]=$request;
			} 
			if( count($requests) > 0 && $pelicanoCliente->setRipped($requests))
			{
				$RippedResponseArray = $pelicanoCliente->getRipped($idCustomer);
				foreach($RippedResponseArray as $item)
				{
					$model = RippedMovie::model()->findByAttributes(array('Id_my_movie'=>$item->Id_my_movie));
					if(isset($model))
					{
						$model->was_sent = 1;
						$model->save();
					}
					
				}
			}
		}
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