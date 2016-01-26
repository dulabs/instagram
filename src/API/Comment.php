<?php
namespace Instagram\API;

use Instagram\Instagram;

/**
 * Comment Endpoints
 * https://www.instagram.com/developer/endpoints/comments
 */

class Comment
{

	public static function getInstance()
	{
		static $instance;
		$instance = ($instance === null) ? new self() : $instance;
		return $instance;
	}

	/**
	 * Get a list of recent comments on a media object. 
	 * @param string $media
	 *
	 * @return Object
	 */

	public function comments($media)
	{
		$endpoint = "media/{$media}/comments";
		return Instagram::_call($endpoint);
	}

	/**
	 * Create a comment on a media object
	 * @param string $media
	 * @param array  $params
	 *
	 * @return Object
	 */

	public function post($media,$params)
	{
		$endpoint = "media/{$media}/comments";
		return Instagram::_call($endpoint,$params,"POST");
	} 

	/**
	 * Remove a comment either on the authenticated user's media object or authored by the authenticated user.
	 * @param string $media
	 * @param string $comment_id
	 *
	 * @return Object
	 */

	public function remove($media,$comment_id)
	{
		$endpoint = "media/{$media}/comments/{$comment_id}";
		return Instagram::_call($endpoint,null,"DELETE");
	}

}