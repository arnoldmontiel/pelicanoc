<?php

class MyMovieNzbController extends Controller
{
	public function actionIndex()
	{
		$this->updateFromServer();
		$this->render('index');
	}

	public function updateFromServer()
	{
		
		$_COMMAND_NAME = "downloadNzbFiles";
		
		$modelCommandStatus = CommandStatus::model()->findByAttributes(array('command_name'=>$_COMMAND_NAME));
		
		if(isset($modelCommandStatus))
		{
			if(!$modelCommandStatus->busy)
			{
				//PelicanoHelper::sendPendingNzbStates();
				try
				{
					
					$modelCommandStatus->setBusy(true);
					$requests = array();
					$setting = Setting::getInstance();
					$pelicanoCliente = new Pelicano;
					$NzbResponseArray = $pelicanoCliente->getNewNzbs($setting->getId_Device());
					foreach ($NzbResponseArray as $item) 
					{
						try {
// 							$modelNzb = Nzb::model()->findByPk($nzbResponse->nzb->Id);
// 							if(!isset($modelNzb))
// 							{
// 								$modelNzb = new Nzb;
// 							}
// 							$modelMyMovieNzb = MyMovieNzb::model()->findByPk($nzbResponse->myMovie->Id);
// 							if(!isset($modelMyMovieNzb))
// 							{
// 								$modelMyMovieNzb = new MyMovieNzb;
// 							}
// 							if($nzbResponse->nzb->deleted)
// 							{
// 								if(!$modelNzb->isNewRecord)
// 								{
// 									if(!$modelNzb->downloading||!$modelNzb->downloaded)
// 									{
// 										$modelMyMovieMovie->delete();
// 										//$modelNzb->delete();
// 										$nzbMovieState= new NzbMovieState;
// 										$nzbMovieState->Id_nzb = $modelNzb->Id;
// 										$nzbMovieState->Id_movie_state = 6;
// 										$nzbMovieState->Id_device = $setting->getId_Device();
					
// 										$nzbMovieState->save();
// 										continue;
// 									}
// 								}
// 								else
// 								{
// 									$nzbMovieState= new NzbMovieState;
// 									$nzbMovieState->Id_nzb = $nzbResponse->nzb->Id;
// 									$nzbMovieState->Id_movie_state = 6;
// 									$nzbMovieState->Id_device = $setting->getId_Device();
										
// 									$nzbMovieState->save();
// 									continue;
// 								}
					
// 							}
							
							$idSeason = null;
						
							//si es serie guardo la serie y la temporada
							if(isset($item->myMovie->myMovieSerieHeader))
							{
								//grabo serie
								$modelMyMovieSerieHeader = MyMovieSerieHeader::model()->findByPk($item->myMovie->myMovieSerieHeader->Id);
								if(!isset($modelMyMovieSerieHeader))
								{
									$modelMyMovieSerieHeader = new MyMovieSerieHeader();
								}
								
								$modelMyMovieSerieHeader->setAttributesByArray($item->myMovie->myMovieSerieHeader);
								$modelMyMovieSerieHeader->save();
								
									
								//grabo temporada
								$modelMyMovieSeason = MyMovieSeason::model()->findByAttributes(array(
																	'Id_my_movie_serie_header'=>$item->myMovie->myMovieSerieHeader->Id,
																	'season_number'=>$item->myMovie->myMovieSerieHeader->myMovieSeason->season_number,
								));
							
								if(!isset($modelMyMovieSeason))
								{
									$modelMyMovieSeason = new MyMovieSeason();
								}
								
								$modelMyMovieSeason->setAttributesByArray($item->myMovie->myMovieSerieHeader->myMovieSeason);
								$modelMyMovieSeason->Id_my_movie_serie_header = $item->myMovie->myMovieSerieHeader->Id;
								$modelMyMovieSeason->save();
								$idSeason = $modelMyMovieSeason->Id;
									
							}
							
							//grabo la info de la caja (my movie)
							$modelMyMovieNzb = MyMovieNzb::model()->findByPk($item->myMovie->Id);
							if(!isset($modelMyMovieNzb))
							{
								$modelMyMovieNzb = new MyMovieNzb();
							}
							
							$modelMyMovieNzb->setAttributesByArray($item->myMovie);
							$modelMyMovieNzb->save();
							
							//grabo el disco
							$idDisc = null;
							$modelMyMovieDiscNzb = MyMovieDiscNzb::model()->findByPk($item->myMovieDisc->Id);
							if(!isset($modelMyMovieDiscNzb))
							{
								$modelMyMovieDiscNzb = new MyMovieDiscNzb();
							}
							$modelMyMovieDiscNzb->setAttributesByArray($item->myMovieDisc);
							$modelMyMovieDiscNzb->save();
							$idDisc = $modelMyMovieDiscNzb->Id;
							
							//si es serie genero relacion con los episodios y el disco
							//y grabo el id de header en la tabla myMovie
							if(isset($idSeason) && isset($idDisc))
							{
							
								$modelMyMovieNzb = MyMovieNzb::model()->findByPk($item->myMovie->Id);
								$modelMyMovieNzb->Id_my_movie_serie_header = $item->myMovie->myMovieSerieHeader->Id;
								$modelMyMovieNzb->is_serie = 1;
								$modelMyMovieNzb->save();
									
								//grabo episodios
								$episodes = $item->myMovie->myMovieSerieHeader->myMovieSeason->Episode;
								foreach($episodes as $episode)
								{
									$modelMyMovieEpisode = MyMovieEpisode::model()->findByAttributes(array(
																									'Id_my_movie_season'=>$idSeason,
																									'episode_number'=>$episode->episode_number,
									));
							
									$idEpisode = null;
									if(!isset($modelMyMovieEpisode))
									{
										$modelMyMovieEpisode = new MyMovieEpisode();
									}
									$modelMyMovieEpisode->setAttributesByArray($episode);
									$modelMyMovieEpisode->Id_my_movie_season = $idSeason;
									$modelMyMovieEpisode->save();
									$idEpisode = $modelMyMovieEpisode->Id;
							
									if(isset($idEpisode))
									{
										$modelDiscEpisodeNzb = DiscEpisodeNzb::model()->findByAttributes(array(
																					'Id_my_movie_episode'=>$idEpisode,
																					'Id_my_movie_disc_nzb'=>$idDisc,
										));
											
										if(!isset($modelDiscEpisodeNzb))
										{
											$modelDiscEpisodeNzb = new DiscEpisodeNzb();
											$modelDiscEpisodeNzb->Id_my_movie_disc_nzb = $idDisc;
											$modelDiscEpisodeNzb->Id_my_movie_episode = $idEpisode;
											$modelDiscEpisodeNzb->save();
										}
									}
							
								}
							}
							
							//grabo el nzb
							$modelNzb = Nzb::model()->findByPk($item->nzb->Id);
							if(!isset($modelNzb))
							{
								$modelNzb = new Nzb();
							}
							$modelNzb->setAttributesByArray($item->nzb);					
													
					
							$transaction = $modelNzb->dbConnection->beginTransaction();
							try {
								$modelNzb->Id_my_movie_disc_nzb = $idDisc;
								$modelNzb->date = date("Y-m-d H:i:s",time());
								$modelNzb->ready = 0;
								$modelNzb->save();
									
								$nzbMovieState= new NzbMovieState;
								$nzbMovieState->Id_nzb = $modelNzb->Id;
								$nzbMovieState->Id_movie_state = 1;
								$nzbMovieState->Id_device = $setting->getId_Device();
					
								$nzbMovieState->save();
					
								$transaction->commit();
					
							} catch (Exception $e) {
								$transaction->rollback();
								$modelCommandStatus->setBusy(false);
							}
						} catch (Exception $e) {
							$modelCommandStatus->setBusy(false);
						}
					}
					
					$countReady = Nzb::model()->countByAttributes(array('ready'=>0));
					$sys = strtoupper(PHP_OS);
					
					if($countReady>0)
					{
						if(substr($sys,0,3) == "WIN")
						{
							$WshShell = new COM('WScript.Shell');
							$oExec = $WshShell->Run(dirname(__FILE__).'/../commands/shell/downloadNzbFiles', 0, false);
						}
						else
						{
							exec(dirname(__FILE__).'/../commands/shell/downloadNzbFiles >/dev/null&');
						}
					}
					else
					{
						$modelCommandStatus->setBusy(false);
					}
				}
				catch (Exception $e) {
					$modelCommandStatus->setBusy(false);
				}	
				
			}
		}
				
	}

	public function actionAjaxStartDownload()
	{
		if(isset($_POST['Id_nzb']))
		{
			$nzb = Nzb::model()->findByPk($_POST['Id_nzb']);
			if(!$nzb->downloading)
			{
				$setting = Setting::getInstance();
				try
				{
// 					if(copy($setting->path_pending.'/'.$nzb->file_name, $setting->path_ready.'/'.$nzb->file_name))
// 					{
// 					}
						$nzb->downloaded = 0;
						$nzb->downloading = 1;
						$nzb->save();
	
						$nzbMovieState= new NzbMovieState;
						$nzbMovieState->Id_nzb = $nzb->Id;
						$nzbMovieState->Id_movie_state = 2;
						$setting=Setting::getInstance();
						$nzbMovieState->Id_device = $setting->getId_Device();
						$nzbMovieState->save();
	
						//we send the new state to the server
						$pelicanoCliente = new Pelicano;
						$request= new MovieStateRequest;
						$request->Id_device= $setting->getId_Device();
						$request->Id_nzb =$nzb->Id;
						$request->Id_state =2;
						$request->date = time();
						$requests[]=$request;
						$status = $pelicanoCliente->setMovieState($requests);
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