<?php

/**
 * This is the model class for table "parental_control".
 *
 * The followings are the available columns in table 'parental_control':
 * @property integer $Id
 * @property integer $value
 * @property string $description
 * @property string $img_url
 * @property integer $age
 *
 * The followings are the available model relations:
 * @property MyMovie[] $myMovies
 */
class ParentalControl extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ParentalControl the static model class
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
		return 'parental_control';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('value, age', 'numerical', 'integerOnly'=>true),
			array('description', 'length', 'max'=>45),
			array('img_url', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('Id, value, description, img_url, age', 'safe', 'on'=>'search'),
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
			'myMovies' => array(self::HAS_MANY, 'MyMovie', 'Id_parental_control'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'Id' => 'ID',
			'value' => 'Value',
			'description' => 'Description',
			'img_url' => 'Img Url',
			'age' => 'Age',
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
		$criteria->compare('value',$this->value);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('img_url',$this->img_url,true);
		$criteria->compare('age',$this->age);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}