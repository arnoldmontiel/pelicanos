<?php

class UserStateRequest 
{

	/**
	* @var integer id customer
	* @soap
	*/
	public $Id_customer;
	
	/**
	* @var string username
	* @soap
	*/
	public $username;
	
	/**
	* @var string password
	* @soap
	*/
	public $password;
	
	/**
	* @var string email
	* @soap
	*/
	public $email;
	
	/**
	* @var integer adult_section
	* @soap
	*/
	public $adult_section;

	/**
	* @var integer deleted
	* @soap
	*/
	public $deleted;
	
	/**
	* @var date birth_date
	* @soap
	*/
	public $birth_date;
	
}