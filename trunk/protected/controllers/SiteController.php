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
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
//		RipperHelper::saveRipped("bcf5cb96-73bc-4ed8-b35b-66aac2d8d693", "eco", false, "A15054953715937293C776B62CF67944164D48AC");

//  		RippedMovie::sincronizeWithServer();
		

//          	$ws = new wsPelicanoC(); 
//  		$ws->addNewRipMovie("668d6579-918c-4fd5-8db7-5e02d826dbcf","Ted",true,'BABEE29B52937ED4E71053FEDAD8BDF16F2DDBDE');
//  		RipperHelper::saveRipped("c12821c2-cc44-49b7-8580-9ecdb59d98a4","x men origins",true,'94205BB520E5DDC75D132D55150379A4847F0343');
// 		RipperHelper::saveRipped("26f629b2-f529-4a87-83d4-c4399e057a77","big fish",true,'2745F7455949CF34D7F69A3E1ABAFA6807E463FB');
// 		RipperHelper::saveRipped("67df0d13-366a-4e65-b6c7-00b0fcb21b8b","linterna",true,'A7978420E2804D3AAF0592313912956E82489334');
// 		RipperHelper::saveRipped("cc2d91ad-0b71-4474-8755-e585a60258ed","kill bill 1",true,'199E02CA16354FCAA3420D98BCD5AE19068B706F');
// 		RipperHelper::saveRipped("fa5840a0-002f-409a-8d36-62edfef678d3","Tintin",true,'5602938E66374F33C07DF5AF264C032251FF8F37');
// 		RipperHelper::saveRipped("3039bfb9-2c81-40ee-a018-3c199f90004c","Breaking bad",true,'98D67873-3A35C6B6');
// 		RipperHelper::saveRipped("a84ae2a9-8b79-4738-acbf-26d3a1750290","Fringe s01",true,'F6B8AB2B897D73D6C2DD94D1D966F22A6E7D3100');
// 		RipperHelper::saveRipped("a807d4d6-9692-4360-95b0-1a31a5d7f33c","Dexter",true,'F5E4051B-A62BF35B');
// 		RipperHelper::saveRipped("a89f3f1e-a7fa-47f6-8406-7f30596a8d9a","Friends",true,'2CF2E61B-704F085E');
//		RipperHelper::saveRipped("a5824f98-a0c2-45b1-842e-c9dc30b066d9","Terminator 3",true,'739808EDDEF910C5EF9E6B999C3D75272698CB30');
		
		
// 		$ws->addNewRipMovie("2a896712-f2ce-4a9c-945e-3aeee118d828","scary movie 4",true,'3FAF030E0DB6E6FDE7047B2AF443A425BBD76A0E');
// 		$ws->addNewRipMovie("92e81461-123a-4e43-bdef-33c7687d5bf9","batman rises",true,'37617E6C0AFC6F4371714EAC977D186D2A2F1A50');
//         $ws->addNewRipMovie("1e758317-8feb-42d2-8492-212e14b9a25c","project x",true,'889AF08E0099DC5EF056FF55B79752B284B5F60B');
        	//$ws->addNewRipMovie("e14844cb-9453-4ca0-9c12-5cd95cfbb9cc","true blood 2 season",true,'2CAF1E15-48078ADB');
        	//$ws->addNewRipMovie("550d5a99-caf0-4de7-ad58-d2b219478314","touch 1 season",true,'C9D65BA9-4AEC2F54');
        //$ws->addNewRipMovie("7777c6b8-fdcb-4f49-aaee-48006229271d","the dictator",true,'E9E728D1E77D3B5D9364B34BD5D2C0A1DF7F1032');
       
//       	$ws->addNewRipMovie("6084a222-2a43-4e48-a9e4-4abfbafeeb2c","indiana jones 4",true,'F4C82A4F22503B905D93E76521261B858BB0BD2B');
// 		$ws->addNewRipMovie("a143e736-c0cb-426e-ba5e-940d56634a1b","hunger",true,'448DEED29CFAB9622A4CF90711A43B9419BA12C1');
// 		$ws->addNewRipMovie("cb90201b-f34f-40f3-a1cc-28488a2a7599","snow",true,'C2E16B1CCB76E632EB0D4DEF44AD70CB717CA2A3');
//     	$ws->addNewRipMovie("382c2341-a914-4930-aad8-605fad583793","anillos",true,'99B17222-92409575');
//		$ws->addNewRipMovie("e84c661c-dd1a-4c28-8c4d-9c83b10d0664","Heroes s3",true,'36E04635-B84DE634');
// 		$ws->addNewRipMovie("41adcb14-c581-44c5-8429-cd44a9eb78a7","Heroes s2",true,'DD936CFF-9303A304');
//  	$ws->addNewRipMovie("523911b2-3c80-450f-b15b-fbc99b0b7bce","Futurama s6",true,'A0609FA5ECFFA01C5ADA1B445665DB85FB2D0CA3');
// 		$ws->addNewRipMovie("fd433ff8-7731-49a1-a6d9-572e129a5e43","Monster Inc.",true,'90FA27F52ACBB66F914700BDD802352971F41537');
// 		$ws->addNewRipMovie("5061b144-60f2-4ff0-9b66-22b7d316ea09","Mi villano favorito",true,'C9AB2C39148D0BAB6DC127F4DEBFFBF1A3E2F162');
		

		//ver
// 		$ws->addNewRipMovie("6d95e59f-386d-48a2-8b8f-ce65e3bdb1fb","Juego de tronos s1",true,'83858383F1BE439F7903DB29568AE05C86B68BA8');

// 		$ws->addNewRipMovie("26c98c9e-6fa5-4550-9537-c436643174ee","Simuladores s1",true,'D20D3E4D-480F27E2');
//   	$ws->addNewRipMovie("af39fbab-1b0c-4519-856e-09c2dff7198d","el cadaver de la novia",true);
//     	$ws->addNewRipMovie("8377d7ee-1f68-43ea-a740-001eb6cbed72","ice age 3",false);
//     	$ws->addNewRipMovie("cb902e53-9b4f-4e2c-8187-910c817ac336","advengers",false);
//  	$ws->addNewRipMovie("f38c7448-07fe-467d-a1c8-00393cd54b1f","kung fu",false,"6CC43A8D50967020E90379B6A5F9BF2A5686D5C9");
//   	$ws->addNewRipMovie("67df0d13-366a-4e65-b6c7-00b0fcb21b8b","linterna",true);
// 		$ws->addNewRipMovie("bcf5cb96-73bc-4ed8-b35b-66aac2d8d693","invencible",true);
// 		$ws->addNewRipMovie("96d0a3ca-0f91-403e-be30-68e06f3dce22","el gran truco",false);
// 		$ws->addNewRipMovie("ddced0ce-2be8-4c30-ac42-13857f5899c5","el regreso del jedi",true);
// 		$ws->addNewRipMovie("cc2d91ad-0b71-4474-8755-e585a60258ed","kill bill 1",true);
// 		$ws->addNewRipMovie("edce9e7c-2012-4858-87f5-0ff79dc464bb","The bourn ultimatun",true);
//      $ws->addNewRipMovie("924b84f3-9e31-49bb-a285-0cb8b19c68c6","Harry Potter",false);
//      $ws->addNewRipMovie("f1f1a24c-cbb4-49c7-8b56-03260add9cc1","Gran Pez",false);
//  		$ws->addNewRipMovie("47454617-24ee-4e1b-b2c7-03f909adc1a1","Inception",false);
//      $ws->addNewRipMovie("a2d49a38-6c90-45ef-bf7e-d6c0b2efe7a6","Batman XXX",true);
//      $ws->addNewRipMovie("096f0252-90f0-4e5b-b37d-0abdc907084e","Piratas XXX",true);

//   		Customer::createCustomer('Pepe', 'Pompin', 'Almafuerte 2361');
		
// 		Log::saveLog("segunda prueba", 2);
// 		Log::sendLog();
		
//   		$hola = new MyMoviesAPI();
//  		$hola->LoadDiscTitleById("96d0a3ca-0f91-403e-be30-68e06f3dce22");
// 		$hola = $mymo->LoadDiscTitleById("af39fbab-1b0c-4519-856e-09c2dff7198d");
// 		$hola = $mymo->LoadDiscTitleById("bcf5cb96-73bc-4ed8-b35b-66aac2d8d693");
// 	$hola->LoadDiscTitleById("a2d49a38-6c90-45ef-bf7e-d6c0b2efe7a6");
	
// 		$caca = new RippedMovie();
// 		$caca->sincronizeWithServer();

//    		$hola = new User();
//    		$hola->sincronizeFromServer();
//		PelicanoHelper::sendExternalIPAddressToServer();

//  		$wsSettings = new wsSettings();
//  		$response = $wsSettings->getCustomerSettings('509bef0c664de');
 		
// 		$wsSettings->ackCustomerSettings('509bef0c664de');
		
// 		PelicanoHelper::getCustomerSettings();
	
// 		PelicanoHelper::sendPendingNzbStates();
//  		PelicanoHelper::updateNzbDataFromServer();
	
		//RipperHelper::saveCurrentDiscData('28a35e6b-11fe83f9');
		
		$modelMovies = new Movies();
		$dataProvider= $modelMovies->search();
		$dataProvider->pagination->pageSize= 100;
		
//		$dataProviderSeries= $modelNzb->searchSeriesOrdered();
//		$dataProviderSeries->pagination->pageSize= 4;
		$this->render('index',array(
					'dataProvider'=>$dataProvider,
//					'dataProviderSeries'=>$dataProviderSeries,
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
	
	public function actionAjaxMovieShowDetail()
	{
		$id_resource = $_POST['idresource'];
		$id = $_POST['id'];
		$sourceType = $_POST['sourcetype'];
		
		$criteria=new CDbCriteria;
		
		$modelNzb = null;
		$modelRippedMovie = null;
		$localFolder = null;
		$modelCurrentDisc = null;
		
		if($sourceType == 1)
		{
			$modelNzb = Nzb::model()->findByPk($id_resource);
			$model = MyMovieNzb::model()->findByPk($id);
			$criteria->join = 'INNER JOIN my_movie_nzb_person p on (p.Id_person = t.Id)';
			$criteria->addCondition('p.Id_my_movie_nzb = "'.$id.'"');			
			$criteria->order = 't.Id ASC';			
		}
		else if($sourceType == 2)
		{
			$modelRippedMovie = RippedMovie::model()->findByPk($id_resource);
			$model = MyMovie::model()->findByPk($id);
			$criteria->join = 'INNER JOIN my_movie_person p on (p.Id_person = t.Id)';
			$criteria->addCondition('p.Id_my_movie = "'.$id.'"');
			$criteria->order = 't.Id ASC';
		}else
		{
			$localFolder = LocalFolder::model()->findByPk($id_resource);
			$model = MyMovie::model()->findByPk($id);
			$criteria->join = 'INNER JOIN my_movie_person p on (p.Id_person = t.Id)';
			$criteria->addCondition('p.Id_my_movie = "'.$id.'"');
			$criteria->order = 't.Id ASC';				
		}
		
		$casting = $this->getCasting($criteria);
		$this->renderPartial('_movieDetails',array('model'=>$model, 
													'casting'=>$casting, 
													'sourceType'=>$sourceType,
													'modelNzb'=>$modelNzb,
													'modelRippedMovie'=>$modelRippedMovie,
													'modelLocalFolder'=>$localFolder,
													'modelCurrentDisc'=>$modelCurrentDisc,));
	}
	
	public function actionAjaxMarkCurrentDiscRead()
	{		
		self::markCurrentDiscRead();
	}
	
	private function markCurrentDiscRead()
	{
		$criteria=new CDbCriteria;
		$criteria->addCondition('Id_current_disc_state <> 1');
		$criteria->addCondition('t.read = 0');
		
		$modelCurrentDisc = CurrentDisc::model()->find($criteria);
		if(isset($modelCurrentDisc))
		{
			$modelCurrentDisc->read = 1;
			$modelCurrentDisc->save();
		}
	}
	
	public function actionAjaxCurrentDiscShowDetail()
	{
				
		$criteria=new CDbCriteria;
		$criteria->condition = 'Id_current_disc_state <> 1';
		
		$modelCurrentDisc = CurrentDisc::model()->find($criteria);
		
		$modelMyMovieDisc = MyMovieDisc::model()->findByAttributes(array('Id'=>$modelCurrentDisc->Id_my_movie_disc));
		
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
	
	public function actionAjaxRipp()
	{
		$criteria=new CDbCriteria;
		$criteria->condition = 'Id_current_disc_state <> 1';
		
		$modelCurrentDisc = CurrentDisc::model()->find($criteria);
		$modelCurrentDisc->command = 2; //ripp
		$modelCurrentDisc->read = 1;
		$modelCurrentDisc->save();

	}
	
	public function actionAjaxRemoveMovie()
	{
		$idResource = (isset($_POST['idResource']))?$_POST['idResource']:null;
		$sourceType = (isset($_POST['sourceType']))?$_POST['sourceType']:null;
		if(isset($idResource) && isset($sourceType))
		{
			switch ($sourceType) {
				case 1:
					$modelNzb = Nzb::model()->findByPk($idResource);
					if(isset($modelNzb))
						$modelNzb->delete();					
					break;
				case 2:
					$modelRippedMovie = RippedMovie::model()->findByPk($idResource);
					if(isset($modelRippedMovie))
						$modelRippedMovie->delete();
					break;
				case 3:
					$modelLocalFolder = LocalFolder::model()->findByPk($idResource);
					if(isset($modelLocalFolder))
						$modelLocalFolder->delete();
					break;				
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
		$this->layout='//layouts/column3';
		$this->showFilter = false;
		
		$play = false;
		
		switch ($sourceType) {
			case 1:
				$nzbModel = Nzb::model()->findByPk($idResource);
				$folderPath = explode('.',$nzbModel->file_name);
				DuneHelper::playDune($id,'/'.$folderPath[0].'/'.$nzbModel->path);
				
				$model = MyMovieNzb::model()->findByPk($id);
				break;
			case 2:
				$nzbRippedMovie = RippedMovie::model()->findByPk($idResource);
				DuneHelper::playDune($id,'/'.'/'.$nzbRippedMovie->path);
				$model = MyMovie::model()->findByPk($id);
				break;
			case 3:
				$localFolder = LocalFolder::model()->findByPk($idResource);
				$folderPath = explode('.',$localFolder->path);
				DuneHelper::playDune($id,'/'.'/'.$localFolder->path);
				
				$model = MyMovie::model()->findByPk($id);
				break;
			case 4:
				self::markCurrentDiscRead();
				DuneHelper::playDuneOnline($id);
			
				$model = MyMovie::model()->findByPk($id);
				break;
		}		
		$this->render('control',array(
				'model'=>$model,
		));
	}
	
	public function actionOpenDuneControl($id, $type)
	{
		$this->layout='//layouts/column3';
		
		$this->showFilter = false;
		
		if($type == 1)
			$model = MyMovieNzb::model()->findByPk($id);
		else
			$model = MyMovie::model()->findByPk($id);
		
		$this->render('control',array(
				'model'=>$model,
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
		$playbackUrl = DuneHelper::getPlaybackUrl();
		//type = 1 = nzb
		//type = 2 = localFolder/rippedMovie/online
		
		$response = array('id'=>0,'type'=>1, 'originalTitle'=>'');
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
				
				if(isset($modelNzbCurrent))
				{
					$response['id'] = $modelNzbCurrent->myMovieDiscNzb->Id_my_movie_nzb;
					$response['originalTitle'] = $modelNzbCurrent->myMovieDiscNzb->myMovieNzb->original_title;
				}
				else 
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
					
					$response['type'] = 2;
					
					if(isset($modelLocalFolderCurrent))
					{
						$response['id'] = $modelLocalFolderCurrent->myMovieDisc->Id_my_movie;
						$response['originalTitle'] = $modelLocalFolderCurrent->myMovieDisc->myMovie->original_title;
					}
					else 
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
						
						if(isset($modeRippedMovieCurrent))
						{
							$response['id'] = $modeRippedMovieCurrent->myMovieDisc->Id_my_movie;
							$response['originalTitle'] = $modeRippedMovieCurrent->myMovieDisc->myMovie->original_title;
						}
						else 
						{
							$criteria=new CDbCriteria;
							$criteria->condition = 'Id_current_disc_state <> 1';
								
							$modelCurrentDisc = CurrentDisc::model()->find($criteria);
							if(isset($modelCurrentDisc))
							{
								$modelMyMovieDisc = MyMovieDisc::model()->findByAttributes(array('Id'=>$modelCurrentDisc->Id_my_movie_disc));
								if(isset($modelMyMovieDisc))
								{
									$response['originalTitle'] = $modelMyMovieDisc->myMovie->original_title;
									$response['id'] = $modelMyMovieDisc->Id_my_movie;						
								}
							}	
						}
					}
					
				}			
			}
// 			else 
// 			{
// 				$criteria=new CDbCriteria;
// 				$criteria->condition = 'Id_current_disc_state <> 1';
					
// 				$modelCurrentDisc = CurrentDisc::model()->find($criteria);
// 				if(isset($modelCurrentDisc))
// 				{
// 					$modelMyMovieDisc = MyMovieDisc::model()->findByAttributes(array('Id'=>$modelCurrentDisc->Id_my_movie_disc));
// 					if(isset($modelMyMovieDisc))
// 					{
// 						$response['originalTitle'] = $modelMyMovieDisc->myMovie->original_title;
// 						$response['id'] = $modelMyMovieDisc->Id_my_movie;
// 						$response['type'] = 2;
// 					}
// 				}
// 			}
			
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
}