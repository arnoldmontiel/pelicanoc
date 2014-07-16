<?php
class SearchDiscResponse
{
	public $id;
	public $type;
	public $country;
	public $barcode;
	public $title;
	public $originalTitle;
	public $edition;
	public $year;
	public $imdb;
	public $discs;
	public $discname;
	public $thumbnail;
	public $thumbnailwidth;
	public $thumbnailheight; 
	public $bigthumbnail; 
	public $bigthumbnailwidth; 
	public $bigthumbnailheight; 
	public $completepercentage; 
	public $parentalRating; 
	public $score; 
	public $IsBoxSetParent; 
	public $IsDiscSetChild; 
	public $IsBoxSetConfirmed;
	
	public function setAttributes($xml)
	{
		//set xml attributes
		foreach($xml->attributes() as $key => $value) {
			$this->setAttribute($key, $value);
		}
	
	}
	
	
	public function setAttribute($name,$value)
	{
		if(property_exists($this,$name))
			$this->$name=$value;
		else
			return false;
		return true;
	}
}