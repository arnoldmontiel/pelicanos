<?php
class NzbSOAP
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
	* @var integer id nzb
	* @soap
	*/
	public $Id;
	
	/**
	* @var string url
	* @soap
	*/
	public $url;
	
	/**
	* @var string file name
	* @soap
	*/
	public $file_name;
	
	/**
	* @var string url
	* @soap
	*/
	public $subt_url;
	
	/**
	 * @var string file name
	 * @soap
	 */
	public $subt_file_name;
	
	/**
	* @var integer id resource type
	* @soap
	*/
	public $Id_resource_type;
	
	/**
	* @var integer deleted
	* @soap
	*/
	public $deleted;
	
	/**
	* @var integer points
	* @soap
	*/
	public $points;
	
	/**
	* @var string id disc
	* @soap
	*/
	public $Id_my_movie_disc_nzb;
	
	/**
	* @var string final content path
	* @soap
	*/
	public $final_content_path;
	
	/**
	 * @var integer id nzb
	 * @soap
	 */
	public $Id_nzb;
	
	/**
	 * @var integer id nzb type
	 * @soap
	 */
	public $Id_nzb_type;
	
	/**
	 * @var string mkv file name
	 * @soap
	 */
	public $mkv_file_name;
	
	/**
	 * @var string size
	 * @soap
	 */
	public $size;
	
	/**
	 * @var integer already downloaded
	 * @soap
	 */
	public $already_downloaded;
}