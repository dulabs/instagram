<?php
namespace Instagram\API;

use Instagram\Instagram;

/**
 * Media Endpoints
 * https://www.instagram.com/developer/endpoints/media
 */

class Media
{

	public static function getInstance()
	{
		static $instance;
		$instance = ($instance === null) ? new self() : $instance;
		return $instance;
	}

	/**
	 * Get information about a media object.
	 * @param string $media
	 *
	 * @return Object
	 */

	public function get($media)
	{
		$endpoint = "media/{$media}";
		return Instagram::_call($endpoint);
	}

	/**
	 * A media object's shortcode can be found in its shortlink URL.
	 * An example shortlink is http://instagram.com/p/tsxp1hhQTG/.
	 * Its corresponding shortcode is tsxp1hhQTG.
	 * @param string $shortcode
	 *
	 * @return Object
	 */

	public function shortcode($shortcode)
	{
		$endpoint = "media/shortcode/{$shortcode}";
		return Instagram::_call($endpoint);
	} 

	/**
	 * Search for recent media in a given area.
	 * @param array $params
	 *
	 * @return Object
	 */

	public function search($params)
	{
		$endpoint = "media/search";
		return Instagram::_call($endpoint,$params);
	}

}