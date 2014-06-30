<?php

class PlayerSOAP
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
	* @var integer Id
	* @soap
	*/
	public $Id;
	
	/**
	* @var string Description
	* @soap
	*/
	public $description;
	
	/**
	 * @var string Url
	 * @soap
	 */
	public $url;
	
	/**
	 * @var integer Type
	 * @soap
	 */
	public $type;

	/**
	 * @var string File Protocol
	 * @soap
	 */
	public $file_protocol;
	
	/**
	* @var string Id_device
	* @soap
	*/
	public $Id_device;
}