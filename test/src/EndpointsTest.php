<?php
namespace Dulabs\Instagram\Test;

require_once(__DIR__."/../../vendor/autoload.php");

use Dulabs\Instagram\Instagram;

class EndpointsTest extends \PHPUnit_Framework_TestCase
{

	public function testUserEndpoint()
	{
		$i = new Instagram();
		$this->assertInternalType('object',$i->user());
	}

	public function testLikeEndpoint()
	{
		$i = new Instagram();
		$this->assertInternalType('object',$i->like());
	}

	public function testRelationshipStringEndpoint()
	{
		$i = new Instagram();
		$this->assertInternalType('string',$i->relationship());
	}
	
	public function testRelationshipEndpoint()
	{
		$i = new Instagram();
		$this->assertInternalType('object',$i->relationship());
	}

	public function testUserSelf()
	{
		$i = new Instagram();
		$i->setAccessToken($token);
		$this->assertInternalType('method',$i->user()->self());
	}
}