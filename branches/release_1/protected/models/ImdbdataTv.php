<?php

/**
 * This is the model class for table "imdbdata_tv".
 *
 * The followings are the available columns in table 'imdbdata_tv':
 * @property string $ID
 * @property string $Title
 * @property integer $Year
 * @property string $Rated
 * @property string $Released
 * @property string $Genre
 * @property string $Director
 * @property string $Writer
 * @property string $Actors
 * @property string $Plot
 * @property string $Poster
 * @property string $Poster_original
 * @property string $Backdrop
 * @property string $Backdrop_original
 * @property string $Runtime
 * @property double $Rating
 * @property string $Votes
 * @property string $Response
 * @property string $Id_parent
 * @property integer $Season
 * @property integer $Episode
 *
 * The followings are the available model relations:
 * @property ImdbdataTv $idParent
 * @property ImdbdataTv[] $imdbdataTvs
 * @property Nzb[] $nzbs
 * @property Season[] $seasons
 */
class ImdbdataTv extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ImdbdataTv the static model class
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
		return 'imdbdata_tv';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ID', 'required'),
			array('Season, Episode', 'numerical', 'integerOnly'=>true),
			array('ID, Rated, Released, Runtime, Votes, Response, Id_parent, Year, Rating', 'length', 'max'=>45),
			array('Title, Genre, Director, Writer, Poster, Poster_original, Backdrop, Backdrop_original', 'length', 'max'=>255),
			array('Actors, Plot', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID, Title, Year, Rated, Released, Genre, Director, Writer, Actors, Plot, Poster, Poster_original, Backdrop, Backdrop_original, Runtime, Rating, Votes, Response, Id_parent, Season, Episode', 'safe', 'on'=>'search'),
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
			'parent' => array(self::BELONGS_TO, 'ImdbdataTv', 'Id_parent'),
			'imdbdataTvs' => array(self::HAS_MANY, 'ImdbdataTv', 'Id_parent'),
			'nzbs' => array(self::HAS_MANY, 'Nzb', 'Id_imdbdata_tv'),
			'seasons' => array(self::HAS_MANY, 'Season', 'Id_imdbdata_tv'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID' => 'ID',
			'Title' => 'Title',
			'Year' => 'Year',
			'Rated' => 'Rated',
			'Released' => 'Released',
			'Genre' => 'Genre',
			'Director' => 'Director',
			'Writer' => 'Writer',
			'Actors' => 'Actors',
			'Plot' => 'Plot',
			'Poster' => 'Poster',
			'Poster_original' => 'Poster Original',
			'Backdrop' => 'Backdrop',
			'Backdrop_original' => 'Backdrop Original',
			'Runtime' => 'Runtime',
			'Rating' => 'Rating',
			'Votes' => 'Votes',
			'Response' => 'Response',
			'Id_parent' => 'Id Parent',
			'Season' => 'Season',
			'Episode' => 'Episode',
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

		$criteria->compare('ID',$this->ID,true);
		$criteria->compare('Title',$this->Title,true);
		$criteria->compare('Year',$this->Year);
		$criteria->compare('Rated',$this->Rated,true);
		$criteria->compare('Released',$this->Released,true);
		$criteria->compare('Genre',$this->Genre,true);
		$criteria->compare('Director',$this->Director,true);
		$criteria->compare('Writer',$this->Writer,true);
		$criteria->compare('Actors',$this->Actors,true);
		$criteria->compare('Plot',$this->Plot,true);
		$criteria->compare('Poster',$this->Poster,true);
		$criteria->compare('Poster_original',$this->Poster_original,true);
		$criteria->compare('Backdrop',$this->Backdrop,true);
		$criteria->compare('Backdrop_original',$this->Backdrop_original,true);
		$criteria->compare('Runtime',$this->Runtime,true);
		$criteria->compare('Rating',$this->Rating);
		$criteria->compare('Votes',$this->Votes,true);
		$criteria->compare('Response',$this->Response,true);
		$criteria->compare('Id_parent',$this->Id_parent,true);
		$criteria->compare('Season',$this->Season);
		$criteria->compare('Episode',$this->Episode);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	public function searchHeader()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.
	
		$criteria=new CDbCriteria;
	
		$criteria->compare('ID',$this->ID,true);
		$criteria->compare('Title',$this->Title,true);
		$criteria->compare('Year',$this->Year);
		$criteria->compare('Rated',$this->Rated,true);
		$criteria->compare('Released',$this->Released,true);
		$criteria->compare('Genre',$this->Genre,true);
		$criteria->compare('Director',$this->Director,true);
		$criteria->compare('Writer',$this->Writer,true);
		$criteria->compare('Actors',$this->Actors,true);
		$criteria->compare('Plot',$this->Plot,true);
		$criteria->compare('Poster',$this->Poster,true);
		$criteria->compare('Poster_original',$this->Poster_original,true);
		$criteria->compare('Backdrop',$this->Backdrop,true);
		$criteria->compare('Backdrop_original',$this->Backdrop_original,true);
		$criteria->compare('Runtime',$this->Runtime,true);
		$criteria->compare('Rating',$this->Rating);
		$criteria->compare('Votes',$this->Votes,true);
		$criteria->compare('Response',$this->Response,true);
		$criteria->compare('Id_parent',$this->Id_parent,true);
		$criteria->compare('Season',$this->Season);
		$criteria->compare('Episode',$this->Episode);

		$criteria->addCondition('Id_parent is NULL');
		
		return new CActiveDataProvider($this, array(
				'criteria'=>$criteria,
		));
	}
	
}