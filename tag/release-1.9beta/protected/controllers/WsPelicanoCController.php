<?php

class WsPelicanoCController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */

	public function actions()
	{
		return array(
		            'wsdl'=>array(
		                'class'=>'CWebServiceAction',
		),
		);
	}

	/**
	 * 
	 * Set current disc IN
	 * @param string $idDisc
	 * @return integer idCurrent
	 * @soap
	 */
	public function setCurrentDiscIn($idDisc)
	{
		$idCurrent = 0;
		
		//Por las dudas paso todos los registros de la tabla a estado 1 = Out Disc (Sin disco)
		$criteria=new CDbCriteria;
		$criteria->condition = 'Id_current_disc_state <> 1';		
		
		CurrentDisc::model()->updateAll(array('Id_current_disc_state'=>1, 
												'out_date'=>new CDbExpression('NOW()')), 
												$criteria);
		//---------
		
// 		$modelCurrentDisc = new CurrentDisc();
// 		$modelCurrentDisc->Id_current_disc_state = 2; // Pending Data
// 		$modelCurrentDisc->Id_my_movie_disc = $idDisc;
		
// 		$modelMyMovieDisc = MyMovieDisc::model()->findByAttributes(array('Id'=>$idDisc));
// 		if(isset($modelMyMovieDisc))
// 			$modelCurrentDisc->Id_current_disc_state = 3; // Width Data	
		
// 		if($modelCurrentDisc->save())
// 			$idCurrent = $modelCurrentDisc->Id;
		
		$idCurrent = 0;
		RipperHelper::saveCurrentDiscData($idDisc);
		
		$modelCurrentDisc = new CurrentDisc();
		$modelCurrentDisc->Id_current_disc_state = 3; // Width Data
		$modelCurrentDisc->Id_my_movie_disc = $idDisc;
					
		if($modelCurrentDisc->save())
			$idCurrent = $modelCurrentDisc->Id;
		
		return $idCurrent;	
	}
	
	/**
	*
	* Set current disc OUT
	* @param string $id
	* @return bool success
	* @soap
	*/
	public function setCurrentDiscOut($id)
	{
		$modelCurrentDisc = CurrentDisc::model()->findByPk($id);
		
		if(isset($modelCurrentDisc))
		{
			$modelCurrentDisc->Id_current_disc_state = 1; // Disc Out
			$modelCurrentDisc->out_date = new CDbExpression('NOW()');
			if($modelCurrentDisc->save())
				return true;
		}
		return false;
	}
	
	/**
	*
	* Set current command
	* @param string $id
	* @return integer command
	* @soap
	*/
	public function getCurrentCommand($id)
	{
		$command = 0;
		$modelCurrentDisc = CurrentDisc::model()->findByPk($id);
	
		if(isset($modelCurrentDisc))
		{
			$command = $modelCurrentDisc->command;
		}
		
		return $command;
	}
	
	/**
	 * Returns add new rip movie
	 * @param string idMyMovie
	 * @param string path
	 * @param boolean parentalControl
	 * @param string idDisc
	 * @return boolean result
	 * @soap
	 */
	public function addNewRipMovie($idMyMovie, $path, $parentalControl, $idDisc)
	{
	
		$result = RipperHelper::saveRipped($idMyMovie, "/pelicano/ripped/".$path, $parentalControl, $idDisc);
		
		//Esto se hace en el heartbeat para mejorar performance
		// 		if($result)
		// 			RippedMovie::sincronizeWithServer();
		
		return $result;
	}
	
	/**
	* Log task or error
	* @param string username
	* @param string description
	* @param integer log_type
	* @return boolean result
	* @soap
	*/
	public function log($username, $description, $log_type)
	{
		$model = new Log();
		
		$model->username = $username;
		$model->description = $description;
		$model->Id_log_type = $log_type;
	
		$result = false;
		if($model->save())
		{
			$result = true;
		}
	
		return $result;
	}
	
	/**
	* Returns true if mymovieId is already ripped
	* @param string idDisc
	* @return boolean alreadyRipped
	* @soap
	*/
	public function isAlreadyRipped($idDisc)
	{
		$model = RippedMovie::model()->findByAttributes(array('Id_my_movie_disc'=>$idDisc));
		if(isset($model)) // check if movie is already ripped
		{
			return true;
		}
		return false;
	}
	
	/**
	* Set percentage
	* @param integer id
	* @param integer percentage
	* @return bool success
	* @soap
	*/
	public function setPercentage($id, $percentage)
	{
		$modelCurrentDisc = CurrentDisc::model()->findByPk($id);
	
		if(isset($modelCurrentDisc))
		{
			try {
	
				$modelCurrentDisc->percentage = $percentage;
				$modelCurrentDisc->save();
	
				return true;
			} catch (Exception $e) {
				return false;
			}
		}
		return false;
	
	}
	
}
