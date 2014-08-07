<?php
class ConsumptionSOAP
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
	 * @var integer Id nzb
	 * @soap
	 */
	public $Id_nzb;
	
	/**
	 * @var integer points
	 * @soap
	 */
	public $points;

	/**
	 * @var string date
	 * @soap
	 */
	public $date;

	/**
	 * @var integer aready paid
	 * @soap
	 */
	public $already_paid;

}