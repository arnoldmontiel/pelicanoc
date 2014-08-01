<?php

/**
 * This is the model class for table "nzb".
 *
 * The followings are the available columns in table 'nzb':
 * @property integer $Id
 * @property string $Id_my_movie_disc_nzb
 * @property integer $Id_resource
 * @property string $url
 * @property string $path
 * @property string $file_name
 * @property string $subt_file_name
 * @property string $subt_url
 * @property integer $downloading
 * @property integer $downloaded
 * @property string $date
 * @property integer $requested
 * @property integer $points
 * @property integer $ready
 * @property string $mkv_file_name
 * @property integer $deleted
 * @property integer $already_downloaded
 *
 * The followings are the available model relations:
 * @property CustomerTransaction[] $customerTransactions
 * @property MyMovieDiscNzb $idMyMovieDiscNzb
 * @property Resource $idResource
 * @property NzbMovieState[] $nzbMovieStates
 */
class Nzb extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Nzb the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function setAttributesByArray($array)
	{
		$attributesArray = get_object_vars($array);
		while (($value = current($attributesArray)) !== false) {
			$this->setAttribute(key($attributesArray), $value);
			next($attributesArray);
		}
	}
	
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'nzb';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Id, Id_nzb_state, Id_nzb_type', 'required'),
			array('Id, Id_resource, Id_nzb_state, downloading, downloaded, requested, points, ready, Id_nzb_type, sent,ready_to_play,is_personal,has_error,size,deleted,already_downloaded', 'numerical', 'integerOnly'=>true),
			array('sabnzbd_size', 'length', 'max'=>30),
			array('sabnzbd_id', 'length', 'max'=>45),
			array('Id_my_movie_disc_nzb', 'length', 'max'=>200),
			array('final_content_path', 'length', 'max'=>256),
			array('url, path, file_name, subt_file_name, subt_url, mkv_file_name', 'length', 'max'=>255),
			array('date, change_state_date', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('Id, Id_my_movie_disc_nzb, Id_resource, Id_nzb_state, url, path, file_name, subt_file_name, subt_url, downloading, downloaded, date, requested, points, ready, change_state_date, sent, Id_nzb_type, Id_nzb, mkv_file_name, ready_to_play, sabnzbd_size, sabnzbd_id, is_personal, has_error,size, deleted, already_downloaded', 'safe', 'on'=>'search'),
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
			'customerTransactions' => array(self::HAS_MANY, 'CustomerTransaction', 'Id_nzb'),
			'myMovieDiscNzb' => array(self::BELONGS_TO, 'MyMovieDiscNzb', 'Id_my_movie_disc_nzb'),
			'idResource' => array(self::BELONGS_TO, 'Resource', 'Id_resource'),
			'nzbState' => array(self::BELONGS_TO, 'NzbState', 'Id_nzb_state'),
			'bookmarks' => array(self::HAS_MANY, 'Bookmark', 'Id_nzb'),
			'TMDBData' => array(self::BELONGS_TO, 'TMDBData', 'Id_TMDB_data'),
			'nzbType' => array(self::BELONGS_TO, 'NzbType', 'Id_nzb_type'),
			'nzb' => array(self::BELONGS_TO, 'Nzb', 'Id_nzb'),
			'nzbs' => array(self::HAS_MANY, 'Nzb', 'Id_nzb'),
			'currentPlays' => array(self::HAS_MANY, 'CurrentPlay', 'Id_nzb'),				
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'Id' => 'ID',
			'Id_my_movie_disc_nzb' => 'Id My Movie Disc Nzb',
			'Id_resource' => 'Id Resource',
			'Id_nzb_state' => 'Id Nzb State',
			'url' => 'Url',
			'path' => 'Path',
			'file_name' => 'File Name',
			'subt_file_name' => 'Subt File Name',
			'subt_url' => 'Subt Url',
			'downloading' => 'Downloading',
			'downloaded' => 'Downloaded',
			'date' => 'Date',
			'requested' => 'Requested',
			'points' => 'Points',
			'ready' => 'Ready',
			'change_state_date' => 'Change State Date',
			'sent' => 'Sent',
			'final_content_path'=>'Path content',
		
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
		$criteria->compare('Id_my_movie_disc_nzb',$this->Id_my_movie_disc_nzb,true);
		$criteria->compare('Id_resource',$this->Id_resource);
		$criteria->compare('Id_nzb_state',$this->Id_nzb_state);
		$criteria->compare('url',$this->url,true);
		$criteria->compare('path',$this->path,true);
		$criteria->compare('file_name',$this->file_name,true);
		$criteria->compare('subt_file_name',$this->subt_file_name,true);
		$criteria->compare('subt_url',$this->subt_url,true);
		$criteria->compare('downloading',$this->downloading);
		$criteria->compare('downloaded',$this->downloaded);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('requested',$this->requested);
		$criteria->compare('points',$this->points);
		$criteria->compare('ready',$this->ready);
		$criteria->compare('change_state_date',$this->change_state_date,true);
		$criteria->compare('sent',$this->sent);
		$criteria->compare('final_content_path',$this->final_content_path,true);
		
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function searchHomeOrdered()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.
	
		$criteria=new CDbCriteria;
		
		$criteria->addNotInCondition("Id_nzb_state", array(6));
		$criteria->compare('ready',1);
		
		$criteria->order = "t.date DESC";
	
		return new CActiveDataProvider($this, array(
							'criteria'=>$criteria,
		));
	}
	
	public function searchMarketplace()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.
	
		$criteria=new CDbCriteria;
	
// 		$criteria->compare('downloaded',0);		
// 		$criteria->compare('downloading',0);
		$criteria->compare('ready',1);
		$criteria->addCondition("Id_nzb is null");
		
		return new CActiveDataProvider($this, array(
									'criteria'=>$criteria,
		));
	}
	
	public function searchDownloads()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.
	
		$criteria=new CDbCriteria;
	
		$criteria->compare('downloaded',0);
		$criteria->compare('downloading',1);
		$criteria->addCondition('t.Id_nzb is null');
		$criteria->compare('ready',1);
	
		return new CActiveDataProvider($this, array(
										'criteria'=>$criteria,
		));
	}	
	
	public function searchNoSent()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.
	
		$criteria=new CDbCriteria;
	
		$criteria->compare('sent',0);
		$criteria->compare('ready',1);
	
	
		return new CActiveDataProvider($this, array(
								'criteria'=>$criteria,
		));
	}
}