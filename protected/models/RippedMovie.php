<?php

/**
 * This is the model class for table "ripped_movie".
 *
 * The followings are the available columns in table 'ripped_movie':
 * @property integer $Id
 * @property string $path
 * @property string $Id_my_movie_disc
 * @property string $creation_date
 * @property integer $parental_control
 * @property integer $was_sent
 *
 * The followings are the available model relations:
 * @property Imdbdata $idImdbdata
 */
class RippedMovie extends CActiveRecord
{	
	public $serieId;
	public $seasonId;
	
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
			array('Id_my_movie_disc', 'required'),
			array('Id_my_movie_disc', 'length', 'max'=>200),
			array('path', 'length', 'max'=>255),
			array('parental_control, was_sent', 'numerical', 'integerOnly'=>true),
			array('creation_date', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('Id, path, Id_my_movie_disc, creation_date, parental_control, was_sent', 'safe', 'on'=>'search'),
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
			'Id_my_movie_disc' => 'Id My Movie Disc',
			'creation_date' => 'Creation Date',
			'parental_control' => 'Parental Control',
			'was_sent' => 'Was Sent',
		);
	}

	public function isSerie()
	{
		return isset($this->myMovieDisc->myMovie->Id_my_movie_serie_header);
	}
	
	public function isBluray()
	{
		return $this->myMovieDisc->myMovie->type == "Blu-ray";
	}
	
	public function isDVD()
	{
		return $this->myMovieDisc->myMovie->type == "DVD";
	}
	
	public function hasDolbyDigital()
	{
		$mymovieAudioTracks = MyMovieAudioTrack::model()->findAllByAttributes(array('Id_my_movie'=>$this->myMovieDisc->Id_my_movie));
		foreach($mymovieAudioTracks as $item)
		{
			if($item->audioTrack->type == "Dolby Digital")
				return true;
		}
		return false;
	}
	
	public function hasDolbyTrueHD()
	{
		$mymovieAudioTracks = MyMovieAudioTrack::model()->findAllByAttributes(array('Id_my_movie'=>$this->myMovieDisc->Id_my_movie));
		foreach($mymovieAudioTracks as $item)
		{
			if($item->audioTrack->type == "Dolby TrueHD")
			return true;
		}
		return false;
	}
	
	public function hasDts()
	{
		$mymovieAudioTracks = MyMovieAudioTrack::model()->findAllByAttributes(array('Id_my_movie'=>$this->myMovieDisc->Id_my_movie));
		foreach($mymovieAudioTracks as $item)
		{
			if($item->audioTrack->type == "DTS-HD Master")
			return true;
		}
		return false;
	}
	
	public function hasDolbySurround()
	{
		$mymovieAudioTracks = MyMovieAudioTrack::model()->findAllByAttributes(array('Id_my_movie'=>$this->myMovieDisc->Id_my_movie));
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
		
		$setting = Setting::getInstance();
		$idDevice = $setting->getId_Device(); 
		
		if(isset($idDevice))
		{
			$rippedMovies = RippedMovie::model()->findAllByAttributes(array('was_sent'=>0));
			foreach($rippedMovies as $item)
			{
				$request= new RippedRequest;
				
				$request->Id_device = $idDevice;
				$request->ripped_date = $item->creation_date;
				$request->myMovie->setAttributes($item->myMovieDisc->myMovie);
				
				$request->myMovie->myMovieSerieHeader = self::getSerie($item->myMovieDisc);
				
				//set audio track
				$relAudioTracks = MyMovieAudioTrack::model()->findAllByAttributes(array('Id_my_movie'=>$item->myMovieDisc->Id_my_movie));
				foreach($relAudioTracks as $relAudioTrack)
				{
					$audioTrackSOAP = new MyMovieAudioTrackSOAP();
					$audioTrackSOAP->setAttributes($relAudioTrack->audioTrack);
					$request->myMovie->AudioTrack[] = $audioTrackSOAP;
				}
				
				//set subtitle
				$relSubtitles = MyMovieSubtitle::model()->findAllByAttributes(array('Id_my_movie'=>$item->myMovieDisc->Id_my_movie));
				foreach($relSubtitles as $relSubtitle)
				{
					$subtitleSOAP = new MyMovieSubtitleSOAP();
					$subtitleSOAP->setAttributes($relSubtitle->subtitle);
					$request->myMovie->Subtitle[] = $subtitleSOAP;
				}
				
				//set person
				$relPersons = MyMoviePerson::model()->findAllByAttributes(array('Id_my_movie'=>$item->myMovieDisc->Id_my_movie));
				foreach($relPersons as $relPerson)
				{
					$personSOAP = new MyMoviePersonSOAP();
					$personSOAP->setAttributes($relPerson->person);
					$request->myMovie->Person[] = $personSOAP;
				}
				
				$request->myMovieDisc->setAttributes($item->myMovieDisc);
				
				$requests[]=$request;
			} 
			

			if( count($requests) > 0 && $pelicanoCliente->setRipped($requests))
			{
				$RippedResponseArray = $pelicanoCliente->getRipped($idDevice);
				foreach($RippedResponseArray as $item)
				{
					$model = RippedMovie::model()->findByAttributes(array('Id_my_movie_disc'=>$item->Id_my_movie_disc));
					if(isset($model))
					{
						$model->was_sent = 1;
						$model->save();
					}
					
				}
			}
		}
	}
	
	
	private function getSerie($modelMyMovieDisc)
	{
		if(isset($modelMyMovieDisc->myMovie->myMovieSerieHeader))
		{
			$modelSerieHeader = new MyMovieSerieHeaderSOAP();
			$modelSerieHeader->setAttributes($modelMyMovieDisc->myMovie->myMovieSerieHeader);
			
			$discEpisodes = DiscEpisode::model()->findAllByAttributes(array('Id_my_movie_disc'=>$modelMyMovieDisc->Id));
			$setSeason = true;
			foreach($discEpisodes as $item)
			{
				if($setSeason)
				{
				    $modelSeason = MyMovieSeason::model()->findByPk($item->myMovieEpisode->Id_my_movie_season);
				    $modelSerieHeader->myMovieSeason->setAttributes($modelSeason);
					$setSeason = false;
				}	
				
				$episodeSOAP = new MyMovieEpisodeSOAP();
				$episodeSOAP->setAttributes($item->myMovieEpisode);
				$modelSerieHeader->myMovieSeason->Episode[] = $episodeSOAP;
			}
			
			return $modelSerieHeader;
		}
		
		return null;
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
		$criteria->compare('Id_my_movie_disc',$this->Id_my_movie_disc,true);
		$criteria->compare('creation_date',$this->creation_date,true);
		
		$criteria->join =	"LEFT OUTER JOIN my_movie_disc md ON md.Id=t.Id_my_movie_disc
							 LEFT OUTER JOIN my_movie m ON md.Id_my_movie=m.Id";
		
		//$criteria->addSearchCondition("e.Id_my_movie_season",$this->seasonId);
		$criteria->addCondition('m.Id_parental_control<>9');
		$criteria->addCondition('m.Id_parental_control<>8');
		$criteria->addCondition('m.Id_parental_control<>7');							
		
		$criteria->order = "t.creation_date DESC";
		
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function searchAdult()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.
	
		$criteria=new CDbCriteria;
	
		$criteria->compare('Id',$this->Id);
		$criteria->compare('path',$this->path,true);
		$criteria->compare('Id_my_movie',$this->Id_my_movie,true);
		$criteria->compare('creation_date',$this->creation_date,true);
	
		$criteria->with[]="myMovie";
		$criteria->addCondition('myMovie.Id_parental_control=9','OR');
		$criteria->addCondition('myMovie.Id_parental_control=8','OR');
		$criteria->addCondition('myMovie.Id_parental_control=7','OR');
	
		$criteria->order = "t.creation_date DESC";
	
		return new CActiveDataProvider($this, array(
				'criteria'=>$criteria,
		));
	}
	
	public function searchSerie()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.
	
		$criteria=new CDbCriteria;
	
		$criteria->compare('Id',$this->Id);
		$criteria->compare('path',$this->path,true);
		$criteria->compare('Id_my_movie',$this->Id_my_movie,true);
		$criteria->compare('creation_date',$this->creation_date,true);
	
		$criteria->with[]="myMovie";
		$criteria->addCondition('myMovie.Id_parental_control<>9');
		$criteria->addCondition('myMovie.Id_parental_control<>8');
		$criteria->addCondition('myMovie.Id_parental_control<>7');						
		$criteria->addCondition('myMovie.Id_my_movie_serie_header = "' . $this->serieId. '"');
	
		$criteria->order = "t.creation_date DESC";
	
		return new CActiveDataProvider($this, array(
					'criteria'=>$criteria,
		));
	}

	public function searchSeason()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.
	
		$criteria=new CDbCriteria;
	
		$criteria->compare('Id',$this->Id);
		$criteria->compare('path',$this->path,true);
		$criteria->compare('creation_date',$this->creation_date,true);
	
		$criteria->join =	"LEFT OUTER JOIN disc_episode de ON de.Id_my_movie_disc=t.Id_my_movie_disc
							 LEFT OUTER JOIN my_movie_episode e ON e.Id=de.Id_my_movie_episode";
		$criteria->addSearchCondition("e.Id_my_movie_season",$this->seasonId);
	
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
		
		
		$criteria->with[]="myMovie";
		$criteria->addCondition('myMovie.Id_parental_control<>9');
		$criteria->addCondition('myMovie.Id_parental_control<>8');
		$criteria->addCondition('myMovie.Id_parental_control<>7');
								
		$criteria->order = "t.creation_date DESC";
	
	
		return new CActiveDataProvider($this, array(
								'criteria'=>$criteria,
		));
	}
	public function searchAdultOn($expresion)
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
	
	
		$criteria->with[]="myMovie";
		$criteria->addCondition('myMovie.Id_parental_control=9','OR');
		$criteria->addCondition('myMovie.Id_parental_control=8','OR');
		$criteria->addCondition('myMovie.Id_parental_control=7','OR');
					
		$criteria->order = "t.creation_date DESC";
	
	
		return new CActiveDataProvider($this, array(
									'criteria'=>$criteria,
		));
	}
}