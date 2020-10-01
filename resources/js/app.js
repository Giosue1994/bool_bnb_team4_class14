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


    if (document.URL.includes("search") ) {

      var latitude = document.querySelector("#form-lat").value;
      var longitude = document.querySelector("#form-lng").value;
      var radius = document.querySelector("#form-rad").value;

      var map = L.map('map-example-container', {
        scrollWheelZoom: true,
        zoomControl: true
      });

      var osmLayer = new L.TileLayer(
        'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
          minZoom: 1,
          maxZoom: 13,
          attribution: 'Map data © <a href="https://openstreetmap.org">OpenStreetMap</a> contributors'
        }
      );

      var markers = [];

      L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
          attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
      }).addTo(map);

      L.marker([latitude, longitude]).addTo(map)
        .bindPopup('A pretty CSS3 popup.<br> Easily customizable.')
        .openPopup();

      var circle = L.circle([latitude, longitude], {
          color: 'red',
          fillColor: '#f03',
          fillOpacity: 0.5,
          radius: radius * 1000
      }).addTo(map);

      // map.setView(new L.LatLng(0, 0), 1);
      map.setView(new L.LatLng(latitude, longitude), 7);
      map.addLayer(osmLayer);

      placesAutocomplete.on('suggestions', handleOnSuggestions);
      placesAutocomplete.on('cursorchanged', handleOnCursorchanged);
      placesAutocomplete.on('clear', handleOnClear);
      placesAutocomplete.on('change', handleOnChange);
    }

    placesAutocomplete.on("change", function resultSelected(e) {
      document.querySelector("#form-lat").value =
        e.suggestion.latlng.lat || "";
      document.querySelector("#form-lng").value =
        e.suggestion.latlng.lng || "";
    });

    function handleOnChange(e) {
      markers
        .forEach(function(marker, markerIndex) {
          if (markerIndex === e.suggestionIndex) {
            markers = [marker];
            marker.setOpacity(1);
            findBestZoom();
          } else {
            removeMarker(marker);
          }

        });
    }

    function handleOnSuggestions(e) {
      markers.forEach(removeMarker);
      markers = [];

      if (e.suggestions.length === 0) {
        map.setView(new L.LatLng(latitude, longitude), 7);
        return;
      }

      e.suggestions.forEach(addMarker);
      findBestZoom();
    }

    function handleOnClear() {
      map.setView(new L.LatLng(latitude, longitude), 15);
      markers.forEach(removeMarker);
    }

    function handleOnCursorchanged(e) {
      markers
        .forEach(function(marker, markerIndex) {
          if (markerIndex === e.suggestionIndex) {
            marker.setOpacity(1);
            marker.setZIndexOffset(1000);
          } else {
            marker.setZIndexOffset(0);
            marker.setOpacity(0.5);
          }
        });
    }

    function addMarker(suggestion) {
      var marker = L.marker(suggestion.latlng, {opacity: .3});
      marker.addTo(map);
      markers.push(marker);
    }

    function removeMarker(marker) {
      map.removeLayer(marker);
    }

    function findBestZoom() {
      var featureGroup = L.featureGroup(markers);
      map.fitBounds(featureGroup.getBounds().pad(0.5), {animate: false});
    }

  })();
});
