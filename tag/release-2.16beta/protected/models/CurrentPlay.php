<?php

/**
 * This is the model class for table "current_play".
 *
 * The followings are the available columns in table 'current_play':
 * @property integer $Id
 * @property integer $Id_player
 * @property integer $Id_local_folder
 * @property integer $Id_ripped_movie
 * @property integer $Id_nzb
 * @property integer $Id_current_disc
 * @property integer $is_playing
 * @property string $creation_date
 *
 * The followings are the available model relations:
 * @property CurrentDisc $idCurrentDisc
 * @property LocalFolder $idLocalFolder
 * @property Nzb $idNzb
 * @property Player $idPlayer
 * @property RippedMovie $idRippedMovie
 */
class CurrentPlay extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'current_play';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Id_player', 'required'),
			array('Id_player, Id_local_folder, Id_ripped_movie, Id_nzb, Id_current_disc, is_playing', 'numerical', 'integerOnly'=>true),
			array('creation_date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('Id, Id_player, Id_local_folder, Id_ripped_movie, Id_nzb, Id_current_disc, is_playing, creation_date', 'safe', 'on'=>'search'),
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
			'currentDisc' => array(self::BELONGS_TO, 'CurrentDisc', 'Id_current_disc'),
			'localFolder' => array(self::BELONGS_TO, 'LocalFolder', 'Id_local_folder'),
			'nzb' => array(self::BELONGS_TO, 'Nzb', 'Id_nzb'),
			'player' => array(self::BELONGS_TO, 'Player', 'Id_player'),
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
			'Id_player' => 'Id Player',
			'Id_local_folder' => 'Id Local Folder',
			'Id_ripped_movie' => 'Id Ripped Movie',
			'Id_nzb' => 'Id Nzb',
			'Id_current_disc' => 'Id Current Disc',
			'is_playing' => 'Is Playing',
			'creation_date' => 'Creation Date',
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
		$criteria->compare('Id_player',$this->Id_player);
		$criteria->compare('Id_local_folder',$this->Id_local_folder);
		$criteria->compare('Id_ripped_movie',$this->Id_ripped_movie);
		$criteria->compare('Id_nzb',$this->Id_nzb);
		$criteria->compare('Id_current_disc',$this->Id_current_disc);
		$criteria->compare('is_playing',$this->is_playing);
		$criteria->compare('creation_date',$this->creation_date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CurrentPlay the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
