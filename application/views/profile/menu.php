<div class="container">
	<div class="row profile">
		<div class="col-md-3">
			<div class="profile-sidebar">
				<!-- SIDEBAR USERPIC -->
				<div class="profile-tier">
					<img src="<?= base_url("assets/img/crown-bronze.png") ?>" alt="tier" class="center-block tier-big" />
				</div>
				<div class="profile-userpic">
					<img src="<?=$scr_photo?>" class="img-responsive" alt="">

				</div>
				<!-- END SIDEBAR USERPIC -->
				<!-- SIDEBAR USER TITLE -->
				<div class="profile-usertitle">

					<div class="profile-usertitle-name">
						<?= $user_profile->name ?>
					</div>
					<div class="profile-usertitle-paid">
						<?php if ($premium_data["isPremium"]): ?>
							<span class="label label-success">Conta Grátis</span>

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
							<a href="<?=base_url("profile")?>">
								<i class="glyphicon glyphicon-home"></i> Visão Geral
							</a>
						</li>
						<li>
							<a href="<?=base_url("profile/config")?>">
								<i class="glyphicon glyphicon-user"></i> Configurações
							</a>
						</li>
						<li>
							<a href="<?=base_url("profile/services")?>">
								<i class="fa fa-briefcase" aria-hidden="true"></i> Serviços
							</a>
						</li>
						<li>
							<a href="#">
								<i class="fa fa-line-chart" aria-hidden="true"></i> Estatísticas
							</a>
						</li>

						<li>
							<a href="#">
								<i class="glyphicon glyphicon-flag"></i> Ajuda
							</a>
						</li>
						<li>
							<a href="#">
								<i class="fa fa-diamond" aria-hidden="true"></i> Assinatura
							</a>
						</li>
					</ul>
				</div>
				<!-- END MENU -->
			</div>
		</div>

		<div class="col-md-9">
			<div class="profile-content">
