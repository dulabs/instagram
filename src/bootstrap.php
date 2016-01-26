<?php
include_once(__DIR__.'/APIManager.php');
include_once(__DIR__.'/OAuthManager.php');

spl_autoload_register(function($class){
	Instagram\APIManager::load($class);
});

include_once(__DIR__.'/Instagram.php');

