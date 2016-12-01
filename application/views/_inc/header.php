<!DOCTYPE html>
<html lang="pt-br">

    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <meta name="description" content="" />
        <link rel="apple-touch-icon" sizes="57x57" href="<?=base_url("assets/img/favicon/apple-icon-57x57.png")?>">
        <link rel="apple-touch-icon" sizes="60x60" href="<?=base_url("assets/img/favicon/apple-icon-60x60.png")?>">
        <link rel="apple-touch-icon" sizes="72x72" href="<?=base_url("assets/img/favicon/apple-icon-72x72.png")?>">
        <link rel="apple-touch-icon" sizes="76x76" href="<?=base_url("assets/img/favicon/apple-icon-76x76.png")?>">
        <link rel="apple-touch-icon" sizes="114x114" href="<?=base_url("assets/img/favicon/apple-icon-114x114.png")?>">
        <link rel="apple-touch-icon" sizes="120x120" href="<?=base_url("assets/img/favicon/apple-icon-120x120.png")?>">
        <link rel="apple-touch-icon" sizes="144x144" href="<?=base_url("assets/img/favicon/apple-icon-144x144.png")?>">
        <link rel="apple-touch-icon" sizes="152x152" href="<?=base_url("assets/img/favicon/apple-icon-152x152.png")?>">
        <link rel="apple-touch-icon" sizes="180x180" href="<?=base_url("assets/img/favicon/apple-icon-180x180.png")?>">
        <link rel="icon" type="image/png" sizes="192x192"  href="<?=base_url("assets/img/favicon/android-icon-192x192.png")?>">
        <link rel="icon" type="image/png" sizes="32x32" href="<?=base_url("assets/img/favicon/favicon-32x32.png")?>">
        <link rel="icon" type="image/png" sizes="96x96" href="<?=base_url("assets/img/favicon/favicon-96x96.png")?>">
        <link rel="icon" type="image/png" sizes="16x16" href="<?=base_url("assets/img/favicon/favicon-16x16.png")?>">
        <link rel="manifest" href="<?=base_url("assets/img/favicon/manifest.json")?>">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="<?=base_url("assets/img/favicon/ms-icon-144x144.png")?>">
        <meta name="theme-color" content="#ffffff">
        <title>Akijob</title>
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
        <link href="<?= base_url("assets/css/bootstrap.min.css") ?>" rel="stylesheet">
        <link href="<?= base_url("assets/css/style.css") ?>" rel="stylesheet">
        <link href="<?= base_url("assets/css/bootstrap-select.min.css") ?>" rel="stylesheet">
        <link href="<?= base_url('assets/css/bootstrap-social.css') ?>" rel="stylesheet">
        <link href="<?= base_url('assets/css/font-awesome.css') ?>" rel="stylesheet">
        <?php if (isset($styles)): ?>
            <?php foreach ($styles as $style): ?>
                <link href="<?= $style ?>" rel="stylesheet">
            <?php endforeach; ?>
        <?php endif; ?>



        <!--[if lt IE 9]>
          <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->


    </head>

    <!-- HTML code from Bootply.com editor -->

    <body>

        <!-- Wrap all page content here -->
        <div id="main">

            <!-- Fixed navbar -->
            <nav class="navbar navbar-default navbar-static-top" id="navbar-form">
                <div class="container">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="<?= base_url() ?>"><img src="<?= base_url("assets/img/logo-vetor.png") ?>" alt="AkiJob" /></a>
                    </div>
                    <div id="navbar" class="navbar-collapse collapse">

                        <ul class="nav navbar-nav navbar-right">
                            <?php if ($this->session->userdata('logged_in') && $this->session->userdata('logged_in')->id_status == 1): ?>
                                <li><a href="<?= base_url("profile") ?>">Minha Conta</a></li>
                                <li><a href="<?= base_url("logout") ?>">Sair</a></li>
                            <?php elseif ($this->session->userdata('logged_in') && $this->session->userdata('logged_in')->id_status == -1): ?>
                                <li><a href="<?= base_url("logout") ?>">Sair</a></li>
                            <?php else: ?>
                                <li><a href="<?= base_url('login') ?>">Entrar</a></li>
                            <?php endif; ?>
                        </ul>
                    </div>
                    <!--/.nav-collapse -->
                </div>
            </nav>
