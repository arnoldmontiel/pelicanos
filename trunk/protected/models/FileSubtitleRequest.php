<?php

class FileSubtitleRequest 
{
	
	/**
	* @var string language
	* @soap
	*/
	public $language;
	
	/**
	* @var string short language
	* @soap
	*/
	public $short_language;
	
	/**
	 * @var string description
	 * @soap
	 */
	public $description;
	
	/**
	 * @var string type
	 * @soap
	 */
	public $type;
	
}