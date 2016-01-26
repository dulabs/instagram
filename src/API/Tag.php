<?php
namespace Instagram\API;

use Instagram\Instagram;

/**
 * Tag Endpoints
 * https://www.instagram.com/developer/endpoints/tags
 */

class Tag
{

	public static function getInstance()
	{
		static $instance;
		$instance = ($instance === null) ? new self() : $instance;
		return $instance;
	}

	/**
	 * Get information about a tag object.
	 * @param string $name
	 *
	 * @return Object
	 */

	public function get($name)
	{
		$endpoint = "tags/{$name}";
		return Instagram::_call($endpoint);
	}

	/**
	 * Get a list of recently tagged media.
	 * @param string $name
	 * @param array  $params
	 *
	 * @return Object
	 */

	public function media($name,$params=null)
	{
		$endpoint = "tags/{$name}/media/recent";
		return Instagram::_call($endpoint,$params);
	}

	/**
	 * Search for tags by name.
	 * @param array  $params
	 *
	 * @return Object
	 */

	public function search($params)
	{
		$endpoint = "tags/search";
		return Instagram::_call($endpoint,$params);
	}

}