<?php

class NzbResponse 
{
	function __construct()
	{
		$this->nzb = new NzbSOAP;
		$this->myMovie = new MyMovieSOAP;
		$this->myMovieDisc = new MyMovieDiscSOAP;		
	}
	
	/**
	* @var NzbSOAP
	* @soap
	*/
	public $nzb;
	
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
	 * @var integer[]
	 * @soap
	 */
	public $MarketCategories;	

}