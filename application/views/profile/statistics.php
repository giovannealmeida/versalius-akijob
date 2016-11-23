
<h2 class="profile-page-title"><strong>Estatísticas</strong></h2>
				<div class="divider"></div>

				<h4 ><strong>Visitas</strong></h4>
				
				<h5>Total de visitas: <?= $all_services[0]->total_visits?></h5>
				
				<h5>Visitas por serviço</h5>
				<div class="row">
				<?php foreach ($all_services as $key => $service):?>
					
					<div class="col-xs-4">
						<small class="text-success"><?= $service->job ?>:<?= $service->service_visits?></small><br>
					</div>
				<?php endforeach;?>
				<br>	
				</div>
				<div class="divider"></div>
				


				</div> <!-- END PROFILE-CONTENT -->

			</div> <!-- END COL -->
		</div> <!-- END ROW -->
	</div> <!-- END CONTAINER -->

</div>
