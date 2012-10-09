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
					
							$transaction = $modelNzb->dbConnection->beginTransaction();
							try {
								$modelMyMovieMovie->save();
								$modelNzb->Id_my_movie_movie = $modelMyMovieMovie->Id;
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