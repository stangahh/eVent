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
	$event_id = $_GET['eventid'];
	$eventarray = $membership->get_event_information($event_id);
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
	$event_description = $eventarray[10];
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
</head>

<body>

	<?php include 'includes/navigation.php' ?>
	
	<!-- event page content  -->
	<h2 class="center"><?php echo $event_name?></h2>
	<div class="parallax-container z-depth-2">
		<div class="parallax"><img alt="image" src=<?php echo $event_photo?>></div>
		<div class="section no-pad-bot" id="index-banner">
			<div class="center">
				<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
				<!-- donate button -->
					<a data-target="modal2" class="btn-large modal-trigger waves-effect waves-red light-blue darken-3 tooltipped center" data-position="bottom" data-delay="50" data-tooltip="Please help make this event happen">Donate <i class="material-icons right">thumb_up</i></a>
					<!-- follow button -->
						<a class="btn-large waves-effect waves-red light-blue darken-3 tooltipped center" 
						data-position="bottom" data-delay="50" data-tooltip="Keep up to date on this event"
						onclick="add_user_going(<?php echo $org_id . ", " . $username ?>)">
							<!-- TODO: if this user is going; change text to "I'm Going"-->
							Going? <i class="material-icons right">turned_in_not</i></a>
					<!-- Event Remove Button -->
						<!-- TODO: if this user created the event; show delete button-->
						<a href=<?php echo "home.php?delete=" . $event_id . ""?> class="btn-large waves-effect waves-red light-blue darken-3 tooltipped center" data-position="bottom" data-delay="50" data-tooltip="Permanently Delete This Event">Remove
						<i class="material-icons right">delete</i>
						</a>
				</div>
			</div>
		</div>
	</div>

  <div class="container">
	<div class="row">

		<?php
			if ($amount_needed == 0) {
				$percent_there = 100;
			} else {
				$percent_there = ($amount_funded / $amount_needed) * 100;
			}
		?>
		<h4 class="heading"> We have been funded $<?php echo $amount_funded?> out of our goal of $<?php echo $amount_needed?></h3>
			<div class="progress col l12 s12">
				 <div class="determinate" style="width: <?php echo $percent_there?>%"></div>
		 	</div>

		<div class="col s12 m6">
			<div class="card light-blue darken-3">
				<div class="card-content white-text">
					<span class="flow-text card-title">Address: <?php echo $location_address?></span>
					<!-- <p class="card-title"><?php echo $event_time?></p> -->
					<p class="flow-text">Date: <?php echo $event_date?></p>
					<p class="flow-text">An event by: <?php echo $event_org_name?></p>
					<p class="flow-text">Percent funded: <?php echo $percent_there?>%</p>
				</div>
				<div class="card-action">
					<a href="https://www.facebook.com/sharer/sharer.php?u=ozbot.com.au/event.php?eventid=<?php echo $event_id ?>" target="_blank">Share with facebook</a>
					<a data-target="modal2" href="#modal2" class="modal-trigger">Donate</a>
				</div>
			</div>
			<h4>INFO</h4>
			<blockquote>
			<p class="flow-text"><?php echo $event_description?></p>
		</blockquote>
		</div>
		<div class="col s12 m6">
			<style>
				#map {
					height: 400px;
					width: 100%;
				}
			</style>
			<div id="map"></div>
		</div>

	<!-- end of contents -->
	</div>
	</div>

	<div id="modal2" class="modal modal-fixed-footer">
		<div class="modal-content">
			<h4>Donate</h4>

			<!-- mock card fields -->
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
					<label for="SVC">SVC</label>
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
			</form>
		</div>

		<div class="modal-footer">
			<button class="modal-action modal-close btn-flat waves-effect waves-red light-blue darken-3 white-text center tooltipped" type="submit" data-position="left" data-delay="50" data-tooltip="Cool beans" type="submit" name="action">Submit
				<i class="material-icons right">send</i>
			</button>
		</div>
	</div>
	<!-- map code -->
	<script>
	function initMap() {
		var myLatLng = {lat: <?php echo $latitude ?>, lng: <?php echo $longitude ?>};
	  var map = new google.maps.Map(document.getElementById('map'), {
	    center: myLatLng,
	    zoom: 8,
	    styles: [{
	      "featureType": "administrative",
	      "elementType": "labels.text.fill",
	      "stylers": [{
	        "color": "#444444"
	      }]
	    }, {
	      "featureType": "landscape",
	      "elementType": "all",
	      "stylers": [{
	        "color": "#f2f2f2"
	      }]
	    }, {
	      "featureType": "poi",
	      "elementType": "all",
	      "stylers": [{
	        "visibility": "off"
	      }]
	    }, {
	      "featureType": "road",
	      "elementType": "all",
	      "stylers": [{
	        "saturation": -100
	      }, {
	        "lightness": 45
	      }]
	    }, {
	      "featureType": "road.highway",
	      "elementType": "all",
	      "stylers": [{
	        "visibility": "simplified"
	      }]
	    }, {
	      "featureType": "road.highway",
	      "elementType": "geometry.fill",
	      "stylers": [{
	        "color": "#edc200"
	      }]
	    }, {
	      "featureType": "road.highway",
	      "elementType": "labels.text.fill",
	      "stylers": [{
	        "color": "#000000"
	      }]
	    }, {
	      "featureType": "road.highway",
	      "elementType": "labels.text.stroke",
	      "stylers": [{
	        "color": "#ffffff"
	      }, {
	        "visibility": "simplified"
	      }]
	    }, {
	      "featureType": "road.arterial",
	      "elementType": "labels.icon",
	      "stylers": [{
	        "visibility": "off"
	      }]
	    }, {
	      "featureType": "transit",
	      "elementType": "all",
	      "stylers": [{
	        "visibility": "off"
	      }]
	    }, {
	      "featureType": "water",
	      "elementType": "all",
	      "stylers": [{
	        "color": "#f5a301"
	      }, {
	        "visibility": "on"
	      }]
	    }, {
	      "featureType": "water",
	      "elementType": "labels.text.fill",
	      "stylers": [{
	        "color": "#000000"
	      }]
	    }, {
	      "featureType": "water",
	      "elementType": "labels.text.stroke",
	      "stylers": [{
	        "visibility": "off"
	      }]
	    }]
	  });
	  var infoWindow = new google.maps.InfoWindow({
	    map: map
	  });
		var marker = new google.maps.Marker({
			position: myLatLng,
			map: map,
			title: 'Hello World!'
		});
	}
</script>
  <!--  Scripts-->
	<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD96Lw0LXZoGQTthyvcOkvsIa3FEiOmeCI&callback=initMap"></script>
  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="js/materialize.js"></script>
  <script src="js/init.js"></script>

</body>

  <?php include 'includes/footer.php' ?>

</html>
