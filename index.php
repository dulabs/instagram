<?php
include_once(__DIR__.'/src/bootstrap.php');

use Instagram\OAuthManager as OAuth;

// remove it and change with your api at below.
include_once(__DIR__.'/key.php');

//$config['api_key'] = "";
//$config['api_secret'] = "";
$config['callback_url'] = "http://localhost/instagram/callback.php";
$config['response_type'] = OAuth::RESPONSE_TYPE_CODE;

OAuth::setConfig($config);

// Define scopes here
?>
<a href="<?php echo OAuth::login(['basic','public_content','follower_list']); ?>">Login Instagram</a>