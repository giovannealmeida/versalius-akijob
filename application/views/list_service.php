<!DOCTYPE html>
<html>
    <head>
        <title>Remove Markers</title>
    </head>
    <body>
        <div id="floating-panel">
            <input id="delete-all-button" type=button value="Limpar">
        </div>
        <input id="pac-input" class="controls" type="text" placeholder="Pesquisar">
        <div id="map"></div>
        <link href="<?= base_url('/assets/css/google_maps/mapsSearch.css'); ?>" rel="stylesheet" type="text/css" />
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC69Ji81pHJ6ol7VhIrIDE1mUofcZw_WuA&signed_in=true&libraries=places,drawing&callback=initMap"
        async defer></script>
    </body>
    <script>

        // In the following example, markers appear when the user clicks on the map.
        // The markers are stored in an array.
        // The user can then click an option to hide, show or delete the markers.
        var map;
        var markers = [];
        var infoWindows = [];
        var all_overlays = [];

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
                zoom: 15,
                center: {lat: -14.67806, lng: -39.375},
                styles: myStyles
            });

            var drawingManager = new google.maps.drawing.DrawingManager({
                drawingControl: true,
                drawingControlOptions: {
                    position: google.maps.ControlPosition.TOP_CENTER,
                    drawingModes: [
                        google.maps.drawing.OverlayType.CIRCLE,
                        google.maps.drawing.OverlayType.POLYGON,
                        google.maps.drawing.OverlayType.POLYLINE,
                        google.maps.drawing.OverlayType.RECTANGLE
                    ]
                },
                circleOptions: {
                    fillColor: '#ADD8E6',
                    opacity: 1,
                    weight: 1,
                    fillOpacity: 0.4,
                    clickable: false,
                    editable: false,
                    zIndex: 1
                }
            });
            drawingManager.setMap(map);

            loadMarkers();

            google.maps.event.addListener(drawingManager, 'overlaycomplete', function (event) {
                all_overlays.push(event);
                verifyMakersInDrawn();
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

            google.maps.event.addDomListener(document.getElementById('delete-all-button'), 'click', deleteAllShape);
        }

        // Adds a marker to the map and push to the array.
        function addMarker(location, html) {
            var marker = new google.maps.Marker({
                position: location,
                map: map
            });
            setInfo(marker, html);
            markers.push(marker);
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
            for (var i = 0; i < markers.length; i++) {
                markers[i].setVisible(true);
            }
        }

        // Deletes all markers in the array by removing references to them.
        function deleteMarkers() {
            clearMarkers();
            markers = [];
        }

        function deleteAllShape() {
            for (var i = 0; i < all_overlays.length; i++) {
                all_overlays[i].overlay.setMap(null);
            }
            all_overlays = [];
            showMarkers();
        }

        function loadMarkers() {
            <?php foreach ($services as $service): ?>
                var location = {lat: <?= $service['latitude'] ?>, lng: <?= $service['longitude'] ?>};
                var htm = "<h1><?= $service['name'] ?></h1><br>" +
                        "<b>Email: </b><?= $service['email'] ?><br>" +
                        "<b>Endereço: </b><?= $service['address'] ?>, <?= $service['number'] ?><br>" +
                        "<b>Bairro: </b><?= $service['neighborhood'] ?><br>" +
                        "<b>Complemento: </b><?= $service['complement'] ?><br>" +
                        "<b>CEP: </b><?= $service['zip_code'] ?><br>";
                addMarker(location, htm);
            <?php endforeach; ?>
        }

        function setInfo(marker, html) {
            var infowindow = new google.maps.InfoWindow({
                content: html
            });

            infoWindows.push(infowindow);

            marker.addListener('click', function () {
                for (var i = 0; i < infoWindows.length; i++) {
                    infoWindows[i].close();
                }
                infowindow.open(marker.get('map'), marker);
            });
        }

        function verifyMakersInDrawn() {
            var i = j = 0;
            while (j < all_overlays.length) { //número de desenhos
                i = 0;
                while (i < markers.length) { // Número de marcadors
                    if (all_overlays[j].type == google.maps.drawing.OverlayType.CIRCLE || all_overlays[j].type == google.maps.drawing.OverlayType.RECTANGLE) {
                        if (all_overlays[j].overlay.getBounds().contains(markers[i].getPosition())) { //verifica se o marcador está dentro do desenho
                            markers[i].setMap(map);
                            markers[i].setVisible(true);
                        } else {
                            // remove the ones that are not within the circle's bounds
                            if (markers[i].visible && j == 0) {
                                markers[i].setMap(null);
                                markers[i].setVisible(false);
                            }
                            //break;
                        }
                    } else {
                        var coordinates = all_overlays[j].overlay.getPath().getArray();
                        if (google.maps.geometry.poly.containsLocation(markers[i].getPosition(), new google.maps.Polygon({paths: coordinates}))) {
                            // only do setMap if the marker wasn't already visible 
                            //if (markers[i].getVisible() != true) {
                            markers[i].setMap(map);
                            markers[i].setVisible(true);
                            //}
                        } else {
                            // remove the ones that are not within the circle's bounds
                            if (markers[i].visible && j == 0) {
                                markers[i].setMap(null);
                                markers[i].setVisible(false);
                            }
                        }
                    }
                    i++;
                }
                j++;
            }
        }

    </script>
</html>