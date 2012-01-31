<?php

class MovieResponse 
{

	/**
	 * 
	 * Set MovieResponse model with attributes from Nzb model (using imdbdata related too).
	 * @param Nab $modelNzb
	 */
	public function setAttributes($modelNzb)
	{
		//set nzb attributes
		$attributesArray = $modelNzb->attributes;
		while ($value = current($attributesArray)) {
			$this->setAttribute(key($attributesArray), $value);
			next($attributesArray);
		}
		
		//set imdbdata attributes
		$attributesArray = $modelNzb->imdbData->attributes;
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
	* @var integer link ID
	* @soap
	*/
	public $Id;
	
	/**
	* @var string url
	* @soap
	*/
	public $url;
	
	/**
	* @var string file name
	* @soap
	*/
	public $file_name;
	
	/**
	* @var string url
	* @soap
	*/
	public $subt_url;
	
	/**
	 * @var string file name
	 * @soap
	 */
	public $subt_file_name;
	
	/**
	* @var string id imdb
	* @soap
	*/
	public $ID;
	
	/**
	* @var string title
	* @soap
	*/
	public $Title;
	
	/**
	* @var string year
	* @soap
	*/
	public $Year;
	
	/**
	* @var string rated
	* @soap
	*/
	public $Rated;
	
	/**
	* @var string released
	* @soap
	*/
	public $Released;
	
	/**
	* @var string genre
	* @soap
	*/
	public $Genre;
	
	/**
	* @var string director
	* @soap
	*/
	public $Director;
	
	/**
	* @var string writer
	* @soap
	*/
	public $Writer;
	
	/**
	* @var string actors
	* @soap
	*/
	public $Actors;
	
	/**
	* @var string plot
	* @soap
	*/
	public $Plot;
	
	/**
	* @var string poster
	* @soap
	*/
	public $Poster;
	
	/**
	* @var string runtime
	* @soap
	*/
	public $Runtime;
	
	/**
	* @var string rating
	* @soap
	*/
	public $Rating;
	
	/**
	* @var string votes
	* @soap
	*/
	public $Votes;
	
	/**
	* @var string response
	* @soap
	*/
	public $Response;
}