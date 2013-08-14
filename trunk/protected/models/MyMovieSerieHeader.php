<?php

/**
 * This is the model class for table "my_movie_serie_header".
 *
 * The followings are the available columns in table 'my_movie_serie_header':
 * @property string $Id
 * @property string $description
 * @property string $poster
 * @property string $poster_original
 * @property string $big_poster
 * @property string $big_poster_original
 * @property string $genre
 * @property string $name
 * @property string $sort_name
 * @property string $rating
 * @property string $original_network
 * @property string $original_status
 *
 * The followings are the available model relations:
 * @property MyMovie[] $myMovies
 */
class MyMovieSerieHeader extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return MyMovieSerieHeader the static model class
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
		return 'my_movie_serie_header';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Id', 'required'),
			array('Id', 'length', 'max'=>200),
			array('poster, poster_original, big_poster,big_poster_original, genre, name, sort_name, original_network', 'length', 'max'=>255),
			array('rating', 'length', 'max'=>10),
			array('original_status', 'length', 'max'=>100),
			array('description', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('Id, description, poster, poster_original,big_poster, big_poster_original, genre, name, sort_name, rating, original_network, original_status', 'safe', 'on'=>'search'),
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
			'myMovies' => array(self::HAS_MANY, 'MyMovie', 'Id_my_movie_serie_header'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'Id' => 'ID',
			'description' => 'Description',
			'poster' => 'Poster',
			'poster_original' => 'Poster Original',
			'big_poster' => 'Big Poster',
			'big_poster_original' => 'Big Poster Original',
			'genre' => 'Genre',
			'name' => 'Name',
			'sort_name' => 'Sort Name',
			'rating' => 'Rating',
			'original_network' => 'Original Network',
			'original_status' => 'Original Status',
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
		$criteria->compare('description',$this->description,true);
		$criteria->compare('poster',$this->poster,true);
		$criteria->compare('poster_original',$this->poster_original,true);
		$criteria->compare('big_poster',$this->big_poster,true);
		$criteria->compare('big_poster_original',$this->big_poster_original,true);
		$criteria->compare('genre',$this->genre,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('sort_name',$this->sort_name,true);
		$criteria->compare('rating',$this->rating,true);
		$criteria->compare('original_network',$this->original_network,true);
		$criteria->compare('original_status',$this->original_status,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}