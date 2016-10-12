<form class="col s12 m8 l6 offset-l3 offset-m2 offset-s0" enctype="multipart/form-data" type="file" method="post" action="event_preview.php">
  <div class="row">
    <div class="input-field col s12">
      <input id="event_name" name="event_name" type="text" class="validate" data-error="wrong" data-success="right" required>
      <label for="event_name">Event Name</label>
    </div>

    <div class="input-field col s12">
      <textarea id="event_desc" name="event_desc" class="materialize-textarea" required></textarea>
      <label for="event_desc">Event Description</label>
    </div>

    <div class="input-field col s12">
      <input id="autocomplete" placeholder="" name="location" required onFocus="geolocate()" type="text" class="validate">
      <label for="autocomplete">Address</label>
    </div>

  <div class="row">
    <div class="input-field col l6 s12">
      <input id="amt_required" type="number" min="00000" required max="99999" class="validate" data-error="wrong" data-success="right" required name="amt_required">
      <label for="amt_required">Funding Required (AUD$) </label>
    </div>

    <div class="input-field col l6 s12">
      <input id="event_date" type="date" name="event_date" class="datepicker" data-error="wrong" data-success="right" validate required>
      <label for="event_date">Event Date</label>
    </div>
  </div>
<!-- autofilled feilds -->
    <div class="input-field col s8 m8 l5">
      <input id="locality" placeholder="" name="Event_Area" type="text" data-error="wrong" data-success="right" class="validate">
      <label for="locality">Event Area </label>
    </div>
    <div class="input-field col s4 m4 l2">
      <input placeholder="" id="postal_code" type="number" class="validate" data-error="wrong" data-success="right" name="postal_code">
      <label for="postal_code">Postcode</label>
    </div>
    <div class="input-field col s6 m6 l2">
      <input id="lat" placeholder="" name="lat" type="text" data-error="wrong" data-success="right" class="validate" required>
      <label for="lat">Latitude</label>
    </div>
    <div class="input-field col s6 m6 l2">
      <input id="lng" placeholder="" name="lng" type="text" data-error="wrong" data-success="right" class="validate" required>
      <label for="lng">Longitude</label>
    </div>
<div class="row">
  <div class="file-field input-field col s12 l12">
    <div class="btn">
      <span>File</span>
      <input type="file" name="event_img" id="event_img">
    </div>
    <div class="file-path-wrapper">
      <input class="file-path validate" type="text">
    </div>
  </div>
</div>
  <button class="btn-large waves-effect waves-light right tooltipped" data-position="left" data-delay="50" data-tooltip="Cool beans" type="submit" name="submit">Preview<i class="material-icons right">send</i>
  </button>
</div>
</form>

<script>
  var placeSearch, autocomplete;
  var componentForm = {
    locality: 'long_name',
    postal_code: 'short_name'
 };
  function initAutocomplete() {
    autocomplete = new google.maps.places.Autocomplete(
        /** @type {!HTMLInputElement} */(document.getElementById('autocomplete')),
        {types: ['geocode']});
    autocomplete.addListener('place_changed', fillInAddress);
  }
  function fillInAddress() {
  // Get the place details from the autocomplete object.
  var place = autocomplete.getPlace();

  for (var component in componentForm) {
    document.getElementById(component).value = '';
    //document.getElementById(component).disabled = false;
  }

  // Get each component of the address from the place details
  // and fill the corresponding field on the form.
  for (var i = 0; i < place.address_components.length; i++) {
    var addressType = place.address_components[i].types[0];
    if (componentForm[addressType]) {
      var val = place.address_components[i][componentForm[addressType]];
      document.getElementById(addressType).value = val;
    }
  }
      var lat = place.geometry.location.lat();
      var lng = place.geometry.location.lng();
      Materialize.toast("Location found", 5000);
      document.getElementById("lat").value = lat;
      document.getElementById("lng").value = lng;

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
