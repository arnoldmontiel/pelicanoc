<?php

/**
 * This is the model class for table "bookmark".
 *
 * The followings are the available columns in table 'bookmark':
 * @property integer $Id
 * @property string $description
 * @property integer $start
 * @property integer $end
 * @property integer $Id_nzb
 * @property integer $Id_local_folder
 * @property integer $Id_ripped_movie
 * @property string $time_start
 * @property string $time_end
 *
 * The followings are the available model relations:
 * @property Nzb $nzb
 * @property LocalFolder $localFolder
 * @property RippedMovie $rippedMovie
 */
class Bookmark extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'bookmark';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('start, end, Id_nzb, Id_local_folder, Id_ripped_movie', 'numerical', 'integerOnly'=>true),
			array('description', 'length', 'max'=>255),
			array('time_start, time_end', 'length', 'max'=>45),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('Id, description, start, end, Id_nzb, Id_local_folder, Id_ripped_movie, time_start, time_end', 'safe', 'on'=>'search'),
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
			'nzb' => array(self::BELONGS_TO, 'Nzb', 'Id_nzb'),
			'localFolder' => array(self::BELONGS_TO, 'LocalFolder', 'Id_local_folder'),
			'rippedMovie' => array(self::BELONGS_TO, 'RippedMovie', 'Id_ripped_movie'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'Id' => 'ID',
			'description' => 'Description',
			'start' => 'Start',
			'end' => 'End',
			'Id_nzb' => 'Id Nzb',
			'Id_local_folder' => 'Id Local Folder',
			'Id_ripped_movie' => 'Id Ripped Movie',
			'time_start' => 'Time Start',
			'time_end' => 'Time End',
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
		$criteria->compare('description',$this->description,true);
		$criteria->compare('start',$this->start);
		$criteria->compare('end',$this->end);
		$criteria->compare('Id_nzb',$this->Id_nzb);
		$criteria->compare('Id_local_folder',$this->Id_local_folder);
		$criteria->compare('Id_ripped_movie',$this->Id_ripped_movie);
		$criteria->compare('time_start',$this->time_start,true);
		$criteria->compare('time_end',$this->time_end,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Bookmark the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
