<?php
class NzbCommand extends CConsoleCommand  {
	/*
	 * @param file_name 
	 * @return 0: It was an error, 1:It was success
	 */
	
	
	function actionDownloadNzbFiles() 
	{
		include dirname(__FILE__).'../../components/PelicanoHelper.php';
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
			
					if($modelNzb->url!='')
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
					
					if(!isset($modelNzb->nzb)) // SOLO SI ES PADRE
					{
						$modelMyMovieNzb = MyMovieNzb::model()->findByPk($modelNzb->myMovieDiscNzb->Id_my_movie_nzb);
						
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
						
						if($modelMyMovieNzb->big_poster_original!='' && $validator->validateValue($modelMyMovieNzb->big_poster_original))
						{
							try {
								$content = @file_get_contents($modelMyMovieNzb->big_poster_original);
								if ($content !== false) {
									$file = fopen($img_path . $modelMyMovieNzb->Id."_big.jpg", 'w');
									fwrite($file,$content);
									fclose($file);
									$modelMyMovieNzb->big_poster = $modelMyMovieNzb->Id."_big.jpg";
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
					}						
					$modelNzb->ready = 1;
					$modelNzb->save();

					//envio el estado de los nzb al servidor
					PelicanoHelper::sendPendingNzbStates();
					
					$transaction->commit();
			
				} catch (Exception $e) {
					$transaction->rollback();						
				}
			}
			$setting = Setting::getInstance();
			
			if($setting->is_movie_tester)
			{
				//si es movie tester separo todos los nzb padres e hijos, todos los hijos
				//seran padres y heredaran la meta data.
				PelicanoHelper::prepareNZBtoMovieTester();
			}				
		} 
		catch (Exception $e) {
		}			
	}
	
	function actionUpdateStateMovies($file_name) 
	{
		PelicanoHelper::updateStateMovies($file_name);
	}
}