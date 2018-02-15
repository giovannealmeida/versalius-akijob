<html>
	<head>
		<title>Login</title>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/style.css">
		<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro|Open+Sans+Condensed:300|Raleway' rel='stylesheet' type='text/css'>
	</head>
	<body>
		<div id="main">
			<?php if ($this->session->userdata("logged_in")): ?>
				Olá, <a href="<?=base_url("profile")?>"><?= $user_name ?></a>
				<br>
				<a href="<?=base_url("logout")?>">Logout</a>
			<?php else: ?>
				<div id="login_facebook">
					<a href="<?=$login_url_facebook?>">Login com Facebook</a>
				</div>
				<div id="login_google">
					<a href="<?=$login_url_google?>">Login com Google</a>
				</div>
				<div id="login_email">
					<?php echo form_open('login/'); ?>
					<?php echo form_label('Email: ', 'email'); ?>
					<?php echo form_input(array("name" => "email", "id" => "email")); ?>
					<br/>
					<?php echo form_label('Senha: ', 'password'); ?>
					<?php echo form_password(array("name" => "password", "id" => "password")); ?>
					<br/>
					<a href="<?=base_url("login/register")?>" >Cadastre-se</a>
					<?php echo form_submit('submit', 'Acessar'); ?>
					<?php if($this->session->flashdata("login_error")) :?>
					<br/><br/> *Usuário não existe
					<?php endif; ?>
				</div>
			<?php endif; ?>

			<hr>
			<h4>Escontre profissionais</h4>
			<form class="" action="<?=base_url("search")?>" method="post">
				<input type="text" name="service" placeholder="Serviço"/>
				<input type="text" name="city" placeholder="Cidade" />
				<input type="submit" value="Pesquisar">
			</form>
		</div>


		<script type="text/javascript">
		if (window.location.hash && window.location.hash == '#_=_') {
			if (window.history && history.pushState) {
				window.history.pushState("", document.title, window.location.pathname);
			} else {
				// Prevent scrolling by storing the page's current scroll offset
				var scroll = {
					top: document.body.scrollTop,
					left: document.body.scrollLeft
				};
				window.location.hash = '';
				// Restore the scroll offset, should be flicker free
				document.body.scrollTop = scroll.top;
				document.body.scrollLeft = scroll.left;
			}
		}
		</script>
	</body>
</html>
