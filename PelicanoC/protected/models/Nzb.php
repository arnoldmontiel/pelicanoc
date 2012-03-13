<?php
/**
* This is the model class for table "nzb".
*
* The followings are the available columns in table 'nzb':
* @property integer $Id
* @property string $Id_imdbdata_tv
* @property string $Id_imdbdata
* @property string $url
* @property string $path
* @property string $description
* @property string $file_name
* @property string $Id_imdbdata
* @property string $subt_file_name
* @property string $subt_url
* @property integer $resource_Id
* @property integer $downloading
* @property integer $downloaded
* @property string $date
*
* The followings are the available model relations:
* @property Imdbdata $imdbdata$idImdbdata
* @property ImdbdataTv $imdbdataTv
* @property Resource $resource
* @property NzbMovieState[] $nzbMovieStates
*/
class Nzb extends CActiveRecord
{
	public function afterSave()
	{
		$setting = Setting::getInstance();
		$nzbCustomer = NzbCustomer::model()->findByPk(array('Id_nzb'=>$this->Id,'Id_customer'=>$setting->getId_customer()));
		if(!isset($nzbCustomer))
		{
			$nzbCustomer = new NzbCustomer;				
		}
		$nzbCustomer->Id_nzb = $this->Id;
		$nzbCustomer->Id_customer = $setting->getId_customer();
		$nzbCustomer->downloading = $this->downloading;
		$nzbCustomer->downloaded = $this->downloaded;
		$nzbCustomer->date = $this->date;
		$nzbCustomer->requested = $this->requested;
		$nzbCustomer->save();
		
		return parent::afterSave();	
	}
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Nzb the static model class
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
			array('Id', 'required'),
			array('Id, resource_Id, downloading, downloaded', 'numerical', 'integerOnly'=>true),
			array('Id_imdbdata_tv, Id_imdbdata', 'length', 'max'=>45),
			array('url, path, description, file_name, subt_file_name, subt_url', 'length', 'max'=>255),
			array('date', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('Id, Id_imdbdata_tv, Id_imdbdata, url, path, description, file_name, subt_file_name, subt_url, resource_Id, downloading, downloaded, date', 'safe', 'on'=>'search'),
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
			'imdbdata' => array(self::BELONGS_TO, 'Imdbdata', 'Id_imdbdata'),
			'imdbdataTv' => array(self::BELONGS_TO, 'ImdbdataTv', 'Id_imdbdata_tv'),
			'resource' => array(self::BELONGS_TO, 'Resource', 'resource_Id'),
			'nzbMovieStates' => array(self::HAS_MANY, 'NzbMovieState', 'Id_nzb'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'Id' => 'ID',
			'Id_imdbdata_tv' => 'Id Imdbdata Tv',
			'Id_imdbdata' => 'Id Imdbdata',
			'url' => 'Url',
			'path' => 'Path',
			'description' => 'Description',
			'file_name' => 'File Name',
			'subt_file_name' => 'Subt File Name',
			'subt_url' => 'Subt Url',
			'resource_Id' => 'Resource',
			'downloading' => 'Downloading',
			'downloaded' => 'Downloaded',
			'date' => 'Date',
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
		$criteria->compare('Id_imdbdata_tv',$this->Id_imdbdata_tv,true);
		$criteria->compare('Id_imdbdata',$this->Id_imdbdata,true);		
		$criteria->compare('url',$this->url,true);
		$criteria->compare('downloaded',$this->downloaded);
		$criteria->compare('path',$this->path,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('file_name',$this->file_name,true);
		$criteria->compare('subt_file_name',$this->subt_file_name,true);
		$criteria->compare('subt_url',$this->subt_url,true);
		$criteria->compare('resource_Id',$this->resource_Id);
		$criteria->compare('downloading',$this->downloading);
		$criteria->compare('downloaded',$this->downloaded);
		$criteria->compare('date',$this->date,true);
		
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	/**
	* Retrieves a list of models based on the current search/filter conditions.
	* @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	*/
	public function searchNews()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.
	
		$criteria=new CDbCriteria;
	
		$criteria->addCondition('t.date > DATE_SUB(CURDATE(),INTERVAL 7 DAY)');
		$criteria->order = "t.date DESC";
		
		return new CActiveDataProvider($this, array(
					'criteria'=>$criteria,
		));
	}
	public function searchNewsOn($expresion)
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.
	
		$criteria=new CDbCriteria;
	
		$criteria->addCondition('t.date > DATE_SUB(CURDATE(),INTERVAL 7 DAY)');
		$criteria->order = "t.date DESC";

		$criteria->compare('file_name',$expresion,true);
		$criteria->with[]='imdbdata';		
		$criteria->compare('imdbdata.Title',$expresion,true,'OR');
		$criteria->compare('imdbdata.Actors',$expresion,true,'OR');
		$criteria->compare('imdbdata.Director',$expresion,true,'OR');
		$criteria->compare('imdbdata.Year',$expresion,true,'OR');
		$criteria->compare('imdbdata.Writer',$expresion,true,'OR');
		$criteria->compare('imdbdata.Genre',$expresion,true,'OR');
		$criteria->compare('imdbdata.Plot',$expresion,true,'OR');
		
		return new CActiveDataProvider($this, array(
						'criteria'=>$criteria,
		));
	}
	
	/**
	* Retrieves a list of models based on the current search/filter conditions.
	* @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	*/
	public function searchOrdered()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.
	
		$criteria=new CDbCriteria;
	
		$criteria->with[]='imdbdata';
		$criteria->order = "imdbdata.Year DESC";
		
		$criteria->addCondition('Id_imdbdata is not NULL');
				
		return new CActiveDataProvider($this, array(
						'criteria'=>$criteria,
		));
	}
	public function searchHomeOrdered()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.
	
		$criteria=new CDbCriteria;
	
		$criteria->with[]='imdbdata';
		$criteria->order = "t.date DESC";
		
		$criteria->addCondition('Id_imdbdata is not NULL');
				
		return new CActiveDataProvider($this, array(
						'criteria'=>$criteria,
		));
	}
	public function searchOn($expresion)
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.
	
		$criteria=new CDbCriteria;
	
		$criteria->order = "t.date DESC";
		
		$criteria->addCondition('Id_imdbdata is not NULL');
				
		$criteria->compare('file_name',$expresion,true,'OR');
		$criteria->with[]='imdbdata';
		$criteria->compare('imdbdata.Title',$expresion,true,'OR');
		$criteria->compare('imdbdata.Actors',$expresion,true,'OR');
		$criteria->compare('imdbdata.Director',$expresion,true,'OR');
		$criteria->compare('imdbdata.Year',$expresion,true,'OR');
		$criteria->compare('imdbdata.Writer',$expresion,true,'OR');
		$criteria->compare('imdbdata.Genre',$expresion,true,'OR');
		$criteria->compare('imdbdata.Plot',$expresion,true,'OR');
		$criteria->order = "imdbdata.Year DESC";
		
		
		return new CActiveDataProvider($this, array(
							'criteria'=>$criteria,
		));
	}
	/**
	* Retrieves a list of models based on the current search/filter conditions.
	* @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	*/
	public function searchSeriesOrdered()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.
	
		$criteria=new CDbCriteria;
	
		$criteria->order = "t.date DESC";
		$criteria->addCondition('Id_imdbdata_tv is not NULL');
				
		return new CActiveDataProvider($this, array(
						'criteria'=>$criteria,
		));
	}
	public function searchSeriesOn($expresion)
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.
	
		$criteria=new CDbCriteria;
	
		
		$criteria->addCondition('Id_imdbdata_tv is not NULL');
				
		$criteria->compare('file_name',$expresion,true,'OR');
		$criteria->with[]='imdbdata';
		$criteria->compare('imdbdata.Title',$expresion,true,'OR');
		$criteria->compare('imdbdata.Actors',$expresion,true,'OR');
		$criteria->compare('imdbdata.Director',$expresion,true,'OR');
		$criteria->compare('imdbdata.Year',$expresion,true,'OR');
		$criteria->compare('imdbdata.Writer',$expresion,true,'OR');
		$criteria->compare('imdbdata.Genre',$expresion,true,'OR');
		$criteria->compare('imdbdata.Plot',$expresion,true,'OR');
		$criteria->order = "imdbdata.Year DESC";
				
		return new CActiveDataProvider($this, array(
							'criteria'=>$criteria,
		));
	}
	public function searchEpisodes($Id_imdbdata_tv_parent)
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.
	
		$criteria=new CDbCriteria;
	
		$criteria->order = "t.date DESC";
		
		$criteria->with[]='imdbdataTv';
		$criteria->compare('imdbdataTv.Id_parent',$Id_imdbdata_tv_parent,false);
			
		return new CActiveDataProvider($this, array(
								'criteria'=>$criteria,
		));
	}
	public function searchEpisodesOfSeason($Id_imdbdata_tv_parent,$season)
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.
	
		$criteria=new CDbCriteria;
	
	
		$criteria->with[]='imdbdataTv';
		$criteria->compare('imdbdataTv.Id_parent',$Id_imdbdata_tv_parent,false);
		$criteria->compare('imdbdataTv.Season',$season,false);
		$criteria->order = "imdbdataTv.Episode";
		
		return new CActiveDataProvider($this, array(
									'criteria'=>$criteria,
		));
	}
	
	public function searchStored()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.
	
		$criteria=new CDbCriteria;
	
		$criteria->join = "LEFT OUTER JOIN nzb_movie_state nms ON nms.Id_nzb=t.Id";				
		$criteria->compare("nms.Id_movie_state", "3");
		$criteria->order = "nms.date DESC";
		
		return new CActiveDataProvider($this, array(
							'criteria'=>$criteria,
		));
	}
	public function searchStoredOn($expresion)
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.
	
		$criteria=new CDbCriteria;
	
		$criteria->join = "LEFT OUTER JOIN nzb_movie_state nms ON nms.Id_nzb=t.Id";
				
		$criteria->compare("nms.Id_movie_state", "3");
		$criteria->order = "nms.date DESC";
					
		$criteria->compare('file_name',$expresion,true);
 		$criteria->with[]='imdbdata';
 		$criteria->compare('imdbdata.Title',$expresion,true,'OR');
		$criteria->compare('imdbdata.Actors',$expresion,true,'OR');
		$criteria->compare('imdbdata.Director',$expresion,true,'OR');
		$criteria->compare('imdbdata.Year',$expresion,true,'OR');
		$criteria->compare('imdbdata.Writer',$expresion,true,'OR');
		$criteria->compare('imdbdata.Genre',$expresion,true,'OR');
		$criteria->compare('imdbdata.Plot',$expresion,true,'OR');
	
		return new CActiveDataProvider($this, array(
								'criteria'=>$criteria,
		));
	}
	public function searchRequested()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.
	
		$criteria=new CDbCriteria;
	
		$criteria->join = "LEFT OUTER JOIN nzb_movie_state nms ON nms.Id_nzb=t.Id";
		$criteria->compare("nms.Id_movie_state", "4");
		$setting= Setting::getInstance();
		$criteria->compare("nms.Id_customer", $setting->getId_Customer());
		$criteria->order = "nms.date DESC";
		$criteria->condition = "nms.Id_movie_state= 4 AND nms.Id_nzb_movie_state =
			 (select max(Id_nzb_movie_state)
				from nzb_movie_state 
				where nzb_movie_state.Id_nzb=t.Id
					 and nzb_movie_state.Id_customer=".$setting->getId_Customer().")";
		
		return new CActiveDataProvider($this, array(
								'criteria'=>$criteria,
		));
	}
	public function searchRequestedOn($expresion)
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.
	
		$criteria=new CDbCriteria;
	
		$criteria->join = "LEFT OUTER JOIN nzb_movie_state nms ON nms.Id_nzb=t.Id";
	
		$criteria->compare("nms.Id_movie_state", "4");
		$setting= Setting::getInstance();
		$criteria->compare("nms.Id_customer", $setting->getId_Customer());
		$criteria->order = "nms.date DESC";
			
		$criteria->compare('file_name',$expresion,true);
		$criteria->with[]='imdbdata';
		$criteria->compare('imdbdata.Title',$expresion,true,'OR');
		$criteria->compare('imdbdata.Actors',$expresion,true,'OR');
		$criteria->compare('imdbdata.Director',$expresion,true,'OR');
		$criteria->compare('imdbdata.Year',$expresion,true,'OR');
		$criteria->compare('imdbdata.Writer',$expresion,true,'OR');
		$criteria->compare('imdbdata.Genre',$expresion,true,'OR');
		$criteria->compare('imdbdata.Plot',$expresion,true,'OR');
		
		$criteria->with[]='imdbdata_tv';
		$criteria->compare('imdbdataTv.Title',$expresion,true,'OR');
		$criteria->compare('imdbdataTv.Actors',$expresion,true,'OR');
		$criteria->compare('imdbdataTv.Director',$expresion,true,'OR');
		$criteria->compare('imdbdataTv.Year',$expresion,true,'OR');
		$criteria->compare('imdbdataTv.Writer',$expresion,true,'OR');
		$criteria->compare('imdbdataTv.Genre',$expresion,true,'OR');
		$criteria->compare('imdbdataTv.Plot',$expresion,true,'OR');
		
		return new CActiveDataProvider($this, array(
									'criteria'=>$criteria,
		));
	}
	
	
}