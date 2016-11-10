				<h2 class="profile-page-title"><strong>Serviços Anunciados</strong></h2>
				<div class="divider"></div>

				<div class="table-responsive">
                    <?php if ($this->session->flashdata("mensagem_service")) : ?>
                        <div class="alert alert-success">
                            <strong><?php echo $this->session->flashdata("mensagem_service"); ?></strong><br/>
                        </div>
                    <?php endif; ?>
                    <?php if ($this->session->flashdata("erro_service")) : ?>
                        <div class="alert alert-danger">
                            <strong><?php echo $this->session->flashdata("erro_service"); ?></strong><br/>
                        </div>
                    <?php endif; ?>
                    <table class="table">
                        <thead>
                            <tr>

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
                                    <td><?= $service->job ?></td>
                                    <td></td>
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
                </div> <!-- END RESPONSIVE-TABLE -->


				<a href="<?= base_url("service/novo") ?>"><button type="button" class="btn btn-primary"><i class="fa fa-plus-circle" aria-hidden="true"></i>  Novo Serviço</button></a>




				</div> <!-- END PROFILE-CONTENT -->

			</div> <!-- END COL -->
		</div> <!-- END ROW -->
	</div> <!-- END CONTAINER -->

</div>
