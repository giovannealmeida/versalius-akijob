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
	<link href="<?=base_url('assets/css/price-table.css')?>" rel="stylesheet">

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
			<div class="comparison">
				<table>
					<thead>
						<tr>
							<th class="tl tl2"></th>
							<th class="product" style="">Grátis</th>
							<th class="product" style="">Premium</th>
						</tr>
						<tr>
							<th></th>
							<th class="price-info">
								<div class="price-now text-center"><span>Grátis</span>
								</div>
							</th>
							<th class="price-info">
								<div class="price-now text-center"><span>R$ 6,99</span>
									<p>  / mês</p>
								</div>
							</th>

						</tr>
					</thead>
					<tbody>
						<tr>
							<td></td>
							<td colspan="3">Busca de Profissionais</td>
						</tr>
						<tr class="compare-row">
							<td>Busca de Profissionais</td>
							<td><span class="glyphicon glyphicon-ok"></span></span>
							</td>
							<td><span class="glyphicon glyphicon-ok"></span></td>

						</tr>
						<tr>
							<td> </td>
							<td colspan="3">Recomendar Profissinais</td>
						</tr>
						<tr>
							<td>Recomendar Profissinais</td>
							<td><span class="glyphicon glyphicon-ok"></span></span>
							</td>
							<td><span class="glyphicon glyphicon-ok"></span></td>

						</tr>
						<tr>
							<td> </td>
							<td colspan="3">Avaliar Serviço</td>
						</tr>
						<tr class="compare-row">
							<td>Avaliar Serviço</td>
							<td><span class="glyphicon glyphicon-ok"></span></span>
							</td>
							<td><span class="glyphicon glyphicon-ok"></span></td>

						</tr>
						<tr>
							<td> </td>
							<td colspan="4">Anunciar Serviço</td>
						</tr>
						<tr>
							<td>Anunciar Serviço</td>
							<td><span class="glyphicon glyphicon-ok"></span></span>
							</td>
							<td><span class="glyphicon glyphicon-ok"></span></td>

						</tr>
						<tr>
							<td> </td>
							<td colspan="3">Portfolio</td>
						</tr>
						<tr class="compare-row">
							<td>Portfolio</td>
							<td><span class="glyphicon glyphicon-remove"></span></td>
							<td><span class="glyphicon glyphicon-ok"></span></td>

						</tr>
						<tr>
							<td> </td>
							<td colspan="4">Anunciar mais de um Serviço</td>
						</tr>
						<tr>
							<td>Anunciar mais de um Serviço</td>
							<td><span class="glyphicon glyphicon-remove"></span></td>
							<td><span class="glyphicon glyphicon-ok"></span></td>

						</tr>

						<tr>
							<td> </td>
							<td colspan="4">Maior Visibilidade</td>
						</tr>
						<tr>
							<td>Maior Visibilidade</td>
							<td><span class="glyphicon glyphicon-remove"></span></td>
							<td><span class="glyphicon glyphicon-ok"></span></td>

						</tr>

						<tr>
							<td> </td>
							<td colspan="4">Painel de Estatística sobre o Perfil</td>
						</tr>
						<tr>
							<td>Painel de Estatística sobre o Perfil</td>
							<td><span class="glyphicon glyphicon-remove"></span></td>
							<td><span class="glyphicon glyphicon-ok"></span></td>

						</tr>

						<tr>
							<td> </td>
						</tr>
						<tr>
							<td style="border-bottom: none;border-left: none;"></td>
							<td><a href="#"><button type="button" name="button" class="btn btn-primary btn-lg">Cadastre-se</button></a></td>
							<td><a href="#"><button type="button" name="button" class="btn btn-success btn-lg">Contrate!</button></a></td>
						</tr>
					</tbody>
				</table>

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
