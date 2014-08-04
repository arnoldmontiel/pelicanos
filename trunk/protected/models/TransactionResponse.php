<?php

class TransactionResponse 
{

	/**
	 * 
	 * Set TransactionResponse model with attributes from CustomerTRansaction model
	 * @param Nab $modelTransaction
	 */
	public function setAttributes($modelTransaction)
	{
		//set attributes
		$attributesArray = $modelTransaction->attributes;
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
	* @var integer Id_customer
	* @soap
	*/
	public $Id_customer;
	
	/**
	* @var integer points
	* @soap
	*/
	public $points;
	
	/**
	* @var string description
	* @soap
	*/
	public $description;
	
}