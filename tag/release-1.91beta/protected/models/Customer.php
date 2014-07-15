<?php

/**
 * This is the model class for table "customer".
 *
 * The followings are the available columns in table 'customer':
 * @property integer $Id
 * @property string $name
 * @property string $last_name
 * @property integer $current_points
 * @property string $address
 * @property string $adult_password
 * @property string $parental_password
 *
 * The followings are the available model relations:
 * @property Nzb[] $nzbs
 */
class Customer extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Customer the static model class
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
		return 'customer';
	}
	
	public static function useCustomer($code)
	{
		if(!empty($code))
		{
			$setting = Setting::getInstance();				
			$pelicanoCliente = new Pelicano;

			$CustomerResponse = $pelicanoCliente->useCustomer($code, $setting->getId_Device());
				
			if($CustomerResponse != null)
			{
				$modelCustomer = new Customer();
				$modelCustomer->Id = $CustomerResponse->Id;
				$modelCustomer->name = $CustomerResponse->name;
				$modelCustomer->last_name = $CustomerResponse->last_name;
				$modelCustomer->address = $CustomerResponse->address;
				$modelCustomer->save();
	
				$setting = Setting::getInstance();
				$setting->Id_customer = $CustomerResponse->Id;
				$setting->save();
				return true;
			}
				
		}
		return false;
	}
	
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, last_name', 'required'),
			array('Id, current_points', 'numerical', 'integerOnly'=>true),
			array('name, last_name,adult_password,parental_password', 'length', 'max'=>45),
			array('address', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('Id, name, last_name, current_points, address', 'safe', 'on'=>'search'),
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
			'nzbs' => array(self::MANY_MANY, 'Nzb', 'nzb_customer(Id_customer, Id_nzb)'),
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
			'last_name' => 'Last Name',
			'username' => 'Username',
			'current_points' =>'Current Points',
			'adult_password'=> 'Adult Password',
			'parental_password'=> 'Parental Password',
			'address' => 'Address',
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
		$criteria->compare('last_name',$this->last_name,true);
		$criteria->compare('current_points',$this->current_points);
		$criteria->compare('address',$this->address,true);
		
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}