<?php

class SeasonResponse 
{

	/**
	 * 
	 * Set SeasonResponse model with attributes from Nzb model (using imdbdataTv related too).
	 * @param Nab $modelSeason
	 */
	public function setAttributes($modelSeason)
	{
		//set season attributes
		$attributesArray = $modelSeason->attributes;
		while ($value = current($attributesArray)) {
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
	
	/**
	* @var string imdbID
	* @soap
	*/
	public $Id_imdbdata_tv;
	
	/**
	* @var integer season
	* @soap
	*/
	public $season;
	
	/**
	* @var integer episodes
	* @soap
	*/
	public $episodes;
}