<?php
class UserSOAP
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
	 * @var integer adult_section
	 * @soap
	 */
	public $adult_section;
	
	/**
	* @var string email
	* @soap
	*/
	public $email;
	
	/**
	* @var integer deleted
	* @soap
	*/
	public $deleted;
	
	/**
	 * @var date birth_date
	 * @soap
	 */
	public $birth_date;
}