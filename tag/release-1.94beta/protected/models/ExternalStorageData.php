<?php

/**
 * This is the model class for table "external_storage_data".
 *
 * The followings are the available columns in table 'external_storage_data':
 * @property integer $Id
 * @property integer $Id_current_external_storage
 * @property string $path
 * @property string $title
 * @property string $year
 * @property string $poster
 * @property integer $copy
 * @property integer $status
 * @property string $description
 * @property string $imdb
 * @property string $type
 * @property string $file
 * @property integer $is_personal
 * @property integer $already_exists
 * @property integer $Id_local_folder
 * @property string $size
 *
 * The followings are the available model relations:
 * @property CurrentExternalStorage $idCurrentExternalStorage
 * @property LocalFolder $idLocalFolder
 */
class ExternalStorageData extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'external_storage_data';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Id_current_external_storage', 'required'),
			array('Id_current_external_storage, copy, status, is_personal, already_exists, Id_local_folder', 'numerical', 'integerOnly'=>true),
			array('path, poster, description, file', 'length', 'max'=>255),
			array('title', 'length', 'max'=>100),
			array('year, imdb, type', 'length', 'max'=>45),
			array('size', 'length', 'max'=>20),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('Id, Id_current_external_storage, path, title, year, poster, copy, status, description, imdb, type, file, is_personal, already_exists, Id_local_folder, size', 'safe', 'on'=>'search'),
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
			'currentExternalStorage' => array(self::BELONGS_TO, 'CurrentExternalStorage', 'Id_current_external_storage'),
			'localFolder' => array(self::BELONGS_TO, 'LocalFolder', 'Id_local_folder'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'Id' => 'ID',
			'Id_current_external_storage' => 'Id Current External Storage',
			'path' => 'Path',
			'title' => 'Title',
			'year' => 'Year',
			'poster' => 'Poster',
			'copy' => 'Copy',
			'status' => 'Status',
			'description' => 'Description',
			'imdb' => 'Imdb',
			'type' => 'Type',
			'file' => 'File',
			'is_personal' => 'Is Personal',
			'already_exists' => 'Already Exists',
			'Id_local_folder' => 'Id Local Folder',
			'size' => 'Size',
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
		$criteria->compare('Id_current_external_storage',$this->Id_current_external_storage);
		$criteria->compare('path',$this->path,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('year',$this->year,true);
		$criteria->compare('poster',$this->poster,true);
		$criteria->compare('copy',$this->copy);
		$criteria->compare('status',$this->status);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('imdb',$this->imdb,true);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('file',$this->file,true);
		$criteria->compare('is_personal',$this->is_personal);
		$criteria->compare('already_exists',$this->already_exists);
		$criteria->compare('Id_local_folder',$this->Id_local_folder);
		$criteria->compare('size',$this->size,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ExternalStorageData the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
