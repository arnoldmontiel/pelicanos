<?php
class MyMoviePersonSOAP
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
	 * @var string name
	 * @soap
	 */
	public $name;

	/**
	 * @var string type
	 * @soap
	 */
	public $type;

	/**
	 * @var string role
	 * @soap
	 */
	public $role;
	
	/**
	* @var string photo_original
	* @soap
	*/
	public $photo_original;
}