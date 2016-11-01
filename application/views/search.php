<!DOCTYPE html>
<html lang="en">

<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<meta charset="utf-8">
	<title>Akijob</title>
	<meta name="generator" content="Bootply" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta name="description" content="" />
	<link href="<?=base_url("assets/css/bootstrap.min.css")?>" rel="stylesheet">
	<link href="<?=base_url("assets/css/style.css")?>" rel="stylesheet">
	<link href="<?=base_url("assets/css/akijob.css")?>" rel="stylesheet">
	<link href="<?=base_url("assets/css/bootstrap-select.min.css")?>" rel="stylesheet">



	<!--[if lt IE 9]>
          <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->


</head>

<!-- HTML code from Bootply.com editor -->

<body>

	<!-- Wrap all page content here -->
	<div id="wrap">

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
					<a class="navbar-brand" href="<?=base_url()?>"><img src="<?=base_url("assets/img/logo-vetor.png")?>" alt="AkiJob" /></a>
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
				<div class="col-xs-10 col-sm-8 col-md-4 col-lg-4 col-xs-offset-1 col-sm-offset-2 col-md-offset-4 col-lg-offset-4">
					<img src="<?=base_url("assets/img/logo-vetor.png")?>" alt="logo" class="img-responsive center-block" />

				</div>
			</div>
			<div class="search-form-container row">
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

			</div>
		</div>
	</div>

	<div id="footer">
		<div class="container">
			<p>© Copyright 2016 VERSALIUS</p>
		</div>
	</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>


	<script src="<?=base_url("assets/js/bootstrap.min.js")?>"></script>

	<script src="<?=base_url("assets/js/bootstrap-select.min.js")?>"></script>


</body>

</html>
