<?php

class CustomerRequest 
{
	/**
	* @var integer id
	* @soap
	*/
	public $Id;
	
	/**
	* @var integer id reseller
	* @soap
	*/
	public $Id_reseller;
	
	/**
	* @var string name
	* @soap
	*/
	public $name;

	/**
	* @var string last_name
	* @soap
	*/
	public $last_name;
	
	/**
	* @var string address
	* @soap
	*/
	public $address;
}