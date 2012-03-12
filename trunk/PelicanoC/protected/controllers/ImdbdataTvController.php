<?php

class ImdbdataTvController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column1';

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
	public function actionViewEpisode($id)
	{
		$model = Nzb::model()->findByPk($id);
		$modelImdbdataTv = $model->imdbdataTv;
		$this->render('viewEpisode',array(
				'model'=>$model,
				'modelImdbdataTv'=>$modelImdbdataTv,
		));
	}
	
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$modelNzb = new Nzb;
		$model = ImdbdataTv::model()->findByPk($id);
		$firstSeason = $model->seasons[0];
		$dataProvider= $modelNzb->searchEpisodesOfSeason($id,$firstSeason->season);
		$this->render('view',array(
			'model'=>$model,
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new ImdbdataTv;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['ImdbdataTv']))
		{
			$model->attributes=$_POST['ImdbdataTv'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->ID));
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

		if(isset($_POST['ImdbdataTv']))
		{
			$model->attributes=$_POST['ImdbdataTv'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->ID));
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
	{		//$this->updateFromServer();
		$model = new ImdbdataTv;
		$dataProvider= $model->searchHeader();
		$dataProvider->pagination->pageSize= 12;
		
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new ImdbdataTv('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['ImdbdataTv']))
			$model->attributes=$_GET['ImdbdataTv'];

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
		$model=ImdbdataTv::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
	public function actionAjaxSearch()
	{
		$modelNzb = new Nzb;
		$expression = "";
		if(isset($_POST['imdb_search_field']))
		{
			$expression=trim($_POST['imdb_search_field']);
		}
		$dataProvider= $modelNzb->searchSeriesOn($expression);
		$dataProvider->pagination->pageSize= 12;
	
		$this->widget('zii.widgets.CListView', array(
				'dataProvider'=>$dataProvider,
				'itemView'=>'_view',
				'summaryText' =>"",
		));
	}
	public function actionAjaxChangeSeason()
	{
		if(isset($_POST['season_id'])&&isset($_POST['id_imdbdata_tv_parent']))
		{
			$model = new Nzb;
			$dataProvider= $model->searchEpisodesOfSeason($_POST['id_imdbdata_tv_parent'],$_POST['season_id']);

			$this->widget('zii.widgets.CListView', array(
				'dataProvider'=>$dataProvider,
				'itemView'=>'_viewEpisode',
				'summaryText' =>"",
				'pager'=>array('cssFile'=>Yii::app()->baseUrl.'/css/pager-custom.css','header'=>''),
			
			));
		}		
	}
	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='imdbdata-tv-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	public function updateFromServer()
	{
		$setting = Setting::getInstance();
		$pelicanoCliente = new Pelicano;
		$SerieResponseArray = $pelicanoCliente->getNewSeries($setting->Id_customer);
		foreach ($SerieResponseArray as $Serie) {
			try {
				$modelNzb = Nzb::model()->findByPk($serie->Id);
				if(!isset($modelNzb))
				{
					$modelNzb = new Nzb;
				}
				$modelImdbdata = Imdbdata::model()->findByPk($serie->ID);
				if(!isset($modelImdbdata))
				{
					$modelImdbdata=new Imdbdata;
				}
	
				$nzbAttr = $modelNzb->attributes;
				while(current($nzbAttr)!==False)
				{
					$attrName= key($nzbAttr);
					if(isset($serie->$attrName))
					{
						$modelNzb->setAttribute($attrName, $serie->$attrName);
					}
					next($nzbAttr);
				}
	
				$imdbdataAttr = $modelImdbdata->attributes;
				while(current($imdbdataAttr)!==False)
				{
					$attrName= key($imdbdataAttr);
					if(isset($serie->$attrName))
					{
						$modelImdbdata->setAttribute($attrName, $serie->$attrName);
					}
					next($imdbdataAttr);
				}
				$validator = new CUrlValidator();
	
				if($modelNzb->url!='' && $validator->validateValue($setting->host_name.$modelNzb->url))
				{
					$content = file_get_contents($setting->host_name.$modelNzb->url);
					if ($content !== false) {
						$file = fopen($setting->path_pending."/".$modelNzb->file_name, 'w');
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
						$file = fopen($setting->path_subtitle."/".$modelNzb->subt_file_name, 'w');
						fwrite($file,$content);
						fclose($file);
					} else {
						// an error happened
					}
				}
				if($serie->Poster!='' && $validator->validateValue($modelImdbdata->Poster))
				{
					$content = file_get_contents($modelImdbdata->Poster);
					if ($content !== false) {
						$file = fopen($setting->path_images."/".$modelImdbdata->ID.".jpg", 'w');
						fwrite($file,$content);
						fclose($file);
						$modelImdbdata->Poster_original = $modelImdbdata->Poster;
						$modelImdbdata->Poster = $modelImdbdata->ID.".jpg";
					} else {
						// an error happened
					}
				}
				$transaction = $modelNzb->dbConnection->beginTransaction();
				try {
					$modelImdbdata->save();
					$modelNzb->Id_imdbdata = $modelImdbdata->ID;
					$modelNzb->date = date("Y-m-d H:i:s",time());
					$modelNzb->save();
						
					$nzbSerieState= new NzbSerieState;
					$nzbSerieState->Id_nzb = $modelNzb->Id;
					$nzbSerieState->Id_serie_state = 1;
					$nzbSerieState->save();
	
					$transaction->commit();
					//we send the new state to the server
					$pelicanoCliente = new Pelicano;
					$request= new SerieStateRequest;
					$request->id_customer = $setting->Id_customer;
					$request->id_serie =$modelNzb->Id;
					$request->id_state =1;
					$request->date = time();
					$requests[]=$request;
						
					$status = $pelicanoCliente->setSerieState($requests);
	
				} catch (Exception $e) {
					$transaction->rollback();
				}
			} catch (Exception $e) {
			}
		}
	}
	
}
