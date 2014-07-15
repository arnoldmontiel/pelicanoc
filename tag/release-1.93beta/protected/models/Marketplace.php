<?php

/**
 * This is the model class for table "marketplace".
 *
 * The followings are the available columns in table 'marketplace':
 * @property integer $Id
 * @property string $Id_my_movie_disc_nzb
 * @property integer $source_type
 * @property string $date
 * @property string $title
 * @property integer $Id_TMDB_data
 * @property string $year
 * @property string $genre
 * @property integer $downloaded
 * @property integer $downloading
 */
class Marketplace extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'marketplace';
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
			array('Id, source_type, Id_TMDB_data, downloaded, downloading', 'numerical', 'integerOnly'=>true),
			array('Id_my_movie_disc_nzb', 'length', 'max'=>200),
			array('title', 'length', 'max'=>100),
			array('year', 'length', 'max'=>45),
			array('genre', 'length', 'max'=>255),
			array('date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('Id, Id_my_movie_disc_nzb, source_type, date, title, Id_TMDB_data, year, genre, downloaded, downloading', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'Id' => 'ID',
			'Id_my_movie_disc_nzb' => 'Id My Movie Disc Nzb',
			'source_type' => 'Source Type',
			'date' => 'Date',
			'title' => 'Title',
			'Id_TMDB_data' => 'Id Tmdb Data',
			'year' => 'Year',
			'genre' => 'Genre',
			'downloaded' => 'Downloaded',
			'downloading' => 'Downloading',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		$criteria=new CDbCriteria;
		$criteria->order = "t.title ASC";

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Marketplace the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
