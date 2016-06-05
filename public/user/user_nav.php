

<div class="large-2 columns">
    		<br />
				<br />
    		<img class="thumbnail"  src="<?php echo $_SESSION['profile_image'] ?>">
    		<br />
		<br />
<?php
	if(!isset($_COOKIE['user_id'])){
	header('location: index.php');
}
?>
<?php
				$user_pages = array(
						'../create_post'  => 'Create post',
						'../update_data'  => 'Update data',
						'../users'		  => 'Users',
						'../MyPost'		  => 'My post',
						'../FollowPost'	  => 'Follow post'
				);

				foreach($user_pages as $address => $name){
					echo '<a class="button" href="' . $path . 'user/' .$address . '">' . $name . '</a>';
				}
  		?>
  			</div>
