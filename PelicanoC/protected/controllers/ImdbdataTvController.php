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
		$season = 0;
		if(isset($_GET['season']))
			$season = (int)$_GET['season'] -1;
		$firstSeason = $model->seasons[$season];
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
	{
		$this->updateFromServer();
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
		PelicanoHelper::sendPendingNzbStates();
		PelicanoHelper::sendPendingImdbdataTvStates();
		
		$setting = Setting::getInstance();
		$pelicanoCliente = new Pelicano;
		$SerieResponseArray = $pelicanoCliente->getNewSeries($setting->getId_Customer());
		foreach ($SerieResponseArray as $serie) {
			try {
				$modelNzb = Nzb::model()->findByPk($serie->Id);
				if(!isset($modelNzb))
				{
					$modelNzb = new Nzb;
				}
				$modelImdbdataTv = ImdbdataTv::model()->findByPk($serie->ID);
				if(!isset($modelImdbdataTv))
				{
					$modelImdbdataTv=new ImdbdataTv;
				}
				if($serie->deleted)
				{
					if(!$modelNzb->isNewRecord)
					{
						if(!$modelNzb->downloading||!$modelNzb->downloaded)
						{
							$modelImdbdataTv->delete();
							//$modelNzb->delete();
				
							$request= new MovieStateRequest;
							$request->id_customer = $setting->getId_Customer();
							$request->id_movie =$modelNzb->Id;
							$request->id_state =6;
							$request->date = time();
							$requests[]=$request;
							continue;
						}
					}
					else
					{
						$request= new SerieStateRequest;
						$request->id_customer = $setting->getId_Customer();
						$request->id_serie_nzb =$serie->Id;
						$request->id_state =6;
						$request->date = time();
						$request->id_imdbdata_tv =$modelImdbdataTv->ID;
						$requests[]=$request;
						
						continue;
					}
						
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
	
				$imdbdataAttr = $modelImdbdataTv->attributes;
				while(current($imdbdataAttr)!==False)
				{
					$attrName= key($imdbdataAttr);
					if(isset($serie->$attrName))
					{
						$modelImdbdataTv->setAttribute($attrName, $serie->$attrName);
					}
					next($imdbdataAttr);
				}
				$modelSeasons = array();
				foreach ($serie->arrSeason as $season)
				{
					$modelSeason = Season::model()->findByPk(array('season'=> $season->season,'Id_imdbdata_tv'=> $season->Id_imdbdata_tv));
					if(!isset($modelSeason))
					{
						$modelSeason = new Season;						
					}
					$modelSeason->season=$season->season;
					$modelSeason->Id_imdbdata_tv=$season->Id_imdbdata_tv;
					$modelSeason->episodes=$season->episodes;
					$modelSeasons[]=$modelSeason;
				}
				
				$validator = new CUrlValidator();
	
				if($modelNzb->url!='' && $validator->validateValue($setting->host_name.$setting->host_path.$modelNzb->url))
				{
					try {
						$content = @file_get_contents($setting->host_name.$setting->host_path.$modelNzb->url);
						if ($content !== false) {
							$file = fopen($setting->path_pending."/".$modelNzb->file_name, 'w');
							fwrite($file,$content);
							fclose($file);
						} else {
							// an error happened
						}						
					} catch (Exception $e) {
					}
				}
				if($modelNzb->subt_url!='' && $validator->validateValue($setting->host_name.$setting->host_path.$modelNzb->subt_url))
				{
					try {
						$content = @file_get_contents($setting->host_name.$setting->host_path.$modelNzb->subt_url);
						if ($content !== false) {
							$file = fopen($setting->path_subtitle."/".$modelNzb->subt_file_name, 'w');
							fwrite($file,$content);
							fclose($file);
						} else {
							// an error happened
						}
						
					} catch (Exception $e) {
							// an error happened
					}
				}
				if($serie->Poster!='' && $validator->validateValue($modelImdbdataTv->Poster))
				{
					try {
						$content = @file_get_contents($modelImdbdataTv->Poster);
						if ($content !== false) {
							$file = fopen($setting->path_images."/".$modelImdbdataTv->ID.".jpg", 'w');
							fwrite($file,$content);
							fclose($file);
							$modelImdbdataTv->Poster_original = $modelImdbdataTv->Poster;
							$modelImdbdataTv->Poster = $modelImdbdataTv->ID.".jpg";
						} else {
							// an error happened
						}						
					} catch (Exception $e) {
							// an error happened
					}
				}
				$transaction = $modelNzb->dbConnection->beginTransaction();
				try {
					$modelImdbdataTv->save();

					if(isset($serie->Id))
					{
						$modelNzb->Id_imdbdata_tv = $modelImdbdataTv->ID;
						$modelNzb->date = date("Y-m-d H:i:s",time());
						$modelNzb->save();

						$nzbMovieState= new NzbMovieState;
						$nzbMovieState->Id_nzb = $modelNzb->Id;
						$nzbMovieState->Id_movie_state = 1;
						$setting=Setting::getInstance();
						$nzbMovieState->Id_customer = $setting->getId_customer();
						
						$nzbMovieState->save();
						
					}
					else 
					{
						$state= new ImdbdataTvMovieState;
						$state->Id_imdbdata_tv = $modelImdbdataTv->ID;
						$state->Id_movie_state = 1;
						$state->Id_customer = $setting->getId_customer();
						
						$state->save();						
					}
					foreach($modelSeasons as $season)
					{
						$season->save();						
					}
							
					$transaction->commit();
	
				} catch (Exception $e) {
					$transaction->rollback();
				}
			} catch (Exception $e) {
			}
		}
		PelicanoHelper::sendPendingNzbStates();
		PelicanoHelper::sendPendingImdbdataTvStates();		
	}
	public function actionAjaxRequestSerie()
	{
		if(isset($_POST['id_nzb']))
		{
			$setting = Setting::getInstance();
			$nzb = Nzb::model()->findByPk($_POST['id_nzb']);
			$nzbCustomer = NzbCustomer::model()->findByPk(array('Id_nzb'=>$nzb->Id,'Id_customer'=>$setting->getId_customer()));
			if(!$nzbCustomer->requested)
			{
				try
				{
					$nzb->requested = 1;
					$nzb->save();
	
					$nzbMovieState= new NzbMovieState;
					$nzbMovieState->Id_nzb = $nzb->Id;
					$nzbMovieState->Id_movie_state = 4;
					$nzbMovieState->Id_customer = $setting->getId_customer();
						
					$nzbMovieState->save();
	
					//we send the new state to the server
					$pelicanoCliente = new Pelicano;
					$request= new SerieStateRequest;
					$request->id_customer = $setting->getId_Customer();
					$request->id_serie_nzb =$nzb->Id;
					$request->id_state =4;
					$request->date = time();
					$request->id_imdbdata_tv = null;
					$requests[]=$request;
						
					$status = $pelicanoCliente->setSerieState($requests);
					if($status)
					{
						$nzbMovieState->sent = 1;
						$nzbMovieState->save();
					}
				}
				catch (Exception $e)
				{
				}
			}
		}
	
	}
	public function actionAjaxCancelRequestedSerie()
	{
		if(isset($_POST['id_nzb']))
		{
			$setting = Setting::getInstance();
			$nzb = Nzb::model()->findByPk($_POST['id_nzb']);
			$nzbCustomer = NzbCustomer::model()->findByPk(array('Id_nzb'=>$nzb->Id,'Id_customer'=>$setting->getId_customer()));
			if($nzbCustomer->requested)
			{
				try
				{
					$nzb->requested = 0;
					$nzb->save();
	
					$nzbMovieState= new NzbMovieState;
					$nzbMovieState->Id_nzb = $nzb->Id;
					$nzbMovieState->Id_movie_state = 5;
					$nzbMovieState->Id_customer = $setting->getId_customer();
						
					$nzbMovieState->save();
	
					//we send the new state to the server
					$pelicanoCliente = new Pelicano;
					$request= new SerieStateRequest;
					$request->id_customer = $setting->getId_Customer();
					$request->id_serie_nzb =$nzb->Id;
					$request->id_state =5;
					$request->date = time();
					$request->id_imdbdata_tv = null;
					$requests[]=$request;
						
					$status = $pelicanoCliente->setSerieState($requests);
					if($status)
					{
						$nzbMovieState->sent = 1;
						$nzbMovieState->save();
					}
					
				}
				catch (Exception $e)
				{
				}
			}
		}
	
	}
	public function actionAjaxStartDownload()
	{
		if(isset($_POST['id_nzb']))
		{
			$nzb = Nzb::model()->findByPk($_POST['id_nzb']);
			if(!$nzb->downloading)
			{
				$setting = Setting::getInstance();
				try
				{
					if(copy($setting->path_pending.'/'.$nzb->file_name, $setting->path_ready.'/'.$nzb->file_name))
					{
						$nzb->downloaded = 0;
						$nzb->downloading = 1;
						$nzb->save();
	
						$nzbMovieState= new NzbMovieState;
						$nzbMovieState->Id_nzb = $nzb->Id;
						$nzbMovieState->Id_movie_state = 2;
						$setting=Setting::getInstance();
						$nzbMovieState->Id_customer = $setting->getId_customer();
						$nzbMovieState->save();
	
						//we send the new state to the server
						$pelicanoCliente = new Pelicano;
						$request= new MovieStateRequest;
						$request->id_customer = $setting->getId_Customer();
						$request->id_movie =$nzb->Id;
						$request->id_state =2;
						$request->date = time();
						$requests[]=$request;
						$status = $pelicanoCliente->setMovieState($requests);
						if($status)
						{
							$nzbMovieState->sent = 1;
							$nzbMovieState->save();
						}
						
					}
				}
				catch (Exception $e)
				{
				}
			}
		}
	}
	
}
