<?php include_once __DIR__ . '/config.php'; ?>
<?php include __DIR__ . '/vendor/autoload.php'; ?>
<?php include_once 'head.php'; ?>
<?php include 'menu.php'; ?>
<?php
use plava\login;

$data = new login();
$data->con=$con;
$data->login();

?>
<br />
<br />
<div class="row">
  <div class="medium-6 medium-centered large-4 large-centered columns">
    <form method="post">
      <div class="row column login">
        <h4 class="text-center">
        <?php echo isset($_POST['email']) || isset($_POST['password']) ? 
        'Wrong e-mail and/or password' : 'Enter email and password'; ?>
        </h4>
        <br />
        <label for="email">Email</label>
          <input required="required" type="text" id="email" name="email" placeholder="somebody@example.com"  />
        <label for="password">Password</label>
          <input required="required" type="password" id="password" name="password" placeholder="Password"  /">
        <p><input type="submit" value="Submit" class="button expanded" /></p>
      </div>
    </form>
  </div>
</div>
<br />
<br />

<?php include 'footer.php'; ?>
<?php include_once 'script.php'; ?>