<?php // var_dump($all_services);?>
<h2 class="profile-page-title"><strong>Estatísticas</strong></h2>
				<?php if(isset($invalide_date) == true):?>
					<div class="divider"></div>
					<h4 ><strong>Visitas</strong></h4>
					<h5><?= $invalide_date?></h5>
					<?php echo form_open('profile/statistics', array('id' => 'monthYear', 'class' => 'form-horizontal', 'role' => 'form')); ?>
					<div class="row">
						<div class="col-xs-5">
						
						<h5><?php echo form_dropdown(array('class' => "selectpicker", 'data-live-search' => "true", 'data-width' => "100%", 'name' => "selectMonth", 'id' => "selectMonth",), $months);?></h5>
						</div>
						<div class="col-xs-5">
						<h5><?php echo form_dropdown(array('class' => "selectpicker", 'data-live-search' => "true", 'data-width' => "100%", 'name' => "selectYear", 'id' => "selectYear",), $years);?></h5>		
						</div>
						<div class="col-xs-2">
						<input type="submit" class="btn btn-primary" value="Ok">
						
						</div>	
					</div>
					<?php echo form_close(); ?>
					<div class="divider"></div>
					
				<?php elseif(isset($no_service) == false):?>
				<div class="divider"></div>

				<h4 ><strong>Visitas</strong></h4>
				
				<h5>Total de visitas: <?= $all_services[0]->total_visits?></h5>
				<?php echo form_open('profile/statistics', array('id' => 'monthYear', 'class' => 'form-horizontal', 'role' => 'form')); ?>
				<div class="row">
					<div class="col-xs-5">
					
					<h5><?php echo form_dropdown(array('class' => "selectpicker", 'data-live-search' => "true", 'data-width' => "100%", 'name' => "selectMonth", 'id' => "selectMonth",), $months);?></h5>
					</div>
					<div class="col-xs-5">
					<h5><?php echo form_dropdown(array('class' => "selectpicker", 'data-live-search' => "true", 'data-width' => "100%", 'name' => "selectYear", 'id' => "selectYear",), $years);?></h5>		
					</div>
					<div class="col-xs-2">
					<input type="submit" class="btn btn-primary" value="Ok">
					
					</div>	
				</div>
				<?php echo form_close(); ?>		
				
				
				
				<h5>Visitas por serviço</h5>
				<div class="row">
				<?php foreach ($all_services as $key => $service):?>
					
					<div class="col-xs-4">
						<small class="text-success"><?= $service->job ?>:<?= $service->service_visits?></small><br>
					</div>
				<?php endforeach;?>
				<br>	
				</div>
				<div id="linechart_material"></div>	
				
				
				<div class="divider"></div>
				<?php endif;?>
				
				<?php if(isset($no_service) == true):?>
				<div class="divider"></div>

				<h4 ><strong>Visitas</strong></h4>
				<h5><?= $no_service?></h5>
				<div class="divider"></div>
				<?php endif;?>

				</div> <!-- END PROFILE-CONTENT -->

			</div> <!-- END COL -->
		</div> <!-- END ROW -->
	</div> <!-- END CONTAINER -->

</div>
