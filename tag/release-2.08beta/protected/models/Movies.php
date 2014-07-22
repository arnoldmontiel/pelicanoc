	<?php

/**
 * This is the model class for table "movies".
 *
 * The followings are the available columns in table 'movies':
 * @property integer $Id
 * @property string Id_my_movie_disc_nzb
 * @property string Id_my_movie_disc
 * @property string $source_type
 * @property string $date
 * @property string $title
 * @property integer $Id_TMDB_data
 * @property string $year
 * @property string $genre
 * @property string $is_new
 */
class Movies extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Movies the static model class
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
		return 'movies';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Id, Id_TMDB_data', 'numerical', 'integerOnly'=>true),
			array('Id_my_movie_disc_nzb, Id_my_movie_disc', 'length', 'max'=>200),
			array('source_type, is_new', 'length', 'max'=>20),
			array('title', 'length', 'max'=>100),
			array('year', 'length', 'max'=>45),
			array('genre', 'length', 'max'=>255),
			array('date', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('Id, Id_my_movie_disc_nzb, Id_my_movie_disc, source_type, date, title, Id_TMDB_data, year, genre, is_new', 'safe', 'on'=>'search'),
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
			'myMovieDisc' => array(self::BELONGS_TO, 'myMovieDisc', 'Id_my_movie_disc'),
			'myMovieDiscNzb' => array(self::BELONGS_TO, 'MyMovieDiscNzb', 'Id_my_movie_disc_nzb'),
			'TMDBData' => array(self::BELONGS_TO, 'TMDBData', 'Id_TMDB_data'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'Id' => 'ID',
			'disc' => 'Disc',
			'source_type' => 'Source Type',
			'date' => 'Date',
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
		$criteria->order = "t.title ASC";
		
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}