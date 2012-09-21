<?php
class SearchDiscRequest extends CFormModel
{
	
	public $Handshake; //string;
	public $Reference; //string;
	public $Title; //string;
	public $Country; //string;
	public $Type; //string;
	public $Results; //int;
	public $Strict; //boolean;
	public $IncludeEnglish; //boolean;
	public $IncludeAdult; //boolean;
	public $Locale; //int;
	
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