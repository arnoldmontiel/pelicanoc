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
		RipperHelper::saveRipped("e84c661c-dd1a-4c28-8c4d-9c83b10d0664","Heroes s3",true,'36E04635-B84DE634');
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
	
 		$modelNzb = new Nzb;
		$dataProvider= $modelNzb->searchHomeOrdered();
		$dataProvider->pagination->pageSize= 8;
		
//		$dataProviderSeries= $modelNzb->searchSeriesOrdered();
//		$dataProviderSeries->pagination->pageSize= 4;
		$this->render('index',array(
					'dataProvider'=>$dataProvider,
//					'dataProviderSeries'=>$dataProviderSeries,
		));
		
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