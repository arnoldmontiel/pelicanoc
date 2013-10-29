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
	
		$this->render('downloads',array(
									'dataProvider'=>$dataProvider,
									'sABnzbdStatus'=>$sABnzbdStatus,
									'modelMyMovie'=>$modelMyMovie,
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
	
	public function actionAjaxGetExternalStorage()
	{
		$modelCurrentESs = CurrentExternalStorage::model()->findAllByAttributes(array('is_in'=>1));
		$this->renderPartial('_externalStorageAccess',array('modelCurrentESs'=>$modelCurrentESs));
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
	
	public function actionAjaxProcessExternalStorage()
	{		
		$idCurrentES = (isset($_POST['id']))?$_POST['id']:null;
		if(isset($idCurrentES))
			ReadFolderHelper::processExternalStorage($idCurrentES);
	}
	
	public function actionAjaxExternalStorageExplore()
	{
		$idCurrentES = (isset($_POST['id']))?$_POST['id']:null;
		if(isset($idCurrentES))
			ReadFolderHelper::scanExternalStorage($idCurrentES);
	}
	
	public function actionAjaxMarkCurrentESRead()
	{		
		$modelCurrentES = CurrentExternalStorage::model()->findByAttributes(array('is_in'=>1));
		
		if(isset($modelCurrentES))
		{
			$modelCurrentES->read = 1;
			$modelCurrentES->save();
		}
		
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
				if(PelicanoHelper::eraseResource($modelResource->path))
					$modelResource->delete();
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
		$this->layout='//layouts/column3';
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
			$backdrop = $TMDBData->backdrop;				
			$poster = $TMDBData->big_poster;				
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
		$this->layout='//layouts/column3';
		
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
			$backdrop = $TMDBData->backdrop;				
			$poster = $TMDBData->big_poster;				
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
		$modelCurrentUSB = CurrentExternalStorage::model()->find($criteria);
		
		$isDiscIN = 0;
		$read = 0;
		$state = 1;
		if(isset($modelCurrentUSB))
		{
			$isDiscIN = 1;
			$read = $modelCurrentUSB->read;
			$state = $modelCurrentUSB->state;
		}
		
		$currentUSB = array('is_in'=>$isDiscIN,'read'=>$read, 'state'=>$state);
		
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
			$movie = reset($results);
			$images = $movie->posters('154');
			$bds = $movie->backdrops('300',"");
			if(!isset($model))
			{
				$model = new TMDBData();
				$model->TMDB_id =$movie->id;
			}
			$this->render('_tmdb',array('idResource'=>$idResource,'sourceType'=>$sourceType, 'model'=>$model,'myMovie'=>$myMovie,'movie'=>$movie,'images'=>$images,'bds'=>$bds));
				
		}
	}
	
}