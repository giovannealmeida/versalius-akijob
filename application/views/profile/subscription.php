				<h2 class="profile-page-title"><strong>Gerenciamento de Assinatura</strong></h2>
				<div class="divider"></div>
				<?php if ($this->session->flashdata("code_redeem") === "success" ): ?>
					<p class="hint bg-success text-success"><i class="fa fa-check" aria-hidden="true"></i> <strong>Parabéns!</strong> Sua assinatura foi atualizada!</p>
				<?php elseif($this->session->flashdata("code_redeem") === "fail" ): ?>
					<p class="hint bg-danger text-danger"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> <strong>Erro!</strong> O código informado não existe ou já foi ultilizado</p>
				<?php endif; ?>

				<p>
					Seu plano atual: <strong class="text-<?=$plan_class?>"><?=$plan?></strong>
					<a href="<?=base_url("subscribe")?>"><button class="btn btn-primary">  <?= (!$premium_data["isPremium"]) ? "ASSINE!" : "Estenda sua assinatura!" ?></button> </a>
				</p>

				<?php if ($premium_data["isPremium"]): ?>
					<p>
						Sua assinatura expira em: <strong class="text-danger"><?=$date_end?></strong>
					</p>

				<?php endif; ?>
				<br>
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-4">
						<form action="<?=base_url("subscribe/redeem")?>" method="post">
							<div class="row">
								<div class="col-xs-12">
									<div class="form-group">
										<label for="code">Insira o código promocional</label>
										<input type="input" class="form-control" id="code" placeholder="Código Promocional" name="code">
									</div>

								</div>
							</div>
							<div class="row">
								<div class="col-xs-12">
									<div class="form-group">
										<button type="submit" class="btn btn-success">Resgatar</button>
									</div>

								</div>
							</div>
						</form>

					</div>

				</div>

				</div> <!-- END PROFILE-CONTENT -->

			</div> <!-- END COL -->
		</div> <!-- END ROW -->
	</div> <!-- END CONTAINER -->

</div>
