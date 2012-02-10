<?php
class NzbCommand extends CConsoleCommand  {
	/*
	 * @param file_name 
	 * @return 0: It was an error, 1:It was success
	 */
	function actionUpdateStateMovies($file_name) {
		$setting = Setting::getInstance();
		
		$criteria=new CDbCriteria;
		$criteria->addCondition('t.downloaded = 0 and t.downloading = 1 ');		
		$arrayNbz = Nzb::model()->findAll($criteria);

		
		foreach ($arrayNbz as $modelNbz)
		{
			$modelNbz->downloading = 0;
			$modelNbz->downloaded = 1;
				if(strpos($modelNbz->file_name,$file_name)===false)
				{
					$modelNbz->downloading = 1;
					$modelNbz->downloaded = 0;						
				}
			if($modelNbz->downloaded)
			{
				$nzbMovieState= new NzbMovieState;
				$nzbMovieState->Id_nzb = $modelNbz->Id;
				$nzbMovieState->Id_movie_state = 3;				
				$nzbMovieState->save();
				
				$pelicanoCliente = new Pelicano;
				$request = new MovieStateRequest;
				$request->id_customer = $setting->Id_customer;
				$request->id_movie = $modelNbz->Id;
				$request->id_state = 3;//downloaded
				$status = $pelicanoCliente->setMovieState($request);				
			}
			$modelNbz->save();							
		}
		return 0;
	}
}