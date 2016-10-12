<!--Top nav bar -->
  <nav class="orange darken-3" role="navigation">
    <div class="nav-wrapper container"><a id="logo-container" href="home.php" class="brand-logo">eVent</a>

      <!-- Items on the top nav bar in desktop mode -->
      <ul class="right hide-on-med-and-down">
        <li><a href="home.php" class="tooltipped" data-position="bottom" data-tooltip="All Events">Home</a></li>
        <li><a href="new_event.php" class="tooltipped" data-position="bottom" data-tooltip="Create a New Event here">New Event</a></li>
        <li><a href="lsp.php" class="tooltipped" data-position="bottom" data-tooltip="Find all the nearest events to you">Find Events</a></li>
        <li><a href="going_to.php" class="tooltipped" data-position="bottom" data-tooltip="Cheak the events you are instrested in">Going To</a></li>
        <!-- Dropdown Trigger -->
        <li><a class='dropdown-button' href='#' data-hover="true" data-beloworigin="true" data-constrainwidth data-activates='dropdown1'><?php echo $username ?></a></li>

        <!-- Dropdown Structure -->
        <ul id='dropdown1' class='dropdown-content'>
          <li><a href="organisation.php" class="tooltipped" data-position="left" data-tooltip="View events connected to my organisation"><?php echo "Organisation - " . $organisation_name ?></a></li>
          <li><a href="accountsettings.php" class="tooltipped" data-position="left" data-tooltip="Change your account details"><span class="name">My Account</span></a></li>
          <li class="divider"></li>
          <li><a href="login.php?status=logout" class="tooltipped" data-position="left" data-tooltip="Goodbye!"><?php echo "Logout - " . $username ?></a></li>
        </ul>
      </ul>

      <!-- Code for the sidenav -->
      <ul id="nav-mobile" class="side-nav">
        <li><img class="background" src="media/event_img.png"></li>

        <li><a href="home.php" class="tooltipped" data-position="right" data-tooltip="All Events">Home</a></li>
        <li><a href="new_event.php" class="tooltipped" data-position="right" data-tooltip="Create a New Event here">New Event</a></li>
        <li><a href="lsp.php" class="tooltipped" data-position="right" data-tooltip="Find all the nearest events to you">Find Events</a></li>
        <li><a href="going_to.php" class="tooltipped" data-position="right" data-tooltip="Cheak the events you are instrested in">My Events</a></li>
        <li><div class="divider"></div></li>
        <li><a href="organisation.php" class="tooltipped" data-position="right" data-tooltip="View events connected to my organisation"><?php echo "Organisation - " . $organisation_name ?></a></li>
        <li><a href="accountsettings.php" class="tooltipped" data-position="right" data-tooltip="Change your account details"><span class="name">My Account</span></a></li>
        <li class="divider"></li>
        <li><a href="login.php?status=logout" class="tooltipped" data-position="right" data-tooltip="Goodbye!"><?php echo "Logout - " . $username ?></a></li>
      </ul>
      <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
    </div>
  </nav>
