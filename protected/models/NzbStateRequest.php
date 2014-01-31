<?php

class NzbStateRequest 
{
	
	/**
	* @var string device id
	* @soap
	*/
	public $Id_device;
	
	/**
	* @var integer nzb id
	* @soap
	*/
	public $Id_nzb;
	
	/**
	* @var integer state id
	* @soap
	*/
	public $Id_state;
	
	/**
	* @var integer change_state_date
	* @soap
	*/
	public $change_state_date;
	
}