<?php include __DIR__ . '/config.php'; ?>

<meta charset="utf-8" />
<meta http-equiv="x-ua-compatible" content="ie=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Project | Welcome</title>
<link rel="stylesheet" href="<?php echo $path; ?>css/foundation.css" />
<link rel="stylesheet" href="<?php echo $path; ?>css/app.css" />
<?php

// Setting background picture is set inside header (with CSS).


	if(isset($_COOKIE['user_id'])){	
	
	include 'config.php';	
	
	$cover = $db::select(" select cover_image from images where user = :user", array('user' => $_COOKIE['user_id']));

	if(empty($cover[0]->cover_image)){
		 $cov =  $path . 'img/user/default/cover_default.png';
	}else{
		$cov =  $path . 'user/img/' . $_COOKIE['user_id'] . '/cover/' . $cover[0]->cover_image;
		}
			}else{
					$cov =  $path . 'img/user/default/cover_default.png';
				}
?>

<style>
	 body { 
 	background-image: url(<?php echo $cov; ?>);
	background-position: 50% 50%;
	background-size: 100% 100%;
	background-repeat: no-repeat;
 	}
</style>