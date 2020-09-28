require('./bootstrap');

var $ = require( "jquery" );

$(document).ready(function() {

  (function() {
    var placesAutocomplete = places({
      container: document.querySelector("#form-city"),
      templates: {
        value: function(suggestion) {
          return suggestion.name;
        }
      }
    }).configure({
      type: [
        "city",
        "address"
      ]
    });
    placesAutocomplete.on("change", function resultSelected(e) {
      document.querySelector("#form-lat").value =
        e.suggestion.latlng.lat || "";
      document.querySelector("#form-lng").value =
        e.suggestion.latlng.lng || "";
    });
  })();

});
