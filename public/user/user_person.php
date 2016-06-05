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
  	<?php

  	use plava\manageFollowing;

	$follow = new manageFollowing();
	
	$follow->con=$con;

	
	$follow->addFollowing();
	$follow->removeFollowing();	
	$try = $follow->following();
	

	
$info = $con->prepare(' select b.profile_image, a.display_name, a.nickname, a.personal_data
						from users as a 
						left join images as b on a.user_id = b.user
						where a.user_id = :user						
							   ');
$info->execute(array('user' => $_GET['user_id']));
$info = $info->fetch(PDO::FETCH_OBJ);



if(empty($info->profile_image)){
		$_SESSION['person_image'] = $path . 'img/user/default/user_default.png';
	}else{
		$_SESSION['person_image'] = $path . 'user/img/' . $_GET['user_id'] . '/profile/' .$info->profile_image;
	}
  	?>
	<?php include __DIR__ . '/../menu.php'; ?>
	 <div class="row">
	<?php include 'user_nav.php' ?>	
	<br />
	<br />
		<div class="large-10 columns">
		<br />
			<div class="row">
				<div class="large-12 columns">
					<div class="callout">
				 		<div class="row">
							<div class="large-7 columns">	
							<img class="thumbnail" height="120" width="120" src="<?php echo $_SESSION['person_image'] ?>">						
							</div>	
							<div class="large-5 columns">
							<h1><?php echo $info->display_name; ?></h1>
							<br />
							<h5 style="float: left;">Nickname: <?php echo $info->nickname; ?></h5><br />
							<div class="row" style="text-align: center">
				 				<br /><br />
				 			<h4><?php 
							if(!empty($try->follow)){
							echo '<form method="post">
							<input type="hidden" name="user_id" value="' . $_GET['user_id'] . '" />
							<button name="user_id_r" type="submit" value="' . $_GET['user_id'] . '">unfollow</button>
							 </form>'; 	
							}else{
							echo '<form method="post">
							<input type="hidden" name="user_id" value="' . $_GET['user_id'] . '" />
							<button name="user_id_a" type="submit" value="' . $_GET['user_id'] . '">follow</button>
							 </form>'; 	
							}
								?>
							</h4>
						<br /> 					 	
				</div>				
			</div>
			<br />
			<div class="row">
					<div class="large-12 columns">
						

						
						<ul class="tabs" data-tabs id="example-tabs">
						  <li class="tabs-title is-active"><a href="#panel1" aria-selected="true">Details</a></li>
						</ul>						
						<div class="tabs-content" data-tabs-content="example-tabs">
						  <div class="tabs-panel is-active" id="panel1">
						    <p><?php echo $info->personal_data; ?></p>						    
						  </div>
						</div>	
					</div>
				</div>
			</div>
		</div>		
	</div>
</div>
		</div>
	</div>
	<?php include __DIR__ . '/../footer.php' ?>
	<?php include __DIR__ . '/../script.php' ?>    
  </body>
</html>
