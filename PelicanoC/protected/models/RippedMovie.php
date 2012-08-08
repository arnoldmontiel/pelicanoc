<?php

/**
 * This is the model class for table "ripped_movie".
 *
 * The followings are the available columns in table 'ripped_movie':
 * @property integer $Id
 * @property string $path
 * @property string $Id_imdbdata
 * @property string $Id_myMovie
 *
 * The followings are the available model relations:
 * @property Imdbdata $idImdbdata
 */
class RippedMovie extends CActiveRecord
{
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
			array('Id_imdbdata', 'required'),
			array('path, Id_myMovie', 'length', 'max'=>255),
			array('Id_imdbdata', 'length', 'max'=>45),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('Id, path, Id_imdbdata, Id_myMovie', 'safe', 'on'=>'search'),
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
			'imdbdata' => array(self::BELONGS_TO, 'Imdbdata', 'Id_imdbdata'),
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
			'Id_imdbdata' => 'Id Imdbdata',
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
		$criteria->compare('path',$this->path,true);
		$criteria->compare('Id_imdbdata',$this->Id_imdbdata,true);

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
		$criteria->order = "imdbdata.Year DESC";
	
	
		return new CActiveDataProvider($this, array(
								'criteria'=>$criteria,
		));
	}
}