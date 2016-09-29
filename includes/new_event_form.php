<form class="col s12 m8 l6 offset-l3 offset-m2 offset-s0" enctype="multipart/form-data" type="file" method="post" action="event_preview.php">
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

  <div class="row">
    <div class="input-field col s12">
      <input id="autocomplete" name="location" onFocus="geolocate()" type="text" class="validate">
      <label for="autocomplete">Address</label>
    </div>
  </div>

  <div class="row">
    <div class="input-field col s12">
      <input id="amt_required" type="number" min="00000" max="99999" class="validate" name="amt_required">
      <label for="amt_required">Funding Required (AUD$) </label>
    </div>
  </div>

  <div class="row">
    <div class="input-field col s12">
      <input id="event_date" type="date" name="event_date" class="datepicker" class="validate">
      <label for="event_date">Event Date</label>
    </div>
  </div>

  <div class="row">
    <div class="input-field col s12">
      <input id="event_location" name="event_location" type="text" class="validate">
      <label for="event_location">Event Area (e.g. Brisbane, Melbourne, Chermside)</label>
    </div>
  </div>

  <div class="row">
    <div class="input-field col s12">
      <input id="postcode" type="text" class="validate" name="postcode">
      <label for="postcode">Postcode</label>
    </div>
  </div>

  <div class="file-field input-field">
    <div class="btn">
      <span>File</span>
      <input type="file">
    </div>
    <div class="file-path-wrapper">
      <input class="file-path validate" type="text">
    </div>
  </div>

  <button class="btn-large waves-effect waves-light right tooltipped" data-position="left" data-delay="50" data-tooltip="Cool beans" type="submit" name="submit" href="event_preview.php">Preview<i class="material-icons right">send</i>
  </button>
</form>

<script>
  var placeSearch, autocomplete;

  function initAutocomplete() {
    autocomplete = new google.maps.places.Autocomplete(
        /** @type {!HTMLInputElement} */(document.getElementById('autocomplete')),
        {types: ['geocode']});
  }
  // Bias the autocomplete object to the user's geographical location,
  // as supplied by the browser's 'navigator.geolocation' object.
  function geolocate() {
    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(function(position) {
        var geolocation = {
          lat: position.coords.latitude,
          lng: position.coords.longitude
        };
        var circle = new google.maps.Circle({
          center: geolocation,
          radius: position.coords.accuracy
        });
        autocomplete.setBounds(circle.getBounds());
      });
    }
  }
</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD96Lw0LXZoGQTthyvcOkvsIa3FEiOmeCI&callback=initAutocomplete&libraries=places">
</script>


<!-- // function address_to_coordinates(){
// $address = str_replace(" ", "+", $address);
//
// $json = file_get_contents("http://maps.google.com/maps/api/geocode/json?address=$address&sensor=false&region=$region");
// $json = json_decode($json);
//
// $lat = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lat'};
// $long = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lng'};
//
//    echo "Materialize.toast('$lat', 4000)"

} -->
