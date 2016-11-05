<!DOCTYPE html>
<html lang="pt-br">

    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <meta name="description" content="" />
        <title>Akijob</title>
        <link href="<?= base_url("assets/css/bootstrap.min.css") ?>" rel="stylesheet">
        <link href="<?= base_url("assets/css/style.css") ?>" rel="stylesheet">
        <link href="<?= base_url("assets/css/bootstrap-select.min.css") ?>" rel="stylesheet">
        <link href="<?= base_url('assets/css/bootstrap-social.css') ?>" rel="stylesheet">
        <link href="<?= base_url('assets/css/font-awesome.css') ?>" rel="stylesheet">
        <link href="<?= base_url('assets/css/akijob.css') ?>" rel="stylesheet">
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
            <nav class="navbar navbar-default navbar-static-top">
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
                            <?php if ($this->session->userdata('logged_in')): ?>
                                <li><a href="<?= base_url("profile") ?>">Minha Conta</a></li>
                                <li><a href="<?= base_url("logout") ?>">Logout</a></li>
                            <?php else: ?>
                                <li><a href="<?= base_url('login') ?>">Login</a></li>
                            <?php endif; ?>
                        </ul>
                    </div>
                    <!--/.nav-collapse -->
                </div>
            </nav>
