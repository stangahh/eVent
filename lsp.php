<?php
	require_once 'classes/Membership.php';
	
	$membership = New Membership(); //simple new class call
	$membership->confirm_member(); //checks if a user is logged in, any user! (yes this is insecure but i made it simple =)
	$username = $membership->get_username(); //local variable of activer user username
	$organisation_id = $membership->get_org_id($username); //get organisation id for user
	$organisation_name = $membership->get_org_name($organisation_id); //get organisation name for user
?>

<!DOCTYPE html>
<html lang="en" class="no-js">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
		<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
		
		<title>eVent - Location</title>
		
		<meta name="description" content="IFB299 - Website" />
		<meta name="keywords" content="" />
		<meta name="author" content="McLeod" />
		
		<link rel="shortcut icon" href="media/favicon.ico">
		<link rel="stylesheet" type="text/css" href="css/normalize.css" />
		<link rel="stylesheet" type="text/css" href="css/main.css" />
		<link rel="stylesheet" type="text/css" href="css/component.css" />
		
		<script src="js/modernizr.custom.js"></script>
		
		<style>
			#map {
			height: 100%;
			}
		</style>

	</head>
	<body>
		<div class="container">
			<ul id="gn-menu" class="gn-menu-main">
				<li class="gn-trigger">
					<a class="gn-icon gn-icon-menu"><span>Menu</span></a>
					<nav class="gn-menu-wrapper">
						<div class="gn-scroller">
							<ul class="gn-menu">
								<li><a class="gn-icon gn-icon-earth" href="home.php">Home</a></li>
								<li><a class="gn-icon gn-icon-help" href="lsp.php">Location Services</a></li>
								<li><a class="gn-icon gn-icon-article" href="tos.php">Terms of Service</a></li>
								<li><a class="gn-icon gn-icon-cog" href="accountsettings.php">Settings</a></li>
								<li><a class="gn-icon gn-icon-earth" href="login.php?status=loggout">Logout</a></li>
							</ul>
						</div><!-- /gn-scroller -->
					</nav>
				</li>
				<!-- <li><a href="">Page Menu 1</a></li> -->
				<!-- <li><a href="">Page Menu 2</a></li> -->
				<!-- <li><a href="">Page Menu 3</a></li> -->
				<li><a href="accountsettings.php"><span><?php echo $organisation_name . " - " . $username ?></span></a></li>
				<li></li>
			</ul>
					
			<header>
				<h1>Location Services<span>Functional proof of location services working for demostration purposes</span></h1>	
			</header> 
			
		</div><!-- /container -->
		
		<!-- Page Content -->
		
		<div class="main-content">
			<body>
				<div id="map"></div>
				<script>
				  // Note: This example requires that you consent to location sharing when
				  // prompted by your browser. If you see the error "The Geolocation service
				  // failed.", it means you probably did not give permission for the browser to
				  // locate you.

				  function initMap() {
					var map = new google.maps.Map(document.getElementById('map'), {
					  center: {lat: -34.397, lng: 150.644},
					  zoom: 6
					});
					var infoWindow = new google.maps.InfoWindow({map: map});

					// Try HTML5 geolocation.
					if (navigator.geolocation) {
					  navigator.geolocation.getCurrentPosition(function(position) {
						var pos = {
						  lat: position.coords.latitude,
						  lng: position.coords.longitude
						};

						infoWindow.setPosition(pos);
						infoWindow.setContent('Location found.');
						map.setCenter(pos);
					  }, function() {
						handleLocationError(true, infoWindow, map.getCenter());
					  });
					} else {
					  // Browser doesn't support Geolocation
					  handleLocationError(false, infoWindow, map.getCenter());
					}
				  }

				  function handleLocationError(browserHasGeolocation, infoWindow, pos) {
					infoWindow.setPosition(pos);
					infoWindow.setContent(browserHasGeolocation ?
										  'Error: The Geolocation service failed.' :
										  'Error: Your browser doesn\'t support geolocation.');
				  }
				</script>
				<script async defer
				src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD96Lw0LXZoGQTthyvcOkvsIa3FEiOmeCI&callback=initMap">
				</script>
			  </body>		
		</div>
		
		<script src="js/classie.js"></script>
		<script src="js/gnmenu.js"></script>
		
		<script>
			new gnMenu( document.getElementById( 'gn-menu' ) );
		</script>
						
	</body>
</html>