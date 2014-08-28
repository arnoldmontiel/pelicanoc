<?php

/**
 * This is the model class for table "my_movie".
 *
 * The followings are the available columns in table 'my_movie':
 * @property string $Id
 * @property string $type
 * @property string $bar_code
 * @property string $country
 * @property string $local_title
 * @property string $original_title
 * @property string $sort_title
 * @property string $aspect_ratio
 * @property string $video_standard
 * @property string $production_year
 * @property string $release_date
 * @property string $running_time
 * @property string $description
 * @property string $extra_features
 * @property string $parental_rating_desc
 * @property string $imdb
 * @property string $rating
 * @property string $data_changed
 * @property string $covers_changed
 * @property string $genre
 * @property string $studio
 * @property string $poster
 * @property string $poster_original
 * @property string $big_poster
 * @property string $big_poster_original
 * @property string $backdrop
 * @property string $backdrop_original
 * @property integer $Id_parental_control
 * @property integer $adult
 * @property string $Id_my_movie_serie_header
 * @property string $media_type
 *
 * The followings are the available model relations:
 * @property ParentalControl $parentalControl
 * @property MyMovieSerieHeader $myMovieSerieHeader
 * @property AudioTrack[] $audioTracks
 * @property Subtitle[] $subtitles
 * @property RippedMovie[] $rippedMovies
 */
class MyMovie extends CActiveRecord
{
	public $percentage;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return MyMovie the static model class
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
		return 'my_movie';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Id, Id_parental_control', 'required'),
			array('Id_parental_control, adult, is_custom', 'numerical', 'integerOnly'=>true),
			array('Id, Id_my_movie_serie_header', 'length', 'max'=>200),
			array('type, bar_code, country, aspect_ratio, video_standard, production_year, release_date, running_time, imdb, media_type', 'length', 'max'=>45),
			array('local_title, original_title, sort_title, data_changed, covers_changed', 'length', 'max'=>100),
			array('parental_rating_desc, genre, poster, poster_original, big_poster, big_poster_original, backdrop, backdrop_original', 'length', 'max'=>255),
			array('studio', 'length', 'max'=>512),
			array('rating', 'length', 'max'=>10),
			array('description, extra_features, is_custom, certification', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('Id, type, bar_code, country, local_title, original_title, sort_title, aspect_ratio, video_standard, production_year, release_date, running_time, description, extra_features, parental_rating_desc, imdb, rating, data_changed, covers_changed, genre, studio, poster, poster_original, big_poster, big_poster_original, backdrop, backdrop_original, Id_parental_control, adult, Id_my_movie_serie_header, media_type', 'safe', 'on'=>'search'),
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
			'parentalControl' => array(self::BELONGS_TO, 'ParentalControl', 'Id_parental_control'),
			'myMovieSerieHeader' => array(self::BELONGS_TO, 'MyMovieSerieHeader', 'Id_my_movie_serie_header'),
			'audioTracks' => array(self::MANY_MANY, 'AudioTrack', 'my_movie_audio_track(Id_my_movie, Id_audio_track)'),
			'subtitles' => array(self::MANY_MANY, 'Subtitle', 'my_movie_subtitle(Id_my_movie, Id_subtitle)'),
			'persons' => array(self::MANY_MANY, 'Person', 'my_movie_person(Id_my_movie, Id_person)'),
			'rippedMovies' => array(self::HAS_MANY, 'RippedMovie', 'Id_my_movie'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'Id' => 'ID',
			'type' => 'Type',
			'bar_code' => 'Bar Code',
			'country' => 'Country',
			'local_title' => 'Local Title',
			'original_title' => 'Original Title',
			'sort_title' => 'Sort Title',
			'aspect_ratio' => 'Aspect Ratio',
			'video_standard' => 'Video Standard',
			'production_year' => 'Production Year',
			'release_date' => 'Release Date',
			'running_time' => 'Running Time',
			'description' => 'Description',
			'extra_features' => 'Extra Features',
			'parental_rating_desc' => 'Parental Rating Desc',
			'imdb' => 'Imdb',
			'rating' => 'Rating',
			'data_changed' => 'Data Changed',
			'covers_changed' => 'Covers Changed',
			'genre' => 'Genre',
			'studio' => 'Studio',
			'poster' => 'Poster',
			'poster_original' => 'Poster Original',
			'big_poster' => 'Big Poster',
			'big_poster_original' => 'Big Poster Original',
			'backdrop' => 'Backdrop',
			'backdrop_original' => 'Backdrop Original',
			'Id_parental_control' => 'Id Parental Control',
			'adult' => 'Adult',
			'Id_my_movie_serie_header' => 'Id My Movie Serie Header',
			'media_type' => 'Media Type',
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
		$criteria->compare('type',$this->type,true);
		$criteria->compare('bar_code',$this->bar_code,true);
		$criteria->compare('country',$this->country,true);
		$criteria->compare('local_title',$this->local_title,true);
		$criteria->compare('original_title',$this->original_title,true);
		$criteria->compare('sort_title',$this->sort_title,true);
		$criteria->compare('aspect_ratio',$this->aspect_ratio,true);
		$criteria->compare('video_standard',$this->video_standard,true);
		$criteria->compare('production_year',$this->production_year,true);
		$criteria->compare('release_date',$this->release_date,true);
		$criteria->compare('running_time',$this->running_time,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('extra_features',$this->extra_features,true);
		$criteria->compare('parental_rating_desc',$this->parental_rating_desc,true);
		$criteria->compare('imdb',$this->imdb,true);
		$criteria->compare('rating',$this->rating,true);
		$criteria->compare('data_changed',$this->data_changed,true);
		$criteria->compare('covers_changed',$this->covers_changed,true);
		$criteria->compare('genre',$this->genre,true);
		$criteria->compare('studio',$this->studio,true);
		$criteria->compare('poster',$this->poster,true);
		$criteria->compare('poster_original',$this->poster_original,true);
		$criteria->compare('big_poster',$this->big_poster,true);
		$criteria->compare('big_poster_original',$this->big_poster_original,true);
		$criteria->compare('backdrop',$this->backdrop,true);
		$criteria->compare('backdrop_original',$this->backdrop_original,true);
		$criteria->compare('Id_parental_control',$this->Id_parental_control);
		$criteria->compare('adult',$this->adult);
		$criteria->compare('Id_my_movie_serie_header',$this->Id_my_movie_serie_header,true);
		$criteria->compare('media_type',$this->media_type,true);
		
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}