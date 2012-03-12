<?php

class SerieStateRequest 
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
	* @var integer customer
	* @soap
	*/
	public $id_Customer;
	
	/**
	* @var integer serieNzb
	* @soap
	*/
	public $id_SerieNzb;
	
	/**
	* @var integer state
	* @soap
	*/
	public $id_State;
	
	/**
	* @var integer date
	* @soap
	*/
	public $date;
	
	/**
	* @var integer idImdb
	* @soap
	*/
	public $id_Imdb;
}