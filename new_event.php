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
  <title>eVent - New Event</title>

  <!-- CSS  -->
  <link rel="shortcut icon" href="media/favicon.ico">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
</head>
<body>

  <?php include 'includes/navigation.php' ?>

<!-- New page content  -->
<h1 class="center heading">New event</h1>
  <div class="row">
    <form class="col s12 m8 l6 offset-l3 offset-m2 offset-s0" enctype="multipart/form-data" type="file" method="post" action=""> 
      <div class="row">
        <div class="input-field col s12">
          <input id="event_name" name="event_name" type="text" class="validate"> 
          <label for="event_name">Event Name</label>
        </div>
      </div>
			<div class="row">
        <div class="input-field col s12">
          <textarea id="event_desc" name="event_desc" class="materialize-textarea"></textarea> 

          <label for="event_desc">Event Description</label>
        </div>
			</div>

        <div class="input-field col s12">
          <input id="event_location" name="location" type="text" class="validate">
          <label for="event_location">Address</label>
        </div>
      <div class="row">
        <div class="input-field col s12"> 
          <input id="amt_required" type="number" min="00000" max="99999" class="validate" name="amt_required"> 
          <label for="amt_required">Funding Required (AUD$) </label> 
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <input id="event_date" type="date" class="datepicker" class="validate">
          <label for="event_date">Event Date</label>
        </div>
      </div>
      <div class="input-field col s12"> 
        <input id="event_location" name="event_location" type="text" class="validate"> 
        <label for="event_location">Event Area (e.g. Brisbane, Melbourne, Chermside)</label> 
      </div> 
      <div class="row"> 
        <div class="input-field col s4"> 
          <input id="postcode" type="text" class="validate" name="postcode"> 
          <label for="postcode">Postcode</label> 
        </div> 
      </div>
      <div class="btn">
          <span>Upload Image</span>
          <input type="file" name="image">
      </div>
     
    <div class="file-field input-field"></div>

    <button class="btn-large waves-effect waves-light right tooltipped" type="submit" data-position="left" data-delay="50" data-tooltip="Cool beans" type="submit" name="action">Submit<i class="material-icons right">send</i>
    </button>

    </form>
  </div>

  <br>

<!--  Scripts-->
<script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script src="js/materialize.js"></script>
<script src="js/init.js"></script>


</body>

<?php include 'includes/footer.php' ?>
  
</html>
