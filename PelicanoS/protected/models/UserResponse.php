<?php

class UserResponse 
{

	/**
	 * 
	 * Set UserResponse model with attributes from CustomerUsers model.
	 * @param custUsers $modelCustomerUsers
	 */
	public function setAttributes($modelCustomerUsers)
	{
		//set customerUsers attributes
		$attributesArray = $modelCustomerUsers->attributes;
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
	* @var string username
	* @soap
	*/
	public $username;
	
	/**
	* @var string password
	* @soap
	*/
	public $password;
	
	/**
	* @var string email
	* @soap
	*/
	public $email;
	
	/**
	* @var integer parental_control
	* @soap
	*/
	public $parental_control;

	/**
	* @var integer deleted
	* @soap
	*/
	public $deleted;
}