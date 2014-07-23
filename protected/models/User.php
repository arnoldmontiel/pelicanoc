<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property string $username
 * @property string $password
 * @property string $email
 * @property integer $Id_customer
 * @property integer $adult_section
 * @property string $birth_date
 * @property integer $Id_theme
 *
 * The followings are the available model relations:
 * @property Theme $theme
 * @property Customer $customer
 */
class User extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return User the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	static private $_user = null;
	
	/**
	* Returns the static model of the specified AR class.
	* @param string $className active record class name.
	* @return User the static model class
	*/
	
	public static function isAdult()
	{
		$user = User::model()->findByPk(Yii::app()->user->Id);
		return $user->adult_section;
	}
	
	public static function getCurrentUser()
	{
		if(!isset(self::$_user))
		{
			self::$_user = User::model()->findByPk(Yii::app()->user->Id);
		}
		return self::$_user;
	}
	
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('username, password, Id_theme', 'required'),
			array('Id_customer, adult_section', 'numerical', 'integerOnly'=>true),
			array('username, password, email', 'length', 'max'=>128),
			array('birth_date', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('username, password, email, Id_customer, adult_section, birth_date, Id_theme', 'safe', 'on'=>'search'),
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
			'theme' => array(self::BELONGS_TO, 'Theme', 'Id_theme'),
			'customer' => array(self::BELONGS_TO, 'Customer', 'Id_customer'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'username' => 'Username',
			'password' => 'Password',
			'email' => 'Email',
			'Id_customer' => 'Id Customer',
			'adult_section' => 'Adult Section',
			'birth_date' => 'Birth Date',
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

		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('Id_customer',$this->Id_customer);
		$criteria->compare('adult_section',$this->adult_section);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}