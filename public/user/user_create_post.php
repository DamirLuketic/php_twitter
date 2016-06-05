<?php

	if(!isset($_COOKIE['user_id'])){
	header('location: index.php');
} 
?>
<?php include __DIR__ . '/../config.php' ?>
<?php include __DIR__ . '/../vendor/autoload.php'; ?>
<!doctype html>
<html class="no-js" lang="en">
  <head>
  	<?php include __DIR__ . '/../head.php' ?>
  </head>
  <body>
	<?php include __DIR__ . '/../menu.php'; ?>
	 <div class="row">
	<?php include 'user_nav.php' ?>
	<?php
	

	
	if(isset($_POST['post']) && !empty($_POST['post'])){
		$insert_post = $con->prepare(' insert into posts(user, post_created, post) values
									   (:user, now(), :post)
									 ');
		$insert_post->execute(array(
							'user'   => $_COOKIE['user_id'],
							'post'   => $_POST['post']
							));
	}
	?>	
	<br />
	<br />
		<div class="large-10 columns">				
<div class="row">
		<form method="post">
			  <fieldset class="fieldset">
			  <legend>New post:</legend>
              <textarea name="post" cols="30" rows="7"></textarea>
          	  <input type="submit" value="submit" />
              </fieldset>
		</form>
</div>
		</div>
	</div>
	<?php include __DIR__ . '/../footer.php' ?>
	<?php include __DIR__ . '/../script.php' ?>    
  </body>
</html>