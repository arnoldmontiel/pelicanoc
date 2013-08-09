<?php
class NzbCommand extends CConsoleCommand  {
	/*
	 * @param file_name 
	 * @return 0: It was an error, 1:It was success
	 */
	
	
	function actionDownloadNzbFiles() 
	{
		$_COMMAND_NAME = "downloadNzbFiles";
		
		include dirname(__FILE__).'../../components/PelicanoHelper.php';
		
		$modelCommandStatus = CommandStatus::model()->findByAttributes(array('command_name'=>$_COMMAND_NAME));
		
		if(isset($modelCommandStatus))
		{
			try 
			{
				
				$validator = new CUrlValidator();
				$setting = Setting::getInstance();
				
				$arrayNbz = Nzb::model()->findAllByAttributes(array('ready'=>0));
				
				$img_path = dirname(__FILE__).'/../.'.$setting->path_images.'/';
				foreach ($arrayNbz as $modelNzb)
				{
						
					$transaction = $modelNzb->dbConnection->beginTransaction();
						
					try {
				
						$modelMyMovieNzb = MyMovieNzb::model()->findByPk($modelNzb->myMovieDiscNzb->Id_my_movie_nzb);
				
						if($modelNzb->url!='' && $validator->validateValue($setting->host_name.$setting->host_path.$modelNzb->url))
						{
							try {
								$content = @file_get_contents($setting->host_name.$setting->host_path.$modelNzb->url);
								if ($content !== false) {
									$fileName = dirname(__FILE__)."/../../".$setting->path_pending."/".$modelNzb->file_name;
									$file = fopen($fileName, 'w');
									
									//$file = fopen($setting->path_pending."/".$modelNzb->file_name, 'w');
									fwrite($file,$content);
									fclose($file);
									chmod($fileName, 0666);
									chown($fileName, "www-data");
									chgrp($fileName, "www-data");
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
								$file = fopen(dirname(__FILE__)."/../../".$setting->path_subtitle."/".$modelNzb->subt_file_name, 'w');
								//$file = fopen($setting->path_subtitle."/".$modelNzb->subt_file_name, 'w');
								fwrite($file,$content);
								fclose($file);
							} else {
								// an error happened
							}
						}
						if($modelMyMovieNzb->poster_original!='' && $validator->validateValue($modelMyMovieNzb->poster_original))
						{
							try {
								$content = @file_get_contents($modelMyMovieNzb->poster_original);
								if ($content !== false) {
									$file = fopen($img_path . $modelMyMovieNzb->Id.".jpg", 'w');
									fwrite($file,$content);
									fclose($file);
									$modelMyMovieNzb->poster = $modelMyMovieNzb->Id.".jpg";
								} else {
									// an error happened
								}
							} catch (Exception $e) {								
								// an error happened
							}
						}
				
						if($modelMyMovieNzb->backdrop_original!='' && $validator->validateValue($modelMyMovieNzb->backdrop_original))
						{
							try {
								$content = @file_get_contents($modelMyMovieNzb->backdrop_original);
								if ($content !== false) {
									$file = fopen($img_path . $modelMyMovieNzb->Id."_bd.jpg", 'w');
									fwrite($file,$content);
									fclose($file);
									$modelMyMovieNzb->backdrop = $modelMyMovieNzb->Id."_bd.jpg";
								} else {
									// an error happened
								}
							} catch (Exception $e) {
								// an error happened
							}
						}
				
						if(isset($modelNzb->myMovieDiscNzb->myMovieNzb->myMovieSerieHeader))
						{
							$modelSerie = MyMovieSerieHeader::model()->findByPk($modelNzb->myMovieDiscNzb->myMovieNzb->Id_my_movie_serie_header);
							
							if(isset($modelSerie))
							{
								if($modelSerie->poster_original!='' && $validator->validateValue($modelSerie->poster_original))
								{
									try {
										$content = @file_get_contents($modelSerie->poster_original);
										if ($content !== false) {
											$file = fopen($img_path . $modelSerie->Id.".jpg", 'w');
											fwrite($file,$content);
											fclose($file);
											$modelSerie->poster = $modelSerie->Id.".jpg";
											
											$modelSerie->save();
										} else {
											// an error happened
										}
									} catch (Exception $e) {										
										// an error happened
									}
								}
								
							 	$seasons = MyMovieSeason::model()->findAllByAttributes(array('Id_my_movie_serie_header'=>$modelSerie->Id, 'banner'=>null));
								foreach($seasons as $modelSeason)
								{
									$newFileName = $modelSeason->Id_my_movie_serie_header .'_'.$modelSeason->season_number;
									if($modelSeason->banner_original!='' && $validator->validateValue($modelSeason->banner_original))
									{
										try {
											$content = @file_get_contents($modelSeason->banner_original);
											if ($content !== false) {
												$file = fopen($img_path . $newFileName .".jpg", 'w');
												fwrite($file,$content);
												fclose($file);
												$modelSeason->banner = $newFileName .".jpg";
													
												$modelSeason->save();
											} else {
												// an error happened
											}
										} catch (Exception $e) {
											// an error happened
										}
									}
								}
							 
							}
						}
						
						$modelMyMovieNzb->save();
						$modelNzb->ready = 1;
						$modelNzb->save();
				
						$transaction->commit();
				
					} catch (Exception $e) {
						$transaction->rollback();						
					}
				}
				
				$modelCommandStatus->setBusy(false);
			} 
			catch (Exception $e) {
				$modelCommandStatus->setBusy(false);
			}

			//envio el estado de los nzb al servidor
			PelicanoHelper::sendPendingNzbStates();
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
			$modelNzb->Id_nzb_state = 3;
			$fileName = explode('.',$modelNzb->file_name);
			$fileName = $fileName[0];
			if(strpos($file_name,$fileName)===false)
			{
				$modelNzb->Id_nzb_state = 2;
				$modelNzb->downloading = 1;
				$modelNzb->downloaded = 0;						
			}
			if($modelNzb->downloaded)
			{
// 				$nzbMovieState= new NzbMovieState;
// 				$nzbMovieState->Id_nzb = $modelNzb->Id;
// 				$nzbMovieState->Id_movie_state = 3;				
// 				$nzbMovieState->save();
				
				$pelicanoCliente = new Pelicano;
				$request = new NzbStateRequest;
				$request->Id_device = $setting->Id_device;
				$request->Id_nzb = $modelNzb->Id;
				$request->change_state_date = time();				
				$request->Id_state = 3;//downloaded
								
				$requests[]=$request;
				$status = $pelicanoCliente->setNzbState($requests);				
			}
			$modelNzb->save();							
		}
		return 0;
	}
}