<?php include_once 'config.php'; ?>
<?php include __DIR__ . '/vendor/autoload.php'; ?>
<?php include_once 'head.php'; ?>
<?php include 'menu.php'; ?>
<br />

<?php


use plava\register;
include 'config.php';
$data = new register();
$data->con=$con;
$data->register();
?>

<br />
<form method="post">
	<div class="row column login">
    <div class="large-6 columns">
      <label>Name*
    	<input required="required" type="text" name="display_name" placeholder="First name:" />
      </label>
    </div>
        <div class="large-6 columns">
      <label>Nickname*
        <input required="required" type="text" name="nickname" placeholder="Last name:" />
      </label>
    </div>
    <div class="large-6 columns">
        <label>Email address*
        <input required="required" type="email" name="email" placeholder="Email address:" />
        </label>       
         </div>
    <div class="large-6 columns">
        <label>Your interest
        <input type="text" name="personal_data" placeholder="Some personal data::" />
        </label>       
         </div>
    <div class="large-6 columns">
        <label>Password*
          <input required="required" type="password" name="password" placeholder="Password:" />
          </label>
          <br />
        </div>
    <div class="large-6 columns">
        <label>Connfirm password*
          <input required="required" type="password" name="password_confirm" placeholder="Password:" />
          </label>
        </div>
       <div class="large-6 columns">
       	<label>Submit
       	        <p><input type="submit" value="Register" class="button expanded" /></p> 
       	</label>
       </div>
      </div>     
</form>
<br />
<br />

<?php include 'footer.php'; ?>
<?php include 'script.php'; ?>



