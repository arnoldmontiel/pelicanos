<?php

class LogRequest 
{
	
	/**
	* @var integer customer id
	* @soap
	*/
	public $Id_customer;

	/**
	* @var date log_date
	* @soap
	*/
	public $log_date;
	
	/**
	* @var string username
	* @soap
	*/
	public $username;
	
	/**
	* @var string description
	* @soap
	*/
	public $description;
	
	/**
	* @var integer log_type id
	* @soap
	*/
	public $Id_log_type;
	
	/**
	* @var integer Id_log_customer
	* @soap
	*/
	public $Id_log_customer;

}