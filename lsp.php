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
  <title>eVent - Home</title>

  <!-- CSS  -->
  <link rel="shortcut icon" href="media/favicon.ico">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
</head>
<body>
  <!--Top nav bar -->
  <nav class="orange darken-2 lighten-1" role="navigation">
    <div class="nav-wrapper container"><a id="logo-container" href="home.php" class="brand-logo">eVent</a>
      <ul class="right hide-on-med-and-down">
        <!-- Items on the top nav bar in desktop mode -->
        <li><a href="home.php" class="active tooltipped" data-position="bottom" data-tooltip="What's trending">Home</a></li>
        <li><a href="lsp.php" class="tooltipped" data-position="bottom" data-tooltip="Lots of stuff is on">Find events</a></li>
        <li><a href="login.php?status=logout" class="tooltipped" data-position="bottom" data-tooltip="Cya later"><?php echo "Logout - " . $username ?></a></li>
      </ul>
      <!-- Code for the sidenav -->
        <ul id="nav-mobile" class="side-nav">
        <li>
           <img class="background" src="media/event_img.png">
           <a href="accountsettings.php"><span class="name"><?php echo $organisation_name . " - " . $username ?></span></a>
       </li>
        <li><a href="home.php"><i class="material-icons">home</i>Home</a></li>
        <li><a href="lsp.php">Find things nearby</a></li>
        <li><div class="divider"></div></li>
        <li><i class="material-icons">lock_open</i><a href="login.php?status=loggout">Logout</a></li>
      </ul>
      <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
    </div>
  </nav>
<!-- home page content  -->
<h1 class="center heading">eVents</h1>
<style type="text/css">
		/* Set a size for our map container, the Google Map will take up 100% of this container */
		#map {
				width: 100%;
				height: 500px;
		}
</style>

<div id="map"></div>
<script src="https://maps.googleapis.com/maps/api/js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB62udX6drscmtSIrU8hGB8W6UGjP10lEY&callback=initMap"></script>
<script>
		// When the window has finished loading create our google map below
		google.maps.event.addDomListener(window, 'load', init);

		function init() {
				// Basic options for a simple Google Map
				// For more options see: https://developers.google.com/maps/documentation/javascript/reference#MapOptions
				var mapOptions = {
						// How zoomed in you want the map to start at (always required)
						zoom: 11,

						// The latitude and longitude to center the map (always required)
						center: new google.maps.LatLng(40.6700, -73.9400), // New York

						// How you would like to style the map.
						styles: [{"featureType":"administrative","elementType":"labels.text.fill","stylers":[{"color":"#444444"}]},{"featureType":"landscape","elementType":"all","stylers":[{"color":"#f2f2f2"}]},{"featureType":"poi","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"road","elementType":"all","stylers":[{"saturation":-100},{"lightness":45}]},{"featureType":"road.highway","elementType":"all","stylers":[{"visibility":"simplified"}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#edc200"}]},{"featureType":"road.highway","elementType":"labels.text.fill","stylers":[{"color":"#000000"}]},{"featureType":"road.highway","elementType":"labels.text.stroke","stylers":[{"color":"#ffffff"},{"visibility":"simplified"}]},{"featureType":"road.arterial","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"transit","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"water","elementType":"all","stylers":[{"color":"#f5a301"},{"visibility":"on"}]},{"featureType":"water","elementType":"labels.text.fill","stylers":[{"color":"#000000"}]},{"featureType":"water","elementType":"labels.text.stroke","stylers":[{"visibility":"off"}]}]
				};

				// Get the HTML DOM element that will contain your map
				// We are using a div with id="map" seen below in the <body>
				var mapElement = document.getElementById('map');

				// Create the Google Map using our element and options defined above
				var map = new google.maps.Map(mapElement, mapOptions);

				// Let's also add a marker while we're at it
				var marker = new google.maps.Marker({
						position: new google.maps.LatLng(40.6700, -73.9400),
						map: map,
						title: 'Snazzy!'
				});

		// Try HTML5 geolocation.
		if (navigator.geolocation) {
			navigator.geolocation.getCurrentPosition(function(position) {
			var pos = {
				lat: position.coords.latitude,
				lng: position.coords.longitude
			};

			mapElement.setPosition(pos);
			mapElement.setContent('Location found.');
			map.setCenter(pos);
			}, function() {
			handleLocationError(true, mapElement, map.getCenter());
			});
		} else {
			// Browser doesn't support Geolocation
			handleLocationError(false, mapElement, map.getCenter());
		}
		}

		function handleLocationError(browserHasGeolocation, mapElement, pos) {
		mapElement.setPosition(pos);
		mapElement.setContent(browserHasGeolocation ?
								'Error: The Geolocation service failed.' :
								'Error: Your browser doesn\'t support geolocation.');
		}
	</script>

  <?php include 'includes/footer.php' ?>


  <!--  Scripts-->
  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="js/materialize.js"></script>
  <script src="js/init.js"></script>


  </body>
</html>
