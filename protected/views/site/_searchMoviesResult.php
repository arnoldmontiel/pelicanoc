<?php 
foreach ($movies as $movie)
{
	$date = date_parse($movie->release_date);
	$date = " (".$date['year'].")";
	echo "<a id='".$movie->id."' href='#' class='list-group-item'>".$movie->original_title.$date."</a>";
}

// $moviesList = array();
// $first = true;
// foreach ($movies as $movie)
// {
// 	if($first===true)
// 	{
// 		$first = $movie->id;
// 	}
// 	$date = date_parse($movie->release_date);
// 	$moviesList[$movie->id]=$movie->original_title." (".$date['year'].")";
// }
// echo CHtml::radioButtonList("movie",$first,$moviesList,
// 		array('labelOptions'=>array('style'=>'display:inline;')
// 		));
// echo "<br>";

?>
