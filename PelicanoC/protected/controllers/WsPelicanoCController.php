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
	 * Returns add new rip movie
	 * @param string idMyMovie
	 * @param string path
	 * @param boolean parental_control
	 * @return boolean result
	 * @soap
	 */
	public function addNewRipMovie($idMyMovie, $path, $parental_control)
	{
		
		$model = RippedMovie::model()->findByAttributes(array('Id_my_movie'=>$idMyMovie));
		
		if(isset($model)) // check if movie is already ripped
		{	
			$model->delete();
			MyMovie::model()->deleteByPk($idMyMovie);
		}

 		$myMoviesAPI = new MyMoviesAPI();		
		
		$result = $myMoviesAPI->LoadDiscTitleById($idMyMovie);
		if($result)
		{
			$this->saveRippedMovie($idMyMovie, $path, $parental_control);
			RippedMovie::sincronizeWithServer();
		}
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
	* @param string idMyMovie
	* @return boolean alreadyRipped
	* @soap
	*/
	public function isAlreadyRipped($idMyMovie)
	{
		$model = RippedMovie::model()->findByAttributes(array('Id_my_movie'=>$idMyMovie));
		if(isset($model)) // check if movie is already ripped
		{
			return true;
		}
		return false;
	}
	
	
	private function saveRippedMovie($idMyMovie, $path, $parental_control)
	{
		
		$modelRippedMovie = new RippedMovie();
		$modelRippedMovie->path = $path;
		$modelRippedMovie->Id_my_movie = $idMyMovie;
		$modelRippedMovie->parental_control = (int)$parental_control;
		if($modelRippedMovie->save())
			return true;
		
		return false;

	}
	
}
