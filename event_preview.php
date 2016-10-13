<?php
  //Author: Maxwell McLeod
  require_once 'classes/Membership.php';

  $membership = New Membership(); //simple new class call
  $membership->confirm_member(); //checks if a user is logged in, any user! (yes this is insecure but i made it simple =)
  $username = $membership->get_username(); //local variable of activer user username
  $user_id = $membership->get_id($username);
  $organisation_id = $membership->get_org_id($username); //get organisation id for user
  $organisation_name = $membership->get_org_name($organisation_id); //get organisation name for user
  $latest_event = $membership->get_latest_event_from_user($user_id);
  $latest_event_info = $membership->get_event_information($latest_event);

  $event_name = $latest_event_info[0];
	$org_id = $latest_event_info[1];
	$event_org_name = $membership->get_org_name($org_id);
	$location_address = $latest_event_info[2];
	$latitude = $latest_event_info[3];
	$longitude = $latest_event_info[4];
	$postcode = $latest_event_info[5];
	$amount_funded = $membership->sum_donation($latest_event);
	$amount_needed = $latest_event_info[7];
	$creator_id = $latest_event_info[8];
	$event_date = $latest_event_info[9];
	$event_description = $latest_event_info[10];
	$event_photo = $latest_event_info[11];
?>

<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html" charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>

  <title>eVent - Event Preview</title>

  <!-- CSS  -->
  <link rel="shortcut icon" href="media/favicon.ico">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
</head>

<?php include 'includes/navigation.php' ?>
<body>


  <h1 class="center">Preview of event just created</h1>

  <!-- Small preview -->
  <div class="row center">
    <card class="col s12 m6 l3">
      <div class="card medium hoverable center">
        <div class="card-image waves-effect waves-block waves-light">
          <img alt="photo upload failed"  src="eventimg/<?php echo $event_photo; ?>.jpg">
        </div>

        <div class="card-stacked">
          <div class="card-content">
            <?php echo "<strong>".$latest_event_info[0]."</strong> ".$latest_event_info[2] ?>
          </div>
        </div>
      </div>
    </card>

  <!-- Large preview -->
  <div class="col s12 m6 l9">
    <h2><?php echo $latest_event_info[0] ?></h2>
    <p>TODO: Second preview</p>
  </div>
</div>

  <div class="row center">
    <!-- TODO: Make this delete button delete the $latest_event -->
    <button class="btn-large waves-effect waves-red red tooltipped center" data-position="left" data-delay="50" data-tooltip="Scrap this event and start again" type="submit" name="trash">Trash and Restart<i class="material-icons right">delete</i>
  	</button>

  	<a href="going_to.php" class="btn-large waves-effect waves-red light-blue darken-3 tooltipped center" data-position="left" data-delay="50" data-tooltip="Press to upload your event!" >Submit<i class="material-icons right">send</i>
  	</a>
  </div>

  <!--  Scripts-->
  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="js/materialize.js"></script>
  <script src="js/init.js"></script>


</body>

<?php include 'includes/footer.php' ?>

</html>
