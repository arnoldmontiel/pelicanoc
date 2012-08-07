<?php

class WsPelicanoCController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	public function actions()
	{
		return array(
		            'wsdl'=>array(
		                'class'=>'CWebServiceAction',
// 					'classMap'=>array(
// 			                    'MovieResponse'=>'MovieResponse',  // or simply 'Post'
// 								'SerieResponse'=>'SerieResponse',  // or simply 'Post'
// 								'SeasonResponse'=>'SeasonResponse',
// 								'SerieStateRequest'=>'SerieStateRequest',
// 								'MovieStateRequest'=>'MovieStateRequest',
// 								'TransactionResponse'=>'TransactionResponse',
// 		),
		),
		);
	}

	/**
	 * Returns add new rip movie
	 * @param string idMyMovie
	 * @param string path
	 * @return string
	 * @soap
	 */
	public function addNewRipMovie($idMyMovie, $path)
	{
 		$myMovies = new MyMovies();		
		return $myMovies->LoadMovieById($idMyMovie);
	}

	
}
