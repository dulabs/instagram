<?php

if(!isset($_COOKIE["instagram_token"]) && empty($_COOKIE["instagram_token"]))
{
	echo "No Access Token Was Found";
	exit;
}


include_once(__DIR__.'/src/bootstrap.php');

use Instagram\Instagram;

$token = $_COOKIE["instagram_token"];
Instagram::setAccessToken($token);

/* get current user info

 $response = Instagram::user()->self();
 print_r($response);

 */

/* Search User

 $response = Instagram::user()->search(['q' => 'jelly']);
 print_r($response);

 */

/* Get Current User Media

 $response = Instagram::user()->self_media();

 print_r($response);
 */

 

/* Get Follows

 $response = Instagram::relationship()->follows();
 
 print_r($response);

 */

 /* 
 
 Get Users who like a media 
 @param string $media_id

 $response = Instagram::like()->users("1052787763161649701_44077099");
 print_r($response);
*/

