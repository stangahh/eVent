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
<!-- First Third  -->
<div class="col s5 m8">
  <h1 class="heading">New event</h1>
  <div class="row">
    <?php include 'includes/new_event_form.php' ?>
  </div>
</div>

  <!-- Second Third -->
    <div class="card row col s4 center">
      <card class="col s12 m6 l3">
        <div class="card medium hoverable">
          <div class="card-image waves-effect waves-block waves-light">
            <img src=""> 
          </div>
          <div class="card-stacked">
              <div class="card-content">
                <p>
                  <script>
                    return document.getElementById('event_name').value;
                  </script>                  
                </p>

              </div>
              <div class="card-action">
                <a href="">Read more</a>
              </div>
            </div>
        </div>
      </card>
    </div>


<!--  Scripts-->
<script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script src="js/materialize.js"></script>
<script src="js/init.js"></script>


</body>

<?php include 'includes/footer.php' ?>
  
</html>
