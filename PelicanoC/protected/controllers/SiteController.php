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
		//PelicanoHelper::UpdatePoints();
			
//       	$ws = new wsPelicanoC();
//   	  	$ws->addNewRipMovie("af39fbab-1b0c-4519-856e-09c2dff7198d","el cadaver de la novia",true);
//  		$ws->addNewRipMovie("8377d7ee-1f68-43ea-a740-001eb6cbed72","ice age 3");
//  	$ws->addNewRipMovie("cb902e53-9b4f-4e2c-8187-910c817ac336","lalaooo");
//  		$ws->addNewRipMovie("f38c7448-07fe-467d-a1c8-00393cd54b1f","kung fu");
//  		$ws->addNewRipMovie("67df0d13-366a-4e65-b6c7-00b0fcb21b8b","linterna");
// 		$ws->addNewRipMovie("bcf5cb96-73bc-4ed8-b35b-66aac2d8d693","invencible");
		
//  		$mymo = new MyMoviesAPI();
// 		$hola = $mymo->LoadDiscTitleById("af39fbab-1b0c-4519-856e-09c2dff7198d");
// 		$hola = $mymo->LoadDiscTitleById("bcf5cb96-73bc-4ed8-b35b-66aac2d8d693");
// 		$hola = $mymo->LoadDiscTitleById("f38c7448-07fe-467d-a1c8-00393cd54b1f");
		

// 		$hola = new User();
// 		$hola->updateUserFromServer();
		
		$modelNzb = new Nzb;
		$dataProvider= $modelNzb->searchHomeOrdered();
		$dataProvider->pagination->pageSize= 4;
		
		$dataProviderSeries= $modelNzb->searchSeriesOrdered();
		$dataProviderSeries->pagination->pageSize= 4;
		$this->render('index',array(
					'dataProvider'=>$dataProvider,
					'dataProviderSeries'=>$dataProviderSeries,
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