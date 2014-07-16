<?php

/**
 * This is the model class for table "current_external_storage".
 *
 * The followings are the available columns in table 'current_external_storage':
 * @property integer $Id
 * @property string $in_date
 * @property string $out_date
 * @property integer $is_in
 * @property integer $read
 * @property string $path
 * @property integer $state
 * @property integer $soft_scan_ready
 * @property integer $hard_scan_ready
 * @property string $label
 *
 * The followings are the available model relations:
 * @property ExternalStorageData[] $externalStorageDatas
 */
class CurrentExternalStorage extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'current_external_storage';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('is_in, read, state, soft_scan_ready, hard_scan_ready', 'numerical', 'integerOnly'=>true),
			array('path', 'length', 'max'=>200),
			array('label', 'length', 'max'=>256),
			array('in_date, out_date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('Id, in_date, out_date, is_in, read, path, state, soft_scan_ready, hard_scan_ready, label', 'safe', 'on'=>'search'),
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
			'externalStorageDatas' => array(self::HAS_MANY, 'ExternalStorageData', 'Id_current_external_storage'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'Id' => 'ID',
			'in_date' => 'In Date',
			'out_date' => 'Out Date',
			'is_in' => 'Is In',
			'read' => 'Read',
			'path' => 'Path',
			'state' => 'State',
			'soft_scan_ready' => 'Soft Scan Ready',
			'hard_scan_ready' => 'Hard Scan Ready',
			'label' => 'Label',
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
		$criteria->compare('in_date',$this->in_date,true);
		$criteria->compare('out_date',$this->out_date,true);
		$criteria->compare('is_in',$this->is_in);
		$criteria->compare('read',$this->read);
		$criteria->compare('path',$this->path,true);
		$criteria->compare('state',$this->state);
		$criteria->compare('soft_scan_ready',$this->soft_scan_ready);
		$criteria->compare('hard_scan_ready',$this->hard_scan_ready);
		$criteria->compare('label',$this->label,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CurrentExternalStorage the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
