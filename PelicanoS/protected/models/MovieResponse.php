<?php

class MovieResponse 
{

	/**
	 * 
	 * Set MovieResponse model with attributes from Nzb model (using myMovieMovie related too).
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
		
		//set myMovieMovie attributes
		$attributesArray = $modelNzb->myMovieMovie->attributes;
		while (($value = current($attributesArray)) !== false) {
			if(key($attributesArray) != 'Id')
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
	* @var integer id nzb
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
	* @var string id myMovie
	* @soap
	*/
	public $Id_my_movie_movie;
	
	//----------------------------My Movie Fields---------------------------------------
	
		
	/**
	* @var integer id parental control
	* @soap
	*/
	public $Id_parental_control;

	/**
	* @var string local title
	* @soap
	*/
	public $local_title;

	/**
	* @var string original title
	* @soap
	*/
	public $original_title;
	
	/**
	* @var string sort title
	* @soap
	*/
	public $sort_title;
				
	/**
	* @var string production year
	* @soap
	*/
	public $production_year;
	
	/**
	* @var string running time
	* @soap
	*/
	public $running_time;
	
	/**
	* @var string description
	* @soap
	*/
	public $description;
	
	/**
	* @var string parental rating description
	* @soap
	*/
	public $parental_rating_desc;
	
	/**
	* @var string id imdb
	* @soap
	*/
	public $imdb;
	
	/**
	* @var string rating
	* @soap
	*/
	public $rating;
	
	/**
	* @var string rating votes
	* @soap
	*/
	public $rating_votes;
	
	/**
	* @var string genre
	* @soap
	*/
	public $genre;
	
	/**
	* @var string studio
	* @soap
	*/
	public $studio;
	
	/**
	* @var string poster original
	* @soap
	*/
	public $poster_original;
		
	/**
	* @var string backdrop original
	* @soap
	*/
	public $backdrop_original;
	
	/**
	* @var integer adult
	* @soap
	*/
	public $adult;
	
	/**
	* @var string extra features
	* @soap
	*/
	public $extra_features;
	
	/**
	* @var string country
	* @soap
	*/
	public $country;
	
	/**
	* @var string video standard
	* @soap
	*/
	public $video_standard;
	
	/**
	* @var string release date
	* @soap
	*/
	public $release_date;
	
	/**
	* @var string bar code
	* @soap
	*/
	public $bar_code;
	
	/**
	* @var string type
	* @soap
	*/
	public $type;

}