<?php

class RippedRequest 
{	
	
	/**
	* @var MyMovieSOAP 
	* @soap
	*/
	public $myMovie;
	
	/**
	* @var MyMovieDiscSOAP
	* @soap
	*/
	public $myMovieDisc;

	/**
	* @var date ripped_date
	* @soap
	*/
	public $ripped_date;
	
	/**
	* @var string Id_device
	* @soap
	*/
	public $Id_device;
	
}