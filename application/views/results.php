<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

        <title>Akijob - Resultado</title>
        <link href="<?= base_url("assets/css/bootstrap.min.css") ?>" rel="stylesheet">
        <link href="<?= base_url("assets/css/style.css") ?>" rel="stylesheet">
        <link href="<?= base_url("assets/css/result.css") ?>" rel="stylesheet">
        <link href="<?= base_url("assets/css/bootstrap-select.min.css") ?>" rel="stylesheet">


    </head>

    <body>

        <!-- begin template -->
        <div class="navbar navbar-custom navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="<?= base_url() ?>"><img src="<?= base_url("assets/img/logo-vetor.png") ?>" alt="AkiJob" /></a>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <form class="navbar-form navbar-left" action="<?= base_url("results") ?>" method="post">
                        <div class="form-group search-navbar">
                            <label class="sr-only" for="selectJob">Serviços</label>
                            <?php echo form_dropdown(array('class' => "selectpicker with-ajax", "data-abs-log" => "false", 'data-live-search' => "true", 'data-width' => "100%", 'name' => "selectJob", 'id' => "selectJob",)); ?>
                        </div>
                        <div class="form-group search-navbar">
                            <label class="sr-only" for="selectCity ">Cidade</label>
                            <?php echo form_dropdown(array('class' => "selectpicker with-ajax", "data-abs-log" => "false", 'data-live-search' => "true", 'data-width' => "100%", 'name' => "selectCity", 'id' => "selectCity",)); ?>
                        </div>
                        <button type="submit" class="btn btn-primary search-button">Buscar</button>
                    </form>
                    <ul class="nav navbar-nav navbar-right">
                        <?php if ($user_profile): ?>
                            <li><a href="<?= base_url("profile") ?>">Minha Conta</a></li>
                            <li><a href="<?= base_url("logout") ?>">Sair</a></li>
                        <?php else: ?>
                            <li><a href="<?= base_url('login') ?>">Entrar</a></li>
                        <?php endif; ?>
                    </ul>
                </div>
                <!--/.nav-collapse -->
            </div>
        </div>
        <div id="map-canvas" class="hidden-xs hidden-sm"></div>
        <input id="delete-all-button" class="controls" type=button value="Limpar">
        <div class="container-fluid" id="main-result">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4" id="left">

                    <h3><?=count($services)?> Profissionais Encontrados</h2>

                        <hr>
                        <div class="list-container" style="height: 90%; overflow: auto;">
                            <?php if (count($services) > 0): ?>
                                <?php foreach ($services as $key => $service): ?>
                                    <div class="list-group result-list" id="line-<?= $key ?>">
                                        <div class="list-group-item " id="item-<?= $key ?>" onclick="animationMarker(<?= $key ?>)">
                                            <div class="row">
                                                <!--<div class="score">
                                                </div>-->
                                                <div class="details">
                                                    <a href="<?= base_url("service/toView/{$service->id}") ?>" target="_blank"><span class="list-group-item-heading"><?= $service->name ?></span></a>
                                                    <input id="display_stars" disabled="true" id="input-id" type="text" class="rating" data-size="xs" value="<?= isset($service->rating) ? $service->rating : 0 ?>" >
                                                    <?php if ($tier_url[$service->id]): ?>
                                                        <img src="<?= $tier_url[$service->id] ?>" alt="tier" class="tier"/>
                                                    <?php endif; ?>

                                                    <small class="address"><?= $service->street . ', ' . $service->number . ' - ' . $service->neighborhood ?></small>
                                                    <span class="job "><?= $service->job ?></span>
                                                    <span class="recomendations hidden-xs">
                                                        <?= $service->saldo ?> Recomendações
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="divider"></div>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                </div>
                <div class=" col-xs-12 col-sm-12 col-md-6 col-lg-8">
                    <script type='text/javascript'>var base_url = {url: "<?= base_url() ?>"};</script>
                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
                    <script src="<?= base_url("assets/js/bootstrap.min.js") ?>"></script>
                    <script src="<?= base_url("assets/js/bootstrap-select.min.js") ?>"></script>
                    <script src="<?= base_url("assets/js/ajax-bootstrap-select.min.js") ?>"></script>
                    <script src="<?= base_url("assets/js/search.js") ?>"></script>

                    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC69Ji81pHJ6ol7VhIrIDE1mUofcZw_WuA&signed_in=true&libraries=places,drawing&callback=initMap"
                    async defer></script>

                    <!-- default styles -->
                    <link href="<?= base_url("assets/css/star-rating.css") ?>" media="all" rel="stylesheet" type="text/css" />

                    <!-- important mandatory libraries -->
                    <script src="<?= base_url("assets/js/star-rating.js") ?>" type="text/javascript"></script>
                </div>

            </div>
        </div>
        <!-- end template -->

        <script>

                                    // In the following example, markers appear when the user clicks on the map.
                                    // The markers are stored in an array.
                                    // The user can then click an option to hide, show or delete the markers.
                                    var map;
                                    var markers = [];
                                    var infoWindows = [];
                                    var all_overlays = [];
                                    var id = 0;

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

                                        map = new google.maps.Map(document.getElementById('map-canvas'), {
                                            zoom: 13,
                                            center: {lat: <?= $city->latitude ?>, lng: <?= $city->longitude ?>},
                                            styles: myStyles,
                                            mapTypeControlOptions: {
                                                style: google.maps.MapTypeControlStyle.DROPDOWN_MENU,
                                                position: google.maps.ControlPosition.RIGHT_TOP
                                            }
                                        });

                                        var deleteButton = document.getElementById('delete-all-button');
                                        map.controls[google.maps.ControlPosition.TOP_CENTER].push(deleteButton);

                                        var drawingManager = new google.maps.drawing.DrawingManager({
                                            drawingControl: true,
                                            drawingControlOptions: {
                                                position: google.maps.ControlPosition.LEFT_TOP,
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

                                        google.maps.event.addListener(drawingManager, 'overlaycomplete', function (event) {
                                            all_overlays.push(event);
                                            verifyMakersInDrawn();
                                        });
                                        // Create the search box and link it to the UI element.

                                        // Bias the SearchBox results towards current map's viewport.

                                        google.maps.event.addDomListener(document.getElementById('delete-all-button'), 'click', deleteAllShape);
                                        loadMarkers();
                                    }


                                    // Adds a marker to the map and push to the array.
                                    function addMarker(location, html) {
                                        var marker = new google.maps.Marker({
                                            position: location,
                                            animation: google.maps.Animation.DROP,
                                            /*icon: {
                                             url: '../assets/img/marker-default.png',
                                             scaledSize: new google.maps.Size(50, 50)
                                             },*/
                                            map: map
                                        });
                                        setInfo(marker, html);
                                        marker.set("id", id);
                                        markers.push(marker);
                                        id++;
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
                                            $("#line-" + i).show();
                                            $("#item-" + i).show();
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

                                    function setInfo(marker, html) {
                                        var infowindow = new google.maps.InfoWindow({
                                            content: html
                                        });

                                        infoWindows.push(infowindow);

                                        marker.addListener('click', function () {
                                            highlightsDiv(marker.get("id"));
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
                                                        $("#line-" + i).show();
                                                        $("#item-" + i).show();
                                                    } else {
                                                        // remove the ones that are not within the circle's bounds
                                                        if (markers[i].visible && j == 0) {
                                                            markers[i].setMap(null);
                                                            markers[i].setVisible(false);
                                                            $("#line-" + i).hide();
                                                            $("#item-" + i).hide();
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
                                                        $("#line-" + i).show();
                                                        $("#item-" + i).show();
                                                        //}
                                                    } else {
                                                        // remove the ones that are not within the circle's bounds
                                                        if (markers[i].visible && j == 0) {
                                                            markers[i].setMap(null);
                                                            markers[i].setVisible(false);
                                                            $("#line-" + i).hide();
                                                            $("#item-" + i).hide();
                                                        }
                                                    }
                                                }
                                                i++;
                                            }
                                            j++;
                                        }
                                    }

                                    function loadMarkers() {
<?php if (count($services) > 0) : ?>
    <?php foreach ($services as $service): ?>
                                                var location = {lat: <?= $service->latitude ?>, lng: <?= $service->longitude ?>};
                                                var htm = "<h1><?= $service->name ?></h1><br>" +
                                                        "<b>Email: </b><?= $service->email ?><br>" +
                                                        "<b>Endereço: </b><?= $service->street ?>, <?= $service->number ?><br>" +
                                                        "<b>Bairro: </b><?= $service->neighborhood ?><br>" +
                                                        "<b>Complemento: </b><?= $service->complement ?><br>" +
                                                        "<b>CEP: </b><?= $service->zip_code ?><br>";
                                                addMarker(location, htm);
    <?php endforeach; ?>
<?php endif; ?>
                                    }

                                    function highlightsDiv(id) {
                                        /* Criar função para destacar*/
                                        var container = $(".list-container");
                                        var scrollTo = $("#item-" + id);
                                        container.animate({
                                            scrollTop: scrollTo.offset().top - container.offset().top + container.scrollTop()
                                        });
                                    }

                                    function animationMarker(id_marker) {
                                        if (markers[id_marker].getAnimation() !== null) {
                                            markers[id_marker].setAnimation(null);
                                        } else {
                                            markers[id_marker].setAnimation(google.maps.Animation.BOUNCE);
                                        }
                                    }

        </script>
</html>

</body>

</html>
