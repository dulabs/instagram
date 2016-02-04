<?php
namespace Dulabs\Instagram;


class Instagram extends APIManager
{

	public function User()
	{
		return API\User::getInstance();
	}

	public function Relationship()
	{
		return API\Relationship::getInstance();
	}

	public function Media()
	{
		return API\Media::getInstance();
	}

	public function Comment()
	{
		return API\Comment::getInstance();
	}

	public function Like()
	{
		return API\Like::getInstance();
	}

	public function Tag()
	{
		return API\Tag::getInstance();
	}

	public function Location()
	{
		return API\Location::getInstance();
	}

}