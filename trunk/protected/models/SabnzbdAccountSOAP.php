<?php

class SabnzbdAccountSOAP
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
	* @var string Server Name
	* @soap
	*/
	public $server_name;
	
	/**
	 * @var string Username
	 * @soap
	 */
	public $username;
	
	/**
	 * @var string Password
	 * @soap
	 */
	public $password;
	
	/**
	 * @var string Name
	 * @soap
	 */
	public $name;
	
	/**
	 * @var string Host
	 * @soap
	 */
	public $host;
	
	/**
	 * @var integer Enable
	 * @soap
	 */
	public $enable;
	
	/**
	 * @var string Fill Server
	 * @soap
	 */
	public $fill_server;
	
	/**
	 * @var integer Connections
	 * @soap
	 */
	public $connections;
	
	/**
	 * @var integer SSL
	 * @soap
	 */
	public $ssl;
	
	/**
	 * @var integer Time Out
	 * @soap
	 */
	public $timeout;
	
	/**
	 * @var integer Optional
	 * @soap
	 */
	public $optional;
	
	/**
	 * @var integer Port
	 * @soap
	 */
	public $port;
	
	/**
	* @var integer Retention
	* @soap
	*/
	public $retention;
	
	/**
	* @var string Id_device
	* @soap
	*/
	public $Id_device;
}