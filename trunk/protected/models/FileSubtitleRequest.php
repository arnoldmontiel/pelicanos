<?php

class FileSubtitleRequest 
{
	
	/**
	* @var string language
	* @soap
	*/
	public $language;
	
	/**
	* @var string codec
	* @soap
	*/
	public $codec;
	
	/**
	 * @var integer forced
	 * @soap
	 */
	public $forced;
	
}