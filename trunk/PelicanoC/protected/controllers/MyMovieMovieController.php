<?php

class MyMovieMovieController extends Controller
{
	public function actionIndex()
	{
		echo $this->updateFromServer();
		$this->render('index');
	}

	public function updateFromServer()
	{
		PelicanoHelper::sendPendingNzbStates();
		$requests = array();
		$setting = Setting::getInstance();
		$pelicanoCliente = new Pelicano;
		$MovieResponseArray = $pelicanoCliente->getNewMovies($setting->getId_Device());
		foreach ($MovieResponseArray as $movie) {
			try {
				$modelNzb = Nzb::model()->findByPk($movie->Id);
				if(!isset($modelNzb))
				{
					$modelNzb = new Nzb;
				}
				$modelMyMovieMovie = MyMovieMovie::model()->findByPk($movie->Id_my_movie_movie);
				if(!isset($modelMyMovieMovie))
				{
					$modelMyMovieMovie = new MyMovieMovie;
				}
				if($movie->deleted)
				{
					if(!$modelNzb->isNewRecord)
					{
						if(!$modelNzb->downloading||!$modelNzb->downloaded)
						{
							$modelMyMovieMovie->delete();
							//$modelNzb->delete();
							$nzbMovieState= new NzbMovieState;
							$nzbMovieState->Id_nzb = $modelNzb->Id;
							$nzbMovieState->Id_movie_state = 6;
							$nzbMovieState->Id_device = $setting->getId_Device();
								
							$nzbMovieState->save();
							continue;
						}
					}
					else
					{
						$nzbMovieState= new NzbMovieState;
						$nzbMovieState->Id_nzb = $movie->Id;
						$nzbMovieState->Id_movie_state = 6;
						$nzbMovieState->Id_device = $setting->getId_Device();
							
						$nzbMovieState->save();
						continue;
					}
						
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
	
				$myMovieMovieAttr = $modelMyMovieMovie->attributes;
				while(current($myMovieMovieAttr)!==False)
				{
					$attrName= key($myMovieMovieAttr);
					if(isset($movie->$attrName))
					{
						$modelMyMovieMovie->setAttribute($attrName, $movie->$attrName);
					}
					next($myMovieMovieAttr);
				}
				$modelMyMovieMovie->Id = $movie->Id_my_movie_movie;
	
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
						// an error happened
					}
				}
				if($modelNzb->subt_url!='' && $validator->validateValue($setting->host_name.$setting->host_path.$modelNzb->subt_url))
				{
					$content = @file_get_contents($setting->host_name.$setting->host_path.$modelNzb->subt_url);
					if ($content !== false) {
						$file = fopen($setting->path_subtitle."/".$modelNzb->subt_file_name, 'w');
						fwrite($file,$content);
						fclose($file);
					} else {
						// an error happened
					}
				}
				if($movie->poster_original!='' && $validator->validateValue($movie->poster_original))
				{
					try {
						$content = @file_get_contents($movie->poster_original);
						if ($content !== false) {
							$file = fopen($setting->path_images."/".$modelMyMovieMovie->Id.".jpg", 'w');
							fwrite($file,$content);
							fclose($file);
							$modelMyMovieMovie->poster = $modelMyMovieMovie->Id.".jpg";
						} else {
							// an error happened
						}
					} catch (Exception $e) {
						throw $e;
						// an error happened
					}
				}
				
				if($movie->backdrop_original!='' && $validator->validateValue($movie->backdrop_original))
				{
					try {
						$content = @file_get_contents($movie->backdrop_original);
						if ($content !== false) {
							$file = fopen($setting->path_images."/".$modelMyMovieMovie->Id."_bd.jpg", 'w');
							fwrite($file,$content);
							fclose($file);
							$modelMyMovieMovie->backdrop = $modelMyMovieMovie->Id."_bd.jpg";
						} else {
							// an error happened
						}
					} catch (Exception $e) {
						throw $e;
						// an error happened
					}
				}
				
				$transaction = $modelNzb->dbConnection->beginTransaction();
				try {
					$modelMyMovieMovie->save();
					$modelNzb->Id_my_movie_movie = $modelMyMovieMovie->Id;
					$modelNzb->date = date("Y-m-d H:i:s",time());
					$modelNzb->save();
					
					$nzbMovieState= new NzbMovieState;
					$nzbMovieState->Id_nzb = $modelNzb->Id;
					$nzbMovieState->Id_movie_state = 1;
					$nzbMovieState->Id_device = $setting->getId_Device();
	
					$nzbMovieState->save();
	
					$transaction->commit();
						
				} catch (Exception $e) {	
					$transaction->rollback();
				}
			} catch (Exception $e) {
			}
		}
		PelicanoHelper::sendPendingNzbStates();
	}


	/**
	* Displays a particular model.
	* @param integer $id the ID of the model to be displayed
	*/
	public function actionView($id)
	{
		$pageNumber=0;
		if(isset($_GET['currentPage']))
		{
			$this->fromPageNumber=$_GET['currentPage'];
		}
		$model = Nzb::model()->findByPk($id);

		
		$this->render('view',array(
				'model'=>$model,
		));
	}
}