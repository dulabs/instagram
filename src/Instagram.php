<?php
namespace Instagram;


class Instagram extends APIManager
{

	public static function User()
	{
		return API\User::getInstance();
	}

	public static function Relationship()
	{
		return API\Relationship::getInstance();
	}

	public static function Media()
	{
		return API\Media::getInstance();
	}

	public static function Comment()
	{
		return API\Comment::getInstance();
	}

	public static function Like()
	{
		return API\Like::getInstance();
	}

	public static function Tag()
	{
		return API\Tag::getInstance();
	}

	public static function Location()
	{
		return API\Location::getInstance();
	}

}