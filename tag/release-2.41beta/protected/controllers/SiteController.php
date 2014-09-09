<?php

class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
				// captcha action renders the CAPTCHA image displayed on the contact page
				'captcha'=>array(
						'class'=>'CCaptchaAction',
						'backColor'=>0xFFFFFF,
				),
				// page action renders "static" pages stored under 'protected/views/site/pages'
				// They can be accessed via: index.php?r=site/page&view=FileName
				'page'=>array(
						'class'=>'CViewAction',
				),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{

		$modelMovies = new Movies();
		$dataProvider= $modelMovies->search();
		$dataProvider->pagination->pageSize= 250;

		$this->render('index',array(
				'dataProvider'=>$dataProvider,
		));

	}

	public function actionConsumption()
	{
		$this->showFilter = false;
		
		$modelConsumption = new Consumption('search');
		$modelConsumption->unsetAttributes();
		if(isset($_GET['Consumption']))
			$modelConsumption->attributes=$_GET['Consumption'];
		
		$this->render('consumption', array('modelConsumption'=>$modelConsumption));
	
	}
	
	public function actionConfig()
	{
		$this->showFilter = false;
		$setting = Setting::getInstance();
		
		if(!isset($setting->Id_device))
		{
			$this->currentStatus = false;
			$this->showMenu = false;
			$this->render("init", array(
					'model'=>$setting
			));
				
		}
		else
		{
			$network=PelicanoHelper::getNetworkConfiguration();
			if(isset($network['address']))
			{
				if($network['address']=="")	$network['address']="0.0.0.0";
				$network['address']= explode('.', $network['address']);
			}
			if(isset($network['netmask']))
			{
				if($network['netmask']=="")	$network['netmask']="0.0.0.0";
				$network['netmask']= explode('.', $network['netmask']);
			}
			if(isset($network['network']))
			{
				if($network['network']=="")	$network['network']="0.0.0.0";
				$network['network']= explode('.', $network['network']);
			}
			if(isset($network['broadcast']))
			{
				if($network['broadcast']=="")	$network['broadcast']="0.0.0.0";
				$network['broadcast']= explode('.', $network['broadcast']);
			}
			if(isset($network['gateway']))
			{
				if($network['gateway']=="")	$network['gateway']="0.0.0.0";
				$network['gateway']= explode('.', $network['gateway']);
			}
			if(isset($network['dns1']))
			{
				if($network['dns1']=="")	$network['dns1']="0.0.0.0";
				$network['dns1']= explode('.', $network['dns1']);
			}
			if(isset($network['dns2']))
			{
				if($network['dns2']=="")	$network['dns2']="0.0.0.0";
				$network['dns2']= explode('.', $network['dns2']);
			}
			
			$this->render("config", array(
					'model'=>$setting,'network'=>$network
			));				
		}	
	}
	
	public function actionAjaxIsAlive()
	{
		//para ver si la base de datos esta up
		$setting = Setting::getInstance();
		return true;
	}
	
	public function actionAjaxResetDeviceId()
	{
		$setting = Setting::getInstance();
		$setting->Id_device = null;
		$setting->save();
	}
	
	public function actionAjaxSaveGeneralConfig()
	{
		if(isset($_POST['Setting']))
		{
			$setting = Setting::getInstance();
			$setting->attributes = $_POST['Setting'];
			$setting->path_sabnzbd_download = $setting->path_shared;
			$setting->save();
		}
		if(isset($_POST['Network'])){
			if(isset($_POST['Network']['address']))
			{
				$_POST['Network']['address']=implode('.', $_POST['Network']['address']);
			}
			if(isset($_POST['Network']['netmask']))
			{
				$_POST['Network']['netmask']=implode('.', $_POST['Network']['netmask']);
			}
			if(isset($_POST['Network']['network']))
			{
				$_POST['Network']['network']=implode('.', $_POST['Network']['network']);
			}
			if(isset($_POST['Network']['broadcast']))
			{
				$_POST['Network']['broadcast']=implode('.', $_POST['Network']['broadcast']);
			}
			if(isset($_POST['Network']['gateway']))
			{
				$_POST['Network']['gateway']=implode('.', $_POST['Network']['gateway']);
			}
			$_POST['Network']['dns-nameservers']="";
			if(isset($_POST['Network']['dns1']))
			{
				$_POST['Network']['dns1']=implode('.', $_POST['Network']['dns1']);
				$_POST['Network']['dns-nameservers']=$_POST['Network']['dns1'];
			}
			if(isset($_POST['Network']['dns2']))
			{
				$_POST['Network']['dns2']=implode('.', $_POST['Network']['dns2']);
				$_POST['Network']['dns-nameservers']=$_POST['Network']['dns-nameservers']." ".$_POST['Network']['dns2'];
			}
			PelicanoHelper::saveNetworkConfiguration($_POST['Network']);
		}
	}
	
	public function actionAjaxOpenGotoConfigDialog()
	{
		$this->renderPartial('_goToConfig');
	}
	
	public function actionAjaxSaveDeviceId()
	{
		$setting = Setting::getInstance();
		
		$setting->Id_device = $_POST['idDevice'];
		$setting->save();
		
		PelicanoHelper::heartBeat();
		
	}
	
	public function actionAjaxValidateDeviceId()
	{
		echo PelicanoHelper::validateDeviceId($_POST['idDevice']);
	}
	
	public function actionIndexSerie()
	{

		$modelSeries = new Series();
		$dataProvider= $modelSeries->search();
		$dataProvider->pagination->pageSize= 14;

		$this->render('indexSerie',array(
				'dataProvider'=>$dataProvider,
		));

	}

	public function actionMarketplaceCategory()
	{ 		
 		$modelMarketCategories = new MarketCategory();
 		
 		$dataProvider= $modelMarketCategories->search();
 		$dataProvider->pagination->pageSize= 20;
 		
 		$this->render('marketplace',array(
 				'dataProvider'=>$dataProvider,
 		)); 		
	}
	public function actionMarketplace()
	{
		$modelMarketplace = new Marketplace();
			
		$dataProvider= $modelMarketplace->search();
		$dataProvider->pagination->pageSize= 250;
			
		$this->render('marketplaceAll',array(
				'dataProvider'=>$dataProvider,
		));
	}
	
	public function actionGoToDevices($idSelected)
	{
		$this->showFilter = false;
		$modelCurrentESs = CurrentExternalStorage::model()->findAllByAttributes(array('is_in'=>1));		
		CurrentExternalStorage::model()->updateAll(array('read'=>1));
			
		$this->render('devices',array('modelCurrentESs'=>$modelCurrentESs, 'idSelected'=>$idSelected));
	}
	
	public function actionDevices2()
	{
		$this->showFilter = false;
		$this->render('devices');
	}
	
	public function actionDevices()
	{
		$this->showFilter = false;
		$modelCurrentESs = CurrentExternalStorage::model()->findAllByAttributes(array('is_in'=>1));
		$idSelected = 0;
		if(count($modelCurrentESs)>0)
			$idSelected = $modelCurrentESs[0]->Id;

		$this->render('devices',array('modelCurrentESs'=>$modelCurrentESs, 'idSelected'=>$idSelected));
	}

	public function actionDownloads()
	{
		$this->showFilter = false;
		$sABnzbdStatus= new SABnzbdStatus();
		$sABnzbdStatus->getStatus();

		$modelNzb = new Nzb();
		$dataProvider = $modelNzb->searchDownloads();

		$criteria=new CDbCriteria;
		$criteria->join = 'INNER JOIN my_movie_disc mmd ON (mmd.Id_my_movie = t.Id)
				INNER JOIN current_disc cd ON (cd.Id_my_movie_disc = mmd.Id)';
		$criteria->addCondition('cd.Id_current_disc_state <> 1');
		$criteria->addCondition('cd.command =  2'); //ripping
		$modelMyMovie = MyMovie::model()->find($criteria);
		
		$criteriaMovies=new CDbCriteria;
		$criteriaMovies->limit=30;
		$criteriaMovies->order="date DESC";
		$filter="pill-filter-all";
		
		$movies = Movies::model()->findAll($criteriaMovies);

		$criteriaExternal=new CDbCriteria;
		$criteriaExternal->addCondition('(status = 2 OR status = 7)');
		$criteriaExternal->addCondition('Id_local_folder IS NOT NULL');		
		$criteriaExternal->addCondition('copy = 1');
		$criteriaExternal->order = "status";
		//$criteriaExternal->limit=30;
		//$criteriaExternal->order="read_date DESC";
		
		$externalStorageDataCopying = ExternalStorageData::model()->findAll($criteriaExternal);
		
		$criteriaNzb=new CDbCriteria;
		//$criteriaNzb->addCondition('t.Id_nzb_state = 2');
		$criteriaNzb->addCondition('(t.Id_nzb IS NULL) AND (t.downloading = 1 OR t.downloaded = 1) AND (t.ready_to_play = 0)');
		//$criteriaExternal->limit=30;
		//$criteriaExternal->order="read_date DESC";
		
		$nzbDownloading = Nzb::model()->findAll($criteriaNzb);
				
		$this->render('downloads',array(
				'dataProvider'=>$dataProvider,
				'sABnzbdStatus'=>$sABnzbdStatus,
				'modelMyMovie'=>$modelMyMovie,
				'movies'=>$movies,
				'externalStorageDataCopying'=>$externalStorageDataCopying,
				'nzbDownloading'=>$nzbDownloading,
				'filter'=>$filter
		));
	}

	public function actionAjaxRefreshSabNzbStatus()
	{
		$sABnzbdStatus= new SABnzbdStatus();
		$sABnzbdStatus->getStatus();
		$result['jobs'] = $sABnzbdStatus->jobs;
		if(isset($sABnzbdStatus->attributes['speed']))
			$result['speed'] = $sABnzbdStatus->attributes['speed'];
		if(isset($sABnzbdStatus->attributes['speedlimit']))
			$result['speedlimit'] = $sABnzbdStatus->attributes['speedlimit'];
		echo CJSON::encode($result);
	}

	public function actionAjaxDiscIn()
	{
		$criteria=new CDbCriteria;
		$criteria->condition = 'Id_current_disc_state <> 1';
		$modelCurrentDisc = CurrentDisc::model()->find($criteria);

		$this->renderPartial('_discIn',array('model'=>$modelCurrentDisc));
	}

	public function actionAjaxDownloadShowDetail()
	{
		$id = $_POST['id'];
		$idNzb = $_POST['idNzb'];

		$modelNzb = Nzb::model()->findByPk($idNzb);

		$criteria=new CDbCriteria;

		$model = MyMovieNzb::model()->findByPk($id);
		$criteria->join = 'INNER JOIN my_movie_nzb_person p on (p.Id_person = t.Id)';
		$criteria->addCondition('p.Id_my_movie_nzb = "'.$id.'"');
		$criteria->order = 't.Id ASC';

		$casting = $this->getCasting($criteria);

		$this->renderPartial('_downloadDetails',array('model'=>$model, 'casting'=>$casting, 'modelNzb'=>$modelNzb));
	}

	public function actionAjaxGetDevices()
	{
		$id = $_POST['id'];
		$modelCurrentESs = CurrentExternalStorage::model()->findAllByAttributes(array('is_in'=>1));
		$this->renderPartial('_devicesUnit',array('modelCurrentESs'=>$modelCurrentESs,'idSelected'=>$id));
	}

	public function actionAjaxMarketShowDetail()
	{
		$idNzb = $_POST['idNzb'];

		$modelNzb = Nzb::model()->findByPk($idNzb);
		if(isset($modelNzb))
		{
			$modelMyMovieDiscNzb = MyMovieDiscNzb::model()->findByPk($modelNzb->Id_my_movie_disc_nzb);
			$criteria=new CDbCriteria;
			$id= $modelMyMovieDiscNzb->Id_my_movie_nzb;
			$model = MyMovieNzb::model()->findByPk($id);
			$criteria->join = 'INNER JOIN my_movie_nzb_person p on (p.Id_person = t.Id)';
			$criteria->addCondition('p.Id_my_movie_nzb = "'.$id.'"');
			$criteria->order = 't.Id ASC';
			
			$casting = $this->getCasting($criteria);
			if(!$modelNzb->ready_to_play){//para que esta este if? hace lo mismo en el else???
				$sourceType = 1;
				$bookmarks = $modelNzb->bookmarks;
				$this->renderPartial('_movieDetails',array('model'=>$model,
						'casting'=>$casting,
						'sourceType'=>$sourceType,
						'modelNzb'=>$modelNzb,
						'modelRippedMovie'=>null,
						'modelLocalFolder'=>null,
						'modelCurrentDisc'=>null,
						'modelBookmarks'=>$bookmarks,)
				);
			}
			else
			{
				$sourceType = 1;
				$bookmarks = $modelNzb->bookmarks;
				$this->renderPartial('_movieDetails',array('model'=>$model,
						'casting'=>$casting,
						'sourceType'=>$sourceType,
						'modelNzb'=>$modelNzb,
						'modelRippedMovie'=>null,
						'modelLocalFolder'=>null,
						'modelCurrentDisc'=>null,
						'modelBookmarks'=>$bookmarks,
				));
			
			}				
		}
	}		
	public function actionAjaxDownloadFirst()
	{
		if(isset($_POST['Id_nzb']))
		{		
			PelicanoHelper::downloadFirst($_POST['Id_nzb']);
			$nzbs = Nzb::model()->findAllByAttributes(array('Id_nzb'=>$_POST['Id_nzb']));
			foreach ($nzbs as $nzb)
			{
				PelicanoHelper::downloadFirst($nzb->Id);				
			}
		}
	}
	public function actionAjaxRestartDownload()
	{
		if(isset($_POST['Id_nzb']))
		{		
			PelicanoHelper::restartDownload($_POST['Id_nzb']);
			$nzbs = Nzb::model()->findAllByAttributes(array('Id_nzb'=>$_POST['Id_nzb']));
			foreach ($nzbs as $nzb)
			{
				PelicanoHelper::restartDownload($nzb->Id);				
			}
		}
	}
	public function actionAjaxStartDownload()
	{
		if(isset($_POST['Id_nzb']))
		{		
			PelicanoHelper::startDownload($_POST['Id_nzb']);
			$nzbs = Nzb::model()->findAllByAttributes(array('Id_nzb'=>$_POST['Id_nzb']));
			foreach ($nzbs as $nzb)
			{
				PelicanoHelper::startDownload($nzb->Id);				
			}
		}
	}
	public function actionAjaxCancelDownload()
	{
		$alreadyDownloaded = 0;
		if(isset($_POST['Id_nzb']))
		{		
			PelicanoHelper::cancelDownload($_POST['Id_nzb']);
			$nzbs = Nzb::model()->findAllByAttributes(array('Id_nzb'=>$_POST['Id_nzb']));
			foreach ($nzbs as $nzb)
			{
				PelicanoHelper::cancelDownload($nzb->Id);				
			}
			$modelNzb = Nzb::model()->findByPk($_POST['Id_nzb']);
			if(isset($modelNzb))
				$alreadyDownloaded = $modelNzb->already_downloaded;
		}
		echo $alreadyDownloaded;
	}
	
	public function actionAjaxPlaylistsShow()
	{
		$models = Playlist::model()->findAll();
		$this->renderPartial('_playlist',array('models'=>$models));

	}
	public function actionAjaxMovieShowDetail()
	{
		$id_resource = $_POST['idresource'];
		$id = $_POST['id'];
		$sourceType = $_POST['sourcetype'];

		$criteria=new CDbCriteria;

		$modelNzb = null;
		$modelRippedMovie = null;
		$localFolder = null;
		$bookmarks = null;
		$modelCurrentDisc = null;
		if($sourceType == 1)
		{
			$modelNzb = Nzb::model()->findByPk($id_resource);
			$model = MyMovieNzb::model()->findByPk($id);
			$criteria->join = 'INNER JOIN my_movie_nzb_person p on (p.Id_person = t.Id)';
			$criteria->addCondition('p.Id_my_movie_nzb = "'.$id.'"');
			$criteria->order = 't.Id ASC';
			$bookmarks = (isset($modelNzb->bookmarks))?$modelNzb->bookmarks:null;
		}
		else if($sourceType == 2)
		{
			$modelRippedMovie = RippedMovie::model()->findByPk($id_resource);
			$model = MyMovie::model()->findByPk($id);
			$criteria->join = 'INNER JOIN my_movie_person p on (p.Id_person = t.Id)';
			$criteria->addCondition('p.Id_my_movie = "'.$id.'"');
			$criteria->order = 't.Id ASC';
			$bookmarks = (isset($modelRippedMovie->bookmarks))?$modelRippedMovie->bookmarks:null;
		}
		else
		{
			$localFolder = LocalFolder::model()->findByPk($id_resource);
			$model = MyMovie::model()->findByPk($id);
			$criteria->join = 'INNER JOIN my_movie_person p on (p.Id_person = t.Id)';
			$criteria->addCondition('p.Id_my_movie = "'.$id.'"');
			$criteria->order = 't.Id ASC';
			$bookmarks = (isset($localFolder->bookmarks))?$localFolder->bookmarks:null;
		}
		$casting = $this->getCasting($criteria);
		$this->renderPartial('_movieDetails',array('model'=>$model,
				'casting'=>$casting,
				'sourceType'=>$sourceType,
				'modelNzb'=>$modelNzb,
				'modelRippedMovie'=>$modelRippedMovie,
				'modelLocalFolder'=>$localFolder,
				'modelCurrentDisc'=>$modelCurrentDisc,
				'modelBookmarks'=>$bookmarks,
		));
	}
	
	public function actionAjaxConsumptionDetail()
	{
		$month = $_POST['month'];
		$year = $_POST['year'];
		
		$modelConsumptions=new Consumption('search');
		$modelConsumptions->unsetAttributes();  // clear any default values
		if(isset($_GET['Consumption']))
			$modelConsumptions->attributes=$_GET['Consumption'];
		
		$modelConsumptions->month = $month;
		$modelConsumptions->year = $year;
		$this->renderPartial('_consumptionDetail',array('modelConsumptions'=>$modelConsumptions, 'month'=>$month, 'year'=>$year));
	}
	
	public function actionAjaxGetLocalFolderCurrentSize()
	{
		if(isset($_POST['id']))
		{
			$externalStorageData = ExternalStorageData::model()->findByPk($_POST['id']);
			if(isset($externalStorageData))
			{
				$setting = Setting::getInstance();
				$path = $setting->path_shared . $externalStorageData->localFolder->path;
					
				$size = PelicanoHelper::getDirectorySize($path,false);
					
				echo round($size/$externalStorageData->size*100)." %";				
			}
		}
	}
	public function actionAjaxMovieShowFinishedDetail()
	{
		$id_resource = $_POST['idresource'];
		$id = $_POST['id'];
		$sourceType = $_POST['sourcetype'];
	
		$criteria=new CDbCriteria;
	
		$modelNzb = null;
		$modelRippedMovie = null;
		$localFolder = null;
		$bookmarks = null;
		$modelCurrentDisc = null;
		if($sourceType == 1)
		{
			$modelNzb = Nzb::model()->findByPk($id_resource);
			$model = MyMovieNzb::model()->findByPk($id);
			$criteria->join = 'INNER JOIN my_movie_nzb_person p on (p.Id_person = t.Id)';
			$criteria->addCondition('p.Id_my_movie_nzb = "'.$id.'"');
			$criteria->order = 't.Id ASC';
			$bookmarks = $modelNzb->bookmarks;
		}
		else if($sourceType == 2)
		{
			$modelRippedMovie = RippedMovie::model()->findByPk($id_resource);
			$model = MyMovie::model()->findByPk($id);
			$criteria->join = 'INNER JOIN my_movie_person p on (p.Id_person = t.Id)';
			$criteria->addCondition('p.Id_my_movie = "'.$id.'"');
			$criteria->order = 't.Id ASC';
			$bookmarks = $modelRippedMovie->bookmarks;
		}
		else
		{
			$localFolder = LocalFolder::model()->findByPk($id_resource);
			$model = MyMovie::model()->findByPk($id);
			$criteria->join = 'INNER JOIN my_movie_person p on (p.Id_person = t.Id)';
			$criteria->addCondition('p.Id_my_movie = "'.$id.'"');
			$criteria->order = 't.Id ASC';
			$bookmarks = $localFolder->bookmarks;
		}
		$casting = $this->getCasting($criteria);
		//$this->renderPartial('_movieFinishedDetails',array('model'=>$model,
		$this->renderPartial('_movieDetails',array('model'=>$model,
				'casting'=>$casting,
				'sourceType'=>$sourceType,
				'modelNzb'=>$modelNzb,
				'modelRippedMovie'=>$modelRippedMovie,
				'modelLocalFolder'=>$localFolder,
				'modelCurrentDisc'=>$modelCurrentDisc,
				'modelBookmarks'=>$bookmarks,
		));
	}
	
	public function actionAjaxUpdateDownloadFinished()
	{
		
		$criteriaMovies=new CDbCriteria;
		$criteriaMovies->limit=30;
		$criteriaMovies->order="date DESC";
		$filter="";
		if(isset($_POST['idFilter']))
		{
			$filter = $_POST['idFilter'];
			if($filter=="pill-filter-market")
			{
				$criteriaMovies->addCondition('source_type = 1');				
			}
			elseif ($filter=="pill-filter-usb")
			{
				$criteriaMovies->addCondition('source_type = 3');
				$criteriaMovies->join = 'INNER JOIN external_storage_data esd on (esd.Id_local_folder = t.Id)';
				//$criteriaMovies->addCondition("esd.status = 3");
				$criteriaMovies->distinct=true;
			}
			elseif ($filter=="pill-filter-disco")
			{
				$criteriaMovies->addCondition('source_type = 2');				
			}
		}
		$movies = Movies::model()->findAll($criteriaMovies);
		$newItem = false;
		$ids = array();
		if(isset($_POST['ids']))
			$ids = $_POST['ids'];
		if(count($movies)==count($ids))
		{
			$ids = $ids;
			foreach ($movies as $movie)
			{
				$isThere = false;
				foreach ($ids as $id)
				{
					if($movie->Id==$id['idresource']&&$movie->source_type==$id['sourcetype'])
					{
						$isThere = true;
						break;
					}
				}
				if(!$isThere)
				{
					$newItem = true;
					break;
				}
				
			}
			if(!$newItem)
				return;
		}
				
		$this->renderPartial("_downloadFinished",array("movies"=>$movies,"filter"=>$filter,"fromAjax"=>1));						
	}
		
	public function actionAjaxRefreshDownload()
	{
		$criteriaNzb=new CDbCriteria;
		$criteriaNzb->addCondition('(downloading = 1 OR downloaded = 1)');
		$criteriaNzb->addCondition('(ready_to_play = 0)');
		$criteriaNzb->addCondition('Id_nzb IS NULL');
		//$criteriaNzb->order="???";
	
		$nzbs = Nzb::model()->findAll($criteriaNzb);
		$sABnzbdStatus= new SABnzbdStatus();
		$sABnzbdStatus->getStatus();		
		$this->renderPartial("_downloadMarket",array("nzbDownloading"=>$nzbs,"sABnzbdStatus"=>$sABnzbdStatus,"fromAjax"=>1));		
	}
	
	public function actionAjaxSaveSpeedlimit()
	{
		PelicanoHelper::setSpeedlimit($_POST['speed']);
	}
	public function actionAjaxUpdateDownloads()
	{
		$criteriaNzb=new CDbCriteria;
		$criteriaNzb->addCondition('(downloading = 1 OR downloaded = 1)');
		$criteriaNzb->addCondition('(ready_to_play = 0)');
		$criteriaNzb->addCondition('Id_nzb IS NULL');

		$sABnzbdStatus= new SABnzbdStatus();
		$sABnzbdStatus->getStatus();
		
		$nzbs = Nzb::model()->findAll($criteriaNzb);
		$newItem = false;
		if(isset($_POST['ids']))
		{
			if(count($nzbs)==count($_POST['ids']))
			{
				$ids = $_POST['ids'];
				foreach ($nzbs as $nzb)
				{
					if(!in_array( $nzb->Id , $ids, true ))
					{
						$newItem = true;
						break;
					}
				}
			}
			//se cambio el orden, tambien actualizo
			$changeOrder = false;
			$ids = $_POST['ids'];
			$jobs= $sABnzbdStatus->jobs;
			foreach ($ids as $key => $id)
			{
				if(!isset($jobs[$key]) || $jobs[$key]['nzb_id']!=$id)				
				{
					$changeOrder = true;
					break;
				}
			}
			if(!$newItem && !$changeOrder)
				return;		
		}
		$this->renderPartial("_downloadMarket",array("nzbDownloading"=>$nzbs,"sABnzbdStatus"=>$sABnzbdStatus,"fromAjax"=>1));		
	}
	
	public function acionAjaxUpdateDownloadExternal()
	{
		$criteriaExternal=new CDbCriteria;
		$criteriaExternal->addCondition('(status = 2 OR status = 7)');
		$criteriaExternal->addCondition('Id_local_folder IS NOT NULL');
		$criteriaExternal->addCondition('copy = 1');
		$criteriaExternal->order="status";
		//$criteriaExternal->limit=30;
		//$criteriaExternal->order="read_date DESC";
		
		$externalStorageDataCopying = ExternalStorageData::model()->findAll($criteriaExternal);
		$newItem = false;
		if(isset($_POST['ids']))
		{
			if(count($externalStorageDataCopying)==count($_POST['ids']))
			{
				$ids = $_POST['ids'];
				foreach ($externalStorageDataCopying as $esd)
				{
					if(!in_array( $esd->Id , $ids, true ))
					{
						$newItem = true;
						break;
					} 
				}
				if(!$newItem)
					return;
			}
		}
		
		$this->renderPartial("_downloadExternal",array('externalStorageDataCopying'=>$externalStorageDataCopying,"fromAjax"=>1));
	}
	
	public function actionAjaxMovieShowExternalStorageDownloadDetail()
	{
		$id_resource = $_POST['idresource'];
		$id = $_POST['id'];
		$sourceType = $_POST['sourcetype'];
		$idExternalStorageData = $_POST['idExternalStorageData'];
		
		$criteria=new CDbCriteria;

		$externalStorage = ExternalStorageData::model()->findByPk($idExternalStorageData);
		$localFolder = LocalFolder::model()->findByPk($id_resource);
		$model = MyMovie::model()->findByPk($id);
		$criteria->join = 'INNER JOIN my_movie_person p on (p.Id_person = t.Id)';
		$criteria->addCondition('p.Id_my_movie = "'.$id.'"');
		$criteria->order = 't.Id ASC';
		$bookmarks = $localFolder->bookmarks;
		$casting = $this->getCasting($criteria);
		$this->renderPartial('_movieDownloadESDetails',array('model'=>$model,
				'casting'=>$casting,
				'sourceType'=>$sourceType,
				'modelLocalFolder'=>$localFolder,
				'modelBookmarks'=>$bookmarks,
				'modelExternalStorageData'=>$externalStorage
		));
	}
	
	public function actionAjaxCancelCopy()
	{
		$idESData = (isset($_POST['id']))?$_POST['id']:null;
		$canceledModel = array();
		$response = 0;
		if(isset($idESData))
		{
			$modelESData = ExternalStorageData::model()->findByPk($idESData);
			if(isset($modelESData))
			{
				
				if($modelESData->status == 2) //si ESTA copiando
				{
					$modelESData->status = 5; //cancel copy
				}
				else
				{
					if(isset($modelESData->localFolder))
					{
						if($modelESData->already_exists == 1)
						{
							PelicanoHelper::eraseResource($modelESData->localFolder->path);
							$modelESData->already_exists = 0;
						}
						
						LocalFolder::model()->deleteByPk($modelESData->Id_local_folder);
						$modelESData->Id_local_folder = null;
					}
				}
				
				$modelESData->copy = 0;
				if($modelESData->save())
				{
					if($modelESData->status == 5)//cancel copy
						ReadFolderHelper::cancelCopy($modelESData);
					
					$criteria = new CDbCriteria();
					$criteria->addCondition('t.status <> 3');
					$criteria->addCondition('t.copy = 1');
					$criteria->addCondition('t.Id_current_external_storage = '.$modelESData->Id_current_external_storage);
					
					$countOnCopy = ExternalStorageData::model()->count($criteria);
					if($countOnCopy == 0)
					{
						$modelCurrentES = CurrentExternalStorage::model()->findByPk($modelESData->Id_current_external_storage);
						if(isset($modelCurrentES))
						{
							$modelCurrentES->state = 3;
							$modelCurrentES->save();
						}
					}
					
					$canceledModel['id'] = $modelESData->Id;
					$canceledModel['copy'] = $modelESData->copy;
					$canceledModel['status'] = $modelESData->status;
					$canceledModel['alreadyExists'] = $modelESData->already_exists;
				}
				
			}
		}
		
		$response = array('canceledModel'=>$canceledModel);
		
		echo json_encode($response);
		
	}
	
	public function actionAjaxProcessExternalStorage()
	{
		$idESData = (isset($_POST['id']))?$_POST['id']:null;
		$processModel = array();
 		if(isset($idESData))
 		{
 			$modelESData = ExternalStorageData::model()->findByPk($idESData);
 			if(isset($modelESData))
 			{
 				$modelESData->status = 7;
 				$modelESData->copy = 1;
 				if($modelESData->save())
 				{
 					$processModel['id'] = $modelESData->Id;
 					$processModel['copy'] = $modelESData->copy;
 					$processModel['status'] = $modelESData->status;
 					$processModel['alreadyExists'] = $modelESData->already_exists;
 					
 					ReadFolderHelper::processExternalStorage($modelESData->Id_current_external_storage);
 				}
 			}
 		}
 		$response = array('processModel'=>$processModel);
 		
 		echo json_encode($response);
	}

	public function actionAjaxProcessAllExternalStorage()
	{
		$idTable = (isset($_POST['idTable']))?$_POST['idTable']:'';		
		$id = (isset($_POST['id']))?$_POST['id']:null;
		
		$onCopyModels = array();
		if(!empty($idTable) && isset($id))
		{
			$condition = "";
			switch ($idTable) 
			{
				case "knownTable":
					$condition = "copy = 0 AND is_personal = 0 AND imdb <> 'tt0000000' AND Id_current_external_storage = ".$id;
					break;
				case "personalTable":
					$condition = "copy = 0 AND is_personal = 1 AND Id_current_external_storage = ".$id;
					break;
				case "unknownTable":
					$condition = "copy = 0 AND is_personal = 0 AND imdb = 'tt0000000' AND Id_current_external_storage = ".$id;
					break;
			}
			$criteria = new CDbCriteria();
			$criteria->addCondition($condition);
			
			$modelESDatas = ExternalStorageData::model()->findAll($criteria);
						
			foreach($modelESDatas as $modelESData)
			{				
				$onCopyModels[] = array('id'=>$modelESData->Id,				
										'status'=>$modelESData->status,
										'copy'=>1,
										'alreadyExists'=>$modelESData->already_exists);
			}
			
			ExternalStorageData::model()->updateAll(array('copy'=>1),$condition);
			ReadFolderHelper::processExternalStorage($id);
		}
		
		$response = array('onCopyModels'=>$onCopyModels);
		
		echo json_encode($response);
	}
	
	public function actionAjaxOpenChangeName()
	{
		$idESData = (isset($_POST['id']))?$_POST['id']:null;
		if(isset($idESData))
		{
			$modelESData = ExternalStorageData::model()->findByPk($idESData);
			
			if(isset($modelESData))
			{
				$this->renderPartial('_formEditName',array('modelESData'=>$modelESData));
			}
		}		
	}
	
	public function actionAjaxSaveChangedName()
	{
		$idESData = (isset($_POST['id']))?$_POST['id']:null;
		$name = (isset($_POST['name']))?$_POST['name']:'';
		
		if(isset($idESData))
		{
			$modelESData = ExternalStorageData::model()->findByPk($idESData);
				
			if(isset($modelESData))
			{
				$modelESData->title = $name;
				if($modelESData->save())
					ReadFolderHelper::rebuildPeliFileES($modelESData);
			}
		}
	}
	
	public function actionAjaxSetAllAsPersonal()
	{
		$idCurrentES = (isset($_POST['idCurrentES']))?$_POST['idCurrentES']:null;
		$isPersonal = (isset($_POST['isPersonal']))?$_POST['isPersonal']:0;

		if(isset($idCurrentES))
		{
			ExternalStorageData::model()->updateAll(array('is_personal'=>1),'Id_current_external_storage = '.$idCurrentES);
		}

	}

	public function actionAjaxSetAsPersonal()
	{
		$idESData = (isset($_POST['id']))?$_POST['id']:null;
		$isPersonal = (isset($_POST['isPersonal']))?$_POST['isPersonal']:0;

		if(isset($idESData))
		{
			$modelESData = ExternalStorageData::model()->findByPk($idESData);
			if(isset($modelESData))
			{
				$modelESData->is_personal = (int)$isPersonal;
				$modelESData->save();
			}
		}

	}

	public function actionAjaxGetProcessStatus()
	{
		$idCurrentES = (isset($_POST['id']))?$_POST['id']:null;
		$finishCopy = 0;
		$currentESIn = 0;
		$modelFinishCopyESDataArray = array();
		if(isset($idCurrentES))
		{
			$modelCurrentES = CurrentExternalStorage::model()->findByPk($idCurrentES);
			if(isset($modelCurrentES))
				$currentESIn = $modelCurrentES->is_in;
			
			$criteria = new CDbCriteria();
			$criteria->addCondition("t.state <> 2");
			$criteria->addCondition("t.Id =".$idCurrentES);
			
			$modelCurrentES = CurrentExternalStorage::model()->find($criteria);
				
			if(isset($modelCurrentES))
				$finishCopy = 1;
				
			//Traigo los registros que terminaron de copiar y los que dieron error
			$criteria = new CDbCriteria();
			$criteria->addCondition("t.status = 3 OR t.status = 4");
			$criteria->addCondition("t.Id_current_external_storage =".$idCurrentES);
			$modelESDatas = ExternalStorageData::model()->findAll($criteria);
				
			foreach($modelESDatas as $modelESData)
			{				
				$modelFinishCopyESDataArray[] = array('id'=>$modelESData->Id, 
														'status'=>$modelESData->status,
														'copy'=>$modelESData->copy,
														'alreadyExists'=>$modelESData->already_exists);
			}
				
		}		
		$response = array('finishCopy'=>$finishCopy,
							'currentESIn'=>$currentESIn,
										'modelFinishCopyESDataArray'=>$modelFinishCopyESDataArray);
	
		echo json_encode($response);
	}
	
	public function actionAjaxGetSecondScan()
	{
		$idCurrentES = (isset($_POST['id']))?$_POST['id']:null;
		$finishScan = 0;
		$inProcess = 0;
		$modelFinishESDataArray = array();
		if(isset($idCurrentES))
		{
			$modelCurrentES = CurrentExternalStorage::model()->findByAttributes(array('Id'=>$idCurrentES,
																								'hard_scan_ready'=>1));
			
			if(isset($modelCurrentES))
			{
				$finishScan = 1;
				if($modelCurrentES->state == 2)
					$inProcess = 1;
			}
			
			//Traigo los registros que no estan escaneandose
			$criteria = new CDbCriteria();
			$criteria->addCondition('t.status <> 6');
			$criteria->addCondition('t.Id_current_external_storage = '.$idCurrentES);
			
			$modelESDatas = ExternalStorageData::model()->findAll($criteria);
			
			$setting = Setting::getInstance();
			foreach($modelESDatas as $modelESData)
			{
				
				$isUnknown = 0;
				if($modelESData->imdb == 'tt0000000')
					$isUnknown = 1;
				
				$name = $modelESData->title;
				if(!empty($modelESData->year))
					$name .= ' ('.$modelESData->year.')';
				
				$modelFinishESDataArray[] = array('id'=>$modelESData->Id, 
													'alreadyExists'=>$modelESData->already_exists, 
													'isUnknown'=>$isUnknown,
													'status'=>$modelESData->status,
													'copy'=>$modelESData->copy,
													'name'=>$name);
			}
			
		}
				
		$response = array('finishScan'=>$finishScan,
									'inProcess'=>$inProcess,
									'modelFinishESDataArray'=>$modelFinishESDataArray);
		
		echo json_encode($response);
	}

	public function actionAjaxGetFirstScan()
	{
		$idCurrentES = (isset($_POST['id']))?$_POST['id']:null;
		$modelCurrentES = null;
		$ready = false;
		$label = "USB";
		if(isset($idCurrentES))
		{
			$modelCurrentES = CurrentExternalStorage::model()->findByAttributes(array('Id'=>$idCurrentES,
					'soft_scan_ready'=>1));

			if(isset($modelCurrentES))
			{
				$modelESDataDBs = ExternalStorageData::model()->findAllByAttributes(array('Id_current_external_storage'=>$idCurrentES));
				$ready = true;
			}
			
			$modelCurrentES = CurrentExternalStorage::model()->findByPk($idCurrentES);
			if(isset($modelCurrentES))
				$label = $modelCurrentES->label;
			
		}

		if($ready)
			$this->renderPartial('_devicesStep1',array('modelESDataDBs'=>$modelESDataDBs,
					'ready'=>$ready,
					'label'=>$label,
					'idCurrentES'=>$idCurrentES));
		else
			echo "0";
	}

	public function actionAjaxGetPlayES()
	{
		$idESData = (isset($_POST['id']))?$_POST['id']:null;
		$playArray = array();
		
		$modelESData = ExternalStorageData::model()->findByPk($idESData);
		
		if(isset($modelESData))
		{
			if(isset($modelESData->localFolder))
			{
				$playArray['idResource'] = $modelESData->Id_local_folder;
				$playArray['sourceType'] = 3; //localfolder
				$playArray['id'] = $modelESData->localFolder->myMovieDisc->Id_my_movie;
			}
		}
		
		$response = array('playArray'=>$playArray);
		echo json_encode($response);
	}
	
	public function actionAjaxDownloadAllES()
	{
		$idCurrentES = (isset($_POST['id']))?$_POST['id']:null;
		if(isset($idCurrentES))
		{
			ExternalStorageData::model()->updateAll(array('copy'=>1),'Id_current_external_storage = '.$idCurrentES);
			ReadFolderHelper::processExternalStorage($idCurrentES);
		}
	}

	public function actionAjaxHardScanES()
	{
		$idCurrentES = (isset($_POST['id']))?$_POST['id']:null;
		$modelESDatas = null;
		$modelESDataPersonals = null;
		$label = "USB";
		$hardScanReady = 0;
		$inProcess = 0;
		if(isset($idCurrentES))
		{
			$modelCurrentES = CurrentExternalStorage::model()->findByPk($idCurrentES);
			if(isset($modelCurrentES))
			{
				$label = $modelCurrentES->label;
				$modelESDatas = ExternalStorageData::model()->findAllByAttributes(array('Id_current_external_storage'=>$idCurrentES,'is_personal'=>0));
				$modelESDataPersonals = ExternalStorageData::model()->findAllByAttributes(array('Id_current_external_storage'=>$idCurrentES,'is_personal'=>1));
				$hardScanReady = $modelCurrentES->hard_scan_ready;
				if($modelCurrentES->state == 2)
					$inProcess = 1;
				if($modelCurrentES->hard_scan_ready == 0)
					ReadFolderHelper::generatePeliFilesES($idCurrentES);
			}
		}

		$this->renderPartial('_devicesStep2',array('modelESDatas'=>$modelESDatas,
													'modelESDataPersonals'=>$modelESDataPersonals,
													'idCurrentES'=>$idCurrentES,
													'hardScanReady'=>$hardScanReady,
													'label'=>$label));
		
		
		if($hardScanReady == 0)
			echo CHtml::script("$('#hidden-second-scan-working').val(1);");
		elseif($inProcess == 1)
			echo CHtml::script("$('#hidden-process-working').val(1);");
		
	}

	public function actionAjaxExploreExternalStorage()
	{
		$idCurrentES = (isset($_POST['id']))?$_POST['id']:null;
		$name = "USB";
		$workingFirstScan = 0;
		if(isset($idCurrentES))
		{
			$modelCurrentES = CurrentExternalStorage::model()->findByPk($idCurrentES);
			if(isset($modelCurrentES))
			{
				if($modelCurrentES->soft_scan_ready == 0)
				{
					ReadFolderHelper::scanExternalStorage($idCurrentES);
					$workingFirstScan = 1;
				}
				
				$name = $modelCurrentES->label; 
			}
		}

		$h2msg = "<h2>".$name." <i class='fa fa-spinner fa-spin'></i> Analizando...</h2>";
		
		$response = array('msg'=>$h2msg,
						'workingFirstScan'=>$workingFirstScan);
			
		echo json_encode($response);
	}

	public function actionAjaxMarkCurrentESRead()
	{
		CurrentExternalStorage::model()->updateAll(array('read'=>1));
	}

	public function actionAjaxMarkCurrentDiscRead()
	{
		self::markCurrentDiscRead();
	}

	private function markCurrentDiscRead()
	{
		$idCurrentDisc = 0;
		$criteria=new CDbCriteria;
		$criteria->addCondition('Id_current_disc_state <> 1');
		$criteria->addCondition('t.read = 0');

		$modelCurrentDisc = CurrentDisc::model()->find($criteria);
		if(isset($modelCurrentDisc))
		{
			$idCurrentDisc = $modelCurrentDisc->Id;
			$modelCurrentDisc->read = 1;
			$modelCurrentDisc->save();
		}

		return $idCurrentDisc;
	}

	public function actionAjaxCurrentDiscShowDetail()
	{

		$criteria=new CDbCriteria;
		$criteria->condition = 'Id_current_disc_state <> 1';

		$modelCurrentDisc = CurrentDisc::model()->find($criteria);

		$modelMyMovieDisc = MyMovieDisc::model()->findByAttributes(array('Id'=>$modelCurrentDisc->Id_my_movie_disc));

		if(isset($modelMyMovieDisc))
		{
			$id = $modelMyMovieDisc->Id_my_movie;

			$model = MyMovie::model()->findByPk($id);

			$criteria=new CDbCriteria;
			$criteria->join = 'INNER JOIN my_movie_person p on (p.Id_person = t.Id)';
			$criteria->addCondition('p.Id_my_movie = "'.$id.'"');
			$criteria->order = 't.Id ASC';


			$casting = $this->getCasting($criteria);

			$this->renderPartial('_onlineDetails',array('model'=>$model,
					'casting'=>$casting,
					'modelCurrentDisc'=>$modelCurrentDisc));
		}
		else
		{
			$this->renderPartial('_onlineNoDetails');
		}
	}

	public function actionAjaxRipp()
	{
		$criteria=new CDbCriteria;
		$criteria->condition = 'Id_current_disc_state <> 1';

		$modelCurrentDisc = CurrentDisc::model()->find($criteria);
		$modelCurrentDisc->command = 2; //ripp
		$modelCurrentDisc->read = 1;
		$modelCurrentDisc->save();

	}

	public function actionAjaxAddOrRemovePlaylist()
	{
		$idBookmark = (isset($_POST['idBookmark']))?$_POST['idBookmark']:null;
		$idPlaylist = (isset($_POST['idPlaylist']))?$_POST['idPlaylist']:null;
		if(isset($idBookmark) && isset($idPlaylist))
		{
			$playListBookmarks = PlaylistBookmark::model()->findByAttributes(array('Id_bookmark'=>$idBookmark,'Id_playlist'=>$idPlaylist));
			if(isset($playListBookmarks))
			{
				$playListBookmarks->delete();
			}
			else
			{
				$playListBookmarks = new PlaylistBookmark();
				$playListBookmarks->Id_bookmark=$idBookmark;
				$playListBookmarks->Id_playlist=$idPlaylist;
				$playListBookmarks->save();
			}
		}
	}
	public function actionAjaxRemoveBookmark()
	{
		$id = (isset($_POST['id']))?$_POST['id']:null;
		$success = "0";
		if(isset($id))
		{
			$model = Bookmark::model()->findByPk($id);


			if(isset($model))
			{
				PlaylistBookmark::model()->deleteAllByAttributes(array('Id_bookmark'=>$id));
				if($model->delete())
					$success = "1";
			}
		}

		echo $success;
	}

	public function actionAjaxRemoveMovie()
	{
		$idResource = (isset($_POST['idResource']))?$_POST['idResource']:null;
		$sourceType = (isset($_POST['sourceType']))?$_POST['sourceType']:null;
		if(isset($idResource) && isset($sourceType))
		{
			$modelResource = null;

			switch ($sourceType) {
				case 1:
					$modelResource = Nzb::model()->findByPk($idResource);
					break;
				case 2:
					$modelResource = RippedMovie::model()->findByPk($idResource);
					break;
				case 3:
					$modelResource = LocalFolder::model()->findByPk($idResource);
					break;
			}

			if(isset($modelResource))
			{
				if($sourceType==1)//nzb
				{
					if($modelResource->ready_to_play)
					{
						$filename = explode('.', $modelResource->file_name);
						$path =$filename[0];
							
						PelicanoHelper::eraseResource($path);
						
						$modelResource->downloaded = 0;
						$modelResource->ready_to_play = 0;
						$modelResource->save();
							
						$nzbs = $modelResource->nzbs;
						foreach ($nzbs as $nzb)
						{
							$filename = explode('.', $nzb->file_name);
							$path =$filename[0];
							PelicanoHelper::eraseResource($path);
							$nzb->downloaded = 0;
							$nzb->ready_to_play = 0;
							$nzb->save();
						}						
					}					
				}
				else if(PelicanoHelper::eraseResource($modelResource->path))
				{
					PelicanoHelper::onDeleteCheckES($modelResource, $sourceType);
					$modelResource->delete();
				}
			}
		}
	}

	public function actionAjaxEject()
	{
		$criteria=new CDbCriteria;
		$criteria->condition = 'Id_current_disc_state <> 1';

		$modelCurrentDisc = CurrentDisc::model()->find($criteria);
		$modelCurrentDisc->command = 3; //eject
		$modelCurrentDisc->read = 1;
		$modelCurrentDisc->save();

	}

	public function actionAjaxCancelRipp()
	{
		$criteria=new CDbCriteria;
		$criteria->condition = 'Id_current_disc_state <> 1';

		$modelCurrentDisc = CurrentDisc::model()->find($criteria);
		$modelCurrentDisc->command = 1; //cancel ripp
		$modelCurrentDisc->save();

	}

	public function actionAjaxSerieShowDetail()
	{
		$id = $_POST['id'];
		$sourceType = $_POST['sourceType'];

		$criteria=new CDbCriteria;

		if($sourceType == 1)
		{
			$model = MyMovieNzb::model()->findByPk($id);
			$criteria->join = 'INNER JOIN my_movie_nzb_person p on (p.Id_person = t.Id)';
			$criteria->addCondition('p.Id_my_movie_nzb = "'.$id.'"');
			$criteria->order = 't.Id ASC';
		}
		else
		{
			$model = MyMovie::model()->findByPk($id);
			$criteria->join = 'INNER JOIN my_movie_person p on (p.Id_person = t.Id)';
			$criteria->addCondition('p.Id_my_movie = "'.$id.'"');
			$criteria->order = 't.Id ASC';
		}

		$casting = $this->getCasting($criteria);

		$this->renderPartial('_serieDetails',array('model'=>$model, 'casting'=>$casting));
	}

	private function getCasting($criteria)
	{
		$casting = array();
		$persons = Person::model()->findAll($criteria);

		$actors = "";
		$director = "";
		$actorCount = 0;
		foreach($persons as $person)
		{
			if($person->type == 'Actor' && $actorCount < 6)
			{
				$actors = $actors . $person->name . ' / ';
				$actorCount++;
			}

			if($person->type == 'Director')
				$director = $person->name;
		}

		$actors = rtrim($actors, " / ");

		$casting['actors'] = $actors;
		$casting['director'] = $director;

		return $casting;
	}

	public function actionAjaxGetFilesFromPath()
	{
		ReadFolderHelper::scanDirectory();
	}

	public function actionAjaxHideScanedVideo()
	{
		$idLocalFolder = isset($_POST['idLocalFolder'])?$_POST['idLocalFolder']:null;
		$hide = isset($_POST['hide'])?$_POST['hide']:0;
		if(isset($idLocalFolder))
		{
			$modelLocalFolder = LocalFolder::model()->findByPk($idLocalFolder);
			$modelLocalFolder->hide = $hide;
			$modelLocalFolder->save();
		}
	}
	
	public function actionAjaxDeleteScan($id)
	{
		$modelLocalFolder = LocalFolder::model()->findByPk($id);
		if(isset($modelLocalFolder))
			$modelLocalFolder->delete();
	}

	public function actionAjaxGetScanStatus()
	{
		$_COMMAND_NAME = "scanDirectory";

		$modelCommandStatus = CommandStatus::model()->findByAttributes(array('command_name'=>$_COMMAND_NAME));

		if($modelCommandStatus->busy)
			echo 1;
		else
			echo 0;

	}

	public function actionLocalFolderAdmin()
	{
		$this->showFilter = false;
		$model = new LocalFolder('search');
		$model->unsetAttributes();  // clear any default values

		if(isset($_GET['LocalFolder']))
			$model->attributes=$_GET['LocalFolder'];

		$this->render('adminLocalFolder',array(
				'model'=>$model,
		));
	}
	public function actionAjaxStart($id, $sourceType, $idResource)
	{
		$setting = Setting::getInstance();
		if(count($setting->players)> 1)
		{
			return 1;	
		}	
	}
	public function actionAjaxShowPalyerSelector()
	{
		$id = $_POST['id'];
		$sourceType = $_POST['sourceType'];
		$idResource = $_POST['idResource'];
		
		$this->renderPartial('_playerSelector',array('id'=>$id,
				'idResource'=>$idResource,
				'sourceType'=>$sourceType));
		
	}
	public function actionAjaxShowPlayerStatus()
	{
		
		$this->renderPartial('_playerStatus');
		
	}
	public function actionAjaxPlayNzbByPlayer()
	{
		$idNzb=$_POST['idNzb'];
		$idPlayer =$_POST['idPlayer'];
		
		$player = Player::model()->findByPk($idPlayer);	
		$nzbModel = Nzb::model()->findByPk($idNzb);
		$folderPath = explode('.',$nzbModel->file_name);
		
		if(isset($nzbModel->Id_nzb))
		{			
			$idMyMovie = $nzbModel->nzb->myMovieDiscNzb->myMovieNzb->Id;
		}
		else
		{
			$idMyMovie = $nzbModel->myMovieDiscNzb->myMovieNzb->Id;			
		}			
		if(isset($player->type) && $player->type == 1)
			OppoHelper::playOppo($idMyMovie,'/'.$folderPath[0].'/'.$nzbModel->mkv_file_name,$player);
		else
			DuneHelper::playDune($idMyMovie,'/'.$folderPath[0].'/'.$nzbModel->path,$player);				

		if(isset($player->type))
		{
			switch ($player->type) {
				case 0:
					DuneHelper::playDune($idMyMovie,'/'.$folderPath[0].'/'.$nzbModel->path,$player);
					break;
				case 1:
					OppoHelper::playOppo($idMyMovie,'/'.$folderPath[0].'/'.$nzbModel->mkv_file_name,$player);
					break;
				case 2:
					Mede8erHelper::play($idMyMovie,'/'.$folderPath[0].'/'.$nzbModel->path,$player);
					break;
			}
		}
		
		self::saveCurrentPlayByPlayer($idNzb, 1,$player);
	}
	
	public function actionstartByPlayer($id, $idPlayer,$sourceType, $idResource)
	{
		$this->showFilter = false;
		
		$player = Player::model()->findByPk($idPlayer);
		
		$play = false;
		$idResourceCurrentPlay = 0;
		$resultPlay = true;
		$path="";
		switch ($sourceType) {
			case 1:
				$nzbModel = Nzb::model()->findByPk($idResource);
				$TMDBData =$nzbModel->TMDBData;
				$idResourceCurrentPlay = $idResource;
				$folderPath = explode('.',$nzbModel->file_name);				
				$path = '/'.$folderPath[0].'/'.$nzbModel->mkv_file_name;
				$model = MyMovieNzb::model()->findByPk($id);
				break;
			case 2:
				$nzbRippedMovie = RippedMovie::model()->findByPk($idResource);
				$TMDBData =$nzbRippedMovie->TMDBData;
				$idResourceCurrentPlay = $idResource;
				$path = '/'.'/'.$nzbRippedMovie->path;
				$model = MyMovie::model()->findByPk($id);
				break;
			case 3:
				$localFolder = LocalFolder::model()->findByPk($idResource);
				$TMDBData =$localFolder->TMDBData;
				$idResourceCurrentPlay = $idResource;
				$folderPath = explode('.',$localFolder->path);
				//commentar para que el play ande mas rapido
				$path = '/'.'/'.$localFolder->path;
				$model = MyMovie::model()->findByPk($id);
				break;
			case 4:
				$idCurrentDisc = self::markCurrentDiscRead();
				$idResourceCurrentPlay = $idCurrentDisc;
				
				DuneHelper::playDuneOnline($id,$player);
					
				$model = MyMovie::model()->findByPk($id);
				break;
		}
		if($sourceType!=4)
		{
			if(isset($player->type))
			{	
				switch ($player->type) {
					case 0:
						$resultPlay = DuneHelper::playDune($id,$path,$player);
						break;
					case 1:
						$resultPlay = OppoHelper::playOppo($id,$path,$player);
						break;
					case 2:
						$resultPlay = Mede8erHelper::play($id,$path,$player);
						break;
				}
			}
			else
				$resultPlay = false;
		}
		
		if($resultPlay == false) 	return "";
		if(isset($TMDBData))
		{
			$backdrop = $TMDBData->backdrop!=""?$TMDBData->backdrop:$model->backdrop;
			$poster = $TMDBData->big_poster!=""?$TMDBData->big_poster:$model->big_poster;
		}
		else
		{
			$backdrop = $model->backdrop;
			$poster = $model->big_poster;
		}
		$poster = PelicanoHelper::getImageName($poster, "_big");
		$backdrop = PelicanoHelper::getImageName($backdrop, "_bd");
		
		self::saveCurrentPlayByPlayer($idResourceCurrentPlay, $sourceType,$player);

		$this->render('control',array(
				'model'=>$model,
				'backdrop'=>$backdrop,
				'big_poster'=>$poster,
				'idResource'=>$idResource,
				'sourceType'=>$sourceType,
				'player'=>$player
		));
	}
	
	public function actionAjaxGetPlayerStatus()
	{
		$idPlayer = $_POST['idPlayer'];
		$originalTitle='<span class="label label-success">Libre</span>';
		$isAlive = false;
		$result = array();
		$result['idPlayer']= $idPlayer;
		$result['powerOff']= 0;
		$result['playing']= 0;
		$result['title']= "";
		$player = Player::model()->findByPk($idPlayer);
		try {
			if(PelicanoHelper::isPlayerAlive($player->Id))
			{
				$isAlive = true;
				$isPlaying =  false;
				if(isset($player->type) && $player->type == 2)
					$isPlaying = Mede8erHelper::isPlayingByPlayer($player);
				else if(isset($player->type) && $player->type == 1)
					$isPlaying = OppoHelper::isPlayingByPlayer($player);
				else
					$isPlaying= DuneHelper::isPlayingByPlayer($player);										 				
				if($isPlaying)
				{
					$modelCurrentPlaying = CurrentPlay::model()->findByAttributes(array('is_playing'=>1,'Id_player'=>$player->Id));
					$result['playing']= 1;
					$result['title']="Desconocido";
					if(isset($modelCurrentPlaying))
					{						
						if(isset($modelCurrentPlaying->Id_nzb))
						{
							if(isset($modelCurrentPlaying->nzb->Id_nzb))
								$result['title']= $modelCurrentPlaying->nzb->nzb->myMovieDiscNzb->myMovieNzb->original_title;
							else
								$result['title']= $modelCurrentPlaying->nzb->myMovieDiscNzb->myMovieNzb->original_title;
						}
						else if(isset($modelCurrentPlaying->Id_ripped_movie))
						{
							$result['title']= $modelCurrentPlaying->rippedMovie->myMovieDisc->myMovie->original_title;
						}
						else if(isset($modelCurrentPlaying->Id_local_folder))
						{
							$result['title']= $modelCurrentPlaying->localFolder->myMovieDisc->myMovie->original_title;
						}
						else if(isset($modelCurrentPlaying->Id_current_disc))
						{
							$result['title']= $modelCurrentPlaying->currentDisc->myMovieDisc->myMovie->original_title;
						}
					}
				}
			}
			else
			{
				$result['powerOff']= 1;
			}
		} catch (Exception $e) {
			$result['powerOff']= 1;
		}
		if($result['powerOff']==1)
		{
			$player->has_error = $result['powerOff'];
			$player->save();
		}
		PelicanoHelper::saveSystemStatus(1,$result['powerOff']);
		echo json_encode($result); 
	}
	public function actionAjaxCanStart()
	{
		$sourceType = $_POST['sourceType'];
		$idResource = $_POST['idResource'];
		
		echo PelicanoHelper::canStart($sourceType,$idResource);
	}
	public function actionStart($id, $sourceType, $idResource)
	{
		$this->showFilter = false;
	
		$setting = Setting::getInstance();
		$player = $setting->players[0];
	
		$play = false;
		$idResourceCurrentPlay = 0;
		$resultPlay = true;
		switch ($sourceType) {
			case 1:
				$nzbModel = Nzb::model()->findByPk($idResource);
				$TMDBData =$nzbModel->TMDBData;
				$idResourceCurrentPlay = $idResource;
				$folderPath = explode('.',$nzbModel->file_name);
				$resultPlay = DuneHelper::playDune($id,'/'.$folderPath[0].'/'.$nzbModel->path,$player);
	
				$model = MyMovieNzb::model()->findByPk($id);
				break;
			case 2:
				$nzbRippedMovie = RippedMovie::model()->findByPk($idResource);
				$TMDBData =$nzbRippedMovie->TMDBData;
				$idResourceCurrentPlay = $idResource;
				$resultPlay = DuneHelper::playDune($id,'/'.'/'.$nzbRippedMovie->path,$player);
				$model = MyMovie::model()->findByPk($id);
				break;
			case 3:
				$localFolder = LocalFolder::model()->findByPk($idResource);
				$TMDBData =$localFolder->TMDBData;
				$idResourceCurrentPlay = $idResource;
				$folderPath = explode('.',$localFolder->path);
				$resultPlay = DuneHelper::playDune($id,'/'.'/'.$localFolder->path,$player);
	
				$model = MyMovie::model()->findByPk($id);
				break;
			case 4:
				$idCurrentDisc = self::markCurrentDiscRead();
				$idResourceCurrentPlay = $idCurrentDisc;
				DuneHelper::playDuneOnline($id,$player);
					
				$model = MyMovie::model()->findByPk($id);
				break;
		}
		if($resultPlay == false)	return "";
		if(isset($TMDBData))
		{
			$backdrop = $TMDBData->backdrop!=""?$TMDBData->backdrop:$model->backdrop;
			$poster = $TMDBData->big_poster!=""?$TMDBData->big_poster:$model->big_poster;
		}
		else
		{
			$backdrop = $model->backdrop;
			$poster = $model->big_poster;
		}
		$poster = PelicanoHelper::getImageName($poster, "_big");
		$backdrop = PelicanoHelper::getImageName($backdrop, "_bd");
		
		self::saveCurrentPlay($idResourceCurrentPlay, $sourceType);
	
		$this->render('control',array(
				'model'=>$model,
				'backdrop'=>$backdrop,
				'big_poster'=>$poster,
				'idResource'=>$idResource,
				'sourceType'=>$sourceType,
				'player'=>$player,
		));
	}
	
	private function saveCurrentPlay($id, $sourceType)
	{
		if($id > 0)
		{
			CurrentPlay::model()->updateAll(array('is_playing'=>0));

			$modelCurrentPlay = new CurrentPlay();

			switch ($sourceType) {
				case 1:
					$modelCurrentPlay->Id_nzb = $id;
					break;
				case 2:
					$modelCurrentPlay->Id_ripped_movie = $id;
					break;
				case 3:
					$modelCurrentPlay->Id_local_folder = $id;
					break;
				case 4:
					$modelCurrentPlay->Id_current_disc = $id;
					break;
			}

			$modelCurrentPlay->Id_player = 1;
			$modelCurrentPlay->save();
		}
	}
	private function saveCurrentPlayByPlayer($id, $sourceType,$player)
	{
		if($id > 0)
		{
			CurrentPlay::model()->updateAll(array('is_playing'=>0),'Id_player=:id',array(':id'=>$player->Id));
	
			$modelCurrentPlay = new CurrentPlay();
	
			switch ($sourceType) {
				case 1:
					$modelCurrentPlay->Id_nzb = $id;
					break;
				case 2:
					$modelCurrentPlay->Id_ripped_movie = $id;
					break;
				case 3:
					$modelCurrentPlay->Id_local_folder = $id;
					break;
				case 4:
					$modelCurrentPlay->Id_current_disc = $id;
					break;
			}
	
			$modelCurrentPlay->Id_player = $player->Id;
			$modelCurrentPlay->save();
		}
	}
	
	public function actionAjaxGetProgressBar()
	{
		$player=Player::model()->findByPk($_POST['idPlayer']);
		$isPlaying =  false;
		if(isset($player->type) && $player->type == 1)
			echo json_encode(OppoHelper::getProgressBarByPlayer($player));
		else
			echo json_encode(DuneHelper::getProgressBarByPlayer($player));
		
		
	}

	public function actionAjaxShowBookmark()
	{
		$id = $_POST['id'];
		$sourceType = $_POST['sourceType'];

		$criteria = new CDbCriteria();

		switch ($sourceType) {
			case 1:
				$criteria->addCondition('t.Id_nzb = '. $id);
				break;
			case 2:
				$criteria->addCondition('t.Id_ripped_movie = '. $id);
				break;
			case 3:
				$criteria->addCondition('t.Id_local_folder = '. $id);
				break;
		}
		$criteria->order = 'Id desc';

		$bookmarks = Bookmark::model()->findAll($criteria);


		$this->renderPartial('_bookmark',array('bookmarks'=>$bookmarks,
				'idResource'=>$id,
				'sourceType'=>$sourceType));

	}

	public function actionAjaxGetDunePosition()
	{
		$modelDune = DuneHelper::getState();
		$position = 0;
		if(isset($modelDune))
		{
			$position = $modelDune->playback_position;
		}
		echo $position;
	}

	public function actionAjaxPauseDune()
	{
		DuneHelper::pause();
	}

	public function actionAjaxPlayFromPosition()
	{
		$id = (isset($_POST['id']))?$_POST['id']:null;
		$end = 0;

		if(isset($id))
		{
			$model = Bookmark::model()->findByPk($id);

			if(isset($model))
			{
				DuneHelper::playFromPosition($model->start);
				$end = $model->end;
			}
		}
		echo $end;
	}

	public function actionAjaxSaveScene()
	{
		$idResource = (isset($_POST['idResource']))?$_POST['idResource']:null;
		$sourceType = (isset($_POST['sourceType']))?$_POST['sourceType']:null;
		$sceneStart = (isset($_POST['sceneStart']))?$_POST['sceneStart']:null;
		$sceneEnd = (isset($_POST['sceneEnd']))?$_POST['sceneEnd']:null;
		$sceneText = (isset($_POST['sceneText']))?$_POST['sceneText']:null;

		if(isset($idResource) && isset($sourceType) &&
				isset($sceneStart) && isset($sceneEnd) && isset($sceneText))
		{
			$model = new Bookmark();
			switch ($sourceType) {
				case 1:
					$model->Id_nzb = $idResource;
					break;
				case 2:
					$model->Id_ripped_movie = $idResource;
					break;
				case 3:
					$model->Id_local_folder = $idResource;
					break;
			}

			$model->start = $sceneStart;
			$model->end = $sceneEnd;
			$model->time_start = gmdate("H:i:s", $sceneStart);
			$model->time_end = gmdate("H:i:s", $sceneEnd);
			$model->description = $sceneText;
			$model->save();

			$newRow = CHtml::openTag('tr',array('class'=>'bookmark-row','id'=>'id_'.$model->Id));
			$newRow .= CHtml::openTag('td');
			$newRow .= $model->description;
			$newRow .= CHtml::closeTag('td');
			$newRow .= CHtml::openTag('td');
			$newRow .= $model->time_start;
			$newRow .= CHtml::closeTag('td');
			$newRow .= CHtml::openTag('td');
			$newRow .= $model->time_end;
			$newRow .= CHtml::closeTag('td');
			$newRow .= CHtml::openTag('td');
			$newRow .= "<button idrecord='".$model->Id."' class='btn btn-primary btn-medium btn-play-position'><i class='icon-play'></i></button>";
			$newRow .= CHtml::closeTag('td');
			$newRow .= CHtml::openTag('td');
			$newRow .= "<i idrecord='".$model->Id."' class='icon-eraser pointer btn-eraser'></i>";
			$newRow .= CHtml::closeTag('td');
			$newRow .= CHtml::closeTag('tr');
			echo $newRow;
		}

	}

	public function actionOpenDuneControl($id, $type, $id_resource,$id_player)
	{
		$player = Player::model()->findByPk($id_player);
		$this->showFilter = false;

		if($type == 1)
		{
			$model = MyMovieNzb::model()->findByPk($id);
			$modelNzb = Nzb::model()->findByPk($id_resource);
			$TMDBData = $modelNzb->TMDBData;
		}
		else if($type == 2)
		{
			$modelRipped = RippedMovie::model()->findByPk($id_resource);
			$TMDBData = $modelRipped->TMDBData;
			$model = MyMovie::model()->findByPk($id);
		}
		else if($type == 3)
		{
			$modelLocal = LocalFolder::model()->findByPk($id_resource);
			$TMDBData = $modelLocal->TMDBData;
			$model = MyMovie::model()->findByPk($id);
		}
		if(isset($TMDBData))
		{
			$backdrop = $TMDBData->backdrop!=""?$TMDBData->backdrop:$model->backdrop;
			$poster = $TMDBData->big_poster!=""?$TMDBData->big_poster:$model->big_poster;
		}
		else
		{
			$backdrop = $model->backdrop;
			$poster = $model->big_poster;
		}
		$poster = PelicanoHelper::getImageName($poster, "_big");
		$backdrop = PelicanoHelper::getImageName($backdrop, "_bd");
		
		$this->render('control',array(
				'model'=>$model,
				'big_poster'=>$poster,
				'backdrop'=>$backdrop,
				'idResource'=>$id_resource,
				'sourceType'=>$type,
				'player'=>$player
		));
	}

	public function actionAjaxUseRemote()
	{
		$player = Player::model()->findByPk($_GET['Id_player']);
		if(isset($player->type))
		{
			switch ($player->type) {
				case 0:
					DuneHelper::useRemote($_GET['ir_code'],$_GET['Id_player']);
					break;
				case 1:
					OppoHelper::useRemote($_GET['ir_code'],$_GET['Id_player']);
					break;
				case 2:
					Mede8erHelper::useRemote($_GET['ir_code'],$_GET['Id_player']);
					break;
			}
		}
	}

	public function actionAjaxStop()
	{
		if(isset($_GET['Id_player']))
		{
			$player = Player::model()->findByPk($_GET['Id_player']);
			if(isset($player->type))
			{
				switch ($player->type) {
					case 0:
						DuneHelper::setBlackScreenByPlayer($player);
						break;
					case 1:
						OppoHelper::setBackgroundImage($player);
						break;
					case 2:
						Mede8erHelper::setBlackScreen($player);
						break;
				}
			}							
		}
	}

	public function actionAjaxGetPlayback()
	{
		$response = $this->getPlayback();

		echo json_encode($response);
	}
	public function actionAjaxGetPlaybackByPlayer()
	{
		$idPlayer = $_POST['idPlayer'];

		$player = Player::model()->findByPk($idPlayer);
		if(isset($player))
		{		
			$response = $this->getPlaybackByPlayer($player);
			echo json_encode($response);
		}
	}
	
	public function actionAjaxGetRipp()
	{
		$response = array('id'=>0, 'poster'=>'','originalTitle'=>'', 'percentage'=>0);

		$criteria=new CDbCriteria;
		$criteria->select = 'cd.percentage, t.original_title, t.poster, t.Id';
		$criteria->join = 'INNER JOIN my_movie_disc mmd ON (mmd.Id_my_movie = t.Id)
				INNER JOIN current_disc cd ON (cd.Id_my_movie_disc = mmd.Id)';
		$criteria->addCondition('cd.Id_current_disc_state <> 1');
		$criteria->addCondition('cd.command =  2'); //ripping

		$modelMyMovie = MyMovie::model()->find($criteria);

		if(isset($modelMyMovie))
		{
			$response['originalTitle'] = $modelMyMovie->original_title;
			$response['poster'] = $modelMyMovie->poster;
			$response['id'] = $modelMyMovie->Id;
			$response['percentage'] = $modelMyMovie->percentage;
		}
		echo json_encode($response);
	}

	private function getPlayback()
	{
		//type = 1 = nzb
		//type = 2 = rippedMovie
		//type = 3 = localFolder
		//type = 4 = online
		$response = array('id'=>0,'type'=>1, 'originalTitle'=>'');
		//return $response;
		if(DuneHelper::isPlaying())
		{
			$modelCurrentPlaying = CurrentPlay::model()->findByAttributes(array('is_playing'=>1));

			if(isset($modelCurrentPlaying))
			{
				if(isset($modelCurrentPlaying->Id_nzb))
				{
					$response['type'] = 1;
					$response['id'] = $modelCurrentPlaying->nzb->myMovieDiscNzb->Id_my_movie_nzb;
					$response['id_resource'] = $modelCurrentPlaying->Id_nzb;
					$response['originalTitle'] = $modelCurrentPlaying->nzb->myMovieDiscNzb->myMovieNzb->original_title;
				}
				else if(isset($modelCurrentPlaying->Id_ripped_movie))
				{
					$response['type'] = 2;
					$response['id'] = $modelCurrentPlaying->rippedMovie->myMovieDisc->Id_my_movie;
					$response['originalTitle'] = $modelCurrentPlaying->rippedMovie->myMovieDisc->myMovie->original_title;
					$response['id_resource'] = $modelCurrentPlaying->Id_ripped_movie;
				}
				else if(isset($modelCurrentPlaying->Id_local_folder))
				{
					$response['type'] = 3;
					$response['id'] = $modelCurrentPlaying->localFolder->myMovieDisc->Id_my_movie;
					$response['originalTitle'] = $modelCurrentPlaying->localFolder->myMovieDisc->myMovie->original_title;
					$response['id_resource'] = $modelCurrentPlaying->Id_local_folder;
				}
				else if(isset($modelCurrentPlaying->Id_current_disc))
				{
					$response['type'] = 4;
					$response['originalTitle'] = $modelCurrentPlaying->currentDisc->myMovieDisc->myMovie->original_title;
					$response['id'] = $modelCurrentPlaying->currentDisc->myMovieDisc->Id_my_movie;
				}
			}
		}

		return $response;

	}
	private function getPlaybackByPlayer($player)
	{
		//type = 1 = nzb
		//type = 2 = rippedMovie
		//type = 3 = localFolder
		//type = 4 = online
		$response = array('id'=>0,'type'=>1, 'originalTitle'=>'');
		//return $response;
		$isPlaying =  false;
		if(isset($player->type) && $player->type == 1)
			$isPlaying = OppoHelper::isPlayingByPlayer($player);
		else
			$isPlaying = DuneHelper::isPlayingByPlayer($player);
		if($isPlaying)
		{
			$modelCurrentPlaying = CurrentPlay::model()->findByAttributes(array('is_playing'=>1,'Id_player'=>$player->Id));
	
			if(isset($modelCurrentPlaying))
			{
				if(isset($modelCurrentPlaying->Id_nzb))
				{
					$response['type'] = 1;
					 
					if(isset($modelCurrentPlaying->nzb->Id_nzb))
						$myMovieDisc = $modelCurrentPlaying->nzb->nzb->myMovieDiscNzb;
					else
						$myMovieDisc = $modelCurrentPlaying->nzb->myMovieDiscNzb;
					$response['id'] = $myMovieDisc->Id_my_movie_nzb;
					$response['id_resource'] = $modelCurrentPlaying->Id_nzb;
					$response['originalTitle'] = $myMovieDisc->myMovieNzb->original_title;
				}
				else if(isset($modelCurrentPlaying->Id_ripped_movie))
				{
					$response['type'] = 2;
					$response['id'] = $modelCurrentPlaying->rippedMovie->myMovieDisc->Id_my_movie;
					$response['originalTitle'] = $modelCurrentPlaying->rippedMovie->myMovieDisc->myMovie->original_title;
					$response['id_resource'] = $modelCurrentPlaying->Id_ripped_movie;
				}
				else if(isset($modelCurrentPlaying->Id_local_folder))
				{
					$response['type'] = 3;
					$response['id'] = $modelCurrentPlaying->localFolder->myMovieDisc->Id_my_movie;
					$response['originalTitle'] = $modelCurrentPlaying->localFolder->myMovieDisc->myMovie->original_title;
					$response['id_resource'] = $modelCurrentPlaying->Id_local_folder;
				}
				else if(isset($modelCurrentPlaying->Id_current_disc))
				{
					$response['type'] = 4;
					$response['originalTitle'] = $modelCurrentPlaying->currentDisc->myMovieDisc->myMovie->original_title;
					$response['id'] = $modelCurrentPlaying->currentDisc->myMovieDisc->Id_my_movie;
				}
			}
		}
	
		return $response;
	
	}
	
	/**
	 * This is the default 'music' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionMusic()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$this->render('building');
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$headers="From: {$model->email}\r\nReply-To: {$model->email}";
				mail(Yii::app()->params['adminEmail'],$model->subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	public function actionAjaxGetCurrentDisc()
	{
		$criteria=new CDbCriteria;
		$criteria->condition = 'Id_current_disc_state <> 1';
		$modelCurrentDisc = CurrentDisc::model()->find($criteria);

		$isDiscIN = 0;
		$read = 1;
		if(isset($modelCurrentDisc))
		{
			$isDiscIN = 1;
			$read = $modelCurrentDisc->read;
		}

		$currentDisc = array('is_in'=>$isDiscIN,'read'=>$read);
		echo CJSON::encode($currentDisc);
	}

	public function actionAjaxGetCurrentState()
	{
		$criteria=new CDbCriteria;
		$criteria->condition = 'Id_current_disc_state <> 1';
		$modelCurrentDisc = CurrentDisc::model()->find($criteria);

		$isDiscIN = 0;
		$read = 1;
		if(isset($modelCurrentDisc))
		{
			$isDiscIN = 1;
			$read = $modelCurrentDisc->read;
		}

		$currentDisc = array('is_in'=>$isDiscIN,'read'=>$read);

		$criteria=new CDbCriteria;
		$criteria->condition = 'is_in = 1';
		$modelCurrentUSBs = CurrentExternalStorage::model()->findAll($criteria);

		$isDiscIN = 0;
		$read = 1;
		$devicesQty = 0;
		$idUnread = 0;
		$nameUnread = '';
		$label = "";
		$devicesQty = count($modelCurrentUSBs);
		if($devicesQty>0)
		{
			$isDiscIN = 1;
			foreach($modelCurrentUSBs as $modelCurrentUSB)
			{				
				if($modelCurrentUSB->read == 0)
				{
					$idUnread = $modelCurrentUSB->Id; 
					$read = 0;
					$label = $modelCurrentUSB->label;
					break;
				}
			}
		}

		$currentUSB = array('is_in'=>$isDiscIN,
							'read'=>$read, 
							'devicesQty'=>$devicesQty,
							'idUnread'=>$idUnread,
							'nameUnread'=>$nameUnread,
							'label'=>$label);

		$playerPlaying = 0;
		$setting = Setting::getInstance();
		$players = $setting->players;
		foreach ($players as $player)
		{
			if(isset($player->type) && $player->type == 1)
				$isPlaying = OppoHelper::isPlayingByPlayer($player);
			else
				$isPlaying = DuneHelper::isPlayingByPlayer($player);
			if($isPlaying)
			{
 				$playerPlaying++;
 				//No valido esto, para ser consitente con AjaxGetPlayerStatus 
// 				$modelCurrentPlaying = CurrentPlay::model()->findByAttributes(array('is_playing'=>1,'Id_player'=>$player->Id));
// 				if(isset($modelCurrentPlaying))
// 				{
// 					$playerPlaying++;
// 				}
			}
		}
		$criteriaDownloading = new CDbCriteria;
		$criteriaDownloading->condition = '(downloading = 1 OR downloaded = 1) AND ready_to_play = 0 AND Id_nzb is null';
		
		$nzb = Nzb::model()->findAll($criteriaDownloading);
		$downloading['qty'] = count($nzb);

		$modelSystemStatus = SystemStatus::model()->findByPk(1);
		if(isset($modelSystemStatus))
			$systemStatus = $modelSystemStatus->attributes;
		else 
		{
			$modelSystemStatus = new SystemStatus;
			$systemStatus = $modelSystemStatus->attributes;			
		}
		$response = array('playBack'=>array('count'=>$playerPlaying),
				'currentDisc'=>$currentDisc,
				'currentUSB'=>$currentUSB,
				'downloading'=>$downloading,
				'systemStatus'=>$systemStatus);
		//si se esta descargando algo, entonces llamo al status para actualizar la tabla nzb con los ids sabnzbd_id
		if($downloading['qty']>0)
		{
			$sABnzbdStatus= new SABnzbdStatus();
			$sABnzbdStatus->completeSABNZBDId();				
		}

		echo json_encode($response);
	}

	public function actionUseDisc($action)
	{
		$criteria=new CDbCriteria;
		$criteria->condition = 'Id_current_disc_state <> 1';
		$modelCurrentDisc = CurrentDisc::model()->find($criteria);

		if(isset($modelCurrentDisc))
		{
			if($modelCurrentDisc->Id_current_disc_state == 3) //Widh data
			{
				if($action == 'play')
				{
					$this->showFilter = false;
					$modelMyMovieDisc = MyMovieDisc::model()->findByAttributes(array('Id'=>$modelCurrentDisc->Id_my_movie_disc));
					$model = MyMovie::model()->findByPk($modelMyMovieDisc->Id_my_movie);

					$this->render('start',array(
							'model'=>$model,
					));
				}
				else
				{

				}
			}
			else
			{
				$rawData = array();
				$rawData = RipperHelper::searchTitlesByDiscId($modelCurrentDisc->Id_my_movie_disc,'');
				$arrayDataProvider=new CArrayDataProvider($rawData, array(
						'id'=>'id',
						'sort'=>array(
								'attributes'=>array('year', 'type', 'country'),
						),

						'pagination'=>array('pageSize'=>10),

				));
				//$this->render('currentDisc',array('arrayDataProvider'=>$arrayDataProvider,));
				$this->renderPartial('currentDisc',array('arrayDataProvider'=>$arrayDataProvider));
			}
		}
		else
			$this->redirect('index');
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$this->layout='//layouts/login';

		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			//get info user from server
			//User::sincronizeFromServer();

			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}

		$setting = Setting::getInstance();
		
		if(!isset($setting->Id_device))
			$this->redirect( SiteController::createUrl('config'));
		else 			// 	display the login form
			$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
	public function actionTmdb()
	{
		$idResource = $_GET['idResource'];
		$sourceType = $_GET['sourceType'];
		if(isset($_POST['TMDBData']['TMDB_id']))
		{
			$idResource = $_POST['idResource'];
			$sourceType = $_POST['sourceType'];
			$TMDBId = $_POST['TMDBData']['TMDB_id'];
			$poster = $_POST['poster'];
			$bigPoster = $_POST['poster'];
			$bigPoster = str_replace ( "w154" , "w500" , $bigPoster );
			$backdrop = isset($_POST['backdrop'])?$_POST['backdrop']:"";
			$backdrop = str_replace ( "w300" , "original" , $backdrop );
			TMDBHelper::downloadAndLinkImages($TMDBId,$idResource,$sourceType,$poster,$bigPoster,$backdrop);
			$this->redirect(Yii::app()->homeUrl);
		}
		else {
			if($sourceType == 1)
			{
				$modelNzb = Nzb::model()->findByPk($idResource);
				$model = $modelNzb->TMDBData;
				$myMovie = $modelNzb->myMovieDiscNzb->myMovieNzb;
			}
			else if($sourceType == 2)
			{
				$modelRippedMovie = RippedMovie::model()->findByPk($idResource);
				$model = $modelRippedMovie->TMDBData;
				$myMovie = $modelRippedMovie->myMovieDisc->myMovie;
			}
			else
			{
				$localFolder = LocalFolder::model()->findByPk($idResource);
				$model = $localFolder->TMDBData;
				$myMovie = $localFolder->myMovieDisc->myMovie;
			}
			$db = TMDBApi::getInstance();
			$db->adult = true;  // return adult content
			$db->paged = false; // merges all paged results into a single result automatically

			$results = $db->search('movie', array('query'=>$myMovie->original_title, 'year'=>$myMovie->production_year));
			if(empty($results))
			{
				$results = $db->search('movie', array('query'=>$myMovie->original_title));
			}
			$movie = reset($results);
			$images = $movie->posters('154',"");
			$bds = $movie->backdrops('300',"");
			if(!isset($model))
			{
				$model = new TMDBData();
				$model->TMDB_id =$movie->id;
			}
			$this->render('_tmdb',array('idResource'=>$idResource,'sourceType'=>$sourceType, 'model'=>$model,'myMovie'=>$myMovie,'movie'=>$movie,'images'=>$images,'bds'=>$bds));

		}
	}
	public function actionAjaxSaveSelectedMovie()
	{
		if(isset($_POST['Id_movie']))
		{
			$transaction=Yii::app()->db->beginTransaction();
			try
			{
				$idResource = $_POST['idResource'];
				$sourceType = $_POST['sourceType'];
				$personRelation ="";
				if($sourceType == 1)
				{
					$personRelation ="MyMovieNzbPerson";
					$idRelation = "Id_my_movie_nzb";
					$model = Nzb::model()->findByPk($idResource);
					$myMovie = $model->myMovieDiscNzb->myMovieNzb;
					$disc = $model->myMovieDiscNzb;
					$newMyMovie = new MyMovieNzb();
				}
				else if($sourceType == 2)
				{
					$personRelation ="MyMoviePerson";
					$idRelation = "Id_my_movie";
					$model = RippedMovie::model()->findByPk($idResource);
					$myMovie = $model->myMovieDisc->myMovie;
					$disc = $model->myMovieDisc;
					$newMyMovie = new MyMovie();
				}
				else
				{
					$personRelation ="MyMoviePerson";
					$idRelation = "Id_my_movie";
					$model = LocalFolder::model()->findByPk($idResource);
					$myMovie = $model->myMovieDisc->myMovie;
					$disc = $model->myMovieDisc;
					$newMyMovie = new MyMovie();
				}
				$model->is_personal = 0;
				$model->save();
				
				$db = TMDBApi::getInstance();
				$db->adult = true;  // return adult content
				$db->paged = false; // merges all paged results into a single result automatically
		
				$movie = new TMDBMovie($_POST['Id_movie']);
				$persons = $movie->casts();
				$poster = $movie->poster('342');
				$bigPoster = $movie->poster('500');
				$backdrop = $movie->backdrop('original');
		
				TMDBHelper::downloadAndLinkImages($movie->id,$idResource,$sourceType,$poster,$bigPoster,$backdrop);
				if(!$myMovie->is_custom)
				{
					$myMovie->Id=uniqid ("cust_");
					$newMyMovie->attributes =$myMovie->attributes;
					$myMovie = $newMyMovie;
				}
				$releases = $movie->releases();
				$myMovie->certification = "UNRATED";
				foreach($releases->countries as $countries)
				{
					if(($countries->iso_3166_1=="US" || $countries->iso_3166_1=="GB") && $countries->certification!="")
					{
						$myMovie->certification = $countries->certification;
						break;
					}
				}
				
				$myMovie->original_title = $movie->original_title;
				$myMovie->adult = $movie->adult?1:0;
				$myMovie->release_date = $movie->release_date;
				$date =date_parse($movie->release_date);
				$myMovie->production_year = $date['year'];
				$myMovie->running_time = $movie->runtime;
				$myMovie->description = $movie->overview;
				$myMovie->local_title = $movie->title;
				$myMovie->sort_title= $movie->title;
				$myMovie->imdb= $movie->imdb_id;
				$myMovie->rating= (int)$movie->vote_average;
				$myMovie->is_custom = 1;
				$genres = $movie->genres;
				$myMovie->genre="";
				$first = true;
				foreach($genres as $genre)
				{
					$genreVal = trim($genre->name);
					if($first)
					{
						$first = false;
						$myMovie->genre = $genreVal;
					}
					else
					{
						$myMovie->genre = $myMovie->genre.", ".$genreVal;
					}
				}
		
				$companies = $movie->production_companies;
				$myMovie->studio = "";
				$first = true;
				foreach($companies as $companie)
				{
					if($first)
					{
						$first = false;
						$myMovie->studio = $companie->name;
					}
					else
					{
						$myMovie->studio = $myMovie->studio.", ".$companie->name;
					}
				}
				if($myMovie->save())
				{
					$casts =isset($persons['cast'])?$persons['cast']:array();
		
					$relations = $personRelation::model()->findAllByAttributes(array($idRelation=>$myMovie->Id));
					$personsToDelete = array();
					foreach ($relations as $relation)
					{
						$personsToDelete[] = $relation->person;
					}
					$personRelation::model()->deleteAllByAttributes(array($idRelation=>$myMovie->Id));
					foreach ($personsToDelete as $toDelete)
					{
						$toDelete->delete();
					}
					foreach($casts as $cast)
					{
						$person = new Person();
						$person->name= $cast->name;
						$person->type = "Actor";
						$person->role = $cast->character;
						$person->photo_original = $cast->profile();
						if($person->save())
						{
							$myMoviePerson =  new $personRelation();
							$myMoviePerson->$idRelation = $myMovie->Id;
							$myMoviePerson->Id_person =$person->Id;
							$myMoviePerson->save();
						}
					}
					$crews =isset($persons['crew'])?$persons['crew']:array();
					foreach($crews as $crew)
					{
						$person = new Person();
						$person->name= $crew->name;
						$person->type = $crew->job;
						$person->photo_original = $crew->profile();
						if($person->save())
						{
							$myMoviePerson =  new $personRelation();
							$myMoviePerson->$idRelation = $myMovie->Id;
							$myMoviePerson->Id_person =$person->Id;
							$myMoviePerson->save();
						}
					}
					if(isset($disc->Id_my_movie))	$disc->Id_my_movie=$myMovie->Id;
					else $disc->Id_my_movie_nzb=$myMovie->Id;
		
					if($disc->save())
					{
						$transaction->commit();
					}
				}
			}
			catch (Exception $e) {
				$transaction->rollBack();
				var_dump($e);
			}
		}		
	}
	public function actionTmdbChangeMovie()
	{
		if(isset($_POST['movie']))
		{
			$transaction=Yii::app()->db->beginTransaction();
			try
			{
				$idResource = $_POST['idResource'];
				$sourceType = $_POST['sourceType'];
				$personRelation ="";
				if($sourceType == 1)
				{
					$personRelation ="MyMovieNzbPerson";
					$idRelation = "Id_my_movie_nzb";
					$model = Nzb::model()->findByPk($idResource);
					$myMovie = $model->myMovieDiscNzb->myMovieNzb;
					$disc = $model->myMovieDiscNzb;
					$newMyMovie = new MyMovieNzb();
				}
				else if($sourceType == 2)
				{
					$personRelation ="MyMoviePerson";
					$idRelation = "Id_my_movie";
					$model = RippedMovie::model()->findByPk($idResource);
					$myMovie = $model->myMovieDisc->myMovie;
					$disc = $model->myMovieDisc;
					$newMyMovie = new MyMovie();
				}
				else
				{
					$personRelation ="MyMoviePerson";
					$idRelation = "Id_my_movie";
					$model = LocalFolder::model()->findByPk($idResource);
					$myMovie = $model->myMovieDisc->myMovie;
					$disc = $model->myMovieDisc;
					$newMyMovie = new MyMovie();
				}
				$db = TMDBApi::getInstance();
				$db->adult = true;  // return adult content
				$db->paged = false; // merges all paged results into a single result automatically

				$movie = new TMDBMovie($_POST['movie']);
				$persons = $movie->casts();
				$poster = $movie->poster('154');
				$bigPoster = $movie->poster('500');
				$backdrop = $movie->backdrop('original');

				TMDBHelper::downloadAndLinkImages($movie->id,$idResource,$sourceType,$poster,$bigPoster,$backdrop);
				if(!$myMovie->is_custom)
				{
					$myMovie->Id=uniqid ("cust_");
					$newMyMovie->attributes =$myMovie->attributes;
					$myMovie = $newMyMovie;
				}
				$myMovie->original_title = $movie->original_title;
				$myMovie->adult = $movie->adult?1:0;
				$myMovie->release_date = $movie->release_date;
				$date =date_parse($movie->release_date);
				$myMovie->production_year = $date['year'];
				$myMovie->running_time = $movie->runtime;
				$myMovie->description = $movie->overview;
				$myMovie->local_title = $movie->title;
				$myMovie->sort_title= $movie->title;
				$myMovie->imdb= $movie->imdb_id;
				$myMovie->rating= (int)$movie->vote_average;
				$myMovie->is_custom = 1;
				$genres = $movie->genres;
				$myMovie->genre="";
				$first = true;
				foreach($genres as $genre)
				{
					$genreVal = trim($genre->name);
					if($first)
					{
						$first = false;
						$myMovie->genre = $genreVal;
					}
					else
					{
						$myMovie->genre = $myMovie->genre.", ".$genreVal;
					}
				}

				$companies = $movie->production_companies;
				$myMovie->studio = "";
				$first = true;
				foreach($companies as $companie)
				{
					if($first)
					{
						$first = false;
						$myMovie->studio = $companie->name;
					}
					else
					{
						$myMovie->studio = $myMovie->studio.", ".$companie->name;
					}
				}
				if($myMovie->save())
				{
					$casts =$persons['cast'];

					$relations = $personRelation::model()->findAllByAttributes(array($idRelation=>$myMovie->Id));
					$personsToDelete = array();
					foreach ($relations as $relation)
					{
						$personsToDelete[] = $relation->person;
					}
					$personRelation::model()->deleteAllByAttributes(array($idRelation=>$myMovie->Id));
					foreach ($personsToDelete as $toDelete)
					{
						$toDelete->delete();
					}
					foreach($casts as $cast)
					{
						$person = new Person();
						$person->name= $cast->name;
						$person->type = "Actor";
						$person->role = $cast->character;
						$person->photo_original = $cast->profile();
						if($person->save())
						{
							$myMoviePerson =  new $personRelation();
							$myMoviePerson->$idRelation = $myMovie->Id;
							$myMoviePerson->Id_person =$person->Id;
							$myMoviePerson->save();
						}
					}
					$crews =isset($persons['crew'])?$persons['crew']:array();
					foreach($crews as $crew)
					{
						$person = new Person();
						$person->name= $crew->name;
						$person->type = $crew->job;
						$person->photo_original = $crew->profile();
						if($person->save())
						{
							$myMoviePerson =  new $personRelation();
							$myMoviePerson->$idRelation = $myMovie->Id;
							$myMoviePerson->Id_person =$person->Id;
							$myMoviePerson->save();
						}
					}
					if(isset($disc->Id_my_movie))	$disc->Id_my_movie=$myMovie->Id;
					else $disc->Id_my_movie_nzb=$myMovie->Id;

					if($disc->save())
					{
						$transaction->commit();
						$this->redirect(Yii::app()->homeUrl);
					}
				}
			}
			catch (Exception $e) {
				var_dump($e);
				$transaction->rollBack();
			}
		}
		else
		{
			$idResource = $_GET['idResource'];
			$sourceType = $_GET['sourceType'];
			$modelSource = null;

			if($sourceType == 1)
			{
				$modelSource = Nzb::model()->findByPk($idResource);
				$myMovie = $modelSource->myMovieDiscNzb->myMovieNzb;
			}
			else if($sourceType == 2)
			{
				$modelSource = RippedMovie::model()->findByPk($idResource);
				$myMovie = $modelSource->myMovieDisc->myMovie;
			}
			else
			{
				$modelSource = LocalFolder::model()->findByPk($idResource);
				$myMovie = $modelSource->myMovieDisc->myMovie;
			}
			$path = explode("/",$modelSource->path);
			$path = $path[count($path)-1];
			$db = TMDBApi::getInstance();
			$db->adult = true;  // return adult content
			$db->paged = false; // merges all paged results into a single result automatically
			$results = $db->search('movie', array('query'=>$myMovie->original_title));
			$this->render('_tmdbChangeMovie',array('idResource'=>$idResource,'sourceType'=>$sourceType,'myMovie'=>$myMovie,'movies'=>$results));
		}
	}
	
	public function actionAjaxFillMovieList()
	{
		if(isset($_POST['idResource'])&&isset($_POST['sourceType']))
		{
			$idResource = $_POST['idResource'];
			$sourceType = $_POST['sourceType'];
			
			if($sourceType == 1)
			{
				$modelNzb = Nzb::model()->findByPk($idResource);
				$myMovie = $modelNzb->myMovieDiscNzb->myMovieNzb;
			}
			else if($sourceType == 2)
			{
				$modelRippedMovie = RippedMovie::model()->findByPk($idResource);
				$myMovie = $modelRippedMovie->myMovieDisc->myMovie;
			}
			else
			{
				$localFolder = LocalFolder::model()->findByPk($idResource);
				$myMovie = $localFolder->myMovieDisc->myMovie;
			}
			$db = TMDBApi::getInstance();
			$db->adult = true;  // return adult content
			$db->paged = false; // merges all paged results into a single result automatically
			
			$remove = array("_", "-", ".");
			$title = str_replace($remove, " ", $myMovie->original_title);
			
			$results = array();
			if($myMovie->original_title != "Desconocido")
				$results = $db->search('movie', array('query'=>$title));
			
			$this->renderPartial('_movieSelector',array('idResource'=>$idResource,'sourceType'=>$sourceType,'myMovie'=>$myMovie,'movies'=>$results));				
		}
		
	}		
	
	public function actionAjaxExternalStorageSaveSelectedMovie()
	{
		$idApi = (isset($_POST['id']))?$_POST['id']:null;
		$idESData = (isset($_POST['idExternal_storage_data']))?$_POST['idExternal_storage_data']:null;
		
		if(isset($idApi) && isset($idESData))
		{
			$movie = new TMDBMovie($idApi);
			$modelESData = ExternalStorageData::model()->findByPk($idESData);
			if(isset($movie) && isset($modelESData))
			{
				$modelESData->imdb = $movie->imdb_id;
				$modelESData->title = $movie->original_title;
				$date = date_parse($movie->release_date);				
				$modelESData->year = $date['year'];
				if($modelESData->save())
				{
					ReadFolderHelper::rebuildPeliFileES($modelESData);
				}
			}
		}
		
	}
	
	public function actionAjaxFillExternalStorageMovieList()
	{
		if(isset($_POST['id_external_storage_data']))
		{
			$idESData = $_POST['id_external_storage_data'];
			$modelESData = ExternalStorageData::model()->findByPk($idESData);	
			
			if(isset($modelESData))
			{				
				$db = TMDBApi::getInstance();
				$db->adult = true;  // return adult content
				$db->paged = false; // merges all paged results into a single result automatically
				$results = $db->search('movie', array('query'=>$modelESData->title, 'year'=>$modelESData->year));
				$movies = array();
				foreach ($results as $result)
				{		
					$movie = new TMDBMovie($result->id);
					$movieResult['release_date']=$movie->release_date;
					$movieResult['id']=$movie->id;
					$movieResult['original_title']=$movie->original_title;
					$movies[]=$movieResult;				
				}
				$this->renderPartial('_externalStorageMovieSelector',array('id_external_storage_data'=>$idESData,'movies'=>$movies));
			}
		}	
	}
	
	public function actionUpdateMyMovieInfo()
	{
		if(isset($_POST['id_my_movie']))
		{
			$idResource = $_POST['idResource'];
			$sourceType = $_POST['sourceType'];
			$idMyMovie = $_POST['id_my_movie'];
			$actors = explode(',',$_POST['input_actors']);
			$directors = explode(',',$_POST['input_directors']);
			$genres = explode(',',$_POST['input_genres']);
			$myMovieDisc = "MyMovieDisc";
			$myMovieDiscField = "Id_my_movie_disc";
			$relation = "MyMoviePerson";
			$Id_relation = "Id_my_movie";
			$newClass = "MyMovie";

			if($sourceType == 1)
			{
				$myMovieDiscField = "Id_my_movie_disc_nzb";
				$myMovieDisc = "MyMovieDiscNzb";
				$newClass = "MyMovieNzb";
				$modelNzb = Nzb::model()->findByPk($idResource);
				$disc = $modelNzb->myMovieDiscNzb;
				$myMovie = $modelNzb->myMovieDiscNzb->myMovieNzb;
				$relation = "MyMovieNzbPerson";
				$Id_relation = "Id_my_movie_nzb";
				$modelNzb->myMovieDiscNzb;
			}
			else if($sourceType == 2)
			{
				$modelRippedMovie = RippedMovie::model()->findByPk($idResource);
				$disc = $modelRippedMovie->myMovieDisc;
				$myMovie = $modelRippedMovie->myMovieDisc->myMovie;
			}
			else
			{
				$localFolder = LocalFolder::model()->findByPk($idResource);
				$disc = $localFolder->myMovieDisc;
				$myMovie = $localFolder->myMovieDisc->myMovie;
			}
			$myMovie = $newClass::model()->findByPk($idMyMovie);
			if(!$myMovie->is_custom)
			{
				$newMyMovie = new $newClass;
				$myMovie->Id=uniqid ("cust_");
				$newMyMovie->attributes =$myMovie->attributes;
				$persons = $myMovie->persons;
				$myMovie = $newMyMovie;
			}
			$transaction = Yii::app()->db->beginTransaction();
			try {
				$myMovie->is_custom = 1;
				$myMovie->attributes = $_POST[$newClass];
				$myMovie->genre= "";
				$first = true;
				foreach($genres as $genre)
				{
					$genreVal = trim($genre);
					if($first)
					{
						$first = false;
						$myMovie->genre = $genreVal;
					}
					else
					{
						$myMovie->genre = $myMovie->genre.", ".$genreVal;
					}
				}

				$myMovie->save();

				$disc->$Id_relation = $myMovie->Id;
				$disc->save();
				if(isset($persons))
				{
					foreach ($persons as $person){
						$relationDB = new $relation;
						$relationDB->Id_person = $person->Id;
						$relationDB->$Id_relation =$myMovie->Id;
						$relationDB->save();
					}
				}
				$persons = $myMovie->persons;
				foreach ($persons as $person){
					if($person->type!='Actor' && $person->type!='Director') continue;
					//$selectedActors[]=$person->Id;
					if(!in_array($person->Id,$actors)&&!in_array($person->Id,$directors))
					{
						$relation::model()->deleteByPk(array($Id_relation=>$myMovie->Id,'Id_person'=>$person->Id));
						$person->delete();
					}
				}
				foreach ($actors as $actor){
					if($actor=="") continue;
					$actorInDB = Person::model()->findByPk($actor);
					if(!isset($actorInDB))
					{
						$actorInDB = new Person();
						$actorInDB->name = $actor;
						$actorInDB->type = "Actor";
						$actorInDB->save();
						$newRelation = new $relation;
						$newRelation->Id_person = $actorInDB->Id;
						$newRelation->$Id_relation = $myMovie->Id;
						$newRelation->save();
					}
					$relationDB = $relation::model()->findByPk(array($Id_relation=>$myMovie->Id,'Id_person'=>$actorInDB->Id));
					if(!isset($relationDB))
					{
						$relationDB = new $relation;
						$relationDB->Id_person = $actorInDB->Id;
						$relationDB->$Id_relation =$myMovie->Id;
						$relationDB->save();
					}
				}
				foreach ($directors as $director){
					if($director=="") continue;
					$directorInDB = Person::model()->findByPk($director);
					if(!isset($directorInDB))
					{
						$directorInDB = new Person();
						$directorInDB->name = $director;
						$directorInDB->type = "Director";
						$directorInDB->save();
						$newRelation = new $relation;
						$newRelation->Id_person = $directorInDB->Id;
						$newRelation->$Id_relation = $myMovie->Id;
						$newRelation->save();
					}
					$relationDB = $relation::model()->findByPk(array($Id_relation=>$myMovie->Id,'Id_person'=>$directorInDB->Id));
					if(!isset($relationDB))
					{
						$relationDB = new $relation;
						$relationDB->Id_person = $directorInDB->Id;
						$relationDB->$Id_relation =$myMovie->Id;
						$relationDB->save();
					}
				}
				$transaction->commit();
				$this->redirect(Yii::app()->homeUrl);
			} catch (Exception $e) {
				$transaction->rollback();
			}
		}else
		{
			$idResource = $_GET['idResource'];
			$sourceType = $_GET['sourceType'];

			if($sourceType == 1)
			{
				$modelNzb = Nzb::model()->findByPk($idResource);
				$myMovie = $modelNzb->myMovieDiscNzb->myMovieNzb;
			}
			else if($sourceType == 2)
			{
				$modelRippedMovie = RippedMovie::model()->findByPk($idResource);
				$myMovie = $modelRippedMovie->myMovieDisc->myMovie;
			}
			else
			{
				$localFolder = LocalFolder::model()->findByPk($idResource);
				$myMovie = $localFolder->myMovieDisc->myMovie;
			}
			$this->render('_formMyMovie',array('model'=>$myMovie,'idResource'=>$idResource,'sourceType'=>$sourceType));
		}
	}
	public function actionAjaxShearMovieTMDB()
	{
		if(isset($_POST['title']))
		{
			$title = $_POST['title'];
			$db = TMDBApi::getInstance();
			$db->adult = true;  // return adult content
			$db->paged = false; // merges all paged results into a single result automatically
			//$db->debug = true;
			if(isset($_POST['year'])&&$_POST['year']!="")
			{
				$results = $db->search('movie', array('query'=>$title,'year'=>$_POST['year']));				
			}
			else
			{
				$results = $db->search('movie', array('query'=>$title));				
			}
			$this->renderPartial('_searchMoviesResult',array('movies'=>$results));
		}
	}
	public function getPersons($idResource,$sourceType,$type)
	{
		if($sourceType == 1)
		{
			$modelNzb = Nzb::model()->findByPk($idResource);
			$myMovie = $modelNzb->myMovieDiscNzb->myMovieNzb;
		}
		else if($sourceType == 2)
		{
			$modelRippedMovie = RippedMovie::model()->findByPk($idResource);
			$myMovie = $modelRippedMovie->myMovieDisc->myMovie;
		}
		else
		{
			$localFolder = LocalFolder::model()->findByPk($idResource);
			$myMovie = $localFolder->myMovieDisc->myMovie;
		}
		return $myMovie->persons;
	}
	public function actionAjaxGetPersons()
	{
		$type = $_POST['type'];
		$persons = $this->getPersons($_POST['idResource'],$_POST['sourceType'],$type);
		$actor = array();
		$names = array();
		foreach ($persons as $person){
			if($person->type!=$type) continue;
			$actor['id']=$person->Id;
			$actor['text']=$person->name;
			$names[] =	$actor;
		}
		echo json_encode ($names);
	}
	public function actionAjaxGenres()
	{
		$type = $_POST['type'];
		$idResource = $_POST['idResource'];
		$sourceType = $_POST['sourceType'];
		if($sourceType == 1)
		{
			$modelNzb = Nzb::model()->findByPk($idResource);
			$myMovie = $modelNzb->myMovieDiscNzb->myMovieNzb;
		}
		else if($sourceType == 2)
		{
			$modelRippedMovie = RippedMovie::model()->findByPk($idResource);
			$myMovie = $modelRippedMovie->myMovieDisc->myMovie;
		}
		else
		{
			$localFolder = LocalFolder::model()->findByPk($idResource);
			$myMovie = $localFolder->myMovieDisc->myMovie;
		}
		echo json_encode (explode(',',$myMovie->genre));
	}
	public function actionAjaxAllGenres()
	{
		$genres = array();
		$movies = Movies::model()->findAll();		
		foreach($movies as $item)
		{
			$movieGenres = explode(', ',$item->genre);
			foreach($movieGenres as $value)
			{
				if(!empty($value) && ! in_array($value,$genres))
					$genres[] = trim($value);
			}
		}
		asort($genres);
		
		echo json_encode ($genres);
	}
	public function actionAjaxUnlinkMovie()
	{
		if(isset($_POST['idResource'])&&isset($_POST['sourceType']))
		{
			$idResource = $_POST['idResource'];
			$sourceType = $_POST['sourceType'];

			$myMovieDisc = "MyMovieDisc";
			$myMovieDiscField = "Id_my_movie_disc";
			$relation = "MyMoviePerson";
			$Id_relation = "Id_my_movie";
			$newClass = "MyMovie";
			$path ="";	
			$source = null;
			if($sourceType == 1)
			{
				$myMovieDiscField = "Id_my_movie_disc_nzb";
				$myMovieDisc = "MyMovieDiscNzb";
				$newClass = "MyMovieNzb";
				$source = $modelNzb = Nzb::model()->findByPk($idResource);
				$disc = $modelNzb->myMovieDiscNzb;
				$myMovie = $modelNzb->myMovieDiscNzb->myMovieNzb;
				$relation = "MyMovieNzbPerson";
				$Id_relation = "Id_my_movie_nzb";
				$modelNzb->myMovieDiscNzb;				
			}
			else if($sourceType == 2)
			{
				$source = $modelRippedMovie = RippedMovie::model()->findByPk($idResource);
				$disc = $modelRippedMovie->myMovieDisc;
				$myMovie = $modelRippedMovie->myMovieDisc->myMovie;
			}
			else
			{
				$source = $localFolder = LocalFolder::model()->findByPk($idResource);
				$disc = $localFolder->myMovieDisc;
				$myMovie = $localFolder->myMovieDisc->myMovie;
				$path = explode("/",$localFolder->path);
				$path = $path[count($path)-1];		
				$path = preg_replace("/\\.[^.\\s]{3,4}$/", "", $path);
			}
			if(!$myMovie->is_custom)
			{
				$newMyMovie = new $newClass;
				$myMovie->Id=uniqid ("cust_");
				$newMyMovie->attributes =$myMovie->attributes;
				$persons = $myMovie->persons;
				$myMovie = $newMyMovie;
			}
			$transaction = Yii::app()->db->beginTransaction();
			try {
				$myMovie->is_custom = 1;
				$myMovie->genre= "";
				$myMovie->poster="noImage.jpg";
				$myMovie->big_poster="noImage.jpg";
				$myMovie->backdrop="";
				$myMovie->bar_code="";
				$myMovie->country="";
				$myMovie->local_title=$path;
				$myMovie->original_title=$path;
				$myMovie->sort_title=$path;
				$myMovie->aspect_ratio="";
				$myMovie->video_standard="";
				$myMovie->production_year="";
				$myMovie->release_date="";
				$myMovie->running_time="";
				$myMovie->description="";
				$myMovie->extra_features="";
				$myMovie->parental_rating_desc="";
				$myMovie->imdb="";
				$myMovie->rating="0";
				$myMovie->data_changed="";
				$myMovie->covers_changed="";
				$myMovie->studio="";
				$myMovie->media_type="";				
				$myMovie->Id_parental_control=1;
				
				$myMovie->save();
				$tmdb=$source->TMDBData;
				$source->Id_TMDB_data = null;
				$source->is_personal = 1;
				$source->save();
				if(isset($tmdb))
				{
					$tmdb->delete();
				}
			
				$disc->$Id_relation = $myMovie->Id;
				$disc->save();
				$persons = $myMovie->persons;
				foreach ($persons as $person){
					$relation::model()->deleteByPk(array($Id_relation=>$myMovie->Id,'Id_person'=>$person->Id));
					if(empty($person->myMovieNzbs)&&empty($person->myMovies))					
						$person->delete();
				}
				$transaction->commit();
			} catch (Exception $e) {
				$transaction->rollback();
				var_dump($e);
			}				
		}		
	}
	public function actionEditMovie()
	{
		if(isset($_POST['id_my_movie']))
		{
			$idResource = $_POST['idResource'];
			$sourceType = $_POST['sourceType'];
			$idMyMovie = $_POST['id_my_movie'];
			$actors = explode(',',$_POST['input_actors']);
			$directors = explode(',',$_POST['input_directors']);
			$genres = explode(',',$_POST['input_genres']);
			$myMovieDisc = "MyMovieDisc";
			$myMovieDiscField = "Id_my_movie_disc";
			$relation = "MyMoviePerson";
			$Id_relation = "Id_my_movie";
			$newClass = "MyMovie";

			if($sourceType == 1)
			{
				$myMovieDiscField = "Id_my_movie_disc_nzb";
				$myMovieDisc = "MyMovieDiscNzb";
				$newClass = "MyMovieNzb";
				$modelNzb = Nzb::model()->findByPk($idResource);
				$disc = $modelNzb->myMovieDiscNzb;
				$myMovie = $modelNzb->myMovieDiscNzb->myMovieNzb;
				$relation = "MyMovieNzbPerson";
				$Id_relation = "Id_my_movie_nzb";
				$modelNzb->myMovieDiscNzb;
			}
			else if($sourceType == 2)
			{
				$modelRippedMovie = RippedMovie::model()->findByPk($idResource);
				$disc = $modelRippedMovie->myMovieDisc;
				$myMovie = $modelRippedMovie->myMovieDisc->myMovie;
			}
			else
			{
				$localFolder = LocalFolder::model()->findByPk($idResource);
				$disc = $localFolder->myMovieDisc;
				$myMovie = $localFolder->myMovieDisc->myMovie;
			}
			$myMovie = $newClass::model()->findByPk($idMyMovie);
			if(!$myMovie->is_custom)
			{
				$newMyMovie = new $newClass;
				$myMovie->Id=uniqid ("cust_");
				$newMyMovie->attributes =$myMovie->attributes;
				$persons = $myMovie->persons;
				$myMovie = $newMyMovie;
			}
			$transaction = Yii::app()->db->beginTransaction();
			try {
				$myMovie->is_custom = 1;
				$myMovie->attributes = $_POST[$newClass];
				$myMovie->genre= "";
				$first = true;
				foreach($genres as $genre)
				{
					$genreVal = trim($genre);
					if($first)
					{
						$first = false;
						$myMovie->genre = $genreVal;
					}
					else
					{
						$myMovie->genre = $myMovie->genre.", ".$genreVal;
					}
				}
				if($myMovie->Id_parental_control != 0)
					$myMovie->certification = $myMovie->parentalControl->description;
				else 
					$myMovie->Id_parental_control = 1;
					
				$myMovie->save();

				$disc->$Id_relation = $myMovie->Id;
				$disc->save();
				if(isset($persons))
				{
					foreach ($persons as $person){
						$relationDB = new $relation;
						$relationDB->Id_person = $person->Id;
						$relationDB->$Id_relation =$myMovie->Id;
						$relationDB->save();
					}
				}
				$persons = $myMovie->persons;
				foreach ($persons as $person){
					if($person->type!='Actor' && $person->type!='Director') continue;
					//$selectedActors[]=$person->Id;
					if(!in_array($person->Id,$actors)&&!in_array($person->Id,$directors))
					{
						$relation::model()->deleteByPk(array($Id_relation=>$myMovie->Id,'Id_person'=>$person->Id));
						$person->delete();
					}
				}
				foreach ($actors as $actor){
					if($actor=="") continue;
					$actorInDB = Person::model()->findByPk($actor);
					if(!isset($actorInDB))
					{
						$actorInDB = new Person();
						$actorInDB->name = $actor;
						$actorInDB->type = "Actor";
						$actorInDB->save();
						$newRelation = new $relation;
						$newRelation->Id_person = $actorInDB->Id;
						$newRelation->$Id_relation = $myMovie->Id;
						$newRelation->save();
					}
					$relationDB = $relation::model()->findByPk(array($Id_relation=>$myMovie->Id,'Id_person'=>$actorInDB->Id));
					if(!isset($relationDB))
					{
						$relationDB = new $relation;
						$relationDB->Id_person = $actorInDB->Id;
						$relationDB->$Id_relation =$myMovie->Id;
						$relationDB->save();
					}
				}
				foreach ($directors as $director){
					if($director=="") continue;
					$directorInDB = Person::model()->findByPk($director);
					if(!isset($directorInDB))
					{
						$directorInDB = new Person();
						$directorInDB->name = $director;
						$directorInDB->type = "Director";
						$directorInDB->save();
						$newRelation = new $relation;
						$newRelation->Id_person = $directorInDB->Id;
						$newRelation->$Id_relation = $myMovie->Id;
						$newRelation->save();
					}
					$relationDB = $relation::model()->findByPk(array($Id_relation=>$myMovie->Id,'Id_person'=>$directorInDB->Id));
					if(!isset($relationDB))
					{
						$relationDB = new $relation;
						$relationDB->Id_person = $directorInDB->Id;
						$relationDB->$Id_relation =$myMovie->Id;
						$relationDB->save();
					}
				}
				$transaction->commit();
				$this->redirect(Yii::app()->homeUrl);
			} catch (Exception $e) {
				$transaction->rollback();
			}
		}
		else {
			$this->showFilter = false;
			$idResource = $_GET['idResource'];
			$sourceType = $_GET['sourceType'];
			$modelResource = null;
			if($sourceType == 1)
			{
				$modelNzb = Nzb::model()->findByPk($idResource);
				$myMovie = $modelNzb->myMovieDiscNzb->myMovieNzb;
				$modelResource =$modelNzb;
			}
			else if($sourceType == 2)
			{
				$modelRippedMovie = RippedMovie::model()->findByPk($idResource);
				$myMovie = $modelRippedMovie->myMovieDisc->myMovie;
				$modelResource = $modelRippedMovie;
			}
			else
			{
				$localFolder = LocalFolder::model()->findByPk($idResource);
				$myMovie = $localFolder->myMovieDisc->myMovie;
				$modelResource = $localFolder;
			}
			
			$type= "Actor";
			$persons = $this->getPersons($_GET['idResource'],$_GET['sourceType'],$type);
			$actor = array();
			$names = array();
			foreach ($persons as $person){
				if($person->type!=$type) continue;
				$actor['id']=$person->Id;
				$actor['text']=$person->name;
				$names[]=$actor;
			}
			$actors = $names;

			$type= "Director";
			$persons = $this->getPersons($_GET['idResource'],$_GET['sourceType'],$type);
			$directors = array();
			$names = array();
			foreach ($persons as $person){
				if($person->type!=$type) continue;
				$director['id']=$person->Id;
				$director['text']=$person->name;
				$names[] =$director; 
			}
			$directors = $names;
			
			$genres = array();
			$movies = Movies::model()->findAll();
			foreach($movies as $item)
			{
				$movieGenres = explode(', ',$item->genre);
				foreach($movieGenres as $value)
				{
					if(!empty($value) && ! in_array($value,$genres))
						$genres[] = trim($value);
				}
			}
			asort($genres);
							
			$this->render('_formEditMovie',array('model'=>$myMovie,'modelResource'=>$modelResource,'idResource'=>$idResource,'sourceType'=>$sourceType,'actors'=>$actors,'directors'=>$directors,'genres'=>$genres));				
		}
	}
	public function actionAjaxSaveSelectedPoster()
	{
		if(isset($_POST['poster'])&&isset($_POST['idResource'])&&isset($_POST['sourceType'])&&isset($_POST['TMDB_id']))
		{
			$idResource = $_POST['idResource'];
			$sourceType = $_POST['sourceType'];
			$TMDBId =$_POST['TMDB_id'];
			if($sourceType == 1)
			{
				$modelNzb = Nzb::model()->findByPk($idResource);
				$myMovie = $modelNzb->myMovieDiscNzb->myMovieNzb;
			}
			else if($sourceType == 2)
			{
				$modelRippedMovie = RippedMovie::model()->findByPk($idResource);
				$myMovie = $modelRippedMovie->myMovieDisc->myMovie;
			}
			else
			{
				$localFolder = LocalFolder::model()->findByPk($idResource);
				$myMovie = $localFolder->myMovieDisc->myMovie;
			}			
			$poster = $_POST['poster'];
			$bigPoster = $_POST['poster'];
			$bigPoster = str_replace ( "w342" , "w500" , $bigPoster );
// 			$backdrop = isset($_POST['backdrop'])?$_POST['backdrop']:"";
// 			$backdrop = str_replace ( "w300" , "original" , $backdrop );


			$TMDBId .= $idResource ; //Hago esto por si hay repetidos
			
			$modelResource = TMDBHelper::downloadAndLinkImages($TMDBId,$idResource,$sourceType,$poster,$bigPoster,"");
			echo json_encode($modelResource->TMDBData->attributes);
		}
	}
	public function actionAjaxSaveSelectedBackdrop()
	{
		if(isset($_POST['backdrop'])&&isset($_POST['idResource'])&&isset($_POST['sourceType'])&&isset($_POST['TMDB_id']))
		{
			$idResource = $_POST['idResource'];
			$sourceType = $_POST['sourceType'];
			$TMDBId =$_POST['TMDB_id'];
			if($sourceType == 1)
			{
				$modelNzb = Nzb::model()->findByPk($idResource);
				$myMovie = $modelNzb->myMovieDiscNzb->myMovieNzb;
			}
			else if($sourceType == 2)
			{
				$modelRippedMovie = RippedMovie::model()->findByPk($idResource);
				$myMovie = $modelRippedMovie->myMovieDisc->myMovie;
			}
			else
			{
				$localFolder = LocalFolder::model()->findByPk($idResource);
				$myMovie = $localFolder->myMovieDisc->myMovie;
			}
			$backdrop = isset($_POST['backdrop'])?$_POST['backdrop']:"";
			$backdrop = str_replace ( "w300" , "original" , $backdrop );
			$modelResource = TMDBHelper::downloadAndLinkImages($TMDBId,$idResource,$sourceType,"","",$backdrop);
			echo json_encode($modelResource->TMDBData->attributes);
		}
	}
	
	public function actionAjaxFillMoviePosterSelector()
	{
		$idResource = $_POST['idResource'];
		$sourceType = $_POST['sourceType'];
		$idMyMovie = $_POST['id'];
		if($sourceType == 1)
		{
			$modelSource = Nzb::model()->findByPk($idResource);
			$myMovie = $modelSource->myMovieDiscNzb->myMovieNzb;
		}
		else if($sourceType == 2)
		{
			$modelSource = RippedMovie::model()->findByPk($idResource);
			$myMovie = $modelSource->myMovieDisc->myMovie;
		}
		else
		{
			$modelSource = LocalFolder::model()->findByPk($idResource);
			$myMovie = $modelSource->myMovieDisc->myMovie;
		}
		$images=array();
		if(!$modelSource->is_personal)
		{
			$db = TMDBApi::getInstance();
			$db->adult = true;  // return adult content
			$db->paged = false; // merges all paged results into a single result automatically
			
			$results = $db->search('movie', array('query'=>$myMovie->original_title, 'year'=>$myMovie->production_year));
			$movie = reset($results);
			if(isset($movie)&&$movie!==false){
				$images = $movie->posters('342',"");
			}
			else
			{
				$tmdb = $modelSource->TMDBData;
				$movie = new stdClass;
				if(isset($tmdb))
				{
					$movie->id = $tmdb->TMDB_id;
				}
				else
				{
					$movie->id=date('U');
					$tmdb = new TMDBData();
					$tmdb->TMDB_id = $movie->id;
					$tmdb->save();
					$modelSource->Id_TMDB_data =$tmdb->Id;
					$modelSource->save();
				}
			}				
		}else
		{
			$tmdb = $modelSource->TMDBData;
			$movie = new stdClass;
			if(isset($tmdb))
			{
				$movie->id = $tmdb->TMDB_id;
			}
			else
			{
				$movie->id=date('U');
				$tmdb = new TMDBData();
				$tmdb->TMDB_id = $movie->id;
				$tmdb->save();
				$modelSource->Id_TMDB_data =$tmdb->Id;
				$modelSource->save();
			}
				
		}
		$this->renderPartial('_moviePosterSelector',array('model'=>$myMovie,'idResource'=>$idResource,'sourceType'=>$sourceType,'posters'=>$images,'movie'=>$movie,"is_personal"=>$modelSource->is_personal));		
	}
	public function actionAjaxFillMovieBackdropSelector()
	{
		$idResource = $_POST['idResource'];
		$sourceType = $_POST['sourceType'];
		$idMyMovie = $_POST['id'];
		if($sourceType == 1)
		{
			$modelSource = Nzb::model()->findByPk($idResource);
			$myMovie = $modelSource->myMovieDiscNzb->myMovieNzb;
		}
		else if($sourceType == 2)
		{
			$modelSource = RippedMovie::model()->findByPk($idResource);
			$myMovie = $modelSource->myMovieDisc->myMovie;
		}
		else
		{
			$modelSource = LocalFolder::model()->findByPk($idResource);
			$myMovie = $modelSource->myMovieDisc->myMovie;
		}
		$images=array();
		if(!$modelSource->is_personal)
		{
			$db = TMDBApi::getInstance();
			$db->adult = true;  // return adult content
			$db->paged = false; // merges all paged results into a single result automatically
	
			$results = $db->search('movie', array('query'=>$myMovie->original_title, 'year'=>$myMovie->production_year));
			$movie = reset($results);
			if(isset($movie)&&$movie!==false){
				$images = $movie->backdrops('300',"");
			}
			else
			{
				$tmdb = $modelSource->TMDBData;
				$movie = new stdClass;
				if(isset($tmdb))
				{
					$movie->id = $tmdb->TMDB_id;				
				}
				else 
				{
					$movie->id=date('U');
					$tmdb = new TMDBData(); 
					$tmdb->TMDB_id = $movie->id;
					$tmdb->save();
					$modelSource->Id_TMDB_data =$tmdb->Id;
					$modelSource->save();
				}
			}
		}
		else
		{
			$tmdb = $modelSource->TMDBData;
			$movie = new stdClass;
			if(isset($tmdb))
			{
				$movie->id = $tmdb->TMDB_id;
			}
			else
			{
				$movie->id=date('U');
				$tmdb = new TMDBData();
				$tmdb->TMDB_id = $movie->id;
				$tmdb->save();
				$modelSource->Id_TMDB_data =$tmdb->Id;
				$modelSource->save();
			}
		
		}
		
		$this->renderPartial('_movieBackdropSelector',array('model'=>$myMovie,'idResource'=>$idResource,'sourceType'=>$sourceType,'backdrops'=>$images,'movie'=>$movie,"is_personal"=>$modelSource->is_personal));		
	}
	public function actionAjaxUploadImage()
	{
		$urls = array();

		if (isset($_POST['liteUploader_id']) && $_POST['liteUploader_id'] == 'fileUpload1')
		{
			foreach ($_FILES['fileUpload1']['error'] as $key => $error)
			{
			    if ($error == UPLOAD_ERR_OK)
				{
					$uploadedUrl = 'images/' . $_FILES['fileUpload1']['name'][$key];
					if(isset($_POST['id_tmdbdata']))
					{
						$extension = explode(".",$_FILES['fileUpload1']['name'][$key]);
						if(count($extension)>1){
							$uploadedUrl = 'images/' . $_POST['id_tmdbdata']."_temp.".$extension[1];
						}						
					}
					
			        move_uploaded_file( $_FILES['fileUpload1']['tmp_name'][$key], $uploadedUrl);
			        $urls[] = $uploadedUrl;
			    }
			}
		
			$message = 'Successfully Uploaded File(s) From First Upload Input';
		}
		$originalUrls = array();
		if(isset($_POST['urls']))
		{
			if(!empty($_POST['urls']))
				$originalUrls = explode(',',$_POST['urls']);
		}
		echo json_encode(
			array(
				'message' => $message,
				'urls' => array_merge($urls,$originalUrls)
			)
		);
	}
	
	public function actionAjaxChangeTheme()
	{
		$idTheme = (isset($_POST['idTheme']))?$_POST['idTheme']:null;
		if(isset($idTheme))
		{
			$currentUser = User::getCurrentUser();
			$currentUser->Id_theme = $idTheme;
			$currentUser->save();
		}
	}
	
	public function actionAjaxInitializeOppo()
	{
		$players = Player::model()->findAllByAttributes(array('type'=>1));
		foreach($players as $player){
			echo "<div>";
			echo "inicializando:".$player->description;
			echo "</div>";
			OppoHelper::isPlayerAlive($player);
			$setting = Setting::getInstance();
			$sharedPath=explode('/', trim($setting->host_file_server_path, '/'));
			
			$completePath="";
			//si no pude darle play de una hago los tres pasos (login - montar - play)
			//login to samba server
			$params= array();
			$params['serverName'] = $setting->host_file_server_name;
			$params['userName'] = $setting->host_file_server_user;
			$params['psssword'] = $setting->host_file_server_passwd;
			$params['bRememberID'] = 1;
			$retry = 0;
			do
			{
				$url = $player->url .":436/loginSambaWithID?".json_encode($params);
				$url = str_replace('&', '%26', $url);
				$url = str_replace(' ', '%20', $url);
				$response = @file_get_contents($url);
				$retry++;
				$response = json_decode($response);
				if(isset($response)&&$response->success==false)
					sleep ( 1 );			
			}while(isset($response)&&$response->success==false&&$retry<10);
			if(!isset($response)||!is_object($response)||$response->success!=true)
			{
				return false;
			}
			//sleep ( 2 );
			
			//mounting samba path
			$params= array();
			
			$params['folder'] = $sharedPath[0];
			
			$params['userName'] = $setting->host_file_server_user;
			$params['server'] = $setting->host_file_server_name;
	
			$params['bRememberID'] = 1;
			$params['bWithID'] = 1;
			$params['password'] = $setting->host_file_server_passwd;
			$url = $player->url .":436/mountSharedFolder?".json_encode($params);
			$retry = 0;
			do
			{
				$url = str_replace('&', '%26', $url);
				$url = str_replace(' ', '%20', $url);
				$response = @file_get_contents($url);
				$response = json_decode($response);
				$retry++;
				if(isset($response)&&$response->success==false)
				sleep ( 1 );			
			}while(isset($response)&&$response->success==false&&$retry<10);
			
			if(!isset($response)||!is_object($response)||$response->success!=true)
			{
				return false;
			}				
		}
	}
	
}