<?php

/**
 * This is the model class for table "local_folder".
 *
 * The followings are the available columns in table 'local_folder':
 * @property integer $Id
 * @property string $Id_my_movie_disc
 * @property integer $Id_folder_type
 * @property string $read_date
 * @property string $path
 *
 * The followings are the available model relations:
 * @property FolderType $idFolderType
 * @property MyMovieDisc $idMyMovieDisc
 */
class LocalFolder extends CActiveRecord
{
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
			array('Id_my_movie_disc, Id_folder_type', 'required'),
			array('Id_folder_type', 'numerical', 'integerOnly'=>true),
			array('Id_my_movie_disc', 'length', 'max'=>200),
			array('path', 'length', 'max'=>255),
			array('read_date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('Id, Id_my_movie_disc, Id_folder_type, read_date, path', 'safe', 'on'=>'search'),
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
			'idFolderType' => array(self::BELONGS_TO, 'FolderType', 'Id_folder_type'),
			'idMyMovieDisc' => array(self::BELONGS_TO, 'MyMovieDisc', 'Id_my_movie_disc'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'Id' => 'ID',
			'Id_my_movie_disc' => 'Id My Movie Disc',
			'Id_folder_type' => 'Id Folder Type',
			'read_date' => 'Read Date',
			'path' => 'Path',
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

		$criteria->compare('Id',$this->Id);
		$criteria->compare('Id_my_movie_disc',$this->Id_my_movie_disc,true);
		$criteria->compare('Id_folder_type',$this->Id_folder_type);
		$criteria->compare('read_date',$this->read_date,true);
		$criteria->compare('path',$this->path,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
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
