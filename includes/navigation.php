<!--Top nav bar -->
  <nav class="orange darken-2 lighten-1" role="navigation">
    <div class="nav-wrapper container"><a id="logo-container" href="home.php" class="brand-logo">eVent</a>
    
      <!-- Items on the top nav bar in desktop mode -->
      <ul class="right hide-on-med-and-down">
        <li><a href="home.php" class="active tooltipped" data-position="bottom" data-tooltip="All Events">Home</a></li>
        <li><a href="new_event.php" class="tooltipped" data-position="bottom" data-tooltip="Create a New Event here">New Event</a></li>
        <li><a href="lsp.php" class="tooltipped" data-position="bottom" data-tooltip="Find all the nearest events to you">Find Events</a></li>
        <li><a href="accountsettings.php" class="tooltipped" data-position="bottom" data-tooltip="Change your account details"><span class="name">My Account</span></a></li>
        <li><a href="login.php?status=logout" class="tooltipped" data-position="bottom" data-tooltip="Goodbye!"><?php echo "Logout - " . $username ?></a></li>
      </ul>

      <!-- Code for the sidenav -->
      <ul id="nav-mobile" class="side-nav">
        <li><img class="background" src="media/event_img.png"></li>
        <li><a href="home.php"></i>Home</a></li>
        <li><a href="new_event.php">New Event</a></li>
        <li><a href="lsp.php">Find Events</a></li>
        <li><div class="divider"></div></li>
        <li>
          <a href="accountsettings.php"><span class="name">My Account - <?php echo $username ?></span></a>
        </li>
        <li>
          <a href="login.php?status=loggout">Logout</a>
        </li>
      </ul>
      <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
    </div>
  </nav>
