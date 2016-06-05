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
	<?php 

	
	
use plava\uploadPictures;

$images = new uploadPictures();
$images->con=$con;
$images->uploadPictures();

use plava\updatePersonalData;

$update = new updatePersonalData();
$update->con=$con;
$update->updatePersonalData();
	?>
	
    <div class="row">
    <?php include 'user_nav.php' ?>	
	<br />
	<br />

		<div class="large-10 columns">
			<form method="post">


        <div class="large-5 columns">
      <label>Name
        <input type="text" name="display_name" placeholder="Postoffice:"  value="<?php echo $_SESSION['display_name']; ?>" />
      </label>
    </div>
        <div class="large-4 columns">
      <label>Nickname
        <input type="text" name="nickname" placeholder="City:"  value="<?php echo $_SESSION['nickname']; ?>" />
      </label>
    </div>
       <div class="large-3 columns">
      <label>e-mail
        <input type="email" name="email" placeholder="State:" value="<?php echo $_SESSION['email']; ?>" />
      </label>
    </div>
        <div class="large-10 columns">
      <label>Personal
        <input type="text" name="personal_data" placeholder="personal:"  value="<?php echo $_SESSION['personal_data']; ?>" />
      </label>
    </div>
       <div class="large-2 columns">
       	<label>Update
		<p><input type="submit" value="Update" class="button expanded" /></p>
		</label> 
       </div>
        </form>
        <hr />
        <div class="large-12 columns"><div class="callout"><?php  echo isset($_SESSION['check']) ? $_SESSION['check'] : 'Please select.'; ?></div></div>
            <div class="large-6 columns">
          <form method="POST" enctype="multipart/form-data">  	
            	<label>Update profile picture     	
         <input type="file" name="image_profile" />
         <input type="submit"/>
         </label> 
      </form>       
	</div>
        <div class="large-6 columns">    	
	<form method="POST" enctype="multipart/form-data">
		<label>Update cover picture  
         <input type="file" name="image_cover" />
         <input type="submit"/>
        </label>
        <br />
      </form>
	</div>
    <hr />        
        <form method="post">
        <div class="large-6 columns"><br />
        <label>Password*</label>
          <input required="required" type="password" name="password" placeholder="Password:" />
        </div>
   		<div class="large-5 columns"><br />
        <label>Connfirm password*</label>
          <input required="required" type="password" name="password_confirm" placeholder="Password:" />
        </div>
       <div class="large-2 columns"><br />
       	<label>Update password
       	        <p><input type="submit" value="Update password" class="button expanded" /></p>
       	</label>         
       </div>
       </form> 
	</div> 
</div>
	<?php include __DIR__ . '/../footer.php' ?>
	<?php include __DIR__ . '/../script.php' ?>
  </body>
</html>
	
