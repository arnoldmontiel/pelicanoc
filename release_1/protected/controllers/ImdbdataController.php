<?php

class ImdbdataController extends Controller
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
	public function actionView($id)
	{
		$model = Nzb::model()->findByPk($id); 
		//$modelImdbdata = $this->loadModel($id);
		$modelImdbdata = $model->imdbdata;
		if($modelImdbdata->Backdrop_original=!"")
		{
			$validator = new CUrlValidator();				
			if($modelImdbdata->Backdrop!='' && $validator->validateValue($modelImdbdata->Backdrop))
			{
				$content = file_get_contents($modelImdbdata->Backdrop);
				if ($content !== false) {
					$setting = Setting::getInstance();
					$file = fopen($setting->path_images."/".$modelImdbdata->ID."_bd.jpg", 'w');
					fwrite($file,$content);
					fclose($file);
					$modelImdbdata->Backdrop_original = $modelImdbdata->Backdrop;
					$modelImdbdata->Backdrop = $modelImdbdata->ID."_bd.jpg";
					$modelImdbdata->save();
				} else {
					// an error happened
				}
			}
		}						
		$this->render('view',array(
			'model'=>$model,
			'modelImdbdata'=>$model->imdbdata,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Imdbdata;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Imdbdata']))
		{
			$model->attributes=$_POST['Imdbdata'];
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

		if(isset($_POST['Imdbdata']))
		{
			$model->attributes=$_POST['Imdbdata'];
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
		//$this->updateFromServer();
		$modelNzb = new Nzb;
		$dataProvider= $modelNzb->searchOrdered();
		
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}
	/**
	* Lists all models.
	*/
	public function actionAjaxGetNews()
	{
		$this->updateFromServer();
		$this->actionAjaxNewsSearch();		
	}
	
	public function actionNews()
	{
		$modelNzb = new Nzb;
		$dataProvider= $modelNzb->searchNews();
		$this->render('news',array(
				'dataProvider'=>$dataProvider,
		));
	}
	
	public function actionStored()
	{
		$modelNzb = new Nzb;
		$dataProvider= $modelNzb->searchStored();
		$this->render('stored',array(
				'dataProvider'=>$dataProvider,
		));
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
		$model=Imdbdata::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
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
						$nzbMovieState->save();
						
						//we send the new state to the server 
						$pelicanoCliente = new Pelicano;
						$request= new MovieStateRequest;
						$request->id_customer = $setting->Id_customer;
						$request->id_movie =$nzb->Id;
						$request->id_state =2;
						$request->date = time();
						$status = $pelicanoCliente->setMovieState($request);
						
					}
				}
				 catch (Exception $e) 
				{
				}
			}
		}
	}	
	public function updateFromServer()
	{
		$setting = Setting::getInstance();
		$pelicanoCliente = new Pelicano;
		$MovieResponseArray = $pelicanoCliente->getNewMovies($setting->Id_customer);
		foreach ($MovieResponseArray as $movie) {
			try {
				$modelNzb = Nzb::model()->findByPk($movie->Id);
				if(!isset($modelNzb))
				{
					$modelNzb = new Nzb;					
				}
				$modelImdbdata = Imdbdata::model()->findByPk($movie->ID);
				if(!isset($modelImdbdata))
				{
					$modelImdbdata=new Imdbdata;						
				}			
	
				$nzbAttr = $modelNzb->attributes;
				while(current($nzbAttr)!==False)
				{
					$attrName= key($nzbAttr);
					if(isset($movie->$attrName))
					{
						$modelNzb->setAttribute($attrName, $movie->$attrName);						
					}
					next($nzbAttr);
				}
	
				$imdbdataAttr = $modelImdbdata->attributes;
				while(current($imdbdataAttr)!==False)
				{
					$attrName= key($imdbdataAttr);
					if(isset($movie->$attrName))
					{
						$modelImdbdata->setAttribute($attrName, $movie->$attrName);						
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
				if($movie->Poster!='' && $validator->validateValue($modelImdbdata->Poster))
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
					$modelNzb->Id_imdbData = $modelImdbdata->ID;
					$modelNzb->date = date("Y-m-d H:i:s",time());
					$modelNzb->save();
					
					$nzbMovieState= new NzbMovieState;
					$nzbMovieState->Id_nzb = $modelNzb->Id;
					$nzbMovieState->Id_movie_state = 1;
					$nzbMovieState->save();
						
					$transaction->commit();
					//we send the new state to the server
					$pelicanoCliente = new Pelicano;
					$request= new MovieStateRequest;
					$request->id_customer = $setting->Id_customer;
					$request->id_movie =$modelNzb->Id;
					$request->id_state =1;
					$request->date = time();
											
					$status = $pelicanoCliente->setMovieState($request);
						
				} catch (Exception $e) {
					$transaction->rollback();
				}									
			} catch (Exception $e) {
			}
		}
	}
	public function actionAjaxSearch()
	{
		$modelNzb = new Nzb;
		$expression = "";
		if(isset($_POST['imdb_search_field']))
		{
			$expression=trim($_POST['imdb_search_field']);			
		}
		$dataProvider= $modelNzb->searchOn($expression);
				
		$this->widget('zii.widgets.CListView', array(
			'dataProvider'=>$dataProvider,
			'itemView'=>'_view',
			'summaryText' =>"",
		)); 
	}
	public function actionAjaxNewsSearch()
	{
		$modelNzb = new Nzb;
		$expression = "";
		if(isset($_POST['imdb_search_field']))
		{
			$expression=trim($_POST['imdb_search_field']);			
		}
		$dataProvider= $modelNzb->searchNewsOn($expression);
				
		$this->widget('zii.widgets.CListView', array(
			'dataProvider'=>$dataProvider,
			'itemView'=>'_view',
			'summaryText' =>"",
		)); 
	}
	public function actionAjaxStoredSearch()
	{
		$modelNzb = new Nzb;
		$expression = "";
		if(isset($_POST['imdb_search_field']))
		{
			$expression=trim($_POST['imdb_search_field']);			
		}
		$dataProvider= $modelNzb->searchStoredOn($expression);
				
		$this->widget('zii.widgets.CListView', array(
			'dataProvider'=>$dataProvider,
			'itemView'=>'_view',
			'summaryText' =>"",
		)); 
	}
	public function actionAjaxStopMedia()
	{
			if(isset($_POST['id_nzb']))		
		{
			$nzb = Nzb::model()->findByPk($_POST['id_nzb']);
			if($nzb->downloaded)
			{
				$setting = Setting::getInstance();
			}
		}
	}
	public function actionAjaxStartMedia()
	{
		if(!isset($_POST['id_nzb']))
		{

			$nzb = Nzb::model()->findByPk($_POST['id_nzb']);
			if($nzb->downloaded)
			{
				$setting = Setting::getInstance();
				$content = file_get_contents("http://DUNE/cgi-bin/do?cmd=start_file_playback&media_url=smb://ARNOLD-PC/COSAS/Back.to.the.Future.720.HDrip.H264.AAC.ITS-ALI.mp4");
				
				echo $content;
				
			}
		}
	}
	
	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='imdbdata-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
