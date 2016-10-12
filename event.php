<?php
	//Author: Maxwell McLeod
	require_once 'classes/Membership.php';

	$membership = New Membership(); //simple new class call
	$membership->confirm_member(); //checks if a user is logged in, any user! (yes this is insecure but i made it simple =)
	$username = $membership->get_username(); //local variable of activer user username
	$organisation_id = $membership->get_org_id($username); //get organisation id for user
	$organisation_name = $membership->get_org_name($organisation_id); //get organisation name for user
	$events = $membership->get_event_list(0); //fetches an array of all events and stores as local variable

	$event_id = $_GET['eventid'];
	
	if ($_POST && !empty($_POST['amt_required'])) {
		$membership->add_donation($_POST['amt_required'], $membership->get_id($username), $_GET['eventid']);
		$membership->update_donations($_POST['amt_required'], $membership->get_id($username), $_GET['eventid']);
	}
	
	//marks the user as going and submits amount
	if (isset($_GET['going'])){
		echo "<script type='text/javascript'>alert('You are now Attending this Event.');</script>";
	}
	
	//run cancel event if set
	if (!empty($_GET['cancel'])) {
		$membership->cancel_part($membership->get_id($username));
		echo "<script type='text/javascript'>alert('You are no Longer Attending this Event.');</script>";
	}
	
	//check if current user is already going
	$check_going = $membership->is_user_going($membership->get_id($username), $event_id); //true if user is going
	
	$going_button_text = 'GOING?';
	$going_button_action = 'data-target="modal3"';
	
	//change button text f user is going to the event
	if ($check_going) { 
		$going_button_text = 'ALREADY GOING - CANCEL?';
		$going_button_action = 'href="event.php?eventid=' . $event_id . '&cancel=1"';
	}

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
		<div class="parallax"><img alt="image" src="eventimg/<?php echo $event_photo?>.jpg"></div>
		<div class="section no-pad-bot" id="index-banner">
			<div class="center">
				<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
				<!-- donate button -->
					<a data-target="modal2" class="btn-large modal-trigger waves-effect waves-red light-blue darken-3 tooltipped center" data-position="bottom" data-delay="50" data-tooltip="Please help make this event happen">Donate <i class="material-icons right">thumb_up</i></a>
					<!-- follow button -->
						<a class="btn-large waves-effect waves-red light-blue darken-3 tooltipped center <?php if(!$check_going ){echo "modal-trigger";} ?>"
						data-position="bottom" data-delay="50" data-tooltip="Keep up to date on this event"
						<?php echo $going_button_action ?>>
							<!-- TODO: if this user is going; change text to "I'm Going"-->
							<?php echo $going_button_text ?><i class="material-icons right">turned_in_not</i></a>
					<!-- Event Remove Button -->
						<?php
							if ($org_id == $organisation_id) {
								echo "<a href=home.php?delete=" . $event_id . " class='btn-large waves-effect waves-red light-blue darken-3 tooltipped center' data-position='bottom' data-delay='50' data-tooltip='Permanently Delete This Event'>Remove
									<i class='material-icons right'>delete</i></a>";
							}
						?>
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
		<h4 class="heading"> We have been funded $<?php echo $amount_funded ?> out of our goal of $<?php echo $amount_needed?></h3>
			<div class="progress col l12 s12">
				 <div class="determinate" style="width: <?php echo $percent_there?>%"></div>
		 	</div>

		<div class="col s12 m6">
			<div class="card light-blue darken-3">
				<div class="card-content white-text">
					<span class="flow-text card-title"><b>Address:</b> <?php echo $location_address?></span>
					<!-- <p class="card-title"><?php echo $event_time?></p> -->
					<p class="flow-text"><b>Date:</b> <?php echo $event_date?></p>
					<p class="flow-text"><b>An event by:</b> <?php echo $event_org_name?></p>
					<p class="flow-text"><b>Percent funded:</b> <?php echo round($percent_there)?>%</p>
					<!-- NUMBER OF PEOPLE ATTENDING THE EVENT -->
					<p class="flow-text"><b>People going:</b> <?php echo $membership->find_going($event_id)?></p>
					<!-- FOUND AT http://stackoverflow.com/questions/400212/how-do-i-copy-to-the-clipboard-in-javascript -->
				</div>
				<div class="card-action">
					<a href="https://www.facebook.com/sharer/sharer.php?u=ozbot.com.au/event.php?eventid=<?php echo $event_id ?>" target="_blank">Share with facebook</a>
					<a data-target="modal2" href="#modal2" class="modal-trigger">Donate</a>
					<a href="mailto:example@example.com">Contact</a>
					<!-- I hope you dont mind i did this, really nice function by the way, also i dont know why the cursor doesnt show as a pointer please fix -->
					<a id="copy_url" onclick="copyToClipboard(document.getElementById('copy_url').innerHTML)">Event Link</a>
						<script>
							function copyToClipboard() {
								window.prompt("Copy to clipboard: Ctrl+C, Enter", "straya.tech/event.php?eventid=<?php echo $event_id?>");
							}
						</script>
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
		<!-- random code needed for facebook comments api-->
		<div id="fb-root"></div>
				<script>(function(d, s, id) {
					  var js, fjs = d.getElementsByTagName(s)[0];
					  if (d.getElementById(id)) return;
					  js = d.createElement(s); js.id = id;
					  js.src = "//connect.facebook.net/fb_LT/sdk.js#xfbml=1&version=v2.7&appId=310465119303548";
					  fjs.parentNode.insertBefore(js, fjs);
					}(document, 'script', 'facebook-jssdk'));
				</script>
		<div class="col s12 m6">
			<!-- this is the facebook comments part -->
			<br>
			<div class="fb-comments" data-href="http://ozbot.com.au/event.php?eventid=<?php echo $event_id ?>" data-width="100%" data-numposts="4"></div>
		</div>
	<!-- end of contents -->
	</div>
	</div>

	<div id="modal2" class="modal modal-fixed-footer">
		<div class="modal-content">
			<h4>Donate</h4>

			<!-- mock card fields -->
			<div class="row">
				<div class="input-field col s12 l6">
					<i class="material-icons prefix">credit_card</i>
					<input id="icon_prefix" name="icon_prefix" type="text" class="validate">
					<label for="icon_prefix">Bank details</label>
				</div>
				<div class="input-field col s4 m4 l4 offset-s1 offset-m1 offset-l0">
					<input id="expiry" name="expiry" type="date" class="datepicker">
					<label for="expiry">Expiry</label>
				</div>
				<div class="input-field col s2">
					<input id="SVC" name="SVC" type="number">
					<label for="SVC">SVC</label>
				</div>
			</div>

			<p>Please help us make this happen</p>

			<!-- donation form -->
			<form  method="post" action="">
				<div class="col s12 m8 l6 offset-l3 offset-m2 offset-s0">
					<div class="row">
						<div class="input-field col s3">
							<input id="amt_required" name="amt_required" type="number" min="00000" max="99999" class="validate">
							<label for="amt_required">Donation amount</label>
						</div>
					</div>
				</div>

				<div class="modal-footer">
					<button class="modal-action modal-close btn-flat waves-effect waves-red light-blue darken-3 white-text center tooltipped" type="submit" data-position="left" data-delay="50" data-tooltip="Cool beans" type="submit" name="action">Submit
						<i class="material-icons right">send</i>
					</button>
				</div>
			</form>
		</div>
	</div>
	
	<!-- People Going to the Event Form -->
	<div id="modal3" class="modal <!--modal-fixed-footer -->">
		<div class="modal-content">
			<h4>How Many People will be Attending?</h4>
			
			<!-- donation form -->
			<form  method="post" action="event_add_going.php">
				<div class="col s12 m8 l6 offset-l3 offset-m2 offset-s0">
					<div class="row">
						<div class="input-field col s3">
							<input id="people_going" name="people_going" type="number" min="1" max="5" class="validate">
							<label for="amt_required">People Attending</label>
						</div>
						
						<input id="event_id" style="display :none" name="event_id" type="number" value="<?php echo $event_id ?>">
						<input id="user_id" style="display :none" name="user_id" type="number" value="<?php echo $membership->get_id($username) ?>">
						
					</div>
				</div>

				<!-- <div class="modal-footer"> -->
					<button class="modal-action modal-close btn-flat waves-effect waves-red light-blue darken-3 white-text center tooltipped" type="submit" data-position="left" data-delay="50" data-tooltip="Cool beans" type="submit" name="action">Submit
						<i class="material-icons right">send</i>
				<!--	</button> -->
				</div>
			</form>
		</div>
	</div>
	<!-- map code -->
	<script>
	function initMap() {
		var image = 'https://www.livefiregear.com/media/gmapstrlocator/marker/default/map-marker-20x32-v2.png';
		var myLatLng = {lat: <?php echo $latitude ?>, lng: <?php echo $longitude ?>};
	  var map = new google.maps.Map(document.getElementById('map'), {
	    center: myLatLng,
	    zoom: 15,
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
			icon: image,
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
