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

  $going_button_text = 'GOING?';
	$going_button_action = 'data-target="modal3"';

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
  <div class="row">
    <card class="center col s12 m6 l3">
      <h2 class="center">Card</h2>
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
  <div class="col s12 m12 l9">
    <!-- event page content  -->
  	<h2 class="center"><?php echo $event_name?></h2>
  	<div class="parallax-container z-depth-2">
  		<div class="parallax"><img alt="event image not found 404" src="eventimg/<?php echo $event_photo?>.jpg"></div>
  		<div class="section no-pad-bot" id="index-banner">
  			<div class="center">
  				<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
  				<!-- donate button -->
  					<a data-target="modal2" class="btn-large waves-effect waves-red light-blue darken-3 tooltipped center" data-position="bottom" data-delay="50" data-tooltip="Please help make this event happen">Donate <i class="material-icons right">thumb_up</i></a>
  					<!-- follow button -->
  						<a class="btn-large waves-effect waves-red light-blue darken-3 tooltipped center"
  						data-position="bottom" data-delay="50" data-tooltip="Keep up to date on this event">
  							<!-- TODO: if this user is going; change text to "I'm Going"-->
  							<?php echo $going_button_text ?><i class="material-icons right">turned_in_not</i></a>
  						</a>
  				</div>
  			</div>
  		</div>


  	<div class="row">
  		<div class="container">

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
  				<div class="card-content left white-text">
  					<span class="flow-text card-title"><b>Address:</b> <?php echo $location_address?></span>
  					<!-- <p class="card-title"><?php echo $event_time?></p> -->
  					<p class="flow-text"><b>Date:</b> <?php echo $event_date?></p>
  					<p class="flow-text"><b>An event by:</b> <?php echo $event_org_name?></p>
  					<p class="flow-text"><b>Percent funded:</b> <?php echo round($percent_there)?>%</p>
  					<!-- NUMBER OF PEOPLE ATTENDING THE EVENT -->
  					<p class="flow-text"><b>People going:</b> 0</p>
  					<!-- FOUND AT http://stackoverflow.com/questions/400212/how-do-i-copy-to-the-clipboard-in-javascript -->
  				</div>
  				<div class="card-action">
  					<a href="https://www.facebook.com/sharer/sharer.php?u=ozbot.com.au/event.php?eventid=<?php echo $latest_event ?>" target="_blank">Share with facebook</a>
  					<a data-target="modal2" href="#modal2" class="modal-trigger">Donate</a>
  					<a href="mailto:example@example.com">Contact</a>
  					<!-- I hope you dont mind i did this, really nice function by the way, also i dont know why the cursor doesnt show as a pointer please fix -->
  					<a id="copy_url" onclick="copyToClipboard(document.getElementById('copy_url').innerHTML)">Event Link</a>
  						<script>
  							function copyToClipboard() {
  								window.prompt("Copy to clipboard: Ctrl+C, Enter", "straya.tech/event.php?eventid=<?php echo $latest_event?>");
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
  			<div class="fb-comments" data-href="http://ozbot.com.au/event.php?eventid=<?php echo $latest_event ?>" data-width="100%" data-numposts="4"></div>
  		</div>
  	<!-- end of contents -->
  	</div>
  	</div>
  </div>
</div>

  <div class="row center">
    <a class="btn-large waves-effect waves-red red tooltipped center" data-position="left" data-delay="50" data-tooltip="Scrap this event and start again" type="submit" href="home.php?delete=<?php echo $latest_event?>" name="trash">Scrap and Restart<i class="material-icons right">delete</i></a>
  	<a href="going_to.php" class="btn-large waves-effect waves-red light-blue darken-3 tooltipped center" data-position="left" data-delay="50" data-tooltip="Press to upload your event!" >Submit<i class="material-icons right">send</i>
  	</a>
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
