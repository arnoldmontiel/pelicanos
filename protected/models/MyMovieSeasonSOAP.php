<?php
class MyMovieSeasonSOAP
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
	 * @var integer season_number
	 * @soap
	 */
	public $season_number;

	/**
	 * @var string banner_original
	 * @soap
	 */
	public $banner_original;

	/**
	 * @var MyMovieEpisodeSOAP[]
	 * @soap
	 */
	public $Episode;

}