<?php
class MyMovieAudioTrackSOAP
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
	 * @var string language
	 * @soap
	 */
	public $language;

	/**
	 * @var string type
	 * @soap
	 */
	public $type;

	/**
	 * @var string chanel
	 * @soap
	 */
	public $chanel;
}