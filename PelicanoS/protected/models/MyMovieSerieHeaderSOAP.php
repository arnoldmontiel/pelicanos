<?php
class MyMovieSerieHeaderSOAP
{
	/**
	 * @var string Id
	 * @soap
	 */
	public $Id;

	/**
	 * @var string description
	 * @soap
	 */
	public $description;

	/**
	 * @var string poster_original
	 * @soap
	 */
	public $poster_original;

	/**
	 * @var string genre
	 * @soap
	 */
	public $genre;

	/**
	 * @var string name
	 * @soap
	 */
	public $name;

	/**
	 * @var string sort_name
	 * @soap
	 */
	public $sort_name;

	/**
	 * @var string rating
	 * @soap
	 */
	public $rating;

	/**
	 * @var string original_network
	 * @soap
	 */
	public $original_network;

	/**
	 * @var string original_status
	 * @soap
	 */
	public $original_status;

	/**
	 * @var MyMovieSeasonSOAP
	 * @soap
	 */
	public $myMovieSeason;
}