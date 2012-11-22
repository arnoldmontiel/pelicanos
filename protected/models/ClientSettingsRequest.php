<?php


class ClientSettingsRequest 
{
	/**
	* @var string Id_device
	* @soap
	*/
	public $Id_device;
	
	/**
	* @var string ip v4
	* @soap
	*/
	public $ip_v4;
	
	/**
	* @var integer port number used with ip v4
	* @soap
	*/
	public $port_v4;

	/**
	* @var string ip v6
	* @soap
	*/
	public $ip_v6;
	
	/**
	* @var integer port number used with ip v6
	* @soap
	*/
	public $port_v6;
}