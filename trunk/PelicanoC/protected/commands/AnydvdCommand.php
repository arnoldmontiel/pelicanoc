<?php
class AnydvdCommand extends CConsoleCommand  {
	/*
	 * @return 0: It was an error, 1:It was success
	 */
	function actionUpdateStateMovies() 
	{
		$_COMMAND_NAME = "downloadAnydvdUpdate";
		
		$modelCommandStatus = CommandStatus::model()->findByAttributes(array('command_name'=>$_COMMAND_NAME));

		if(isset($modelCommandStatus))
		{
			try 
			{
				$validator = new CUrlValidator();
				
				$setting = Setting::getInstance();
				
				$anydvdVersions = AnydvdVersion::model()->findAllByAttributes(array('downloaded'=>0));
				
				$donwload_path = dirname(__FILE__).'/../.'.$setting->path_anydvd_download.'/';
				
				foreach ($anydvdVersions as $item)
				{
						
					$transaction = $item->dbConnection->beginTransaction();
						
					try {
				
						$modelMyMovieMovie = MyMovieMovie::model()->findByPk($modelNzb->Id_my_movie_movie);
				
						if($item->download_link!='' && $validator->validateValue($setting->host_name.$setting->host_path.$item->download_link))
						{
							try {
								$content = @file_get_contents($setting->host_name.$setting->host_path.$item->download_link);
								if ($content !== false) {
									//$file = fopen(dirname(__FILE__)."/../../".$setting->path_pending."/".$modelNzb->file_name, 'w');
									$file = fopen($donwload_path."/".$item->file_name, 'w');
									fwrite($file,$content);
									fclose($file);
								} else {
									// an error happened
								}
							} catch (Exception $e) {
								// an error happened
							}
						}
						$item->downloaded = 1;
						$item->save();
				
						$transaction->commit();
						PelicanoHelper::sendAnydvdVersionDownloaded($item->version);
						
					} catch (Exception $e) {
						$transaction->rollback();
					}
				}
				
				$modelCommandStatus->setBusy(false);
			} 
			catch (Exception $e) {
				$modelCommandStatus->setBusy(false);
			}

			//envio el estado de las peliculas al servidor
		}
	}
}