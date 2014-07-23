<?php

/**
 * This is the model class for table "customer_transaction".
 *
 * The followings are the available columns in table 'customer_transaction':
 * @property integer $Id
 * @property integer $Id_nzb
 * @property integer $Id_transaction_type
 * @property string $date
 * @property integer $points
 * @property integer $Id_customer
 *
 * The followings are the available model relations:
 * @property Nzb $idNzb
 * @property TransactionType $idTransactionType
 * @property Customer $idCustomer
 */
class CustomerTransaction extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return CustomerTransaction the static model class
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
		return 'customer_transaction';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Id, Id_transaction_type, Id_customer', 'required'),
			array('Id, Id_nzb, Id_transaction_type, points, Id_customer', 'numerical', 'integerOnly'=>true),
			array('description', 'length', 'max'=>255),
			array('date', 'safe'),			
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('Id, Id_nzb, Id_transaction_type, date, points, Id_customer, description', 'safe', 'on'=>'search'),
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
			'idNzb' => array(self::BELONGS_TO, 'Nzb', 'Id_nzb'),
			'idTransactionType' => array(self::BELONGS_TO, 'TransactionType', 'Id_transaction_type'),
			'idCustomer' => array(self::BELONGS_TO, 'Customer', 'Id_customer'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'Id' => 'ID',
			'Id_nzb' => 'Id Nzb',
			'Id_transaction_type' => 'Id Transaction Type',
			'date' => 'Date',
			'points' => 'Points',
			'Id_customer' => 'Id Customer',
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
		$criteria->compare('Id_nzb',$this->Id_nzb);
		$criteria->compare('Id_transaction_type',$this->Id_transaction_type);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('points',$this->points);
		$criteria->compare('Id_customer',$this->Id_customer);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}