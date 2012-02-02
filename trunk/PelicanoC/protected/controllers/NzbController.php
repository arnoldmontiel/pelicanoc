<?php

class NzbController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

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

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Nzb;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Nzb']))
		{
			$model->attributes=$_POST['Nzb'];
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

		if(isset($_POST['Nzb']))
		{
			$model->attributes=$_POST['Nzb'];
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
		//update from NZB server
		//$this->updateFromServer();
		//
		$dataProvider=new CActiveDataProvider('Nzb');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}
	public function updateFromServer()
	{
		$setting = Setting::getInstance();
		$pelicanoCliente = new Pelicano;
		$MovieResponseArray = $pelicanoCliente->getNewMovies($setting->Id_customer);
		foreach ($MovieResponseArray as $movie) {
			try {
				$modelNzb = new Nzb;
				$modelImdbdata=new Imdbdata;

				
				$nzbAttr = $modelNzb->attributes;
				while(current($nzbAttr)!==False)
				{
					$attrName= key($nzbAttr);
					$modelNzb->setAttribute($attrName, $movie->$attrName);
					next($nzbAttr);
				}				
				
				$imdbdataAttr = $modelImdbdata->attributes;
				while(current($imdbdataAttr)!==False)
				{					
					$attrName= key($imdbdataAttr);
					$modelImdbdata->setAttribute($attrName, $movie->$attrName);
					next($imdbdataAttr);
				}
				$validator = new CUrlValidator();
				
				if($modelNzb->url!='' && $validator->validateValue($setting->host_name.$modelNzb->url))
				{
					$content = file_get_contents($setting->host_name.$modelNzb->url);
					if ($content !== false) {
						$file = fopen($setting->path_pending.$modelNzb->file_name, 'w');
						fwrite($file,$content);
						fclose($file);
					} else {
						// an error happened
					}
				}
				if($modelNzb->subt_url!='' && $validator->validateValue($setting->host_name.$modelNzb->subt_url))
				{
					$content = file_get_contents($setting->host_name.$modelNzb->subt_url);
					if ($content !== false) {
						$file = fopen($setting->path_subtitle.$modelNzb->subt_file_name, 'w');
						fwrite($file,$content);
						fclose($file);
					} else {
						// an error happened
					}
				}
				$modelImdbdata->save();
				$modelNzb->save();
				
			} catch (Exception $e) {
			}
		}		
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Nzb('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Nzb']))
			$model->attributes=$_GET['Nzb'];

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
		$model=Nzb::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='nzb-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
