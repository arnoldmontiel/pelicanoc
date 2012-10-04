<?php
class NzbCommand extends CConsoleCommand  {
	/*
	 * @param file_name 
	 * @return 0: It was an error, 1:It was success
	 */
	
	
	function actionDownloadNzbFiles() 
	{
		$validator = new CUrlValidator();
		$setting = Setting::getInstance();
		
		$criteria=new CDbCriteria;
		$criteria->addCondition('t.ready = 0');
		
		$arrayNbz = Nzb::model()->findAll($criteria);
		
		
		foreach ($arrayNbz as $modelNzb)
		{
			
			$transaction = $modelNzb->dbConnection->beginTransaction();
			
			try {
				
				$modelMyMovieMovie = MyMovieMovie::model()->findByPk($modelNzb->Id_my_movie_movie);
	
				if(false && $modelNzb->url!='' && $validator->validateValue($setting->host_name.$setting->host_path.$modelNzb->url))
				{
					try {
						$content = @file_get_contents($setting->host_name.$setting->host_path.$modelNzb->url);
						if ($content !== false) {
							$file = fopen(dirname(__FILE__)."/../../".$setting->path_pending."/".$modelNzb->file_name, 'w');
							//$file = fopen("../../../nzb/".$modelNzb->file_name, 'w');
							fwrite($file,$content);
							fclose($file);
						} else {
							// an error happened
						}
					} catch (Exception $e) {
						// an error happened
					}
				}
				
				if(false && $modelNzb->subt_url!='' && $validator->validateValue($setting->host_name.$setting->host_path.$modelNzb->subt_url))
				{
					$content = @file_get_contents($setting->host_name.$setting->host_path.$modelNzb->subt_url);
					if ($content !== false) {
						$file = fopen(dirname(__FILE__)."/../../".$setting->path_subtitle."/".$modelNzb->subt_file_name, 'w');
						fwrite($file,$content);
						fclose($file);
					} else {
						// an error happened
					}
				}
				if($modelMyMovieMovie->poster_original!='' && $validator->validateValue($modelMyMovieMovie->poster_original))
				{
					try {
						$content = @file_get_contents($modelMyMovieMovie->poster_original);
						if ($content !== false) {
							//$file = fopen("/.". $setting->path_images."/".$modelMyMovieMovie->Id.".jpg", 'w');
							$file = fopen("/var/www/workspace/PelicanoC/images/".$modelMyMovieMovie->Id.".jpg", 'w');							
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
	
				if($modelMyMovieMovie->backdrop_original!='' && $validator->validateValue($modelMyMovieMovie->backdrop_original))
				{
					try {
						$content = @file_get_contents($modelMyMovieMovie->backdrop_original);
						if ($content !== false) {
							//$file = fopen($setting->path_images."/".$modelMyMovieMovie->Id."_bd.jpg", 'w');
							$file = fopen("/var/www/workspace/PelicanoC/images/".$modelMyMovieMovie->Id."_bd.jpg", 'w');
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
				
				$modelMyMovieMovie->save();
				$modelNzb->ready = 1;
				$modelNzb->save();
				
				$transaction->commit();
				
			} catch (Exception $e) {
				$transaction->rollback();
			}
		}
	}
	
	function actionUpdateStateMovies($file_name) {
		$setting = Setting::getInstance();
		
		$criteria=new CDbCriteria;
		$criteria->addCondition('t.downloaded = 0 and t.downloading = 1 ');		
		$arrayNbz = Nzb::model()->findAll($criteria);

		
		foreach ($arrayNbz as $modelNzb)
		{
			$modelNzb->downloading = 0;
			$modelNzb->downloaded = 1;
			if(strpos($modelNzb->file_name,$file_name)===false)
			{
				$modelNzb->downloading = 1;
				$modelNzb->downloaded = 0;						
			}
			if($modelNzb->downloaded)
			{
				$nzbMovieState= new NzbMovieState;
				$nzbMovieState->Id_nzb = $modelNzb->Id;
				$nzbMovieState->Id_movie_state = 3;				
				$nzbMovieState->save();
				
				$pelicanoCliente = new Pelicano;
				$request = new MovieStateRequest;
				$request->id_customer = $setting->getId_Customer();
				$request->id_movie = $modelNzb->Id;
				$request->date = time();				
				$request->id_state = 3;//downloaded
				$requests[]=$request;
				$status = $pelicanoCliente->setMovieState($requests);				
			}
			$modelNzb->save();							
		}
		return 0;
	}
}