
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
                        <img class="img-rounded img-responsive center-block profile-photo" src="                                
                        <?php if ($user_profile->avatar === NULL): ?>
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
                        <p><small class="address"> <span class="glyphicon glyphicon-map-marker"> </span> <?= $city->name . ', ' . $state->initials ?></small></p>
                        <p><small class="address"> <span class="glyphicon glyphicon-envelope"></span> <?= $user_profile->email ?></small></p>
                        <p><small class="address"><span class="glyphicon glyphicon-phone"></span> <?= $user_profile->phone != NULL ? $user_profile->phone : 'Não Fornecido' ?></small></p>
                        <p>
                            <small class="text-success"><?= $recommendations_positive ?> Recomendações Positivas</small>
                            <br>
                            <small class="text-danger"><?= $recommendations_negative ?> Recomendações Negativas</small>
                        </p>


                    </div>
                </div>
            </div>
            <?php if (isset($user_session) && $user_profile->id != $user_session->id) : ?>
                <div class="panel-footer">
                    <div class="text-right recomendations-survey">
                        <span>Você recomendaria este profissional?</span>
                        <a class="btn btn-success btn-sm" href="<?= base_url("profile/recommendations/{$id}/1") ?>"><span class="glyphicon glyphicon-thumbs-up"></span> Sim!</a>
                        <a class="btn btn-danger btn-sm" href="<?= base_url("profile/recommendations//{$id}/-1") ?>"><span class="glyphicon glyphicon-hand-right"></span> Não!</a>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <div class="row">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="row">
                    <div class="col-xs-12 col-sm-9 col-md-9 col-lg-10">
                        <span class="profile-name"><?= $dataService->job ?></span>
                        <input id="display_stars" disabled="true" onclick="disabled" type="text" class="rating" data-size="xs" value="<?= isset($dataService->saldo) ? $dataService->saldo : 0 ?>" >
                        <p><small class="address"> </span> <?= $dataService->city . ' - ' . $dataService->state ?></small></p>
                        <p><small class="address"> </span> <?= $dataService->street . ', ' . $dataService->number . ', ' . $dataService->neighborhood ?></small></p>
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
            <?php if (isset($user_session) && $user_profile->id != $user_session->id) : ?>
                <div class="panel-footer">
                    <div class="text-right recomendations-survey">
                        <span>Avalie a qualidade do serviço</span>
                        <input id="id_service" type="hidden"  value="<?= $dataService->id ?>" >
                        <input id="input-id" type="text" class="rating" data-size="xs" value="<?= isset($rating->value) ? $rating->value : 0 ?>" >
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <?php if (count($portfolios) > 0): ?>
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Este são meus últimos trabalhos</h3>
                </div>
                <div class="panel-body portfolio-container">
                    <?php foreach ($portfolios as $portfolio): ?>
                        <div class="row">
                            <div class="col-sm-8 col-sm-offset-2">
                                <div class="portfolio-card">
                                    <div class="portfolio-img">
                                        <img alt="images.jpg"
                                             src=" <?= 'data:image/jpeg;base64,' . base64_encode(stripslashes($portfolio->image)) ?>" />
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
                </div>
            </div>
        </div>
    <?php endif; ?>



    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Onde me encontrar?</h3>
            </div>
            <div class="panel-body">
                <div id="map" style="width:100%;height: 500px; margin-left: 0px"></div>
            </div>
        </div>
    </div>

    <?php if (isset($user_session) && $user_profile->id != $user_session->id) : ?>
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Comentários</h3>
                </div>
                <div id="comments" class="panel-body">
                    <form action="<?= base_url("Service/toView/" . $id) ?>" method="post">                    
                        <legend>Deixe seu comentário:</legend>                    
                        <textarea name="comment" class="form-control" rows="3" required></textarea>
                        <input id="id_service" type="hidden" name="id_service" value="<?= $id ?>">
                        <input type="hidden" name="id_user" value="<?= $user_profile->id ?>">
                        <input id="offset" type="hidden" name="offset" value="1">
                        <div class="clear"></div><br>
                        <input type="submit" class="btn btn-success" value="Enviar">                    
                    </form>
                    <br>
                    <?php
                    if ($comments != NULL):
                        foreach ($comments as $value):
                            ?>
                            <div class="panel panel-default">
                                <div class="panel-heading"><?= $value->user_name ?></div>
                                <div class="panel-body">
                                    <?= $value->comment ?>
                                </div>
                            </div>
                            <?php
                        endforeach;
                    endif;
                    ?>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <button type="button" id="ButtonLoadMoreComments" value="<?= $id ?>" data-loading-text="Carregando..." class="btn btn-default">Ver mais comentários</button>
</div>


<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC69Ji81pHJ6ol7VhIrIDE1mUofcZw_WuA&libraries=places&callback=initMap" async defer></script>
