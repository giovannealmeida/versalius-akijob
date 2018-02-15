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
        <div class="col-md-8">
            <!-- BEGIN PROFILE USER -->
            <div class="row">
                <div class="col-xs-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-xs-12 col-sm-4 col-md-3 col-lg-3">
                                    <img class="img-rounded img-responsive center-block profile-photo" src="
                                    <?php if ($user_profile->avatar === NULL): ?>
                                        <?= '//placehold.it/200' ?>
                                    <?php elseif ($user_profile->avatar == base64_decode(base64_encode(stripslashes($user_profile->avatar)))): ?>
                                        <?= $user_profile->avatar ?>
                                    <?php else: ?>
                                        <?= 'data:image/jpeg;base64,' . base64_encode(stripslashes($user_profile->avatar)); ?>
                                    <?php endif; ?>
                                         " alt="">
                                </div>
                                <div class="col-xs-12 col-sm-8 col-md-9 col-lg-9">
                                    <span class="profile-name"><?= $user_profile->name ?></span>
                                    <p><small class="address"> <span class="glyphicon glyphicon-envelope"></span> <?= $user_profile->email ?></small></p>
                                    <p><small class="address"><span class="glyphicon glyphicon-phone"></span> <?= $user_profile->phone != NULL ? $user_profile->phone : 'Não Fornecido' ?></small></p>
                                    <p>
                                        <small class="text-success"><span id="span_positive"><?= $recommendations_positive ?></span> Recomendações Positivas</small>
                                        <br>
                                        <small class="text-danger"><span id="span_negative"><?= $recommendations_negative ?></span> Recomendações Negativas</small>
                                    </p>


                                </div>
                            </div>
                        </div>
                        <?php if (isset($user_session) && $user_profile->id != $user_session->id) : ?>
                            <div class="panel-footer">
                                <div class="text-right recomendations-survey">
                                    <span>Você recomendaria este profissional?</span>
                                    <button <?= $recommendation != NULL && $recommendation->value == 1 ? 'class="btn btn-success btn-sm"' : 'class="btn btn-default btn-sm"' ?> id="btn_positive"><span class="glyphicon glyphicon-thumbs-up"></span> Sim!</button>
                                    <button <?= $recommendation != NULL && $recommendation->value == -1 ? 'class="btn btn-danger btn-sm"' : 'class="btn btn-default btn-sm"' ?> id="btn_negative"><span class="glyphicon glyphicon-hand-right"></span> Não!</button>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>

                </div>
            </div>
            <!-- END PROFILE USER -->

            <!-- BEGIN PROFILE SERVICE -->
            <div class="row">
                <div class="col-xs-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="row">
                                <div class="score">
                                    <span><?= number_format(isset($dataService->saldo) ? ($dataService->saldo) : 0, 1) ?></span>
                                </div>
                                <div class="col-xs-12 col-sm-9 col-md-9 col-lg-10">
                                    <span class="profile-name"><?= $dataService->job ?></span>
                                    <p><small class="address"> </span> <?= $dataService->city . ' - ' . $dataService->state ?></small></p>
                                    <p><small class="address"> </span> <?= $dataService->street . ', ' . $dataService->number . ', ' . $dataService->neighborhood ?></small></p>
                                </div>
                            </div>

                            <div class="divider"></div>

                            <div class="skills">
                                <h3 class="text-primary"><strong>Competências</strong></h3>
                                <p class="text-justify skills">
                                    <?= $dataService->skills == "" ? "Não Fornecido" : $dataService->skills ?>
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
                                    <input id="id_service" type="hidden" value="<?= $dataService->id ?>">
                                    <input id="input-id" type="text" class="rating" data-size="xs" value="<?= isset($rating->value) ? $rating->value : 0 ?>">
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <!-- END PROFILE SERVICE -->




            <!-- BEGIN PORTIFOLIO -->
            <?php if ($premium_data["isPremium"] && count($portfolios) > 0): ?>
                <div class='row'>
                    <div class='col-xs-12'>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Últimos trabalhos</h3>
                            </div>
                            <div class="panel-body portfolio-body">
                                <div id="links">
                                    <?php foreach ($portfolios as $portfolio): ?>

                                        <div class=" col-xs-12 col-sm-6 col-md-4 col-lg-3">
                                            <a data-gallery="" title="<?= $portfolio->description ?>" href="<?= 'data:image/jpeg;base64,' . base64_encode(stripslashes($portfolio->image)) ?>">
                                                <img class="img-responsive center-block" alt="images.jpg"
                                                     src=" <?= 'data:image/jpeg;base64,' . base64_encode(stripslashes($portfolio->image)) ?>" />
                                            </a>
                                        </div>

                                    <?php endforeach; ?>


                                    <!--
                                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                                        <a data-gallery="" title="Contact" href="http://farm8.static.flickr.com/7325/11186917235_003d9df5d6_b.jpg">
                                            <img src="http://farm8.static.flickr.com/7325/11186917235_003d9df5d6_b.jpg" class="img-responsive center-block">
                                        </a>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            <!-- END PORTIFOLIO -->

            <!-- BEGIN COMMENTS -->
            <div class="row">
                <div class="col-xs-12">

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Comentários</h3>
                        </div>
                        <div class="panel-body">
                            <form action="<?= base_url("service/service_view/" . $id) ?>" method="post">
                                <?php if (isset($user_session) && $user_profile->id != $user_session->id) : ?>
                                    <legend>Deixe seu comentário:</legend>
                                    <textarea name="comment" class="form-control" rows="3" style="resize: none" required></textarea>
                                    <input id="id_service" type="hidden" name="id_service" value="<?= $id ?>">
                                    <input type="hidden" name="id_user" id="id_user" value="<?= $user_session->id ?>">
                                    <input type="hidden" name="id_user_receiver" id="id_user_receiver" value="<?= $dataService->id_user ?>">
                                    <div class="clear"></div>
                                    <br>
                                    <input type="submit" class="btn btn-success" value="Enviar">
                                <?php endif; ?>
                            </form>
                            <br>
                            <?php
                            if ($comments == NULL) {
                                echo 'Não existem comentários a serem exibidos.';
                            } else {
                                foreach ($comments as $value):
                                    ?>
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <?= $value->user_name ?>
                                        </div>
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-xs-12 col-sm-2 col-md-2 col-lg-1">
                                                    <img class="img-circle img-responsive center-block profile-photo" src="<?= $value->avatar ?>" alt="">
                                                </div>
                                                <div class="col-xs-12 col-sm-10 col-md-10 col-lg-11">
                                                    <p><small class="address"> </span> Postado<?= $value->current_date; ?></small></p>
                                                    <p class="text-justify">
                                                        <?= $value->comment ?>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                endforeach;
                                ?>
                                <div id="comments">
                                </div>
                                <br>
                                <button type="button" id="ButtonLoadMoreComments" value="<?= $id ?>" data-loading-text="Carregando..." class="btn btn-default">Ver mais comentários</button>
                                <?php
                            }
                            ?>                            
                        </div>

                    </div>
                </div>
            </div>
            <!-- END COMMENTS -->
        </div>

        <!-- BEGIN RIGHT COLUMN -->
        <div class="col-md-4">
            <!-- BEGIN SOCIAL PROFILE -->
            <div class="row">
                <div class="col-xs-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Onde me encontrar?</h3>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div id="map" style="width:100%;height: 182.6px; margin-left: 0px"></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <ul class="list-group social-list">
                                        <li class="">
                                            <span class="social-icon"><i class="fa fa-globe" aria-hidden="true"></i></span>
                                            <?php if ($user_profile->site != NULL): ?>
                                                <a href="http://<?= $user_profile->site ?>" target="_blank">
                                                    &nbsp;&nbsp; <?= $user_profile->site ?>
                                                </a>
                                            <?php else: ?>
                                                <span> Não Fornecido </span>
                                            <?php endif; ?>
                                        </li>
                                        <li class="">
                                            <span class="social-icon"><i class="fa fa-facebook-square" aria-hidden="true"></i></span>
                                            <?php if ($user_profile->facebook != NULL): ?>
                                                <a href="https://www.facebook.com/<?= $user_profile->facebook ?>" target="_blank">
                                                    &nbsp;&nbsp; <?= $user_profile->facebook ?>
                                                </a>
                                            <?php else: ?>
                                                <span> Não Fornecido </span>
                                            <?php endif; ?>
                                        </li>
                                        <li class="">
                                            <span class="social-icon"><i class="fa fa-twitter-square" aria-hidden="true"></i></span>
                                            <?php if ($user_profile->twitter != NULL): ?>
                                                <a href="https://twitter.com/<?= $user_profile->twitter ?>" target="_blank">
                                                    &nbsp;&nbsp; <?= $user_profile->twitter ?>
                                                </a>
                                            <?php else: ?>
                                                <span> Não Fornecido </span>
                                            <?php endif; ?>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END SOCIAL PROFILE -->

            <!-- BEGIN SPONSORS -->
            <div class="row hidden-xs hidden-sm">
                <div class="col-xs-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Patrocínio</h3>
                        </div>
                        <div class="panel-body">
                            <img class="center-block ads_600_300" alt="" src="http://www.imagine-publishing.co.uk/adresources/images/300x600.jpg">
                        </div>
                    </div>
                </div>
            </div>
            <!-- END SPONSORS -->

        </div>
        <!-- END RIGHT COLUMN -->
    </div>



</div>
</div>
<div id="blueimp-gallery" class="blueimp-gallery">
    <!-- The container for the modal slides -->
    <div class="slides"></div>
    <!-- Controls for the borderless lightbox -->
    <h3 class="title"></h3>
    <a class="prev">‹</a>
    <a class="next">›</a>
    <a class="close">×</a>
    <a class="play-pause"></a>
    <ol class="indicator"></ol>
    <!-- The modal dialog, which will be used to wrap the lightbox content -->
    <div class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" aria-hidden="true">×</button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body next"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left prev">
                        <i class="glyphicon glyphicon-chevron-left"></i>
                        Previous
                    </button>
                    <button type="button" class="btn btn-primary next">
                        Next
                        <i class="glyphicon glyphicon-chevron-right"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC69Ji81pHJ6ol7VhIrIDE1mUofcZw_WuA&libraries=places&callback=initMap" async defer></script>
