<?php //var_dump($movies);
$moviesList = array();
$first = true;
foreach ($movies as $movie)
{
	if($first===true)
	{
		$first = $movie->id;
	}
	$date = date_parse($movie->release_date);
	$moviesList[$movie->id]=$movie->original_title." (".$date['year'].")";
}
echo CHtml::radioButtonList("movie",$first,$moviesList,
		array('labelOptions'=>array('style'=>'display:inline;')
		));
echo "<br>";

?>
