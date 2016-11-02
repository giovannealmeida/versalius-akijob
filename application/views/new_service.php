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
	<link href="<?=base_url('assets/css/bootstrap-toggle.min.css')?>" rel="stylesheet">



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
						<li><a href="#">Login</a></li>

					</ul>
				</div>
				<!--/.nav-collapse -->
			</div>
		</nav>

		<!-- Begin page content -->
		<div class="container">
			<div class="row">
				<div class="col-cs-12 col-sm-12 col-md-10 col-md-offset-1 col-lg-10 col-lg-offset-1">
					<div class="panel panel-default">
						<div class="panel-heading">
							<h3 class="panel-title"><strong>Novo Serviço</strong></h3>
						</div>
						<div class="panel-body">
							<form class="" action="index.html" method="post">
								<div class="row">
									<div class="col-lg-5">
										<div class="form-group">
											<label for="address">Rua</label>
											<input type="address_street" class="form-control" id="address" placeholder="Rua">
										</div>
									</div>

									<div class="col-lg-5">
										<div class="form-group">
											<label for="complement">Complemento</label>
											<input type="address_complement" class="form-control" id="complement" placeholder="Complemento">
										</div>

									</div>
									<div class="col-lg-2">
										<div class="form-group">
											<label for="number">Número</label>
											<input type="address_number" class="form-control" id="number" placeholder="Número">
										</div>
									</div>

								</div>

								<div class="row">

									<div class="col-lg-2">
										<div class="form-group">
											<label for="cep">CEP</label>
											<input type="address_cep" class="form-control" id="cep" placeholder="CEP">
										</div>
									</div>
									<div class="col-lg-3">
										<div class="form-group">
											<label for="neighborhood">Bairro</label>
											<input type="address_neighborhood" class="form-control" id="neighborhood" placeholder="Bairro">
										</div>
									</div>

									<div class="col-lg-3">
										<div class="form-group">
											<label for="neighborhood">Estado</label>
											<select class="form-control selectpicker" name="state">

											</select>
										</div>
									</div>

									<div class="col-lg-4">
										<div class="form-group">
											<label for="neighborhood">Cidade</label>
											<select class="form-control selectpicker" name="city">

											</select>
										</div>
									</div>



								</div>

								<div class="row">
									<div class="col-xs-12">
										<div class="form-group">
											<label for="neighborhood">Serviço</label>
											<select class="form-control selectpicker" name="job">

											</select>
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-xs-12">
										<label for="skills">Competências</label>
										<textarea class="form-control" name="skills" id="skills" placeholder="Informe aqui sua experiência e capacidade no serviço escolhido"></textarea>
									</div>
								</div>

								<div class="divider"></div>


								<h4 class="text-info">Diferenciais</h4>
								<div class="row">
									<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
										<div class="checkbox">
											<label style="width:100%;">
												<input type="checkbox" data-toggle="toggle" data-on="Possui Disponibilidade 24h" data-off="Não Possui Disponibilidade 24h">
											</label>
										</div>

									</div>
									<div class="col-xs-12 col-sm-12 col-md-6 col-lg-5">
										<div class="checkbox">
											<label style="width:100%;">
												<input type="checkbox" data-toggle="toggle" data-on="Possui Disponibilidade<br>no Final de Semana" data-off="Não Possui Disponibilidade<br>no Final de Semana ">
											</label>
										</div>

									</div>
								</div>

								<div class="divider"></div>

								<div class="row">
									<div class="col-xs-12">
										<h4 class="text-info">Onde te encontrar?</h4>

										<div id="service-map">

										</div>
									</div>

								</div>

								<div class="divider"></div>

								<div class="row">
									<div class="col-xs-12 col-sm-12 col-md-6  col-lg-2 col-lg-offset-8">
										<button type="button" class="btn btn-danger btn-lg btn-block">Cancelar</button>
									</div>
									<div class="col-xs-12 col-sm-12 col-md-6  col-lg-2 ">
										<button type="button" class="btn btn-success btn-lg btn-block">Cadastrar</button>
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
	<script src="<?=base_url('assets/js/bootstrap-toggle.min.js')?>"></script>
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
