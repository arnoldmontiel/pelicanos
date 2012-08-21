<?php

class UserStateRequest 
{

	
	
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
	* @var integer parental_control
	* @soap
	*/
	public $parental_control;

	/**
	* @var integer deleted
	* @soap
	*/
	public $deleted;
	
}