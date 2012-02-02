<?php

/**
 * This is the model class for table "nzb".
 *
 * The followings are the available columns in table 'nzb':
 * @property integer $Id
 * @property string $url
 * @property integer $downloaded
 * @property string $path
 * @property string $description
 * @property string $file_name
 * @property string $Id_imdbData
 * @property string $subt_file_name
 * @property string $subt_url
 *
 * The followings are the available model relations:
 * @property Imdbdata $idImdbData
 */
class Nzb extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Nzb the static model class
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
		return 'nzb';
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
			array('Id, downloaded', 'numerical', 'integerOnly'=>true),
			array('url, path, description, file_name, subt_file_name, subt_url', 'length', 'max'=>255),
			array('Id_imdbData', 'length', 'max'=>45),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('Id, url, downloaded, path, description, file_name, Id_imdbData, subt_file_name, subt_url', 'safe', 'on'=>'search'),
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
			'imdbdata' => array(self::BELONGS_TO, 'Imdbdata', 'Id_imdbData'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'Id' => 'ID',
			'url' => 'Url',
			'downloaded' => 'Downloaded',
			'path' => 'Path',
			'description' => 'Description',
			'file_name' => 'File Name',
			'Id_imdbData' => 'Id Imdb Data',
			'subt_file_name' => 'Subt File Name',
			'subt_url' => 'Subt Url',
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

		$criteria->compare('Id',$this->Id);
		$criteria->compare('url',$this->url,true);
		$criteria->compare('downloaded',$this->downloaded);
		$criteria->compare('path',$this->path,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('file_name',$this->file_name,true);
		$criteria->compare('Id_imdbData',$this->Id_imdbData,true);
		$criteria->compare('subt_file_name',$this->subt_file_name,true);
		$criteria->compare('subt_url',$this->subt_url,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}