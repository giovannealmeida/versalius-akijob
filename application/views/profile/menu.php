<div class="container">
    <div class="row profile">
        <div class="col-md-3">
            <div class="profile-sidebar">
                <!-- SIDEBAR USERPIC -->
                <div class="profile-tier">
                    <a href="#"><img src="<?= $tier_img ?>" alt="tier" class="center-block tier-big" title="Clique para saber mais sobre os rankings"/></a>
                </div>
                <div class="profile-userpic">
                    <img class="img-responsive" src="<?php
                    if ($user_profile->avatar === null)
                        echo base_url('/assets/pages/media/profile/profile_user.png');
                    elseif ($user_profile->avatar == base64_decode(base64_encode(stripslashes($user_profile->avatar))))
                        echo $user_profile->avatar;
                    else
                        echo 'data:image/jpeg;base64,' . base64_encode(($user_profile->avatar));
                    ?>" alt="">

                </div>
                <!-- END SIDEBAR USERPIC -->
                <!-- SIDEBAR USER TITLE -->
                <div class="profile-usertitle">

                    <div class="profile-usertitle-name">
                        <?= $user_profile->name ?>
                    </div>
                    <div class="profile-usertitle-paid">
                        <?php if ($premium_data["isPremium"]): ?>
                            <span class="label label-success">Conta Premium</span>

                        <?php else: ?>
                            <span class="label label-default">Conta Grátis</span>
                        <?php endif; ?>
                    </div>
                </div>
                <!-- END SIDEBAR USER TITLE -->

                <!-- SIDEBAR MENU -->
                <div class="profile-usermenu">
                    <ul class="nav" id="menu-list">
                        <li>
                            <a href="<?= base_url("profile") ?>">
                                <i class="glyphicon glyphicon-home"></i> Visão Geral
                            </a>
                        </li>
                        <li>
                            <a href="<?= base_url("profile/config") ?>">
                                <i class="fa fa-cog" aria-hidden="true"></i> Configurações
                            </a>
                        </li>
                        <li>
                            <a href="<?= base_url("profile/services") ?>">
                                <i class="fa fa-briefcase" aria-hidden="true"></i> Serviços
                            </a>
                        </li>
                        <?php if ($premium_data["isPremium"]): ?>
                            <li>
                                <a href="javascript:void(0)">
                                    <i class="fa fa-line-chart" aria-hidden="true"></i> Estatísticas
                                    <span class="label label-warning">Em Breve!</span>
                                </a>
                            </li>
                        <?php endif; ?>
                        <li>
                            <a href="javascript:void(0)">
                                <i class="glyphicon glyphicon-flag"></i> Ajuda
                            </a>
                        </li>
                        <li>
                            <a href="<?= base_url("profile/plan") ?>">
                                <i class="fa fa-diamond" aria-hidden="true"></i> Assinatura
                            </a>
                        </li>
                        <li>
                            <a href="<?= base_url("profile/account") ?>">
                                <i class="fa fa-user" aria-hidden="true"></i> Conta
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- END MENU -->
            </div>
        </div>

        <div class="col-md-9">
            <div class="profile-content">
