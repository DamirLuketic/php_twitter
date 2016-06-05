<?php

include 'config.php';
include 'vendor/autoload.php';

use plava\AltoRouter;

$router = new AltoRouter();

$lolwat = 'php_twitter/public/';
$router->setBasePath($lolwat);


$router->map('GET','/register', function(){
	include 'register.php';
});

$router->map('POST','/register', function(){
	include 'register.php';
});

$router->map('GET','/login', function(){
	include 'login.php';
});

$router->map('POST','/login', function(){
	include 'login.php';
});


$router->map('GET','/logout', function(){
	include 'logout.php';
});




$router->map('GET','/update_data', function(){
	include 'user/user_update.php';
});

$router->map('POST','/update_data', function(){
	include 'user/user_update.php';
});

$router->map('GET','/create_post', function(){
	include 'user/user_create_post.php';
});

$router->map('POST','/create_post', function(){
	include 'user/user_create_post.php';
});

$router->map('GET','/users', function(){
	include 'user/user_people.php';
});

$router->map('POST','/users', function(){
	include 'user/user_people.php';
});

$router->map('GET','/MyPost', function(){
	include 'user/user_my_post.php';
});

$router->map('POST','/MyPost', function(){
	include 'user/user_my_post.php';
});

$router->map('GET','/FollowPost', function(){
	include 'user/user_follow_post.php';
});

$router->map('POST','/FollowPost', function(){
	include 'user/user_follow_post.php';
});



$router->map('GET','/userDetails', function(){
	include 'user/user_person.php';
});



$match = $router->match();

if ($match && is_callable($match['target'])){
	call_user_func_array($match['target'], $match['params']);
}else{
	header($_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found');
}


?>