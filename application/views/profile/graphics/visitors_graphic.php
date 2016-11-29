<?php //var_dump($visitors);?>
<h2 class="profile-page-title"><strong>Estatísticas</strong></h2>
				
				<div class="divider"></div>

				<h4 ><strong>Visitantes</strong></h4>
				
				
				<?php echo form_open('profile/redirectGraphic', array('id' => 'monthYear', 'class' => 'form-horizontal', 'role' => 'form')); ?>
				<?php echo form_hidden('selectTypeGraphic', 'Visitantes');?>
				<div class="row">
					<div class="col-xs-5">
					
					<h5><?php echo form_dropdown(array('class' => "selectpicker", 'data-live-search' => "true", 'data-width' => "100%", 'name' => "selectMonth", 'id' => "selectMonth",), $months);?></h5>
					</div>
					<div class="col-xs-5">
					<h5><?php echo form_dropdown(array('class' => "selectpicker", 'data-live-search' => "true", 'data-width' => "100%", 'name' => "selectYear", 'id' => "selectYear",), $years);?></h5>		
					</div>
					<div class="col-xs-2">
					<input type="submit" class="btn btn-primary btn-statistics-buscar" value="Buscar" style="position: relative; top: 10px;">
					
					</div>	
				</div>
				<?php echo form_close(); ?>
				<h4>Ultimos Visitantes</h4>		
				<div class="divider"></div>
				
				<?php foreach ($visitors as $key => $value):?> 
					<h5>Nome: <?php echo $value->name;?></h5>
					<h5>Data da visita: <?php echo $value->visit_date?></h5>
				<?php endforeach;?>
				<div class="divider"></div>
				<h5>Escolha um novo gráfico</h5>
				<?php echo form_open('profile/redirectGraphic')?>
					<div class="row">
						<div class="col-xs-4">
						<h5><?php echo form_dropdown(array('class' => "selectpicker", 'data-live-search' => "true", 'data-width' => "100%", 'name' => "selectTypeGraphic", 'id' => "selectTypeGraphic",), $typeGraphic);?></h5>
						</div>
						<div class="col-xs-3">
						<h5><?php echo form_dropdown(array('class' => "selectpicker", 'data-live-search' => "true", 'data-width' => "100%", 'name' => "selectMonth", 'id' => "selectMonth",), $months);?></h5>
						</div>
						<div class="col-xs-3">
						<h5><?php echo form_dropdown(array('class' => "selectpicker", 'data-live-search' => "true", 'data-width' => "100%", 'name' => "selectYear", 'id' => "selectYear",), $years);?></h5>		
						</div>
						<div class="col-xs-2">
						<input type="submit" class="btn btn-primary btn-statistics-buscar" value="Buscar" style="position: relative; top: 10px;">
						</div>	
					</div>
				<?php echo form_close();?>
				<div class="divider"></div>
			
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