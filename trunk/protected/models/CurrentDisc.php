<?php

/**
 * This is the model class for table "current_disc".
 *
 * The followings are the available columns in table 'current_disc':
 * @property integer $Id
 * @property integer $Id_current_disc_state
 * @property string $Id_my_movie_disc
 * @property string $in_date
 * @property string $out_date
 * @property integer $command
 * @property integer $read
 * @property integer $percentage
 *
 * The followings are the available model relations:
 * @property CurrentDiscState $idCurrentDiscState
 */
class CurrentDisc extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'current_disc';
	}

	public function isPlaying()
	{
		$isPlaying = false;
		$playbackUrl = DuneHelper::getPlaybackUrl();
		
		if(isset($playbackUrl))
		{
			if(!empty($playbackUrl))
			{
				$modelNzbs = Nzb::model()->findAll();
		
				$modelNzbCurrent = null;
				foreach($modelNzbs as $nzb)
				{
					if(isset($nzb->path) && !empty($nzb->path))
					{
						if(strpos($playbackUrl,$nzb->path)>0)
						{
							$modelNzbCurrent = $nzb;
							break;
						}
					}
				}
		
				if(!isset($modelNzbCurrent))
				{
					$modelLocalFolderCurrent = null;
					$modelLocalFolders = LocalFolder::model()->findAll();
					foreach($modelLocalFolders as $localFolder)
					{
						if(isset($localFolder->path) && !empty($localFolder->path))
						{
							if(strpos($playbackUrl,$localFolder->path)>0)
							{
								$modelLocalFolderCurrent = $localFolder;
								break;
							}
						}
					}
						
					if(!isset($modelLocalFolderCurrent))					
					{
						$modeRippedMovieCurrent = null;
						$modelRippedMovies = RippedMovie::model()->findAll();
						foreach($modelRippedMovies as $rippedMovie)
						{
							if(isset($rippedMovie->path) && !empty($rippedMovie->path))
							{
								if(strpos($playbackUrl,$rippedMovie->path)>0)
								{
									$modeRippedMovieCurrent = $rippedMovie;
									break;
								}
							}
						}
						
						if(!isset($modeRippedMovieCurrent))
							$isPlaying = true;
					}
						
				}
			}
				
		}		
		return $isPlaying;
	}
	
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Id_current_disc_state', 'required'),
			array('Id_current_disc_state, command, read, percentage', 'numerical', 'integerOnly'=>true),
			array('Id_my_movie_disc', 'length', 'max'=>200),
			array('in_date, out_date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('Id, Id_current_disc_state, Id_my_movie_disc, in_date, out_date, command, read, percentage', 'safe', 'on'=>'search'),
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
			'idCurrentDiscState' => array(self::BELONGS_TO, 'CurrentDiscState', 'Id_current_disc_state'),
			'myMovieDisc' => array(self::BELONGS_TO, 'MyMovieDisc', 'Id_my_movie_disc'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'Id' => 'ID',
			'Id_current_disc_state' => 'Id Current Disc State',
			'Id_my_movie_disc' => 'Id My Movie Disc',
			'in_date' => 'In Date',
			'out_date' => 'Out Date',
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
		$criteria->compare('Id_current_disc_state',$this->Id_current_disc_state);
		$criteria->compare('Id_my_movie_disc',$this->Id_my_movie_disc,true);
		$criteria->compare('in_date',$this->in_date,true);
		$criteria->compare('out_date',$this->out_date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CurrentDisc the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
