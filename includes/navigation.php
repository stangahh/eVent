<!--Top nav bar -->
  <div class="navbar-fixed">
  <nav class="orange darken-3" role="navigation">
    <div class="nav-wrapper container">
      <!-- <a id="logo-container" href="home.php" class="brand-logo">eVent</a> -->

      <!-- Code for the sidenav -->
      <ul id="nav-mobile" class="side-nav fixed center">
        <li><img class="background" src="media/event_img.png"></li>
        <li><a href="home.php" class="tooltipped" data-position="right" data-tooltip="All Events">Home</a></li>
        <li><a href="new_event.php" class="tooltipped" data-position="right" data-tooltip="Create a New Event here">New Event</a></li>
        <li><a href="lsp.php" class="tooltipped" data-position="right" data-tooltip="Find all the nearest events to you">Find Events</a></li>
        <li><a href="going_to.php" class="tooltipped" data-position="right" data-tooltip="Check the events you are interested in">My Events</a></li>
        <li><div class="divider"></div></li>
        <li><a href="organisation.php" class="tooltipped" data-position="right" data-tooltip="View events connected to my organisation"><?php echo "Organisation - " . $organisation_name ?></a></li>
        <li><a href="accountsettings.php" class="tooltipped" data-position="right" data-tooltip="Change your account details"><span class="name">My Account</span></a></li>
        <li class="divider"></li>
        <li><a href="login.php?status=logout" class="tooltipped" data-position="right" data-tooltip="Goodbye!"><?php echo "Logout - " . $username ?></a></li>
      </ul>
      <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
    </div>
  </nav>
  </div>
  <div class="row">
  <style>
    #page{
    padding-left: 0cm;
    }
  @media screen and (min-width: 993px){
    #page{
    padding-left: 8cm;
    }
  }
  </style>
    <div id="page">
