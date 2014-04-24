<?php

/**
 * This is the model class for table "local_folder".
 *
 * The followings are the available columns in table 'local_folder':
 * @property integer $Id
 * @property integer $Id_file_type
 * @property string $Id_my_movie_disc
 * @property integer $Id_source_type
 * @property string $read_date
 * @property string $path
 * @property integer $Id_lote
 *
 * The followings are the available model relations:
 * @property Lote $idLote
 * @property FileType $idFileType
 * @property MyMovieDisc $idMyMovieDisc
 * @property SourceType $idSourceType
 */
class LocalFolder extends CActiveRecord
{
	public $sourceType_description;
	public $fileType_description;
	public $title;
		 
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'local_folder';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Id_file_type, Id_my_movie_disc, Id_lote', 'required'),
			array('Id_file_type, Id_source_type, Id_lote, Id_TMDB_data, is_personal, ready', 'numerical', 'integerOnly'=>true),
			array('Id_my_movie_disc', 'length', 'max'=>200),
			array('path, path_original', 'length', 'max'=>255),
			array('read_date, Id_TMDB_data', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('Id, Id_file_type, Id_my_movie_disc, Id_source_type, read_date, path, Id_lote, sourceType_description, fileType_description, title, is_personal, ready, path_original', 'safe', 'on'=>'search'),
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
			'lote' => array(self::BELONGS_TO, 'Lote', 'Id_lote'),
			'fileType' => array(self::BELONGS_TO, 'FileType', 'Id_file_type'),
			'myMovieDisc' => array(self::BELONGS_TO, 'MyMovieDisc', 'Id_my_movie_disc'),
			'sourceType' => array(self::BELONGS_TO, 'SourceType', 'Id_source_type'),
			'bookmarks' => array(self::HAS_MANY, 'Bookmark', 'Id_local_folder'),
			'TMDBData' => array(self::BELONGS_TO, 'TMDBData', 'Id_TMDB_data'),				
			'externalStorageDatas' => array(self::HAS_MANY, 'ExternalStorageData', 'Id_local_folder'),
			'currentPlays' => array(self::HAS_MANY, 'CurrentPlay', 'Id_local_folder'),				
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'Id' => 'ID',
			'Id_file_type' => 'Tipo',
			'Id_my_movie_disc' => 'Id My Movie Disc',
			'Id_source_type' => 'Fuente',
			'read_date' => 'Fecha',
			'path' => 'Ruta',
			'Id_lote' => 'Lote',
			'fileType_description'=>'Tipo',
			'sourceType_description'=>'Fuente',
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
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('read_date',$this->read_date,true);
		$criteria->compare('path',$this->path,true);
		$criteria->compare('Id_lote',$this->Id_lote);
				
 		$criteria->join='INNER JOIN my_movie_disc md ON (md.Id = t.Id_my_movie_disc)
 						INNER JOIN my_movie m ON (m.Id = md.Id_my_movie)
 						LEFT JOIN source_type s ON (s.Id = t.Id_source_type)
 						INNER JOIN file_type f ON (f.Id = t.Id_file_type)';
		
 		$criteria->addSearchCondition("m.original_title",$this->title);
 		$criteria->addSearchCondition("s.description",$this->sourceType_description);
 		$criteria->addSearchCondition("f.description",$this->fileType_description);
		
		// Create a custom sort
		$sort=new CSort;
		$sort->defaultOrder = 't.Id_lote DESC, m.original_title ASC, t.path ASC';
		$sort->attributes=array(
						'path',
						'read_date',
						'Id_lote',
						'title' => array(
								'asc' => 'm.original_title',
								'desc' => 'm.original_title DESC',
		),
						'sourceType_description' => array(
								'asc' => 's.description',
								'desc' => 's.description DESC',
		),
						'fileType_description' => array(
								'asc' => 'f.description',
								'desc' => 'f.description DESC',
		),		
						'*',
		);
		
		return new CActiveDataProvider($this, array(
						'criteria'=>$criteria,
						'sort'=>$sort,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return LocalFolder the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
