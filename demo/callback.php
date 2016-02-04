<?php
require_once(__DIR__.'/../vendor/autoload.php');

use Dulabs\Instagram\OAuthManager as OAuth;

// remove it and change with your api at below.
include_once(__DIR__.'/key.php');

//$config['api_key'] = "";
//$config['api_secret'] = "";
$config['callback_url'] = "http://localhost/instagram/callback.php";
$config['response_type'] = OAuth::RESPONSE_TYPE_CODE;

// We need to configure OAuth
$oauth = new OAuth();
$oauth->setConfig($config);

if(isset($_GET['code']) && !empty($_GET['code']))
{
	$token = $oauth->getAccessToken();
	setcookie("instagram_token",$token,time()+3600);
	header("location: demo.php");
}
