# New Instagram API

Wrapper for new Instagram API 

# Installation

Download branch master
https://github.com/dulabs/new-instagram-api/archive/master.zip

See index.php to auth user with instagram.

See callback.php to get access token.

# Login

`<?php
require_once(__DIR__.'/../vendor/autoload.php');

use Dulabs\Instagram\OAuthManager as OAuth;

// remove it and change with your api at below.
include_once(__DIR__.'/key.php');

//$config['api_key'] = "";
//$config['api_secret'] = "";
$config['callback_url'] = "http://localhost/instagram/demo/callback.php";
$config['response_type'] = OAuth::RESPONSE_TYPE_CODE;

$oauth = new OAuth();
$oauth->setConfig($config);

// Define scopes here
?>
<a href="<?php echo $oauth->login(['basic','public_content','follower_list']); ?>">Login to Instagram</a>`
