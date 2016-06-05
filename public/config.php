<?php

@session_start();

$path = '/php_twitter/public/';

$mysql_host = "localhost";
$mysql_database = "php_twitter";
$mysql_user = "XXXXXXXXXXX";
$mysql_password = "XXXXXXXXXXX";

include 'vendor/autoload.php';

use Illuminate\Database\Capsule\Manager as Capsule;

$capsule = new Capsule;

$capsule->addConnection([
	'driver' 	=> 'mysql',
	'host'   	=> $mysql_host,
	'database' 	=> $mysql_database,
	'table'		=> 'users',
	'username' 	=> $mysql_user,
	'password' 	=> $mysql_password,
	'charset'  	=> 'utf8',
	'collation' => 'utf8_croatian_ci',
	'prefix'	=> '',	
]);

$capsule->setAsGlobal();

$db = $capsule;

///////////////////////

try{

	$con = new PDO(
	"mysql:host=" . $mysql_host . ";dbname=" . $mysql_database,
	$mysql_user,
	$mysql_password,
	array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
		  PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")
	);
}catch(PDOException $e){
		switch ($e->getCode()) {
			case 2002:
				echo 'MySQL server is not on given address';
				break;
			case 1049:
				echo 'Wrong database name';
				break;
			case 1045:
				echo 'Wrong user name and/or password';
				break;
			default:
				echo $e->getCode();
				break;
		}
	exit;
}

?>