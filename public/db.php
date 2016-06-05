<?php

include 'config.php';
include 'vendor/autoload.php';

$results = $db::select('select * from users');
print_r($results);


?>