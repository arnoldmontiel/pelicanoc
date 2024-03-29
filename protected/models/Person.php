<?php

/**
 * This is the model class for table "person".
 *
 * The followings are the available columns in table 'person':
 * @property integer $Id
 * @property string $name
 * @property string $type
 * @property string $role
 * @property string $photo
 * @property string $photo_original
 *
 * The followings are the available model relations:
 * @property MyMovieNzb[] $myMovieNzbs
 * @property MyMovie[] $myMovies
 */
class Person extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Person the static model class
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
		return 'person';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, type, role', 'length', 'max'=>128),
			array('photo, photo_original', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('Id, name, type, role, photo, photo_original', 'safe', 'on'=>'search'),
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
			'myMovieNzbs' => array(self::MANY_MANY, 'MyMovieNzb', 'my_movie_nzb_person(Id_person, Id_my_movie_nzb)'),
			'myMovies' => array(self::MANY_MANY, 'MyMovie', 'my_movie_person(Id_person, Id_my_movie)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'Id' => 'ID',
			'name' => 'Name',
			'type' => 'Type',
			'role' => 'Role',
			'photo' => 'Photo',
			'photo_original' => 'Photo Original',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('role',$this->role,true);
		$criteria->compare('photo',$this->photo,true);
		$criteria->compare('photo_original',$this->photo_original,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}