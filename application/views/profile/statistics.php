<?php // var_dump($all_services);?>
<h2 class="profile-page-title"><strong>Estatísticas</strong></h2>
				<?php echo form_open('profile/redirectGraphic')?>
					<div class="row">
						<div class="col-xs-4">
						<h5><?php echo form_dropdown(array('class' => "selectpicker", 'data-live-search' => "true", 'data-width' => "100%", 'name' => "selectTypeGraphic", 'id' => "selectMonth",), $typeGraphic);?></h5>
						</div>
						<div class="col-xs-3">
						<h5><?php echo form_dropdown(array('class' => "selectpicker", 'data-live-search' => "true", 'data-width' => "100%", 'name' => "selectMonth", 'id' => "selectMonth",), $months);?></h5>
						</div>
						<div class="col-xs-3">
						<h5><?php echo form_dropdown(array('class' => "selectpicker", 'data-live-search' => "true", 'data-width' => "100%", 'name' => "selectYear", 'id' => "selectYear",), $years);?></h5>		
						</div>
						<div class="col-xs-2">
						<input type="submit" class="btn btn-primary" value="Buscar" style="position: relative; top: 10px;">
						</div>	
					</div>
				<?php echo form_close();?>
				</div> <!-- END PROFILE-CONTENT -->

			</div> <!-- END COL -->
		</div> <!-- END ROW -->
	</div> <!-- END CONTAINER -->

</div>
