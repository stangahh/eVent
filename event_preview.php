<?php
  //Author: Maxwell McLeod
  require_once 'classes/Membership.php';

  $membership = New Membership(); //simple new class call
  $membership->confirm_member(); //checks if a user is logged in, any user! (yes this is insecure but i made it simple =)
  $username = $membership->get_username(); //local variable of activer user username
  $organisation_id = $membership->get_org_id($username); //get organisation id for user
  $organisation_name = $membership->get_org_name($organisation_id); //get organisation name for user
  $events = $membership->get_event_list(0); //fetches an array of all events and stores as local variable

  if (isset($_POST['submit'])) {
    $_SESSION['event_name'] = $_POST['event_name'];
    $_SESSION['event_desc'] = $_POST['event_desc'];
    $_SESSION['event_location'] = $_POST['event_location'];
    $_SESSION['event_goal'] = $_POST['amt_required'];
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

  <h1 class="heading center">Event Preview</h1>

  <div class="row center">
  <card class="col s12 m8 l3">
  <h2 class="center">_</h2>
    <div class="card medium hoverable">
      <a href="">
        <div class="card-image waves-effect waves-block waves-light">
        <img src="">
        </div>
      </a>
      <div class="card-stacked">
        <div class="card-content">
          <p><?php echo $_POST['event_name'] ?>, 
          <?php echo $_POST['event_location'] ?></p>
          <p><?php echo $_POST['event_desc'] ?></p>
        </div>
        <div class="card-action">
          <a>Read More</a>
        </div>
      </div>
    </div>
    </card>
      <div class="col s8 right">
        


<!-- event page content  -->
  <h2 class="center"><?php echo $_POST['event_name'] ?></h2>
  <div class="parallax-container z-depth-2">
    <div class="parallax"><img alt="image" src=""></div>
    <div class="section no-pad-bot" id="index-banner">
      <div class="center">
        <br><br><br><br><br>
        <!-- donate button -->
          <a data-target="modal2" class="btn-large waves-effect waves-red light-blue darken-3 tooltipped center" data-position="bottom" data-delay="50" data-tooltip="Please help make this happen">Donate <i class="material-icons right">thumb_up</i></a>
          <!-- follow button -->
            <a class="btn-large waves-effect waves-red light-blue darken-3 tooltipped center" data-position="bottom" data-delay="50" data-tooltip="Keep up to date on this event">Follow <i class="material-icons right">turned_in_not</i></a>
        </div>
      </div>
    </div>


  <div class="container">
    <div class="row">
    <?php $percent_there = 0; ?>

    <h4 class="heading"> We have been funded $0 out of our goal of $<?php echo $_POST['amt_required']?></h4>
    <div class="progress col l12 s12">
      <div class="determinate" style="width: <?php echo $percent_there?>%"></div>
      </div>

    <div class="col s12 m6">
      <div class="card light-blue darken-3">
        <div class="card-content white-text">
          <span class="flow-text card-title">Address: <?php echo $_POST['event_location']?></span>
          <!-- <p class="card-title"><?php echo $event_time?></p> -->
          <p class="flow-text">Date: <?php echo $_POST['event_date']?></p>
          <p class="flow-text">An event by: <?php echo "TODO" ?></p>
          <p class="flow-text">Percent funded: <?php echo $percent_there?>%</p>
        </dv>
        <div class="card-action">
          <a>Share with facebook</a>
          <a>Donate</a>
        </div>
        </div>
      </div>
      <h4>INFO</h4>
      <blockquote>
      <p class="flow-text"><?php echo $_POST['event_desc'] ?></p>
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
    </div></div></div></div></div></div>

    <div class="row center">
      <button class="btn-large waves-effect waves-red light-blue darken-3 tooltipped center" data-position="left" data-delay="50" data-tooltip="Press to upload your event!" type="submit" name="submit" href="event_preview.php">Submit<i class="material-icons right">send</i>
      </button>
    </div>

<!--  Scripts-->

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

<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD96Lw0LXZoGQTthyvcOkvsIa3FEiOmeCI&callback=initMap"></script>
<script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script src="js/materialize.js"></script>
<script src="js/init.js"></script>


</body>

<?php include 'includes/footer.php' ?>

</html>
