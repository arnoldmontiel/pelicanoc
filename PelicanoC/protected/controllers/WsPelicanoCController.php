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
		$idImdb = $myMovies->LoadMovieById($idMyMovie);
		
		if(!empty($idImdb))
		{
			$this->saveRippedMovie($idImdb,$path);
		}
		return $idImdb;
	}

	private function getBackDropUrl($idImdb)
	{
		$result = $this->readTheMovieDBApi($idImdb);
		$jsonResult = json_decode($result);
		$url = "";
		foreach($jsonResult['0']->backdrops as $item )
		{
			if($item->image->size == 'original')
			{
				$url = $item->image->url;
				return $url;
			}
	
		}
		return $url;
	}
	
	private function saveRippedMovie($idImdb, $path)
	{
		$data = $this->readImdbApi($idImdb);
		$data = json_decode($data);
		if(isset($data))
		{
			$modelImdbdata = new Imdbdata();
				
			$transaction = $modelImdbdata->dbConnection->beginTransaction();
				
			try {
					
				$modelImdbdata->ID = $data->imdbID;
				$modelImdbdata->Year = $data->Year;
				$modelImdbdata->Title = $data->Title;
				$modelImdbdata->Rated = $data->Rated;
				$modelImdbdata->Released = $data->Released;
				$modelImdbdata->Genre = $data->Genre;
				$modelImdbdata->Director = $data->Director;
				$modelImdbdata->Writer = $data->Writer;
				$modelImdbdata->Actors = $data->Actors;
				$modelImdbdata->Plot = $data->Plot;
				$modelImdbdata->Runtime = $data->Runtime;
				$modelImdbdata->Rating = $data->imdbRating;
				$modelImdbdata->Votes = $data->imdbVotes;
				$modelImdbdata->Response = $data->Response;
				$modelImdbdata->Poster_original = $data->Poster;
	
				$validator = new CUrlValidator();
				$setting = Setting::getInstance();
	
				if($data->Poster!='' && $validator->validateValue($data->Poster))
				{
					try {
						$content = @file_get_contents($data->Poster);
						if ($content !== false) {
							$file = fopen($setting->path_images."/".$modelImdbdata->ID.".jpg", 'w');
							fwrite($file,$content);
							fclose($file);
							$modelImdbdata->Poster = $modelImdbdata->ID.".jpg";
						} else {
							// an error happened
						}
					} catch (Exception $e) {
						throw $e;
						// an error happened
					}
				}
	
				$modelImdbdata->Backdrop_original = $this->getBackDropUrl($idImdb);
				if($modelImdbdata->Backdrop_original!='' && $validator->validateValue($modelImdbdata->Backdrop_original))
				{
					try {
						$content = @file_get_contents($modelImdbdata->Backdrop_original);
						if ($content !== false) {
							$file = fopen($setting->path_images."/".$modelImdbdata->ID."_bd.jpg", 'w');
							fwrite($file,$content);
							fclose($file);
							$modelImdbdata->Backdrop = $modelImdbdata->ID."_bd.jpg";
						} else {
							// an error happened
						}
					} catch (Exception $e) {
						throw $e;
						// an error happened
					}
				}
	
				$modelImdbdata->save();
	
				$modelRippedMovie = new RippedMovie();
				$modelRippedMovie->Id_imdbdata = $modelImdbdata->ID;
				$modelRippedMovie->path = $path;
	
				$modelRippedMovie->save();
	
				$transaction->commit();
			} catch (Exception $e) {
				$transaction->rollback();
			}
		}
	}
	
	//for backdrop image
	private function readTheMovieDBApi($idImdb)
	{
		$url = "http://api.themoviedb.org/2.1/Movie.getImages/en/json/cb1fddfd86177c7df456045bddbbc762/". $idImdb;
	
		$fichero_url = fopen($url, "r");
		$texto = "";
		while ($trozo = fgets($fichero_url, 1024)){
			$texto .= $trozo;
		}
		return $texto;
	}
	
	//for imdb data
	private function readImdbApi($idImdb)
	{
		$url = "http://www.imdbapi.com/?i=". $idImdb;
	
		$fichero_url = fopen($url, "r");
		$texto = "";
		while ($trozo = fgets($fichero_url, 1024)){
			$texto .= $trozo;
		}
		return $texto;
	}
	
}
