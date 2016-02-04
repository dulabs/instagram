# New Instagram API

Wrapper for new Instagram API 

# Installation

Download branch master
https://github.com/dulabs/new-instagram-api/archive/master.zip

See index.php to auth user with instagram.

See callback.php to get access token.

# Login

```php 

require_once(__DIR__.'/../vendor/autoload.php');

use Dulabs\Instagram\OAuthManager as OAuth;

$config['api_key'] = "";
$config['api_secret'] = "";
$config['callback_url'] = "http://localhost/instagram/demo/callback.php";
$config['response_type'] = OAuth::RESPONSE_TYPE_CODE;

$oauth = new OAuth();

// initialiaze config
$oauth->setConfig($config);

// define scopes
$loginurl = $oauth->login(['basic','public_content','follower_list']);

header("location: ".$loginurl);
```

# Callback

```php
require_once(__DIR__.'/../vendor/autoload.php');

use Dulabs\Instagram\OAuthManager as OAuth;

$config['api_key'] = "";
$config['api_secret'] = "";
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
```