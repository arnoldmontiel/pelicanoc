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
	 * @param boolean parentalControl
	 * @param string idDisc
	 * @return boolean result
	 * @soap
	 */
	public function addNewRipMovie($idMyMovie, $path, $parentalControl, $idDisc)
	{
	
		$result = RipperHelper::saveRipped($idMyMovie, $path, $parentalControl, $idDisc);
		
		if($result)
			RippedMovie::sincronizeWithServer();
		
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
	
}
