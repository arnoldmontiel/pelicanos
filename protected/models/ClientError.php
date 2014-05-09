<?php
class ClientError
{
	/**
	 * Set model attributes
	 * @param ClientError $model
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
	 * @var integer error_type
	 * @soap
	 */
	public $error_type;

	/**
	 * @var integer has_error
	 * @soap
	 */
	public $has_error;

	/**
	 * @var date log_date
	 * @soap
	 */
	public $log_date;
}