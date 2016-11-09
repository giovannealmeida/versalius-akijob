
<!-- Begin page content -->
<div class="container">
    <!-- <div class="row">
        <div class="panel panel-default">
            <div class="panel-body">
                <img class="app-marker" src="<?= base_url('assets/img/marker.png') ?>" alt="" /> Use nosso aplicativo! <a class="pull-right" href="#"><span class="glyphicon glyphicon-remove"></span></a>
            </div>
        </div>
    </div> -->


    <div class="row">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="row">
                    <div class="col-xs-12 col-sm-3 col-md-3 col-lg-2">
                        <img class="img-rounded img-responsive center-block profile-photo" src="                                <?php if ($user_profile->avatar === NULL): ?>
                            <?= '//placehold.it/200' ?>
                        <?php elseif ($user_profile->avatar == base64_decode(base64_encode(stripslashes($user_profile->avatar)))): ?>
                            <?= $user_profile->avatar ?>
                        <?php else: ?>
                            <?= 'data:image/jpeg;base64,' . base64_encode(stripslashes($user_profile->avatar)); ?>
                        <?php endif; ?>
                             " alt="" >
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
                            <small class="text-success"><?= $recommendations_positive ?> Recomendações Positivas</small>
                            <br>
                            <small class="text-danger"><?= $recommendations_negative ?> Recomendações Negativas</small>
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
                    <a class="btn btn-success btn-sm" href="<?= base_url("profile/recommendations/{$id}/1") ?>"><span class="glyphicon glyphicon-thumbs-up"></span> Sim!</a>
                    <a class="btn btn-danger btn-sm" href="<?= base_url("profile/recommendations//{$id}/-1") ?>"><span class="glyphicon glyphicon-hand-right"></span> Não!</a>
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
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC69Ji81pHJ6ol7VhIrIDE1mUofcZw_WuA&libraries=places&callback=initMap" async defer></script>
