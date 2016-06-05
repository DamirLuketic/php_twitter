	<div class="top-bar" id="example-menu">
        <div class="top-bar-left">
          <ul class="dropdown menu" data-dropdown-menu>
            <li><a href="<?php echo $path ?>">Home</a></li>
            <li class="has-submenu">
            <?php if(!isset($_COOKIE['user_id'])): ?>	
              <a href="#">Login\Register</a>
              <ul class="submenu menu vertical" data-submenu>
				<li><a href="<?php echo $path; ?>login">Login</a></li>
				<li><a href="<?php echo $path; ?>register">Register</a></li>
              </ul>
              <?php else: ?>
              <a href="#">User</a>
              <ul class="submenu menu vertical" data-submenu>
				<li><a href="<?php echo $path; ?>update_data">User data</a></li>
				<li><a href="<?php echo $path; ?>logout">Logout</a></li>
              </ul>
              <?php endif; ?>
            </li>
          </ul>
        </div>
        <div class="top-bar-right">
        </div>
      </div>