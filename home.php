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
  <title>eVent - Home</title>

  <!-- CSS  -->
  <link rel="shortcut icon" href="media/favicon.ico">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
</head>
<body>
  <!--Top nav bar -->
  <nav class="orange darken-2 lighten-1" role="navigation">
    <div class="nav-wrapper container"><a id="logo-container" href="#home.php" class="brand-logo">eVent</a>
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
<!-- home page content  -->
<h1 class="center heading">eVents</h1>
	<article>
    <div class="row center">
		<input class="col l6 s12 offset-s0  offset-l3"  type="text" id="searchBar" onkeyup="searchList()" placeholder="Search for Event name, Location, Detials...">
  </div>
  <div class="row center">
    <ul id="listOfEvents">
		<?php
			foreach( $events as &$p ):
			$p = trim($p);
			$id = substr($p, 0, 5);
			$p = substr($p, 5);
		?>
    <card class="col s12 m6 l3">
    <div class="card medium hoverable">
      <div class="card-image waves-effect waves-block waves-light">
        <img href="event.php?eventid=<?php echo $id; ?>" src="http://www.publicdomainpictures.net/pictures/130000/nahled/yellow-orange-background.jpg">
      </div>
      <div class="card-stacked">
        <div class="card-content">
          <li><p><?php echo $p; ?></p></li>
        </div>
        <div class="card-action">
          <a href="event.php?eventid=<?php echo $id; ?>">Read more</a>
        </div>
    </div>
    </div>
  </card>
		<?php endforeach; ?>

		</ul>
  </div>
	</article>

<?php include 'includes/footer.php';?>

  <!--  Scripts-->
  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="js/materialize.js"></script>
  <script src="js/init.js"></script>


  </body>
</html>
