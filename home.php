<?php
	//Author: Maxwell McLeod
	require_once 'classes/Membership.php';

	$membership = New Membership(); //simple new class call
	$membership->confirm_member(); //checks if a user is logged in, any user! (yes this is insecure but i made it simple =)
	$username = $membership->get_username(); //local variable of activer user username
	$organisation_id = $membership->get_org_id($username); //get organisation id for user
	$organisation_name = $membership->get_org_name($organisation_id); //get organisation name for user

  if (isset($_GET['delete'])) {
    $membership->delete_event($_GET['delete']);
  }

	$events = $membership->get_event_list(0); //fetches an array of all events and stores as local variable

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
  <meta name="theme-color" content="#db5945">
  <title>eVent - Home</title>

  <!-- CSS  -->
  <link rel="shortcut icon" href="media/favicon.ico">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
</head>
<body>

  <?php include 'includes/navigation.php' ?>

<!-- home page content  -->
<h1 class="center heading">eVents</h1>
	<article>
    <div class="row center">
			<div class="input-field col l6 s12 offset-s0  offset-l3">
					<input id="searchBar" onkeyup="searchList()" type="search" placeholder="Search for Event name, Location, Detials..." required>
					<label for="searchBar"><i class="material-icons">search</i></label>
					<i class="material-icons">close</i>
				</div>
		<!-- <input class="col l6 s12 offset-s0  offset-l3"  type="text" id="searchBar" onkeyup="searchList()" placeholder="Search for Event name, Location, Detials..."> -->
  </div>
  <div class="row center">
    <ul id="listOfEvents">
		<?php
			foreach( $events as &$p ):
			$p = trim($p);
			$id = substr($p, 0, 5);
			$eventarray = $membership->get_event_information($id);
			$event_photo = $eventarray[11];
			$p = substr($p, 5);
		?>
    <card class="col s12 m6 l3">
    <div class="card medium hoverable">
			<a href="event.php?eventid=<?php echo $id; ?>">
      <div class="card-image waves-effect waves-block waves-light">
        <img src="/eventimg/<?php echo $event_photo; ?>.jpg">
      </div>
			</a>
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

  <!--  Scripts-->
  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="js/materialize.js"></script>
  <script src="js/init.js"></script>

  </body>

  <?php include 'includes/footer.php' ?>

</html>
