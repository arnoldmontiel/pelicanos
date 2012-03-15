<?php

class SerieResponse 
{

	/**
	 * 
	 * Set SerieResponse model with attributes from Nzb model (using imdbdataTv related too).
	 * @param Nab $modelNzb
	 */
	public function setAttributes($modelNzb)
	{
		//set nzb attributes
		$attributesArray = $modelNzb->attributes;
		while (($value = current($attributesArray)) !== false) {	
			$this->setAttribute(key($attributesArray), $value);
			next($attributesArray);
		}
		
		//set imdbdata attributes
		$attributesArray = $modelNzb->imdbDataTv->attributes;
		while (($value = current($attributesArray)) !== false) {
			$this->setAttribute(key($attributesArray), $value);
			next($attributesArray);
		}
	}
	
	//set serie header information
	public function setHeaderAttributes($modelImdbdataTv)
	{
		//set imdbdata attributes
		$attributesArray = $modelImdbdataTv->attributes;
		while (($value = current($attributesArray)) !== false) {
			$this->setAttribute(key($attributesArray), $value);
			next($attributesArray);
		}
	}
	
	public function setSeasons($seasons)
	{
		//set imdbdata attributes
		foreach ($seasons as $item)
		{
			$seasonResp = new SeasonResponse;
			$seasonResp->setAttributes($item);
			$this->arrSeason[] = $seasonResp;
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
	* @var integer id resource type
	* @soap
	*/
	public $Id_resource_type;
	
	/**
	* @var integer deleted
	* @soap
	*/
	public $deleted;
	
	/**
	 * @var integer points
	 * @soap
	 */
	public $points;
	
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
	
	/**
	* @var string backdrop
	* @soap
	*/
	public $Backdrop;

	/**
	* @var integer Season
	* @soap
	*/
	public $Season;
	
	/**
	* @var integer Episode
	* @soap
	*/
	public $Episode;
	
	/**
	* @var string Id_parent
	* @soap
	*/
	public $Id_parent;
	
	/**
	* @var SeasonResponse[] seasons
	* @soap
	*/
	public $arrSeason = array();
}