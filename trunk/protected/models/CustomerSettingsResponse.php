<?php

class CustomerSettingsResponse
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
	* @var integer id customer
	* @soap
	*/
	public $Id_customer;
	
	/**
	* @var integer id reseller
	* @soap
	*/
	public $Id_reseller;
	
	/**
	* @var string id device
	* @soap
	*/
	public $Id_device;
	
	/**
	* @var string name
	* @soap
	*/
	public $name;

	/**
	* @var string last_name
	* @soap
	*/
	public $last_name;
	
	/**
	* @var string address
	* @soap
	*/
	public $address;
	
	/**
	 * @var ConfigurationSOAP
	 * @soap
	 */
	public $Configuration;
	
	/**
	* @var UserSOAP[]
	* @soap
	*/
	public $Users;
}