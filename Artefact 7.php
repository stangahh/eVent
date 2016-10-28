//from lsp.php
<style>
    html,
    body {
      height: 100%;
    }

    #map {
      height: 600px;
      width: 100%;
      position: fixed;
    }
  </style>

<?php include 'includes/navigation.php' ?>
<body>
    <!-- map page content  -->
    <h1 class="center heading">eVents</h1>
    <div id="map"></div>
    <script>
      function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
          center: {
            lat: -27.4698,
            lng: 153.0251
          },
          zoom: 14,
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

        // Try HTML5 geolocation.
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function (position) {
            var pos = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };

            infoWindow.setPosition(pos);
            infoWindow.setContent('You are here!');
            map.setCenter(pos);
          }, function () {
            handleLocationError(true, infoWindow, map.getCenter());
          });
        } else {
          // Browser doesn't support Geolocation
          handleLocationError(false, infoWindow, map.getCenter());
        }
            var image = 'https://www.livefiregear.com/media/gmapstrlocator/marker/default/map-marker-20x32-v2.png';
            <?php foreach( $events as &$p ):
              $p = trim($p);
              $id = substr($p, 0, 5);
             	$eventarray = $membership->get_event_information($id);
              $latitude = $eventarray[3];
              $longitude = $eventarray[4];
              //$id = trim($id);
            ?>
            //load
            var marker = new google.maps.Marker({
               position: {
                  lat: <?php echo $latitude; ?>,
                  lng: <?php echo $longitude; ?>
               },
                  map: map,
                  url: "http://straya.tech/event.php?eventid=<?php echo $id; ?>",
                  icon: image,
                  title: <?php echo $id; ?>,
                  animation: google.maps.Animation.DROP
              });
            google.maps.event.addListener(marker, 'click', function() {
              window.location.href = this.url;
            });
            <?php endforeach; ?>
      }
			function toggleBounce() {
				if (marker.getAnimation() !== null) {
					marker.setAnimation(null);
				} else {
					marker.setAnimation(google.maps.Animation.BOUNCE);
				}
			}
      function handleLocationError(browserHasGeolocation, infoWindow, pos) {
        infoWindow.setPosition(pos);
        infoWindow.setContent(browserHasGeolocation ?
          'Error: The Geolocation service failed.' :
          'Error: Your browser doesn\'t support geolocation.');
      }

    </script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD96Lw0LXZoGQTthyvcOkvsIa3FEiOmeCI&callback=initMap">
    </script>

    <!--  Scripts-->
    <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script src="js/materialize.js"></script>
    <script src="js/init.js"></script>

</body>
