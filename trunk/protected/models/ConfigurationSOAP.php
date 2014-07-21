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
	* @var string Sabnzbd API Key
	* @soap
	*/
	public $sabnzb_api_key;
	
	/**
	 * @var string Servidor Multimedia IP
	 * @soap
	 */
	public $host_file_server;
	
	/**
	 * @var string Servidor Multimedia Path Archivos
	 * @soap
	 */
	public $host_file_server_path;
	
	/**
	 * @var string Servidor Multimedia Usuario
	 * @soap
	 */
	public $host_file_server_user;
	
	/**
	 * @var string Servidor Multimedia Password
	 * @soap
	 */
	public $host_file_server_passwd;
	
	/**
	 * @var string Servidor Multimedia Nombre
	 * @soap
	 */
	public $host_file_server_name;
	
	/**
	 * @var integer Is Movie Tester
	 * @soap
	 */
	public $is_movie_tester;
	
	/**
	 * @var string host_name
	 * @soap
	 */
	public $host_name;
	
	/**
	 * @var string michael_jackson
	 * @soap
	 */
	public $michael_jackson;
	
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
	 * @var integer disc_min_size_warning
	 * @soap
	 */
	public $disc_min_size_warning;
	
	/**
	 * @var SabnzbdAccountSOAP[]
	 * @soap
	 */
	public $SabnzbdAccounts;
	
	/**
	 * @var PlayerSOAP[]
	 * @soap
	 */
	public $Players;	
	
	/**
	 * @var MarketCategorySOAP[]
	 * @soap
	 */
	public $MarketCategories;
}