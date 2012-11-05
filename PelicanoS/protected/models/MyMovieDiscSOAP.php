<?php
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