<?php
  //Author: Maxwell McLeod
  require_once 'classes/Membership.php';

  $membership = New Membership(); //simple new class call
  $membership->confirm_member(); //checks if a user is logged in, any user! (yes this is insecure but i made it simple =)
  $username = $membership->get_username(); //local variable of activer user username
  $user_id = $membership->get_id($username);
  $organisation_id = $membership->get_org_id($username); //get organisation id for user
  $organisation_name = $membership->get_org_name($organisation_id); //get organisation name for user
  $events = $membership->get_event_list(0); //fetches an array of all events and stores as local variable

  if($_POST && !empty($_POST['event_name']) && !empty($_POST['lat']) && !empty($_POST['lng'])){
    $membership->debug_to_console( "Test" );
    $membership->create_event($_POST['event_name'], $organisation_id, $_POST['location'], $_POST['lat'], $_POST['lng'], $_POST['postal_code'], $_POST['amt_required'], $user_id, $_POST['event_desc'], $_POST['event_date'], $_POST['event_img']);
  }
?>
  
<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
  <title>eVent - Event Preview</title>

  <!-- CSS  -->
  <link rel="shortcut icon" href="media/favicon.ico">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
</head>
<body>

  <?php include 'includes/navigation.php' ?>

  <h1 class="center">Preview of Event just created</h1>
  <p class="center">TODO: Actual Previews</p>


    <div class="row center">
    	<button class="btn-large waves-effect waves-red red tooltipped center" data-position="left" data-delay="50" data-tooltip="Scrap this event and start again" type="submit" name="submit">Trash and Restart<i class="material-icons right">delete</i>
		</button>

		<button class="btn-large waves-effect waves-red light-blue darken-3 tooltipped center" data-position="left" data-delay="50" data-tooltip="Press to upload your event!" type="submit" name="submit">Submit<i class="material-icons right">send</i>
		</button>
    </div>

<!--  Scripts-->
<script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script src="js/materialize.js"></script>
<script src="js/init.js"></script>


</body>

<?php include 'includes/footer.php' ?>

</html>
