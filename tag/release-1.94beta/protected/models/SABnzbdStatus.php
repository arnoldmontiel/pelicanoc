<?php

/**
 * This is the model class for table "SABnzbdStatus".
 *
 * The followings are the available columns in table 'resource':
 * @property SABnzbdQueue $queue
 * @property SABnzbdJob $jobs
 * @property array $attributes Attribute values indexed by attribute names.
 * @property string $have_warnings
 *  
 *
 */
class SABnzbdStatus extends CModel
{
	public $setting; 
	public $urlXml;
	public $urlJson;
	public $urlJsonAdvanced;
	private $_attributes = array();
	private $_jobs = array();
	
	function __construct()
	{
		$this->setting = Setting::getInstance();
		$this->urlXml =  $this->setting->sabnzb_api_url."mode=qstatus&output=xml&apikey=".$this->setting->sabnzb_api_key;
		$this->urlJson = $this->setting->sabnzb_api_url."mode=qstatus&output=json&apikey=".$this->setting->sabnzb_api_key;
		$this->urlJsonAdvanced = $this->setting->sabnzb_api_url."mode=queue&start=START&limit=LIMIT&output=json&apikey=".$this->setting->sabnzb_api_key;		
	}
	function completeSABNZBDId()
	{
		if(empty($this->_attributes))
		{
			$jsonData = @file_get_contents($this->urlJson);
			$this->_attributes = CJSON::decode($jsonData,true);
				
		}
		if(isset($this->_attributes)&&is_array($this->_attributes)&&isset($this->_attributes['jobs']))
		{
			foreach ($this->_attributes['jobs'] as $job)
			{
				$nzbs = Nzb::model()->findAllByAttributes(array('ready'=>1,'downloaded'=>'0','downloading'=>'1'));
				foreach ($nzbs as $nzb)
				{
					$filename = explode('.', $nzb->file_name);
					$filename =$filename[0];
					$parentJob =$job;
					$proccesed = false;
					if(strpos($job['filename'], $filename)!== false)
					{
						$save = false;
						if(!isset($nzb->sabnzbd_id))
						{
							$nzb->sabnzbd_id=$parentJob['id'];
							$save = true;
						}
						if(!isset($nzb->sabnzbd_size))
						{
							$save = true;
							$nzb->sabnzbd_size=$parentJob['mb'];
						}
						if($save)
						{
							$nzb->save();
						}
						break;
					}
				}
			}
		}
	}
	function completeQueuedJobs()
	{
		$workingJobs = array();
		if(isset($this->_attributes['jobs']))
		{
			foreach ($this->_attributes['jobs'] as $job)
			{
				$nzb = Nzb::model()->findByAttributes(array('sabnzbd_id'=>$job['id']));
				if(isset($nzb))
				{
					$job['nzb_id'] = $nzb->Id;
					$job['nzb_id_original']=$nzb->Id;
					if(isset($nzb->Id_nzb))
						$job['nzb_id']=$nzb->Id_nzb;
					//busco en $workingJobs si ya esta, si no, lo inserto y acumulo en ese item
					$found = false;
					foreach ($workingJobs as $jobAdded)
					{
						if($jobAdded['nzb_id']==$job['nzb_id'])
						{
							$found = true;
							break;
						}
					}
					//si no lo encuentro en $workingJobs, lo agrego
					if(!$found)
					{						
						$total = round($job['mb']);
						$current = round($job["mb"]-$job["mbleft"]);
						$percentage = 0;
						if($total > 0)
							$percentage = round(($current * 100) / $total);
						$job['nzb_porcent']=$percentage;
			
						$workingJobs[] = $job;
					}
					else//si lo encuentro en $workingJobs, lo sumo
					{
						foreach ($workingJobs as &$jobAdded)
						{
							if($jobAdded['nzb_id']==$job['nzb_id'])
							{
								$jobAdded['mb'] = $jobAdded['mb'] + $job['mb'];
								$jobAdded["mbleft"] = $jobAdded['mbleft'] + $job['mbleft'];
								$total = round($jobAdded['mb']);
								$current = round($jobAdded["mb"]-$jobAdded["mbleft"]);
								$percentage = 0;
								if($total > 0)
									$percentage = round(($current * 100) / $total);
								$jobAdded['nzb_porcent']=$percentage;
								break;
							}
						}
						unset($jobAdded);
					}						
				}
			}
		}
		$this->_attributes['jobs']=$workingJobs;
		$this->_jobs=$workingJobs;
	}

	
	function completeHistoryJobs()
	{
		$sABnzbdHistory= new SABnzbdHistory();
		$sABnzbdHistory->getHistory();
		foreach ($sABnzbdHistory->slots as $slot)
		{
			$found= false;
			foreach ($this->_jobs as &$jobToUpdate)
			{
				if(!isset($slot['nzb_id']))	continue;
				if($slot['nzb_id']==$jobToUpdate['nzb_id'])
				{
					$nzb = Nzb::model()->findByPk($slot['nzb_id_original']);
					// si isset($jobToUpdate['status']) significa que este job fue agregado manualmente 
					if(isset($jobToUpdate['status'])&&$nzb->has_error)
					{
						$jobToUpdate['status'] ="Failed";
						$jobToUpdate['error'] =1;						
					}
					$jobToUpdate['mb'] = $jobToUpdate['mb'] + $nzb->sabnzbd_size;
					$total = round($jobToUpdate['mb']);
					$current = round($jobToUpdate["mb"]-$jobToUpdate["mbleft"]);
					$percentage = 0;
					if($total > 0)
						$percentage = round(($current * 100) / $total);
					$jobToUpdate['nzb_porcent']=$percentage;

					//Si no es un error el job, actualizo con el nuevo status.
					if(isset($jobToUpdate['status']) && $jobToUpdate['status']!="Failed")
					{
						$jobToUpdate['status'] =$slot['status'];
						if($slot['status']=="Failed")
						{
							$jobToUpdate['error'] =1;
						}
						else
						{
							$jobToUpdate['error'] =0;
						}						
					}
						
					$found= true;
					break;
				}
			}
			unset($jobToUpdate);
			if(!$found)//si no existe este slot en un job activo, entonces agrego un nuevo job
			{
				$job = array();
				$job['nzb_id'] =$slot['nzb_id'];
				$job['status'] =$slot['status'];
				$nzb = Nzb::model()->findByPk($slot['nzb_id_original']);
				$job['mb'] = $nzb->sabnzbd_size;
				$job['mbleft'] =0;
				$job['nzb_id_original'] =$slot['nzb_id_original'];
				if($slot['status']=="Failed")
				{
					$job['error'] =1;
				}
				else
				{
					$job['error'] =0;
				}
				if($nzb->has_error)
				{
					$job['status'] ="Failed";
					$job['error'] =1;
				}
				
				$this->_jobs[]=$job;
				$job['nzb_porcent']=100;				
			}
		}
		$this->_attributes['jobs']=$this->_jobs;				
	}
	
	public function getStatus()
	{
		try {
			$jsonData = @file_get_contents($this->urlJson);
			$this->_attributes = CJSON::decode($jsonData,true);
			
			$this->completeSABNZBDId();
			$this->completeQueuedJobs();
			$this->completeHistoryJobs();
			
			$jsonData = @file_get_contents($this->urlJsonAdvanced);
			$result = CJSON::decode($jsonData,true);
			if(isset($result['queue']['speedlimit']))
				$this->_attributes['speedlimit'] = $result['queue']['speedlimit'];
				
		} catch (Exception $e) {
		}
	}
	/**
	* Returns the static model of the specified AR class.
	* @param string $className active record class name.
	* @return Setting the static model class
	*/
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	/**
	* @return array customized attribute labels (name=>label)
	*/
	public function attributeLabels()
	{
		return array(
			'have_warnings' => 'Have Warnings',
			'timeleft' => 'Time Left',
			'mb' => 'MB',		
			'noofslots' => 'Noof Slots',		
			'paused' => 'Paused',		
			'pause_int' => 'Pause Int',		
			'state' => 'State',		
			'loadavg' => 'Loadavg',		
			'mbleft' => 'MB Left',
			'diskspace2' => 'Disk Space',
			'diskspace1' => 'Disk Space',
			'kbpersec' => 'KB/s',		
		);
	}
	/**
	* Returns the list of all attribute names of the model.
	* This would return all column names of the table associated with this AR class.
	* @return array list of attribute names.
	*/
	public function attributeNames()
	{
		return array_key('have_warnings');
	}
	/**
	* PHP getter magic method.
	* @param string $name property name
	* @return mixed property value
	* @see getAttribute
	*/
	public function __get($name)
	{
		if(isset($this->_attributes[$name]))
		return $this->_attributes[$name];
		return parent::__get($name);
	}
	
	/**
	 * PHP setter magic method.
	 * @param string $name property name
	 * @param mixed $value property value
	 */
	public function __set($name,$value)
	{
		if($this->setAttribute($name,$value)===false)
		{
			parent::__set($name,$value);
		}
	}
	/**
	* Sets the named attribute value.
	* You may also use $this->AttributeName to set the attribute value.
	* @param string $name the attribute name
	* @param mixed $value the attribute value.
	* @return boolean whether the attribute exists and the assignment is conducted successfully
	* @see hasAttribute
	*/
	public function setAttribute($name,$value)
	{
		if(property_exists($this,$name))
			$this->$name=$value;
		else if(isset($this->_attributes[$name]))
			$this->_attributes[$name]=$value;
		else
			return false;
		return true;
	}
	
	/**
	 * 
	 * @see CModel::getAttributes()
	 * @return attributes array
	 */
	public function getAttributes($name=null)
	{
		return $this->_attributes;
	}
	
}