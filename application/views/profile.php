<!DOCTYPE html>
<html lang="en">

    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <meta charset="utf-8">
        <title>Akijob - Perfil</title>
        <meta name="generator" content="Bootply" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <meta name="description" content="" />
        <link href="<?= base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">
        <link href="<?= base_url('assets/css/style.css') ?>" rel="stylesheet">
        <link href="<?= base_url('assets/css/bootstrap-select.min.css') ?>" rel="stylesheet">



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
                        <a class="navbar-brand" href="<?= base_url() ?>"><img src="<?= base_url('assets/img/logo-vetor.png') ?>" alt="AkiJob" /></a>
                    </div>
                    <div id="navbar" class="navbar-collapse collapse">

                        <ul class="nav navbar-nav navbar-right">
                            <li><a href="<?= base_url("index") ?>">Início</a></li>
                            <li><a href="<?= base_url("profile") ?>">Minha Conta</a></li>
                            <li><a href="<?= base_url("logout") ?>">Logout</a></li>
                        </ul>
                    </div>
                    <!--/.nav-collapse -->
                </div>
            </nav>

            <!-- Begin page content -->
            <div class="container">
                <div class="row">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <img class="app-marker" src="<?= base_url('assets/img/marker.png') ?>" alt="" /> Use nosso aplicativo! <a class="pull-right" href="#"><span class="glyphicon glyphicon-remove"></span></a>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="col-xs-12 col-sm-3 col-md-3 col-lg-2">
                                <img class="img-rounded img-responsive center-block profile-photo" src="https://scontent-gru2-1.xx.fbcdn.net/v/t1.0-9/12661910_10201263910395842_3825443503449595796_n.jpg?oh=50529b472045cd4aab65d6171f942e67&amp;oe=58A1BAA5" alt="">
                            </div>
                            <div class="col-xs-12 col-sm-9 col-md-9 col-lg-10">
                                <span class="profile-name"><?= $user_profile->name ?></span>
                                <?php if ($recommendations >= 100 && $recommendations <= 1000): ?>
                                    <img src="<?= base_url("assets/img/crown-bronze.png") ?>" alt="tier" class="tier"/>
                                <?php elseif ($recommendations > 1000 && $recommendations <= 5000): ?>
                                    <img src="<?= base_url("assets/img/crown-silver.png") ?>" alt="tier" class="tier"/>
                                <?php elseif ($recommendations > 5000 && $recommendations < 10000): ?>
                                    <img src="<?= base_url("assets/img/crown-gold.png") ?>" alt="tier" class="tier"/>
                                <?php elseif ($recommendations > 10000): ?>
                                    <img src="<?= base_url("assets/img/crown-platina.png") ?>" alt="tier" class="tier"/>
                                <?php endif; ?>
                                <a class="pull-right hidden-xs hidden-sm btn btn-warning " href="<?= base_url('profile/edit'); ?>">Editar Informações</a>
                                <p><small class="address"> <span class="glyphicon glyphicon-map-marker"> </span> <?= $city->name . ', ' . $state->initials ?></small></p>
                                <p><small class="address"> <span class="glyphicon glyphicon-envelope"></span> <?= $user_profile->email ?></small></p>
                                <p><small class="address"><span class="glyphicon glyphicon-phone"></span> (73) 99121-4980</small></p>
                                <p>
                                    <small class="text-success"><?= $user_profile->positive_recommendations ?> Recomendações Positivas</small>
                                    <br>
                                    <small class="text-danger"><?= $user_profile->negative_recommendations ?> Recomendações Negativas</small>
                                </p>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <h3>Serviços</h3>
                            <div class="divider"></div>
                            <!-- <div class="row">
                                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                                            <div class="service-item service-item-job center-block">
                                                    <div class="header">
                                                            <h4>Padeiro</h4>
                                                    </div>
                                                    <div class="score-big center-block">
                                                            <b>10,0</b>
                                                    </div>
                                                    <div class="options">
                                                            <button type="button" class="btn btn-warning btn-sm"><span class="glyphicon glyphicon-pencil"></span> Editar</button>
                                                            <button type="button" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-remove"></span> Remover</button>
                                                    </div>
                                            </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                                            <a href="#">
                                                    <div class=" service-item service-item-add center-block">
                                                    </div>
                                            </a>
                                    </div>

                            </div> -->
                            <div class="table-responsive">
                                <?php if ($this->session->flashdata("mensagem_service")) : ?>
                                    <div class="alert alert-success">
                                        <strong><?php echo $this->session->flashdata("mensagem_service"); ?></strong><br/>
                                    </div>
                                <?php endif; ?>
                                <?php if ($this->session->flashdata("erro_service")) : ?>
                                    <div class="alert alert-success">
                                        <strong><?php echo $this->session->flashdata("erro_service"); ?></strong><br/>
                                    </div>
                                <?php endif; ?>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>
                                                #
                                            </th>
                                            <th>
                                                Nome do Serviço
                                            </th>
                                            <th>
                                                Nota
                                            </th>
                                            <th>
                                                Opções
                                            </th>

                                        </tr>
                                    </thead>
                                    <?php if (count($services) > 0): ?>
                                        <?php foreach ($services as $key => $service): ?>
                                            <tr>
                                                <th scope="row"><?= $key + 1 ?></th>
                                                <td><?= $service->job ?></td>
                                                <td><?= $service->note ?></td>
                                                <td>
                                                    <a  class="btn btn-info btn-sm" href="<?= base_url("service/toView/{$service->id}"); ?>"><span class="glyphicon glyphicon-eye-openn"></span>Visualizar Anúncio</a>
                                                    <a  class="btn btn-warning btn-sm" href="<?= base_url("service/edit/{$service->id}"); ?>"><span class="glyphicon glyphicon-pencil"></span>Editar</a>
                                                    <a class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja excluir?')" href="<?= base_url("service/delete/{$service->id}"); ?>"><span class="glyphicon glyphicon-remove"></span> Remover</a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </table>
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


        <script src="<?= base_url('assets/js/bootstrap.min.js') ?>"></script>

        <script src="<?= base_url('assets/js/bootstrap-select.min.js') ?>"></script>


    </body>

</html>
