<?php
namespace Instagram\API;

use Instagram\Instagram;

/**
 * Relationship Endpoints
 * https://www.instagram.com/developer/endpoints/relationships
 */

class Relationship
{

	public static function getInstance()
	{
		static $instance;
		$instance = ($instance === null) ? new self() : $instance;
		return $instance;
	}

	/**
	 * Get the list of users this user follows.
	 *
	 * @return Object
	 */

	public function follows()
	{
		$endpoint = "users/self/follows";
		return Instagram::_call($endpoint);
	}	

	/**
	 * Get the list of users this user is followed by. 
	 *
	 * @return Object
	 */

	public function followedby()
	{
		$endpoint = "users/self/followed-by";
		return Instagram::_call($endpoint);
	}

	/**
	 * List the users who have requested 
	 * this user's permission to follow.
	 *
	 * @return Object
	 */

	public function requestedby()
	{
		$endpoint = "users/self/requested-by";
		return Instagram::_call($endpoint);
	}

	/**
	 * Get information about a relationship to another user.
	 * @param string $uid
	 *
	 * @return Object
	 */

	public function get($uid)
	{
		$endpoint = "users/{$uid}/relationship";
		return Instagram::_call($endpoint);
	}

	/**
	 * Modify the relationship between 
	 * the current user and the target user. 
	 * @param string $uid
	 * @param array  $params
	 *
	 * @return Object
	 */

	public function post($uid,$params)
	{
		$endpoint = "users/{$uid}/relationship";
		return Instagram::_call($endpoint,$params);
	}

	
}