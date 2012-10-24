<?php
class MyMovieSOAP
{
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
	
	/**
	* @var string Id
	* @soap
	*/
	public $Id;
	
	/**
	* @var string type
	* @soap
	*/
	public $type;

	/**
	* @var string bar_code
	* @soap
	*/
	public $bar_code;
	
	/**
	* @var string country
	* @soap
	*/
	public $country;
	
	/**
	* @var string local_title
	* @soap
	*/
	public $local_title;
	
	/**
	* @var string original_title
	* @soap
	*/
	public $original_title;
	
	/**
	* @var string sort_title
	* @soap
	*/
	public $sort_title;
	
	/**
	* @var string aspect_ratio
	* @soap
	*/
	public $aspect_ratio;
	
	/**
	* @var string video_standard
	* @soap
	*/
	public $video_standard;
	
	/**
	* @var string production_year
	* @soap
	*/
	public $production_year;
	
	/**
	* @var string release_date
	* @soap
	*/
	public $release_date;
	
	/**
	* @var string running_time
	* @soap
	*/
	public $running_time;
	
	/**
	* @var string description
	* @soap
	*/
	public $description;
	
	/**
	* @var string extra_features
	* @soap
	*/
	public $extra_features;
	
	/**
	* @var string parental_rating_desc
	* @soap
	*/
	public $parental_rating_desc;
	
	/**
	* @var string imdb
	* @soap
	*/
	public $imdb;
	
	/**
	* @var string rating
	* @soap
	*/
	public $rating;
	
	/**
	* @var string data_changed
	* @soap
	*/
	public $data_changed;
	
	/**
	* @var string covers_changed
	* @soap
	*/
	public $covers_changed;
	
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
	* @var string poster_original
	* @soap
	*/
	public $poster_original;
	
	/**
	* @var string backdrop_original
	* @soap
	*/
	public $backdrop_original;
	
	/**
	* @var integer adult
	* @soap
	*/
	public $adult;
	
	/**
	* @var integer Id_parental_control
	* @soap
	*/
	public $Id_parental_control;
}

class MyMovieDiscSOAP
{	
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
	
	/**
	 * @var string Id
	 * @soap
	 */
	public $Id;
	
	/**
	 * @var string name
	 * @soap
	 */
	public $name;
	
	/**
	* @var string Id_my_movie
	* @soap
	*/
	public $Id_my_movie;
}

class RippedRequest 
{	
	
	/**
	* @var MyMovieSOAP 
	* @soap
	*/
	public $myMovie;
	
	/**
	* @var MyMovieDiscSOAP
	* @soap
	*/
	public $myMovieDisc;

	/**
	* @var date ripped_date
	* @soap
	*/
	public $ripped_date;
	
	/**
	* @var string Id_device
	* @soap
	*/
	public $Id_device;
	
}