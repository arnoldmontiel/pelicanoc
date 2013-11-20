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

	public function actionIndexSerie()
	{

		$modelSeries = new Series();
		$dataProvider= $modelSeries->search();
		$dataProvider->pagination->pageSize= 14;

		$this->render('indexSerie',array(
				'dataProvider'=>$dataProvider,
		));

	}

	public function actionMarketplace()
	{
		$this->layout='//layouts/column4';
		$this->showFilter = false;
		$modelNzb = new Nzb();
		$dataProvider = $modelNzb->searchMarketplace();


		$this->render('marketplace',array(
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
		
		$movies = Movies::model()->findAll($criteriaMovies);

		$criteriaExternal=new CDbCriteria;
		$criteriaExternal->addCondition('(status = 2 OR status = 7)');
		$criteriaExternal->addCondition('copy = 1');
		//$criteriaExternal->limit=30;
		//$criteriaExternal->order="read_date DESC";
		
		$externalStorageDataCopying = ExternalStorageData::model()->findAll($criteriaExternal);
		
		$criteriaNzb=new CDbCriteria;
		$criteriaNzb->addCondition('Id_nzb_state = 2');
		$criteriaNzb->addCondition('downloading = 1');
		//$criteriaExternal->limit=30;
		//$criteriaExternal->order="read_date DESC";
		
		$nzbDownloading = Nzb::model()->findAll($criteriaNzb);
				
		$this->render('downloads',array(
				'dataProvider'=>$dataProvider,
				'sABnzbdStatus'=>$sABnzbdStatus,
				'modelMyMovie'=>$modelMyMovie,
				'movies'=>$movies,
				'externalStorageDataCopying'=>$externalStorageDataCopying,
				'nzbDownloading'=>$nzbDownloading
		));
	}

	public function actionAjaxRefreshSabNzbStatus()
	{
		$sABnzbdStatus= new SABnzbdStatus();
		$sABnzbdStatus->getStatus();
		echo CJSON::encode($sABnzbdStatus->jobs);
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
		$id = $_POST['id'];
		$idNzb = $_POST['idNzb'];

		$modelNzb = Nzb::model()->findByPk($idNzb);

		$criteria=new CDbCriteria;

		$model = MyMovieNzb::model()->findByPk($id);
		$criteria->join = 'INNER JOIN my_movie_nzb_person p on (p.Id_person = t.Id)';
		$criteria->addCondition('p.Id_my_movie_nzb = "'.$id.'"');
		$criteria->order = 't.Id ASC';

		$casting = $this->getCasting($criteria);

		$this->renderPartial('_marketDetails',array('model'=>$model, 'casting'=>$casting, 'modelNzb'=>$modelNzb));
	}

	public function actionAjaxStartDownload()
	{
		if(isset($_POST['Id_nzb']))
		{
			PelicanoHelper::startDownload($_POST['Id_nzb']);
		}
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
					$modelESData->status = 5; //cancel copy
				else
				{
					if(isset($modelESData->localFolder))
					{
						LocalFolder::model()->deleteByPk($modelESData->Id_local_folder);
						$modelESData->Id_local_folder = null;
					}
				}
				
				$modelESData->copy = 0;
				if($modelESData->save())
				{
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
		$modelFinishCopyESDataArray = array();
		if(isset($idCurrentES))
		{
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
		if(isset($idCurrentES))
		{
			$modelCurrentES = CurrentExternalStorage::model()->findByPk($idCurrentES);
			if(isset($modelCurrentES))
			{
				$label = $modelCurrentES->label;
				$modelESDatas = ExternalStorageData::model()->findAllByAttributes(array('Id_current_external_storage'=>$idCurrentES,'is_personal'=>0));
				$modelESDataPersonals = ExternalStorageData::model()->findAllByAttributes(array('Id_current_external_storage'=>$idCurrentES,'is_personal'=>1));
				if($modelCurrentES->hard_scan_ready == 0)
					ReadFolderHelper::generatePeliFilesES($idCurrentES);
			}
		}
		$this->renderPartial('_devicesStep2',array('modelESDatas'=>$modelESDatas,
													'modelESDataPersonals'=>$modelESDataPersonals,
													'label'=>$label));
	}

	public function actionAjaxExploreExternalStorage()
	{
		$idCurrentES = (isset($_POST['id']))?$_POST['id']:null;
		$name = "USB";
		if(isset($idCurrentES))
		{
			$modelCurrentES = CurrentExternalStorage::model()->findByPk($idCurrentES);
			if(isset($modelCurrentES))
			{
				if($modelCurrentES->soft_scan_ready == 0)
					ReadFolderHelper::scanExternalStorage($idCurrentES);
				
				$name = $modelCurrentES->label; 
			}
		}

		echo "<h2>".$name." <i class='fa fa-spinner fa-spin'></i> Analizando...</h2>";
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
				if(PelicanoHelper::eraseResource($modelResource->path))
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
		if(isset($_POST['path']))
		{
			ReadFolderHelper::scanDirectory($_POST['path']);
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
		$model = new LocalFolder('search');
		$model->unsetAttributes();  // clear any default values

		if(isset($_GET['LocalFolder']))
			$model->attributes=$_GET['LocalFolder'];

		$this->render('adminLocalFolder',array(
				'model'=>$model,
		));
	}

	public function actionStart($id, $sourceType, $idResource)
	{
		$this->showFilter = false;

		$play = false;
		$idResourceCurrentPlay = 0;
		switch ($sourceType) {
			case 1:
				$nzbModel = Nzb::model()->findByPk($idResource);
				$TMDBData =$nzbModel->TMDBData;
				$idResourceCurrentPlay = $idResource;
				$folderPath = explode('.',$nzbModel->file_name);
				DuneHelper::playDune($id,'/'.$folderPath[0].'/'.$nzbModel->path);

				$model = MyMovieNzb::model()->findByPk($id);
				break;
			case 2:
				$nzbRippedMovie = RippedMovie::model()->findByPk($idResource);
				$TMDBData =$nzbRippedMovie->TMDBData;
				$idResourceCurrentPlay = $idResource;
				DuneHelper::playDune($id,'/'.'/'.$nzbRippedMovie->path);
				$model = MyMovie::model()->findByPk($id);
				break;
			case 3:
				$localFolder = LocalFolder::model()->findByPk($idResource);
				$TMDBData =$localFolder->TMDBData;
				$idResourceCurrentPlay = $idResource;
				$folderPath = explode('.',$localFolder->path);
				DuneHelper::playDune($id,'/'.'/'.$localFolder->path);

				$model = MyMovie::model()->findByPk($id);
				break;
			case 4:
				$idCurrentDisc = self::markCurrentDiscRead();
				$idResourceCurrentPlay = $idCurrentDisc;
				DuneHelper::playDuneOnline($id);
					
				$model = MyMovie::model()->findByPk($id);
				break;
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
		self::saveCurrentPlay($idResourceCurrentPlay, $sourceType);

		$this->render('control',array(
				'model'=>$model,
				'backdrop'=>$backdrop,
				'big_poster'=>$poster,
				'idResource'=>$idResource,
				'sourceType'=>$sourceType,
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

	public function actionAjaxGetProgressBar()
	{
		echo json_encode(DuneHelper::getProgressBar());
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

	public function actionOpenDuneControl($id, $type,$id_resource)
	{
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
		
		$this->render('control',array(
				'model'=>$model,
				'big_poster'=>$poster,
				'backdrop'=>$backdrop,
				'idResource'=>$id,
				'sourceType'=>$type,
		));
	}

	public function actionAjaxUseRemote()
	{
		DuneHelper::useRemote($_GET['ir_code']);
	}

	public function actionAjaxStop()
	{
		DuneHelper::setBlackScreen();
	}

	public function actionAjaxGetPlayback()
	{
		$response = $this->getPlayback();

		echo json_encode($response);
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

		$response = array('playBack'=>$this->getPlayback(),
				'currentDisc'=>$currentDisc,
				'currentUSB'=>$currentUSB);

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
		// display the login form
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
				$myMovie = $localFolder->myMovieDiscNzb->myMovieNzb;
			}
			else if($sourceType == 2)
			{
				$modelRippedMovie = RippedMovie::model()->findByPk($idResource);
				$model = $modelRippedMovie->TMDBData;
				$myMovie = $localFolder->myMovieDisc->myMovie;
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
		
				var_dump(TMDBHelper::downloadAndLinkImages($movie->id,$idResource,$sourceType,$poster,$bigPoster,$backdrop));
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
				$myMovie->is_custom = true;
				$genres = $movie->genres;
				$myMovie->genre="";
				$first = true;
				foreach($genres as $genre)
				{
					if($first)
					{
						$first = false;
						$myMovie->genre = $genre->name;
					}
					else
					{
						$myMovie->genre = $myMovie->genre.", ".$genre->name;
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
				$myMovie->is_custom = true;
				$genres = $movie->genres;
				$myMovie->genre="";
				$first = true;
				foreach($genres as $genre)
				{
					if($first)
					{
						$first = false;
						$myMovie->genre = $genre->name;
					}
					else
					{
						$myMovie->genre = $myMovie->genre.", ".$genre->name;
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

			if($sourceType == 1)
			{
				$modelNzb = Nzb::model()->findByPk($idResource);
				$myMovie = $localFolder->myMovieDiscNzb->myMovieNzb;
			}
			else if($sourceType == 2)
			{
				$modelRippedMovie = RippedMovie::model()->findByPk($idResource);
				$myMovie = $localFolder->myMovieDisc->myMovie;
			}
			else
			{
				$localFolder = LocalFolder::model()->findByPk($idResource);
				$myMovie = $localFolder->myMovieDisc->myMovie;
			}
			$path = explode("/",$localFolder->path);
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
				$myMovie = $localFolder->myMovieDiscNzb->myMovieNzb;
			}
			else if($sourceType == 2)
			{
				$modelRippedMovie = RippedMovie::model()->findByPk($idResource);
				$myMovie = $localFolder->myMovieDisc->myMovie;
			}
			else
			{
				$localFolder = LocalFolder::model()->findByPk($idResource);
				$myMovie = $localFolder->myMovieDisc->myMovie;
			}
			$db = TMDBApi::getInstance();
			$db->adult = true;  // return adult content
			$db->paged = false; // merges all paged results into a single result automatically
			$results = $db->search('movie', array('query'=>$myMovie->original_title));
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
				$disc = $localFolder->myMovieDiscNzb;
				$myMovie = $localFolder->myMovieDiscNzb->myMovieNzb;
				$relation = "MyMovieNzbPerson";
				$Id_relation = "Id_my_movie_nzb";
				$modelNzb->myMovieDiscNzb;
			}
			else if($sourceType == 2)
			{
				$modelRippedMovie = RippedMovie::model()->findByPk($idResource);
				$disc = $localFolder->myMovieDisc;
				$myMovie = $localFolder->myMovieDisc->myMovie;
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
				$myMovie->is_custom = true;
				$myMovie->attributes = $_POST[$newClass];
				$myMovie->genre= "";
				$first = true;
				foreach($genres as $genre)
				{
					if($first)
					{
						$first = false;
						$myMovie->genre = $genre;
					}
					else
					{
						$myMovie->genre = $myMovie->genre.", ".$genre;
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
				$myMovie = $localFolder->myMovieDiscNzb->myMovieNzb;
			}
			else if($sourceType == 2)
			{
				$modelRippedMovie = RippedMovie::model()->findByPk($idResource);
				$myMovie = $localFolder->myMovieDisc->myMovie;
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
			$myMovie = $localFolder->myMovieDiscNzb->myMovieNzb;
		}
		else if($sourceType == 2)
		{
			$modelRippedMovie = RippedMovie::model()->findByPk($idResource);
			$myMovie = $localFolder->myMovieDisc->myMovie;
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
			$myMovie = $localFolder->myMovieDiscNzb->myMovieNzb;
		}
		else if($sourceType == 2)
		{
			$modelRippedMovie = RippedMovie::model()->findByPk($idResource);
			$myMovie = $localFolder->myMovieDisc->myMovie;
		}
		else
		{
			$localFolder = LocalFolder::model()->findByPk($idResource);
			$myMovie = $localFolder->myMovieDisc->myMovie;
		}
		echo json_encode (explode(',',$myMovie->genre));
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
				$myMovie->is_custom = true;
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
				$myMovie->is_custom = true;
				$myMovie->attributes = $_POST[$newClass];
				$myMovie->genre= "";
				$first = true;
				foreach($genres as $genre)
				{
					if($first)
					{
						$first = false;
						$myMovie->genre = $genre;
					}
					else
					{
						$myMovie->genre = $myMovie->genre.", ".$genre;
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
		}
		else {
			$this->showFilter = false;
			$idResource = $_GET['idResource'];
			$sourceType = $_GET['sourceType'];
			$modelResource = null;
			if($sourceType == 1)
			{
				$modelNzb = Nzb::model()->findByPk($idResource);
				$myMovie = $localFolder->myMovieDiscNzb->myMovieNzb;
				$modelResource =$modelNzb;
			}
			else if($sourceType == 2)
			{
				$modelRippedMovie = RippedMovie::model()->findByPk($idResource);
				$myMovie = $localFolder->myMovieDisc->myMovie;
				$modelResource = $modelRippedMovie;
			}
			else
			{
				$localFolder = LocalFolder::model()->findByPk($idResource);
				$myMovie = $localFolder->myMovieDisc->myMovie;
				$modelResource = $localFolder;
			}
			
			$this->render('_formEditMovie',array('model'=>$myMovie,'modelResource'=>$modelResource,'idResource'=>$idResource,'sourceType'=>$sourceType));				
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
				$myMovie = $localFolder->myMovieDiscNzb->myMovieNzb;
			}
			else if($sourceType == 2)
			{
				$modelRippedMovie = RippedMovie::model()->findByPk($idResource);
				$myMovie = $localFolder->myMovieDisc->myMovie;
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
				$myMovie = $localFolder->myMovieDiscNzb->myMovieNzb;
			}
			else if($sourceType == 2)
			{
				$modelRippedMovie = RippedMovie::model()->findByPk($idResource);
				$myMovie = $localFolder->myMovieDisc->myMovie;
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
	
}