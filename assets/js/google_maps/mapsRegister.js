/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
// This example adds a search box to a map, using the Google Place Autocomplete
// feature. People can enter geographical searches. The search box will return a
// pick list containing a mix of places and predicted search terms.

var map;
var markers = [];
var latitude;
var longitude;

function setLatLng(lat, lng){
    this.latitude = lat;
    this.longitude = lng;
}

function initAutocomplete() {

    var myStyles = [
        {
            featureType: "poi",
            elementType: "labels",
            stylers: [
                {visibility: "off"}
            ]
        }
    ];

    map = new google.maps.Map(document.getElementById('map'), {
        zoom: 15,
        center: {lat: latitude, lng: longitude},
        styles: myStyles
    });

    // This event listener will call addMarker() when the map is clicked.
    map.addListener('click', function (event) {
        addMarker(event.latLng);
    });

    // Create the search box and link it to the UI element.
    var input = document.getElementById('pac-input');
    var searchBox = new google.maps.places.SearchBox(input);
    map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

    // Bias the SearchBox results towards current map's viewport.
    map.addListener('bounds_changed', function () {
        searchBox.setBounds(map.getBounds());
    });

    // [START region_getplaces]
    // Listen for the event fired when the user selects a prediction and retrieve
    // more details for that place.
    searchBox.addListener('places_changed', function () {
        var places = searchBox.getPlaces();

        if (places.length == 0) {
            return;
        }

        markers = [];

        // For each place, get the icon, name and location.
        var bounds = new google.maps.LatLngBounds();
        places.forEach(function (place) {
            var icon = {
                url: place.icon,
                size: new google.maps.Size(71, 71),
                origin: new google.maps.Point(0, 0),
                anchor: new google.maps.Point(17, 34),
                scaledSize: new google.maps.Size(25, 25)
            };

            if (place.geometry.viewport) {
                // Only geocodes have viewport.
                bounds.union(place.geometry.viewport);
            } else {
                bounds.extend(place.geometry.location);
            }
        });
        map.fitBounds(bounds);
    });
    // [END region_getplaces]

    // Adds a marker to the map and push to the array.
    function addMarker(location) {
        deleteMarkers();
        var marker = new google.maps.Marker({
            position: location,
            map: map
        });
        markers.push(marker);
        $("#latitude").val(location.lat());
        $("#longitude").val(location.lng());
    }

// Sets the map on all markers in the array.
    function setMapOnAll(map) {
        for (var i = 0; i < markers.length; i++) {
            markers[i].setMap(map);
        }
    }

// Removes the markers from the map, but keeps them in the array.
    function clearMarkers() {
        setMapOnAll(null);
    }

// Shows any markers currently in the array.
    function showMarkers() {
        setMapOnAll(map);
    }

// Deletes all markers in the array by removing references to them.
    function deleteMarkers() {
        clearMarkers();
        markers = [];
    }
}