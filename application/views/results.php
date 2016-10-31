<!DOCTYPE html>
<html lang="pt-BR">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<meta name="description" content="">
	<meta name="author" content="">
	<meta name="theme-color" content="#2c3e50">
	<link rel="icon" type="image/png" href="img/favicon/favicon-32x32.png" sizes="32x32" />
	<link rel="icon" type="image/png" href="img/favicon/favicon-16x16.png" sizes="16x16" />

	<title>Akijob - Resultados</title>

	<!-- Bootstrap core CSS -->
	<link href="css/bootstrap.min.css" rel="stylesheet">


	<!-- Custom styles for this template -->
	<link href="css/style.css" rel="stylesheet">
	<link href="css/bootstrap-select.min.css" rel="stylesheet">
	<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>

	<!-- Static navbar -->
	<nav class="navbar navbar-default navbar-static-top">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#"><img src="img/logo-vetor.png" alt="AkiJob" /></a>
			</div>
			<div id="navbar" class="navbar-collapse collapse">

				<ul class="nav navbar-nav navbar-right">
					<li><a href="#">Login</a></li>

				</ul>
			</div>
			<!--/.nav-collapse -->
		</div>
	</nav>

	<div id="map"></div>

	<div class="container-fluid" id="main">
		<!-- New Search -->
		<!-- <div class="row search-form-container ">
			<div class="col-lg-8 col-lg-offset-2  ">
				<form class="form-inline " id="search-form">
					<div class="form-group col-xs-12 col-sm-5 col-md-5 col-lg-5 search-element">
						<label class="sr-only" for="services_select">Serviços</label>
						<select class=" form-control selectpicker" id="services_select" data-live-search="true">
							<option>Serviços</option>
							<option>2</option>
							<option>3</option>
							<option>4</option>
							<option>5</option>
						</select>
					</div>
					<div class="form-group col-xs-12 col-sm-5 col-md-5 col-lg-5 search-element">
						<label class="sr-only" for="city_select ">Cidade</label>
						<select class=" form-control selectpicker" id="city_select" data-live-search="true">
							<option>Cidade</option>
							<option>2</option>
							<option>3</option>
							<option>4</option>
							<option>5</option>
						</select>
					</div>
					<div class="col-xs-12 col-sm-2 col-md-2 col-lg-2 search-element">
						<button type="submit" class="btn btn-primary btn-lg search-button">Buscar</button>

					</div>
				</form>
			</div>

		</div> -->
		<!-- END - New Search -->


		<div class="row">
			<div class="col-xs-8" id="left">

				<ul>
					<li>TESTE</li><li>TESTE</li><li>TESTE</li><li>TESTE</li><li>TESTE</li><li>TESTE</li><li>TESTE</li><li>TESTE</li><li>TESTE</li><li>TESTE</li><li>TESTE</li><li>TESTE</li><li>TESTE</li><li>TESTE</li><li>TESTE</li><li>TESTE</li><li>TESTE</li><li>TESTE</li><li>TESTE</li><li>TESTE</li><li>TESTE</li><li>TESTE</li><li>TESTE</li><li>TESTE</li><li>TESTE</li><li>TESTE</li><li>TESTE</li><li>TESTE</li><li>TESTE</li><li>TESTE</li><li>TESTE</li><li>TESTE</li><li>TESTE</li><li>TESTE</li><li>TESTE</li><li>TESTE</li><li>TESTE</li><li>TESTE</li><li>TESTE</li><li>TESTE</li><li>TESTE</li><li>TESTE</li><li>TESTE</li><li>TESTE</li><li>TESTE</li><li>TESTE</li><li>TESTE</li><li>TESTE</li><li>TESTE</li><li>TESTE</li><li>TESTE</li><li>TESTE</li><li>TESTE</li><li>TESTE</li><li>TESTE</li><li>TESTE</li><li>TESTE</li><li>TESTE</li><li>TESTE</li><li>TESTE</li><li>TESTE</li><li>TESTE</li><li>TESTE</li><li>TESTE</li><li>TESTE</li><li>TESTE</li><li>TESTE</li><li>TESTE</li><li>TESTE</li><li>TESTE</li><li>TESTE</li><li>TESTE</li><li>TESTE</li><li>TESTE</li><li>TESTE</li><li>TESTE</li><li>TESTE</li><li>TESTE</li><li>TESTE</li><li>TESTE</li><li>TESTE</li><li>TESTE</li><li>TESTE</li><li>TESTE</li><li>TESTE</li><li>TESTE</li><li>TESTE</li><li>TESTE</li><li>TESTE</li><li>TESTE</li><li>TESTE</li><li>TESTE</li>
					<p>
						<b>FIM</b>
					</p>

				</ul>
			</div>

			<div class="col-xs-4">

			</div>
		</div>



	</div>


	<!-- /container -->

	<footer class="footer">
		<div class="container">
			<p>© Copyright 2016 VERSALIUS</p>
		</div>
	</footer>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

	<script src="js/bootstrap.min.js"></script>
	<script src="js/bootstrap-select.min.js"></script>
	<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB51cLBRyONHcO6XKZPTThoi2P_PozYezw&callback=initMap">
	</script>
	<script type="text/javascript">
		var map;

		function initMap() {
			map = new google.maps.Map(document.getElementById('map'), {
				center: {
					lat: -34.397,
					lng: 150.644
				},
				zoom: 8
			});
		}
	</script>
</body>

</html>
