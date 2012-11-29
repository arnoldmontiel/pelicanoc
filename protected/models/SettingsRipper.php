<?php

/**
 * This is the model class for table "settings_ripper".
 *
 * The followings are the available columns in table 'settings_ripper':
 * @property integer $Id
 * @property string $drive_letter
 * @property string $temp_folder_ripping
 * @property string $final_folder_ripping
 * @property string $time_from_reboot
 * @property string $time_to_reboot
 * @property string $mymovies_username
 * @property string $mymovies_password
 */
class SettingsRipper extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return SettingsRipper the static model class
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
		return 'settings_ripper';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Id', 'numerical', 'integerOnly'=>true),
			array('drive_letter', 'length', 'max'=>8),
			array('temp_folder_ripping, final_folder_ripping, mymovies_username, mymovies_password', 'length', 'max'=>256),
			array('time_from_reboot, time_to_reboot', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('Id, drive_letter, temp_folder_ripping, final_folder_ripping, time_from_reboot, time_to_reboot, mymovies_username, mymovies_password', 'safe', 'on'=>'search'),
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
			'drive_letter' => 'Drive Letter',
			'temp_folder_ripping' => 'Temp Folder Ripping',
			'final_folder_ripping' => 'Final Folder Ripping',
			'time_from_reboot' => 'Time From Reboot',
			'time_to_reboot' => 'Time To Reboot',
			'mymovies_username' => 'Mymovies Username',
			'mymovies_password' => 'Mymovies Password',
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
		$criteria->compare('drive_letter',$this->drive_letter,true);
		$criteria->compare('temp_folder_ripping',$this->temp_folder_ripping,true);
		$criteria->compare('final_folder_ripping',$this->final_folder_ripping,true);
		$criteria->compare('time_from_reboot',$this->time_from_reboot,true);
		$criteria->compare('time_to_reboot',$this->time_to_reboot,true);
		$criteria->compare('mymovies_username',$this->mymovies_username,true);
		$criteria->compare('mymovies_password',$this->mymovies_password,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}