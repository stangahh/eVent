//from new_event_from.php
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