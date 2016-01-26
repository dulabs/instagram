<?php
namespace Instagram\API;

use Instagram\Instagram;

/**
 * Like Endpoints
 * https://www.instagram.com/developer/endpoints/likes
 */

class Like
{

	public static function getInstance()
	{
		static $instance;
		$instance = ($instance === null) ? new self() : $instance;
		return $instance;
	}

	/**
	 * Get a list of users who have liked this media.
	 * @param string $media
	 *
	 * @return Object
	 */

	public function users($media)
	{
		$endpoint = "media/{$media}/likes";
		return Instagram::_call($endpoint);
	}

	/**
	 * Set a like on a media
	 * @param string $media
	 *
	 * @return Object
	 */

	public function post($media)
	{
		$endpoint = "media/{$media}/likes";
		return Instagram::_call($endpoint,null,"POST");
	} 

	/**
	 * Remove a like on this media
	 * @param string $media
	 *
	 * @return Object
	 */

	public function remove($media)
	{
		$endpoint = "media/{$media}/likes";
		return Instagram::_call($endpoint,null,"DELETE");
	}

}