<?php
class MyMovieSeasonSOAP
{
	/**
	 * @var integer season_number
	 * @soap
	 */
	public $season_number;

	/**
	 * @var string banner_original
	 * @soap
	 */
	public $banner_original;

	/**
	 * @var MyMovieEpisodeSOAP[]
	 * @soap
	 */
	public $Episode;

}