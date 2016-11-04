<!DOCTYPE html>
<html lang="en">

<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<meta charset="utf-8">
	<title>Akijob - Perfil</title>
	<meta name="generator" content="Bootply" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta name="description" content="" />
	<link href="<?=base_url('assets/css/bootstrap.min.css')?>" rel="stylesheet">
	<link href="<?=base_url('assets/css/style.css')?>" rel="stylesheet">
	<link href="<?=base_url('assets/css/bootstrap-select.min.css')?>" rel="stylesheet">
	<link href="<?=base_url('assets/css/bootstrap-social.css')?>" rel="stylesheet">
	<link href="<?=base_url('assets/css/font-awesome.css')?>" rel="stylesheet">



	<!--[if lt IE 9]>
          <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->


</head>

<!-- HTML code from Bootply.com editor -->

<body>

	<!-- Wrap all page content here -->
	<div id="main">

		<!-- Fixed navbar -->
		<nav class="navbar navbar-default navbar-static-top">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="<?=base_url()?>"><img src="<?=base_url('assets/img/logo-vetor.png')?>" alt="AkiJob" /></a>
				</div>
				<div id="navbar" class="navbar-collapse collapse">

					<ul class="nav navbar-nav navbar-right">
						 <li><a href="<?= base_url('login') ?>">Login</a></li>

					</ul>
				</div>
				<!--/.nav-collapse -->
			</div>
		</nav>

		<!-- Begin page content -->
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-6 col-sm-offset-3 col-md-6 col-md-offset-3 col-lg-4 col-lg-offset-4">
					<div class="panel panel-default">
						<div class="panel-body">
							<h4>Insira seu email</h4>
							<form class="" action="#" method="post">
								<div class="row">
									<div class="col-xs-12">
										<div class="form-group">
											<label for="email" class="sr-only">Email</label>
											<input name="email" type="text" id="email" placeholder="Email" class="form-control" autofocus>
										</div>

									</div>
								</div>
								<div class="row">
									<div class="col-xs-12">
										<div class="form-group">
											<button type="submit" name="button" class="btn btn-primary btn-block">Confirmar</button>
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>

				</div>
			</div>


		</div>
	</div>

	<div id="footer">
		<div class="container">
			<p>© Copyright 2016 VERSALIUS</p>
		</div>
	</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>


	<script src="<?=base_url('assets/js/bootstrap.min.js')?>"></script>
	<script src="<?=base_url('assets/js/bootstrap-select.min.js')?>"></script>
	<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB51cLBRyONHcO6XKZPTThoi2P_PozYezw&callback=initialize"></script>


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

			var map = new google.maps.Map(document.getElementById("service-map"), mapOptions);
			marker.setMap(map);

		};
		/* end google maps -----------------------------------------------------*/
	</script>

</body>

</html>
