<html>
	<head>
		<title>Login</title>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/style.css">
		<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro|Open+Sans+Condensed:300|Raleway' rel='stylesheet' type='text/css'>
	</head>
	<body>
		<div id="main">

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

		</div>
	</body>
</html>
