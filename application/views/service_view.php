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
                            <div class="row">
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
                                    <div class="score-big">
                                        <b><?php echo $dataService->note != NULL ? $dataService->note : '-' ?></b>
                                    </div>
                                    <p><small class="address"> <span class="glyphicon glyphicon-map-marker"> </span> <?= $city->name . ', ' . $state->initials ?></small></p>
                                    <p><small class="address"> <span class="glyphicon glyphicon-envelope"></span> <?= $user_profile->email ?></small></p>
                                    <p><small class="address"><span class="glyphicon glyphicon-phone"></span> <?= $user_profile->phone ?></small></p>
                                    <p>
                                        <small class="text-success"><?= $user_profile->positive_recommendations ?> Recomendações Positivas</small>
                                        <br>
                                        <small class="text-danger"><?= $user_profile->negative_recommendations ?> Recomendações Negativas</small>
                                    </p>


                                </div>
                            </div>

                            <div class="divider"></div>

                            <div class="skills">
                                <h3 class="text-primary"><strong>Competências</strong></h3>
                                <p class="text-justify skills">
                                    <?= $dataService->skills ?>
                                </p>
                            </div>

                            <div class="divider"></div>

                            <div class="differential">
                                <h3 class="text-primary"><strong>Diferencial</strong></h3>
                                <ul class="list-unstyled list-inline">
                                    <?php if ($dataService->availability_fds): ?>
                                        <li>
                                            <span class="label label-default ">Trabalha No Fim de Semana</span>
                                        </li>
                                    <?php endif; ?>
                                    <?php if ($dataService->availability_24h): ?>
                                        <li>
                                            <span class="label label-default ">Trabalha 24h</span>
                                        </li>
                                    <?php endif; ?>

                                </ul>

                            </div>
                        </div>
                        <div class="panel-footer">
                            <div class="text-right recomendations-survey">
                                <span>Você recomendaria este profissional?</span>
                                <a class="btn btn-success btn-sm" href="<?= base_url("profile/positive_recommendations/{$id}") ?>"><span class="glyphicon glyphicon-thumbs-up"></span> Sim!</a>
                                <a class="btn btn-danger btn-sm" href="<?= base_url("profile/negative_recommendations//{$id}") ?>"><span class="glyphicon glyphicon-hand-right"></span> Não!</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Este são meus últimos trabalhos</h3>
                        </div>
                        <div class="panel-body portfolio-container">
                            <?php if (count($portfolios) > 0): ?>
                                <?php foreach ($portfolios as $portfolio): ?>
                                    <div class="row">
                                        <div class="col-sm-8 col-sm-offset-2">
                                            <div class="portfolio-card">
                                                <div class="portfolio-img">
                                                    <img alt="images.jpg" 
                                                         src="data:image/jpeg;base64,<?= $portfolio->image ?>" />
                                                </div>
                                                <div class="portfolio-text">
                                                    <p>
                                                        <?= $portfolio->description ?>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>



                <div class="row">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Onde me encontrar?</h3>
                        </div>
                        <div class="panel-body">
                            <div id="map" style="width:100%;height: 500px; margin-left: 0px"></div>
                            <?php echo form_input(array('class' => 'controls', 'id' => 'pac-input', 'placeholder' => "Pesquisar")); ?>
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
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC69Ji81pHJ6ol7VhIrIDE1mUofcZw_WuA&libraries=places&callback=initMap" async defer></script>
    <script src="<?= base_url('/assets/js/google_maps/mapsRegister.js'); ?>" type="text/javascript"></script>
    <link href="<?= base_url('/assets/css/google_maps/mapsRegister.css'); ?>" rel="stylesheet" type="text/css" />
    <script> setLatLng(<?= $dataService->latitude ?>, <?= $dataService->longitude ?>);</script>
    <?php if (isset($dataService)): ?>
        <script> setMarker({lat:<?= $dataService->latitude ?>, lng:<?= $dataService->longitude ?>});</script>
    <?php endif; ?>

</body>

</html>
