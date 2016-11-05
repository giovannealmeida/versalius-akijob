
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
                                        <?= $dataService->note ?>
                                    </div>
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
                            <div class="row">
                                <div class="col-sm-8 col-sm-offset-2">
                                    <div class="portfolio-card">
                                        <div class="portfolio-img">
                                            <img src="https://wallpaperscraft.com/image/surface_drops_texture_background_lilac_96071_602x339.jpg" alt="" />
                                        </div>
                                        <div class="portfolio-text">
                                            <p>
                                                Aqui é Body Builder Ipsum PORRA! Que não vai dá rapaiz, não vai dá essa porra. É verão o ano todo vem cumpadi. AHHHHHHHHHHHHHHHHHHHHHH..., porra! Negativa Bambam negativa. Birl! Aqui nóis constrói fibra, não é água com músculo. Bora caralho, você quer

                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-8 col-sm-offset-2">
                                    <div class="portfolio-card">
                                        <div class="portfolio-img">
                                            <img src="https://wallpaperscraft.com/image/surface_drops_texture_background_lilac_96071_602x339.jpg" alt="" />
                                        </div>
                                        <div class="portfolio-text">
                                            <p>
                                                Aqui é Body Builder Ipsum PORRA! Que não vai dá rapaiz, não vai dá essa porra. É verão o ano todo vem cumpadi. AHHHHHHHHHHHHHHHHHHHHHH..., porra! Negativa Bambam negativa. Birl! Aqui nóis constrói fibra, não é água com músculo. Bora caralho, você quer

                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>


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
