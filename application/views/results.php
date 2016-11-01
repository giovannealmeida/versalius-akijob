<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<title>Akijob - Resultado</title>
	<link href="<?=base_url("assets/css/bootstrap.min.css")?>" rel="stylesheet">
	<link href="<?=base_url("assets/css/style.css")?>" rel="stylesheet">
	<link href="<?=base_url("assets/css/result.css")?>" rel="stylesheet">
	<link href="<?=base_url("assets/css/bootstrap-select.min.css")?>" rel="stylesheet">


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
				<a class="navbar-brand" href="<?=base_url()?>"><img src="<?=base_url("assets/img/logo-vetor.png")?>" alt="AkiJob" /></a>
			</div>
			<div id="navbar" class="navbar-collapse collapse">
				<form class="navbar-form navbar-left">
					<div class="form-group search-navbar">
						<label class="sr-only" for="services_select">Serviços</label>
						<select class=" form-control selectpicker" data-live-search="true" data-width="100%">
							<option>Serviços</option>
							<option>2</option>
							<option>3</option>
							<option>4</option>
							<option>5</option>
						</select>
					</div>
					<div class="form-group search-navbar">
						<label class="sr-only" for="city_select ">Cidade</label>
						<select class=" form-control selectpicker" data-live-search="true" data-width="100%">
							<option>Cidade</option>
							<option>2</option>
							<option>3</option>
							<option>4</option>
							<option>5</option>
						</select>
					</div>
					<button type="submit" class="btn btn-primary search-button">Buscar</button>
				</form>
				<ul class="nav navbar-nav navbar-right">
					<li><a href="#">Login</a></li>

				</ul>
			</div>
			<!--/.nav-collapse -->
		</div>
	</div>

	<div id="map-canvas" class="hidden-xs hidden-sm"></div>
	<div class="container-fluid" id="main-result">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4" id="left">

				<h3>Profissionais Encontrados</h2>

				<hr>
				<div class="list-container">
					<div class="list-group ">

						<div class="list-group-item ">
							<div class="row">
								<div class="score">
									<b>10,0</b>
								</div>
								<div class="details">
									<a href="#"><span class="list-group-item-heading">Caíque Martins de Santana </span></a><img src="<?=base_url("assets/img/crown-platina.png")?>" alt="tier" class="tier"/>
									<small class="address">Rua Valquiria de Oliviera, Santo Antônio</small>
									<span class="job ">Padeiro</span><span class="recomendations hidden-xs">12 Recomendações</span>
								</div>


							</div>
						</div>
						<div class="divider"></div>

						<div class="list-group-item ">
							<div class="row">
								<div class="score">
									<b>10,0</b>
								</div>
								<div class="details">
									<a href="#"><span class="list-group-item-heading">Caíque Martins de Santana </span></a><img src="<?=base_url("assets/img/crown-gold.png")?>" alt="tier" class="tier"/>
									<small class="address">Rua Valquiria de Oliviera, Santo Antônio</small>
									<span class="job ">Padeiro</span><span class="recomendations hidden-xs">12 Recomendações</span>
								</div>


							</div>
						</div>
						<div class="divider"></div>

						<div class="list-group-item ">
							<div class="row">
								<div class="score">
									<b>10,0</b>
								</div>
								<div class="details">
									<a href="#"><span class="list-group-item-heading">Caíque Martins de Santana </span></a><img src="<?=base_url("assets/img/crown-silver.png")?>" alt="tier" class="tier"/>
									<small class="address">Rua Valquiria de Oliviera, Santo Antônio</small>
									<span class="job ">Padeiro</span><span class="recomendations hidden-xs">12 Recomendações</span>
								</div>


							</div>
						</div>
						<div class="divider"></div>

						<div class="list-group-item ">
							<div class="row">
								<div class="score">
									<b>10,0</b>
								</div>
								<div class="details">
									<a href="#"><span class="list-group-item-heading">Caíque Martins de Santana </span></a><img src="<?=base_url("assets/img/crown-bronze.png")?>" alt="tier" class="tier"/>
									<small class="address">Rua Valquiria de Oliviera, Santo Antônio</small>
									<span class="job ">Padeiro</span><span class="recomendations hidden-xs">12 Recomendações</span>
								</div>


							</div>
						</div>
						<div class="divider"></div>


					</div>

				</div>
			</div>
			<div class=" col-xs-12 col-sm-12 col-md-6 col-lg-8">
				<!--map-canvas will be postioned here-->
			</div>

		</div>
	</div>
	<!-- end template -->



	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script src="<?=base_url("assets/js/bootstrap.min.js")?>"></script>
	<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB51cLBRyONHcO6XKZPTThoi2P_PozYezw&callback=initialize"></script>
	<script src="<?=base_url("assets/js/bootstrap-select.min.js")?>"></script>

	<script type="text/javascript">
		/* google maps -----------------------------------------------------*/
		// google.maps.event.addDomListener(window, 'load', initialize);

		function initialize() {

			/* position Amsterdam */
			var latlng = new google.maps.LatLng(52.3731, 4.8922);

			var mapOptions = {
				center: latlng,
				scrollWheel: false,
				zoom: 13
			};

			var marker = new google.maps.Marker({
				position: latlng,
				url: '/',
				animation: google.maps.Animation.DROP
			});

			var map = new google.maps.Map(document.getElementById("map-canvas"), mapOptions);
			marker.setMap(map);

		};
		/* end google maps -----------------------------------------------------*/
	</script>

</body>

</html>
