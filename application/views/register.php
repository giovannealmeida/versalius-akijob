<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Cadastrar</title>
	</head>
	<body>
		<h1>Registro</h1>
		<a href="<?=base_url()?>">Início</a>
		<br/>
		<br/>

		<?php if ($this->session->flashdata("email_exists")): ?>
			* Email já cadastrado
		<?php endif; ?>
		<?php if ($this->session->flashdata("account_exists") == 1): ?>
			* Esta conta não existse
		<?php endif; ?>
		<?php echo form_open('login/register'); ?>
		<?php echo validation_errors(); ?>
		<?php echo form_label('Nome: ', 'name'); ?>
		<?php echo form_input(array("name" => "name", "id" => "name"), isset($user_profile["name"]) ? $user_profile["name"] : set_value('name')); ?>
		<br/>
		<?php echo form_label('Email: ', 'email'); ?>
		<?php echo form_input(array("name" => "email", "id" => "email"), isset($user_profile["email"]) ? $user_profile["email"] : set_value('email')); ?>
		<br/>
		<?php echo form_label('Senha: ', 'password'); ?>
		<?php echo form_password(array("name" => "password", "id" => "password")); ?>
		<br/>
		<?php echo form_label('Confirme a senha: ', 'password2'); ?>
		<?php echo form_password(array("name" => "password2", "id" => "password2")); ?>
		<br/>
		<?php echo form_label('Gênero: ', 'gender'); ?>
		<?php echo form_dropdown('gender', $genders, '', array("id" => "gender")); ?>

		<br/>
		<?php echo form_label('Data de Nascimento: ', 'birthday'); ?>
		<?php echo form_input(array("name" => "birthday", "id" => "birthday", "placeholder" => "xx/xx/xxxx"), set_value('birthday')); ?>
		<br/>

		<?php echo form_submit('submit', 'Registrar'); ?>
		<?php if($this->session->flashdata("login_error")) :?>
		<br/><br/> *Usuário não existe
		<?php endif; ?>
	</body>
</html>
