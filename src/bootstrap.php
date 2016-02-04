<?php

include_once(__DIR__.'/APIManager.php');
include_once(__DIR__.'/OAuthManager.php');

include_once(__DIR__.'/Instagram.php');

        // we've writen this code where we need
    function load($classname) {
        $filename = __DIR__.str_replace("Dulabs\Instagram\API\\","/API/",$classname) .".php";

        if(file_exists($filename)){

            include_once($filename);
        }
    }

spl_autoload_register(function($class){
	load($class);
});


