<?php
	//Author: Maxwell McLeod
	require_once 'classes/Membership.php';

	$membership = New Membership(); //simple new class call
	$membership->confirm_member(); //checks if a user is logged in, any user! (yes this is insecure but i made it simple =)
	$username = $membership->get_username(); //local variable of activer user username
	$organisation_id = $membership->get_org_id($username); //get organisation id for user
	$organisation_name = $membership->get_org_name($organisation_id); //get organisation name for user
	$events = $membership->get_event_list($organisation_id); //fetches an array of all events and

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
  <meta name="theme-color" content="#db5945">
  <title>eVent - <?php echo $organisation_name ?></title>

  <!-- CSS  -->
  <link rel="shortcut icon" href="media/favicon.ico">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
</head>
<main>

  <?php include 'includes/navigation.php' ?>
<!-- org page content  -->
<h1 class="center heading"><?php echo $organisation_name?></h1>
	<article>
		<div class="row container">
			<div class="col s12 m6 l8">
					<blockquote class="flow-text">
	      	This is an example quotation that uses the blockquote tag.
	    		</blockquote>
			</div>
			<div class="col s12 m6 l4">
		<ul class="collection">
			<?php
				foreach( $events as &$p ):
				$p = trim($p);
				$id = substr($p, 0, 5);
				$eventarray = $membership->get_event_information($id);
				$event_photo = $eventarray[11];
				$p = substr($p, 5);
			?>
			<a class="collection-item avatar" href="event.php?eventid=<?php echo $id; ?>">
			<img class="circle responsive-img" alt="" src="eventimg/<?php echo $event_photo; ?>.jpg">
	    <span class="title"><p><?php echo $p; ?></p>
		 	</a>
			<?php endforeach; ?>
		</ul>
	</div>
</div>

	<!-- floating button to add event  -->
	<div class="fixed-action-btn" style="bottom: 45px; right: 24px;">
		<a href="#DOTO" class="btn-floating btn-large waves-effect waves-light red right"><i class="material-icons">mode_edit</i></a>
	</div>

	</article>

  <!--  Scripts-->
  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="js/materialize.js"></script>
  <script src="js/init.js"></script>

</main>

  <?php include 'includes/footer.php' ?>
</html>
