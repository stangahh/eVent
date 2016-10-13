<?php
	//Author: Maxwell McLeod
	require_once 'classes/Membership.php';

	$membership = New Membership(); //simple new class call
	$membership->confirm_member(); //checks if a user is logged in, any user! (yes this is insecure but i made it simple =)
	$username = $membership->get_username(); //local variable of activer user username
	$organisation_id = $membership->get_org_id($username); //get organisation id for user
	$user_id = $membership->get_id($username);
	$organisation_name = $membership->get_org_name($organisation_id); //get organisation name for user
	$events = $membership->get_event_list(0); //fetches an array of all events and stores as local variable

	if($_POST && !empty($_POST['event_name']) && !empty($_POST['lat']) && !empty($_POST['lng'])){
		$membership->create_event($_POST['event_name'], $organisation_id, $_POST['location'], $_POST['lat'], $_POST['lng'], $_POST['postal_code'], $_POST['amt_required'], $user_id, $_POST['event_desc'], $_POST['event_date'], $_FILES['event_img']);
		header("location: event_preview.php");
}

?>
<!DOCTYPE html>
<html lang="en">
<header>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
  <title>eVent - New Event</title>

  <!-- CSS  -->
  <link rel="shortcut icon" href="media/favicon.ico">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
</header>
<main>

  <?php include 'includes/navigation.php' ?>

  <!-- New page content  -->
  <div class="row">
    <h1 class="heading center">New event</h1>
    <?php include 'includes/new_event_form.php' ?>
  </div>

<!--  Scripts-->
<script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script src="js/materialize.js"></script>
<script src="js/init.js"></script>


</main>

<?php include 'includes/footer.php' ?>

</html>
