<?php
class PelicanoHelper
{
	static public function format_bytes($a_bytes) {
		if ($a_bytes < 1024) {
			return $a_bytes .' B';
		} elseif ($a_bytes < 1048576) {
			return round($a_bytes / 1024, 2) .' KB';
		} elseif ($a_bytes < 1073741824) {
			return round($a_bytes / 1048576, 2) . ' MB';
		} elseif ($a_bytes < 1099511627776) {
			return round($a_bytes / 1073741824, 2) . ' GB';
		} elseif ($a_bytes < 1125899906842624) {
			return round($a_bytes / 1099511627776, 2) .' TB';
		}
	}
	
	static public function format_kbytes($a_kbytes) {
		if ($a_kbytes < 1024) {
			return $a_kbytes .' KB';
		} elseif ($a_kbytes < 1048576) {
			return round($a_kbytes / 1024, 2) .' MB';
		} elseif ($a_kbytes < 1073741824) {
			return round($a_kbytes / 1048576, 2) . ' GB';
		} 
	}
	
	static public function getImageName($name, $posFix = "")
	{
		$pos = strpos($name, "?");
		$fileName=$name;
		if(($pos !== false))
		{
			$fileName=explode('?', $name);
			$fileName = $fileName[0];
		}
		$imagePath = "images/";
		$defaultImage = 'no_image'.$posFix.'.jpg';
		$imageName = $imagePath.$defaultImage;
		if(file_exists($imagePath.$fileName) && !empty($name))
			$imageName = $imagePath.$name;
	
		return $imageName;
	}
	
	static public function generateTicketPDF()
	{
		return "hola carola";
	}
}