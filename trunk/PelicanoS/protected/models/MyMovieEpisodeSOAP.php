<?php
class MyMovieEpisodeSOAP
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
	 * @var integer episode_number
	 * @soap
	 */
	public $episode_number;

	/**
	 * @var string description
	 * @soap
	 */
	public $description;

	/**
	 * @var string name
	 * @soap
	 */
	public $name;
}