<?php
	//Author: Maxwell McLeod
	require_once 'classes/Membership.php';

	$membership = New Membership(); //simple new class call
	$membership->confirm_member(); //checks if a user is logged in, any user! (yes this is insecure but i made it simple =)
	$username = $membership->get_username(); //local variable of activer user username
	$organisation_id = $membership->get_org_id($username); //get organisation id for user
	$organisation_name = $membership->get_org_name($organisation_id); //get organisation name for user
	$events = $membership->get_event_list(0); //fetches an array of all events and stores as local variable

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
  <title>eVent - New</title>

  <!-- CSS  -->
  <link rel="shortcut icon" href="media/favicon.ico">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
</head>
<body>
  <!--Top nav bar -->
  <nav class="orange darken-2 lighten-1" role="navigation">
    <div class="nav-wrapper container"><a id="logo-container" href="http://ozbot.com.au/home.php" class="brand-logo">eVent</a>
      <ul class="right hide-on-med-and-down">
        <!-- Items on the top nav bar in desktop mode -->
        <li><a href="home.php" class="active tooltipped" data-position="bottom" data-tooltip="What's trending">Home</a></li>
        <li><a href="lsp.php" class="tooltipped" data-position="bottom" data-tooltip="Lots of stuff is on">Find events</a></li>
        <li><a href="login.php?status=logout" class="tooltipped" data-position="bottom" data-tooltip="Cya later"><?php echo "Logout - " . $username ?></a></li>
      </ul>
      <!-- Code for the sidenav -->
        <ul id="nav-mobile" class="side-nav">
        <li>
           <img class="background" src="media/event_img.png">
           <a href="accountsettings.php"><span class="name"><?php echo $organisation_name . " - " . $username ?></span></a>
       </li>
        <li><a href="home.php"><i class="material-icons">home</i>Home</a></li>
        <li><a href="lsp.php">Find things nearby</a></li>
        <li><div class="divider"></div></li>
        <li><i class="material-icons">lock_open</i><a href="login.php?status=loggout">Logout</a></li>
      </ul>
      <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
    </div>
  </nav>
<!-- New page content  -->
<h1 class="center heading">New event</h1>
  <div class="row">
    <form class="col s12 m8 l6 offset-l3 offset-m2 offset-s0" method="post" action="">
    <div class="row">
        <div class="input-field col s12">
          <input id="event_name" name="eventname" type="text" class="validate">
          <label for="event_name">Event Name</label>
        </div>
      </div>
			<div class="row">
        <div class="input-field col s12">
          <textarea id="event_desc" name="description" class="materialize-textarea"></textarea>

          <label for="event_desc">Event Description</label>
        </div>
			</div>

        <div class="input-field col s12">
          <input id="event_location" name="location" type="text" class="validate">
          <label for="event_location">Address</label>
        </div>
      <div class="row">
        <div class="input-field col s4">
          <input id="postcode" type="number" min="00000" max="99999" class="validate">
          <label for="postcode">Postcode</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <input id="amt_required" type="number" min="00000" max="99999" class="validate">
          <label for="amt_required">Amount Required</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <input id="event_date" type="date" class="datepicker" class="validate">
          <label for="event_date">Date</label>
        </div>
      </div>
      <div class="file-field input-field">
        <div class="btn">
          <span>Upload Image</span>
          <input type="file">
        </div>
        <div class="file-path-wrapper">
          <input class="file-path validate" type="text">
        </div>
      </div>

      <button class="btn-large waves-effect waves-light right tooltipped" type="submit" data-position="left" data-delay="50" data-tooltip="Cool beans" type="submit" name="action">Submit
        <i class="material-icons right">send</i>
      </button>
    </form>
  </div>
    <br>
//AUTOFILL: event_id, event_org_id, event_creator_user_id
//NEED SOME WAY TO UPLOAD IMAGE

<!-- footer with team name -->
  <footer class="page-footer orange">
    <div class="footer-copyright">
      <div class="container" href="tos.php">
      Made by <a class="orange-text text-lighten-3" href="tos.php">NoneOfTheAbove</a>
      </div>
    </div>
  </footer>


  <!--  Scripts-->
  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="js/materialize.js"></script>
  <script src="js/init.js"></script>


  </body>
</html>
