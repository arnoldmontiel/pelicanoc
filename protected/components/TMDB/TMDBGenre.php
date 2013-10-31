<?php
/**
 * Helper class to hold the Genre Info API calls
 *
 * @link http://help.themoviedb.org/kb/api/genre-info
 */
class TMDBGenre extends Asset {

  public static $type = 'genre';

  public function __construct($data, $language=null){
    if(is_number($data)){
      $this->id = $data;
      $db = TMDBApi::getInstance();
      $data = $this->l1st($language);
    }
    parent::__construct($data);
  }

  /**
   * @link http://help.themoviedb.org/kb/api/genre-list
   */
  public function l1st($language=null){
    $db = TMDBApi::getInstance();
    $info = $db->info(self::$type, $this->id, 'list', array('language'=>$language));
    return $info;
  }

  /**
   * @link http://help.themoviedb.org/kb/api/genre-movies
   */
  public function movies($language=null, $page=1){
    $db = TMDBApi::getInstance();
    $movies = array();
    $info = $db->info(self::$type, $this->id, 'movies', array('language'=>$language, 'page'=>$page));
    foreach($info->results as $index => $movie){
      $movies[$movie->id] = new Movie($movie);
    }
    return $movies;
  }

}
