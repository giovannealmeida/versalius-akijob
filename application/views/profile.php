
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
                <div class="col-xs-12 col-sm-3 col-md-3 col-lg-2">
                    <img class="img-rounded img-responsive center-block profile-photo" src="<?php
                    if ($user_profile->avatar === null)
                        echo base_url('/assets/pages/media/profile/profile_user.png');
                    elseif ($user_profile->id_google != NULL || $user_profile->id_facebook !== NULL)
                        echo $user_profile->avatar;
                    else
                        echo 'data:image/jpeg;base64,' . base64_encode(stripslashes($user_profile->avatar));
                    ?>" alt="" style="width: 200px; height: 200px">
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
                    <p><small class="address"><span class="glyphicon glyphicon-phone"></span> <?= $user_profile->phone ?></small></p>
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
                <a href="<?= base_url("service/novo") ?>"><button type="button" class="btn btn-primary"><i class="fa fa-plus-circle" aria-hidden="true"></i>  Novo Serviço</button></a>

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
                                        <a class="btn btn-primary btn-sm" href="<?= base_url("service/portifolio/{$service->id}"); ?>"><i class="fa fa-camera-retro" aria-hidden="true"></i> Portifolio</a>
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
