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
				$request->id_customer = $setting->Id_customer;
				$request->id_movie = $modelNzb->Id;
				$request->date = time();				
				$request->id_state = 3;//downloaded
				$status = $pelicanoCliente->setMovieState($request);				
			}
			$modelNzb->save();							
		}
		return 0;
	}
}