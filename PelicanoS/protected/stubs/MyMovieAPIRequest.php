<?php
class MyMovieAPIRequest extends CFormModel
{
	
	public $Title; //string;
	public $Country; //string;
	public $Type; //string;
	public $Results; //int;
	public $Strict; //boolean;
	public $IncludeEnglish; //boolean;
	public $IncludeAdult; //boolean;
	public $Id; //string;
	public $Seasonnumber; //int;
	
	public function setAttributes($array)
	{
		//set array values
		$attributesArray = $array;
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
}