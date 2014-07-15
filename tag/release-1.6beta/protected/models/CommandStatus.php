<?php

/**
 * This is the model class for table "command_status".
 *
 * The followings are the available columns in table 'command_status':
 * @property integer $Id
 * @property string $command_name
 * @property integer $busy
 */
class CommandStatus extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return CommandStatus the static model class
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
		return 'command_status';
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
			array('Id, busy', 'numerical', 'integerOnly'=>true),
			array('command_name', 'length', 'max'=>45),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('Id, command_name, busy', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'Id' => 'ID',
			'command_name' => 'Command Name',
			'busy' => 'Busy',
		);
	}

	public function setBusy($busy)
	{
		if($busy)
			$this->busy = 1;
		else
			$this->busy = 0;
		
		$this->save();
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
		$criteria->compare('command_name',$this->command_name,true);
		$criteria->compare('busy',$this->busy);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}