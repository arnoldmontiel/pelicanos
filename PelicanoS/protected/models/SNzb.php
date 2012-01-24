<?php

class SNzb extends CActiveRecord
{
	
	/**
	* @var integer link ID
	* @soap
	*/
	public $Id;

	/**
	* @var string description
	* @soap
	*/
	public $description;
	
	/**
	* @var string url
	* @soap
	*/
	public $url;
	
	/**
	* @var string file name
	* @soap
	*/
	public $file_name;
	
	/**
	* @var string url
	* @soap
	*/
	public $subt_url;
	
	/**
	 * @var string file name
	 * @soap
	 */
	public $subt_file_name;
	
}