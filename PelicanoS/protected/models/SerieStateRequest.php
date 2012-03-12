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
	
	/**
	* @var integer customer
	* @soap
	*/
	public $id_customer;
	
	/**
	* @var integer serieNzb
	* @soap
	*/
	public $id_serieNzb;
	
	/**
	* @var integer state
	* @soap
	*/
	public $id_state;
	
	/**
	* @var integer date
	* @soap
	*/
	public $date;
	
	/**
	* @var integer idImdb
	* @soap
	*/
	public $id_imdb;
}