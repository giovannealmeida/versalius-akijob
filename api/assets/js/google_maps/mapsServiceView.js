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
var dataService;

function setLatLng(lat, lng) {
    this.latitude = Number(lat);
    this.longitude = Number(lng);
}

function setMarker(dataService) {
    this.dataService = dataService;
}

function initMap() {

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
        zoom: 13,
        center: {lat: latitude, lng: longitude},
        styles: myStyles
    });

    // Adds a marker to the map and push to the array.
    function addMarker(location) {
        deleteMarkers();
        var marker = new google.maps.Marker({
            position: location,
            /*icon: {
             url: '../../assets/img/marker-default.png',
             scaledSize: new google.maps.Size(50, 50)
             },*/
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
    if (dataService != undefined) {
        addMarker(dataService);
    }
}