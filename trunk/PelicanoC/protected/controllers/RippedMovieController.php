<?php

class RippedMovieController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}
	
	public function actionViewAdult($id)
	{
		$this->render('viewAdult',array(
				'model'=>$this->loadModel($id),
		));
	}
	
	public function actionAjaxVerifyAndStart()
	{
		if(isset($_POST['Customer']['adult_password'])&&isset($_POST['Id_ripped_movie']))
		{
			$setting = Setting::getInstance();
			$customer = $setting->getCustomer();
			if($customer->adult_password==$_POST['Customer']['adult_password'])
			{
				$this->showMenu = false;
				$this->showBrowsingBox = false;
				$this->renderPartial('startAdult',array(
											'model'=>$this->loadModel($_POST['Id_ripped_movie']),
				));				
			}
		}
	}
	public function actionAjaxVerifyParentalControlAndStart()
	{
		if(isset($_POST['Customer']['parental_password'])&&isset($_POST['Id_ripped_movie']))
		{
			$setting = Setting::getInstance();
			$customer = $setting->getCustomer();
			if($customer->parental_password==$_POST['Customer']['parental_password'])
			{
				$this->showMenu = false;
				$this->showBrowsingBox = false;
				$this->renderPartial('startAdult',array(
											'model'=>$this->loadModel($_POST['Id_ripped_movie']),
				));				
			}
		}
	}
	public function actionAjaxStart($id)
	{
			$this->showMenu = false;
			$this->showBrowsingBox = false;
			$this->render('start',array(
								'model'=>$this->loadModel($id),
			));
	}
	
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new RippedMovie;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['RippedMovie']))
		{
			$model->attributes=$_POST['RippedMovie'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->Id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['RippedMovie']))
		{
			$model->attributes=$_POST['RippedMovie'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->Id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('RippedMovie');
		
		$model = new RippedMovie();
		$dataProvider= $model->search();
		$dataProvider->pagination->pageSize= 12;
		
		if(isset($_GET['searchFilter']))
		{
			$expression=trim($_GET['searchFilter']);
			$dataProvider= $model->searchOn($expression);
		}
		
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}
	
	public function actionIndexAdult()
	{
		$dataProvider=new CActiveDataProvider('RippedMovie');
	
		$model = new RippedMovie();
		$dataProvider= $model->searchAdult();
		$dataProvider->pagination->pageSize= 12;
	
		if(isset($_GET['searchFilter']))
		{
			$expression=trim($_GET['searchFilter']);
			$dataProvider= $model->searchAdultOn($expresion);
		}
	
		$this->render('indexAdult',array(
				'dataProvider'=>$dataProvider,
		));
	}
	
	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new RippedMovie('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['RippedMovie']))
			$model->attributes=$_GET['RippedMovie'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=RippedMovie::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='ripped-movie-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
