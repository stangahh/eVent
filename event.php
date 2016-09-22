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
<?php
		$id = $_GET['eventid'];
		$eventarray = $membership->get_event_information($id);
		$event_name = $eventarray[0];
		$org_id = $eventarray[1];
		$event_org_name = $membership->get_org_name($org_id);
		$location_address = $eventarray[2];
		$latitude = $eventarray[3];
		$longitude = $eventarray[4];
		$postcode = $eventarray[5];
		$amount_funded = $eventarray[6];
		$amount_needed = $eventarray[7];
		$creator_id = $eventarray[8];
		$event_date = $eventarray[9];
		//$event_time = $eventarray[1];
		$event_descrption = $eventarray[10];
		$event_photo = $eventarray[11];

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
  <title><?php echo $event_name?> - eVent</title>

  <!-- CSS  -->
  <link rel="shortcut icon" href="media/favicon.ico">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
</head>
<body>

	<?php include 'includes/navigation.php' ?>

<!-- event page content  -->
<div class="parallax-container z-depth-2">
<div class="parallax"><img alt="image" src=<?php echo $event_photo?>></div>
<div class="section no-pad-bot" id="index-banner">
	<div class="valign-wrapper">
		<!-- sign up button -->
			<a data-target="modal2" class="btn-large modal-trigger waves-effect waves-red light-blue darken-4 tooltipped center" data-position="bottom" data-delay="50" data-tooltip="Please help make this happen">Donate <i class="material-icons right">thumb_up</i></a>
	</div>
</div>
</div>
<br>
<div class="row">
<div class="card light-blue darken-3">
	<div class="progress col l12 s12">
		<?php $percent_there = $amount_needed / $amount_funded; ?>
		 <div class="determinate" style="width: <?php echo $percent_there?>%"></div>
 </div>
</div>
		<div class="col s12 m6">
			<div class="card light-blue darken-3">
				<div class="card-content white-text">
					<span class="card-title"><?php echo $location_address?></span>
					<!-- <p class="card-title"><?php echo $event_time?></p> -->
					<p class="card-title"><?php echo $event_date?></p>

				</div>
				<div class="card-action">
					<a href="https://www.facebook.com/sharer/sharer.php?u=ozbot.com.au/event.php?eventid=<?php echo $id ?>" target="_blank">Share with facebook</a>
					<a data-target="modal2" href="#modal2" class="modal-trigger">Donate</a>
				</div>

			</div>
		</div>
		<div class="col s12 m6">
		<div data-target="modal1" class="modal-trigger truncate hoverable"><?php echo $event_descrption?></div>
		<div id="modal1" class="modal"><p><?php echo $event_descrption?></p></div>
	</div>
</div>
<div id="modal2" class="modal">
	<div class="modal-content">
		<h4>Donate</h4>
		<!-- mock card feilds -->
		<div class="row">
		<div class="input-field col s6">
			<i class="material-icons prefix">credit_card</i>
			<input id="icon_prefix" type="text" class="validate">
			<label for="icon_prefix">Bank details</label>
		</div>
		<div class="input-field col s4">
			<input id="Expiry" type="date" class="datepicker">
			<label for="Expiry">Expiry</label>
		</div>
		<div class="input-field col s2">
			<input id="SVC" type="number">
			<label for="SVC">SCV</label>
		</div>
		</div>
		<p>Please help us make this happen</p>
		<!-- donation form -->
		<form class="col s12 m8 l6 offset-l3 offset-m2 offset-s0" method="post" action="">
			<div class="row">
				<div class="input-field col s3">
					<input id="amt_required" type="number" min="00000" max="99999" class="validate">
					<label for="amt_required">Donation amount</label>
				</div>
			</div>
	</div>
	<div class="modal-footer">
		<button class="btn-large waves-effect waves-light right tooltipped" type="submit" data-position="left" data-delay="50" data-tooltip="Cool beans" type="submit" name="action">Submit
			<i class="material-icons right">send</i>
		</button>
		</form>
	</div>
</div>

  <!--  Scripts-->
  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="js/materialize.js"></script>
  <script src="js/init.js"></script>

  </body>
  
  <?php include 'includes/footer.php' ?>

</html>
