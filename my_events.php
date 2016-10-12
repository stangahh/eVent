<?php
	//Author: Maxwell McLeod
	require_once 'classes/Membership.php';
	require_once 'includes/constants.php';

	$membership = New Membership(); //simple new class call
	$membership->confirm_member(); //checks if a user is logged in, any user! (yes this is insecure but i made it simple =)
	$username = $membership->get_username(); //local variable of activer user username
	$organisation_id = $membership->get_org_id($username); //get organisation id for user
	$organisation_name = $membership->get_org_name($organisation_id); //get organisation name for user
	$userid = $membership->get_id($username); //local variable of activer user id
	$events = $membership->get_event_list($organisation_id); //fetches an array of all events and 
?>
<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
  <title>eVent - Account Settings</title>

  <!-- CSS  -->
  <link rel="shortcut icon" href="media/favicon.ico">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
</head>
<body>
	<?php include 'includes/navigation.php' ?>
	
	<!-- Page Content -->
		<header class="center">
			<h1>Edit Events</h1>
			<h3>
				<?php echo $membership->get_username() . ". From organisation: " . $organisation_name . "(".$organisation_id.")"; ?>
			</h3>
			
			<!-- Small previews-->
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
							<img src="eventimg/<?php echo $event_photo; ?>.jpg">
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
		</header>

</body>

<?php include 'includes/footer.php' ?>


<!--  Scripts-->
<script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script src="js/materialize.js"></script>
<script src="js/init.js"></script>

</html>
