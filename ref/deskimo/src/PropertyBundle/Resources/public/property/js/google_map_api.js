function initMap() {
  //Edit
  if ($('#deskimo_form_property_address').val()) {
    let autocomplete;
    let geocoder = new google.maps.Geocoder();
    let lat = Number($('#deskimo_form_property_lat').val());
    let lng = Number($('#deskimo_form_property_lng').val());

    const map = new google.maps.Map(document.getElementById("map"), {
      center: {lat, lng},
      zoom: 13,
    });

    const marker = new google.maps.Marker({
      position: {lat, lng},
      map,
      draggable: true,
    });

    google.maps.event.addListener(marker, 'dragend', function () {
      let newLatLngObject = marker.getPosition();
      geocoder.geocode({
          location: newLatLngObject
        },
        function (results, status) {
          if (status === "OK" && results) {
            if (results.length >= 1) {
              let newAddress = results[0].formatted_address;

              //Assign new Lat lng + address

              $('#deskimo_form_property_address').val(newAddress);
              $('#deskimo_form_property_lat').val(newLatLngObject.lat());
              $('#deskimo_form_property_lng').val(newLatLngObject.lng());
            }
          }
        }
      );
    });

    autocomplete = new google.maps.places.Autocomplete(
      document.getElementById('deskimo_form_property_address'),
      {
        types: ['establishment'],
        componentRestrictions: {'country': ['SG']},
        field: ['place_id', 'geometry', 'name']
      });

    autocomplete.addListener('place_changed', onPlaceChanged);

    function onPlaceChanged() {
      const place = autocomplete.getPlace();
      if (!place.geometry) {
        return;
      }
      let lat = place.geometry.location.lat();
      let lng = place.geometry.location.lng();

      //Assign lat lng after select an autocomplete place
      $('#deskimo_form_property_lat').val(lat);
      $('#deskimo_form_property_lng').val(lng)

      const map = new google.maps.Map(document.getElementById("map"), {
        center: {lat, lng},
        zoom: 13,
      });

      const marker = new google.maps.Marker({
        position: {lat, lng},
        map,
        draggable: true,
      });

      google.maps.event.addListener(marker, 'dragend', function () {
        let newLatLngObject = marker.getPosition();
        geocoder.geocode({
            location: newLatLngObject
          },
          function (results, status) {
            if (status === "OK" && results) {
              if (results.length >= 1) {
                let newAddress = results[0].formatted_address;

                //Assign new Lat lng + address

                $('#deskimo_form_property_address').val(newAddress);
                $('#deskimo_form_property_lat').val(newLatLngObject.lat());
                $('#deskimo_form_property_lng').val(newLatLngObject.lng());
              }
            }
          }
        );
      });
    }

  } else {
    //Create
    let autocomplete;

    let geocoder = new google.maps.Geocoder();
    autocomplete = new google.maps.places.Autocomplete(
      document.getElementById('deskimo_form_property_address'),
      {
        types: ['establishment'],
        componentRestrictions: {'country': ['SG']},
        field: ['place_id', 'geometry', 'name']
      });

    autocomplete.addListener('place_changed', onPlaceChanged);

    function onPlaceChanged() {
      const place = autocomplete.getPlace();
      if (!place.geometry) {
        return;
      }
      let lat = place.geometry.location.lat();
      let lng = place.geometry.location.lng();

      //Assign lat lng after select an autocomplete place
      $('#deskimo_form_property_lat').val(lat);
      $('#deskimo_form_property_lng').val(lng)

      const map = new google.maps.Map(document.getElementById("map"), {
        center: {lat, lng},
        zoom: 13,
      });

      const marker = new google.maps.Marker({
        position: {lat, lng},
        map,
        draggable: true,
      });

      google.maps.event.addListener(marker, 'dragend', function () {
        let newLatLngObject = marker.getPosition();
        geocoder.geocode({
            location: newLatLngObject
          },
          function (results, status) {
            if (status === "OK" && results) {
              if (results.length >= 1) {
                let newAddress = results[0].formatted_address;

                //Assign new Lat lng + address

                $('#deskimo_form_property_address').val(newAddress);
                $('#deskimo_form_property_lat').val(newLatLngObject.lat());
                $('#deskimo_form_property_lng').val(newLatLngObject.lng());
              }
            }
          }
        );
      });
    }
  }
}

$(document).ready(function () {
  initMap();
});