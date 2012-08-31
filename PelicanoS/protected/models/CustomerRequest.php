<?php

class CustomerRequest 
{
	
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