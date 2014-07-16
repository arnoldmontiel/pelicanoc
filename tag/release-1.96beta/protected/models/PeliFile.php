<?php

/**
 * This is the model class for table "PeliFile".
 *
 * The followings are the available columns in table 'resource':
 * @property array $attributes Attribute values indexed by attribute names.
 *  
 *
 */
class PeliFile extends CModel
{
	function __construct()
	{
		$this->imdb = '';
		$this->country = 'United States';
		$this->idDisc = '';
		$this->type = 'FOLDER';		
		$this->name = '';
		$this->season = '';
		$this->episodes = '';
		$this->source = '';
		$this->poster = '';		
		$this->year = '';
	}
	
	/**
	* @return array customized attribute labels (name=>label)
	*/
	public function attributeLabels()
	{
		return array(
					'imdb' => 'Imdb',
					'country' => 'Country',
					'idDisc' => 'Id Disc',
					'type' => 'Type',			
					'name' => 'Name',
					'season' => 'Season',
					'episodes' => 'Episodes',
					'source' => 'Source',
					'poster' => 'Poster',
					'year' => 'Year',
		);
	}
	
	/**
	* Returns the list of all attribute names of the model.
	* This would return all column names of the table associated with this AR class.
	* @return array list of attribute names.
	*/
	public function attributeNames()
	{
		return array_key();
	}
	
	/**
	* Set model attributes
	* @param Nab $model
	*/
	public function setAttributes($model)
	{
		//set attributes
		$attributesArray = $model->attributes;
		while (($value = current($attributesArray)) !== false) {
			$this->setAttribute(key($attributesArray), $value);
			next($attributesArray);
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
	
	public $imdb;
	public $country;
	public $idDisc;
	public $type;	
	public $name;
	public $season;
	public $episodes;
	public $source;
	public $poster;	
	public $year;
	
}