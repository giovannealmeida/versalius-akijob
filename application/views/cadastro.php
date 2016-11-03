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
						<li><a href="#">Login</a></li>

					</ul>
				</div>
				<!--/.nav-collapse -->
			</div>
		</nav>

		<!-- Begin page content -->
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-10 col-lg-offset-1">
					<div class="panel panel-default">
						<div class="panel-body">
							<div class="row">
								<div class="col-xs-12 col-sm-6 col-md-4 col-md-offset-2">
									<a class="btn btn-block btn-social btn-google">
										<span class="fa fa-google"></span>Cadastre-se com o Gmail
									</a>

								</div>
								<div class="col-xs-12 col-sm-6 col-md-4">
									<a class="btn btn-block btn-social btn-facebook ">
										<span class="fa fa-facebook"></span> Cadastre-se com Facebook
									</a>
								</div>

							</div>
							<div class="divider"></div>
							<h3 class="text-center">Insira seus dados</h3>
							<form class="form-horizontal" role="form">
								<div class="form-group">
									<label for="fullname" class="col-md-3 control-label">Nome Completo</label>
									<div class="col-md-9">
										<input type="text" id="fullname" placeholder="Nome Completo" class="form-control" autofocus>
									</div>
								</div>
								<div class="form-group">
									<label for="email" class="col-md-3 control-label">Email</label>
									<div class="col-md-9">
										<input type="email" id="email" placeholder="Email" class="form-control">
									</div>
								</div>
								<div class="form-group">
									<label for="password" class="col-md-3 control-label">Senha</label>
									<div class="col-md-9">
										<input type="password" id="password" placeholder="Senha" class="form-control">
									</div>
								</div>
								<div class="form-group">
									<label for="password2" class="col-md-3 control-label">Digite a Senha Novamente</label>
									<div class="col-md-9">
										<input type="password" id="password2" placeholder="Digite a Senha Novamente" class="form-control">
									</div>
								</div>
								<div class="form-group">
									<label for="birthDate" class="col-md-3 control-label">Data de Nascimento</label>
									<div class="col-md-9">
										<input type="date" id="birthDate" class="form-control">
									</div>
								</div>
								<div class="form-group">
									<label for="country" class="col-md-3 control-label">Cidade</label>
									<div class="col-md-9">
										<select id="country" class="form-control selectpicker">
											<option></option>
										</select>
									</div>
								</div>
								<!-- /.form-group -->
								<div class="form-group">
									<label class="control-label col-md-3">Sexo</label>
									<div class="col-md-6">
										<div class="row">
											<div class="col-sm-4">
												<label class="radio-inline">
													<input name="sex" type="radio" value="1">Feminino
												</label>
											</div>
											<div class="col-sm-4">
												<label class="radio-inline">
													<input name="sex" type="radio"  value="2">Masculino
												</label>
											</div>

										</div>
									</div>
								</div>
								<!-- /.form-group -->
								<div class="form-group">
									<div class="col-xs-12">
										<div class="checkbox">
											<label>
												<input type="checkbox">Eu li e concordo com os <a href="#"> Termos e Condições de Uso</a>
											</label>
										</div>
									</div>
								</div>
								<!-- /.form-group -->
								<div class="form-group">
									<div class="col-xs-4 col-xs-offset-4 ">
										<button type="submit" class="btn btn-primary btn-block btn-lg">Cadastre-se</button>
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
