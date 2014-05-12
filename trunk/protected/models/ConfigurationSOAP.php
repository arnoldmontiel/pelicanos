<?php

class ConfigurationSOAP
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
	* @var string sabnzb_api_key
	* @soap
	*/
	public $sabnzb_api_key;
	
	/**
	* @var string sabnzb_api_url
	* @soap
	*/
	public $sabnzb_api_url;
	
	/**
	* @var string path_sabnzbd_download
	* @soap
	*/
	public $path_sabnzbd_download;
	
	/**
	* @var string path_pending
	* @soap
	*/
	public $path_pending;
	
	/**
	* @var string host_name
	* @soap
	*/
	public $host_name;
	
	/**
	* @var string path_ready
	* @soap
	*/
	public $path_ready;
	
	/**
	* @var string path_images
	* @soap
	*/
	public $path_images;
	
	/**
	* @var string path_shared
	* @soap
	*/
	public $path_shared;
	
	/**
	* @var string host_path
	* @soap
	*/
	public $host_path;
	
	/**
	* @var string host_file_server
	* @soap
	*/
	public $host_file_server;
	
	/**
	* @var string host_file_server_path
	* @soap
	*/
	public $host_file_server_path;
	
	/**
	* @var string tmdb_api_key
	* @soap
	*/
	public $tmdb_api_key;
	
	/**
	* @var string tmdb_lang
	* @soap
	*/
	public $tmdb_lang;
	
	/**
	 * @var string michael_jackson
	 * @soap
	 */
	public $michael_jackson;	
}