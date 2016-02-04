<?php
namespace Dulabs\Instagram\API;

use Dulabs\Instagram\Instagram;

/**
 * Location Endpoints
 * https://www.instagram.com/developer/endpoints/locations
 */

class Location
{

	public function getInstance()
	{
		static $instance;
		$instance = ($instance === null) ? new self() : $instance;
		return $instance;
	}

	/**
	 * Get information about a location.
	 * @param string $location_id
	 *
	 * @return Object
	 */

	public function get($location_id)
	{
		$endpoint = "locations/{$location_id}";
		return $this->_call($endpoint);
	}

	/**
	 * Get a list of recent media objects from a given location.
	 * @param string $location_id
	 * @param array  $params
	 *
	 * @return Object
	 */

	public function media($location_id,$params=null)
	{
		$endpoint = "locations/{$location_id}/media/recent";
		return $this->_call($endpoint,$params);
	}

	/**
	 * Search for a location by geographic coordinate.
	 * @param array  $params
	 *
	 * @return Object
	 */

	public function search($params)
	{
		$endpoint = "locations/search";
		return $this->_call($endpoint,$params);
	}

}