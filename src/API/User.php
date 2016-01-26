<?php
namespace Instagram\API;

use Instagram\Instagram;

/**
 * User Endpoints
 * https://www.instagram.com/developer/endpoints/users
 */

class User
{

	public static function getInstance()
	{
		static $instance;
		$instance = ($instance === null) ? new self() : $instance;
		return $instance;
	}

	/**
	 * Get information about the owner of the access_token.
	 *
	 * @return Object
	 */

	public function self()
	{
		$endpoint = "users/self/";
		return Instagram::_call($endpoint);
	}	

	/**
	 * Get the most recent media published by 
	 * the owner of the access_token.
	 * @param array $params
	 *
	 * @return Object
	 */

	public function self_media($params=null)
	{
		$endpoint = "users/self/media/recent/";
		return Instagram::_call($endpoint,$params);
	}

	/**
	 * Get the list of recent media liked 
	 * by the owner of the access_token. 
	 * @param array $params
	 *
	 * @return Object
	 */

	public function self_liked($params=null)
	{
		$endpoint = "users/self/media/liked/";
		return Instagram::_call($endpoint,$params);
	}

	/**
	 * Get information about a user.
	 * @param string $uid
	 *
	 * @return Object
	 */

	public function user($uid)
	{
		$endpoint = "users/{$uid}/";
		return Instagram::_call($endpoint);
	}

	/**
	 * Get the most recent media published by a user.
	 * @param string $uid
	 * @param array  $params
	 *
	 * @return Object
	 */

	public function user_media($uid,$params)
	{
		$endpoint = "users/{$uid}/media/recent/";
		return Instagram::_call($endpoint);
	}

	/**
	 * Get a list of users matching the query.
	 * @param array  $params
	 *
	 * @return Object
	 */

	public function search($params)
	{
		$endpoint = "users/search";
		return Instagram::_call($endpoint,$params);
	}


}