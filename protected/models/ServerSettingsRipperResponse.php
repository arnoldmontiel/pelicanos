<?php

class ServerSettingsRipperResponse
{
	/**
	* @var string drive_letter
	* @soap
	*/
	public $drive_letter;
	
	/**
	* @var string temp_folder_ripping
	* @soap
	*/
	public $temp_folder_ripping;

	/**
	* @var string final_folder_ripping
	* @soap
	*/
	public $final_folder_ripping;
	
	/**
	* @var time time_from_reboot
	* @soap
	*/
	public $time_from_reboot;

	/**
	* @var time time_to_reboot
	* @soap
	*/
	public $time_to_reboot;
	
	/**
	* @var string my_movies_username
	* @soap
	*/
	public $mymovies_username;
	
	/**
	* @var string my_movies_password
	* @soap
	*/
	public $mymovies_password;
}