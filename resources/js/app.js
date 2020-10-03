require('./bootstrap');

var $ = require( "jquery" );

var Handlebars = require("handlebars");

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
    if (document.URL.includes("edit") ||  document.URL.includes("create")) {
      var placesAutocomplete = places({
        container: document.querySelector("#form-address"),
        templates: {
          value: function(suggestion) {
            return suggestion.name;
          }
        }
      }).configure({
        type: "address"
      });
      placesAutocomplete.on("change", function resultSelected(e) {
        // document.querySelector("#form-address2").value =
        //   e.suggestion.administrative || "";
        document.querySelector("#form-city").value = e.suggestion.city || "";
        document.querySelector("#form-zip").value =
          e.suggestion.postcode || "";
        document.querySelector("#form-lat").value =
          e.suggestion.latlng.lat || "";
        document.querySelector("#form-lng").value =
          e.suggestion.latlng.lng || "";
      });
    }


    if (document.URL.includes("search") ) {

      $('#btn-search').click(function () {

        map.eachLayer((layer) => {
          layer.remove();
        });

        var latitude = document.querySelector("#form-lat").value;
        var longitude = document.querySelector("#form-lng").value;
        var radius = document.querySelector("#form-rad").value;
        var minRooms = document.querySelector("#form-minRooms").value;
        var minBeds = document.querySelector("#form-minBeds").value;
        var minBaths = document.querySelector("#form-minBaths").value;
        var city = document.querySelector("#form-city").value;
        var servicesArray = []

        var services = document.querySelectorAll("input[type=checkbox]:checked");
        for (var i = 0; i < services.length; i++) {
          servicesArray.push(services[i].value)
        }

        if (radius == '' || radius < 1 || isNaN(radius)) {
          radius = 20
        }

        ajaxMarkers(city,latitude,longitude,radius,minRooms,minBeds,minBaths,servicesArray);



        map.setView(new L.LatLng(latitude, longitude), customZoom);
        var circle = L.circle([latitude, longitude], {
            color: 'red',
            fillColor: '#f03',
            fillOpacity: 0.5,
            radius: radius * 1000
        }).addTo(map);
        map.addLayer(osmLayer);

        // placesAutocomplete.on('suggestions', handleOnSuggestions);
        placesAutocomplete.on('cursorchanged', handleOnCursorchanged);
        placesAutocomplete.on('clear', handleOnClear);
        placesAutocomplete.on('change', handleOnChange);

      })

      var latitude = document.querySelector("#form-lat").value;
      var longitude = document.querySelector("#form-lng").value;
      var radius = document.querySelector("#form-rad").value;
      var minRooms = document.querySelector("#form-minRooms").value;
      var minBeds = document.querySelector("#form-minBeds").value;
      var minBaths = document.querySelector("#form-minBaths").value;
      var city = document.querySelector("#form-city").value;



      if (radius == '' || radius < 1 || isNaN(radius)) {
        radius = 20
      }

      ajaxMarkers(city,latitude,longitude);

// --------------------------------------------------------------------------------------
      function ajaxMarkers(city,latitude, longitude, radius, minRooms, minBeds, minBaths, servicesArray) {

        $.ajax({
          method: 'GET',
          url: 'search',
          data: {
            lat: latitude,
            lng: longitude,
            rad: radius,
            minRooms: minRooms,
            minBeds: minBeds,
            minBaths: minBaths,
            services: servicesArray,
          },
          complete : function(){
            var newurl = this.url
            history.pushState(newurl)
          },
          success: function(result){

            $('.search-results-container').html('')
            var source = document.getElementById("entry-template").innerHTML;
            var template = Handlebars.compile(source);
            console.log(result)
            var counter = $('#counter')
            counter.text(result.length + ' Risultati per ' + city)

            for (var i = 0; i < result.length; i++) {
              var singleResult = result[i]

              L.marker([singleResult.latitude, singleResult.longitude]).addTo(map)
              .bindPopup(singleResult.title)
              var context = singleResult
              var html = template(context);
              $('.search-results-container').append(html)

            }

          },

          error: function(XMLHttpRequest, textStatus, errorThrown)
            { alert(errorThrown); },
        });
      }
// --------------------------------------------------------------------------------------
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

      var circle = L.circle([latitude, longitude], {
          color: 'red',
          fillColor: '#f03',
          fillOpacity: 0.5,
          radius: radius * 1000
      }).addTo(map);

      var customZoom
      if (radius > 1 && radius <= 5) {
        customZoom = 13
      } else if (radius >= 5 && radius < 10) {
        customZoom = 12
      } else if (radius >= 10 && radius < 20) {
        customZoom = 11
      } else if (radius >= 20 && radius < 40) {
        customZoom = 10
      } else if (radius >= 40 && radius < 60) {
        customZoom = 9
      } else if (radius >= 60 && radius < 100) {
        customZoom = 8
      } else if (radius >= 100 && radius < 150) {
        customZoom = 7
      } else {
        customZoom = 6
      }

      // map.setView(new L.LatLng(0, 0), 1);
      map.setView(new L.LatLng(latitude, longitude), customZoom);
      map.addLayer(osmLayer);

      // placesAutocomplete.on('suggestions', handleOnSuggestions);
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
