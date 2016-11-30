<?php //var_dump($visitors); ?>
<h2 class="profile-page-title"><strong>Estatísticas</strong></h2>
				
				<div class="divider"></div>

				<h4 ><strong>Visitantes</strong></h4>
				
				
				<h4>Ultimos Visitantes</h4>		
				<div class="divider"></div>

				<br></br>
				<div class="row" style="position: relative; left:15%; height: 270px; max-width: auto;">
				<?php for($i=0; $i<count($visitors); $i++):?>
					<?php if($i % 3 == 0):?>
					<div class="row">
					<div class="col-xs-12 col-sm-4 col-md-3 col-lg-3">
					<div class="profile-userpic">
					<img class="img-responsive" src="
                    <?php if ($visitors[$i]->avatar === NULL): ?>
                        <?= '//placehold.it/200' ?>
                    <?php elseif ($visitors[$i]->avatar == base64_decode(base64_encode(stripslashes($visitors[$i]->avatar)))): ?>
                        <?= $visitors[$i]->avatar ?>
                    <?php else: ?>
                        <?= 'data:image/jpeg;base64,' . base64_encode(stripslashes($visitors[$i]->avatar)); ?>
                         <?php endif; ?>" alt="">
                    </div>     
					<p class="text-center"><?= $visitors[$i]->name?></p>
					</div>
					<?php endif;?>
					<?php if($i % 3 == 1):?>
					<div class="col-xs-12 col-sm-4 col-md-3 col-lg-3">
					<div class="profile-userpic">
					<img class="img-responsive" src="
                    <?php if ($visitors[$i]->avatar === NULL): ?>
                        <?= '//placehold.it/200' ?>
                    <?php elseif ($visitors[$i]->avatar == base64_decode(base64_encode(stripslashes($visitors[$i]->avatar)))): ?>
                        <?= $visitors[$i]->avatar ?>
                    <?php else: ?>
                        <?= 'data:image/jpeg;base64,' . base64_encode(stripslashes($visitors[$i]->avatar)); ?>
                         <?php endif; ?>" alt="">
					</div>
					<p class="text-center"><?= $visitors[$i]->name?></p>
					</div>
					<?php endif;?>
					<?php if($i % 3 == 2):?>
					<div class="col-xs-12 col-sm-4 col-md-3 col-lg-3">
					<div class="profile-userpic">
					<img class="img-responsive" src="
                    <?php if ($visitors[$i]->avatar === NULL): ?>
                        <?= '//placehold.it/200' ?>
                    <?php elseif ($visitors[$i]->avatar == base64_decode(base64_encode(stripslashes($visitors[$i]->avatar)))): ?>
                        <?= $visitors[$i]->avatar ?>
                    <?php else: ?>
                        <?= 'data:image/jpeg;base64,' . base64_encode(stripslashes($visitors[$i]->avatar)); ?>
                         <?php endif; ?>" alt="">
					</div>
					<p class="text-center"><?= $visitors[$i]->name?></p>
					</div>
					</div>
					<br>
					<?php endif;?>
				<?php endfor; ?>	
				</div>
				<div class="divider"></div>
				<h5>Escolha um novo gráfico</h5>
				<?php echo form_open('profile/redirectGraphic')?>
					<div class="row">
						<div class="col-xs-4">
						<h5><?php echo form_dropdown(array('class' => "selectpicker", 'data-live-search' => "true", 'data-width' => "100%", 'name' => "selectTypeGraphic", 'id' => "selectTypeGraphic", ), $typeGraphic); ?></h5>
						</div>
						<div class="col-xs-3">
						<h5><?php echo form_dropdown(array('class' => "selectpicker", 'data-live-search' => "true", 'data-width' => "100%", 'name' => "selectMonth", 'id' => "selectMonth", ), $months); ?></h5>
						</div>
						<div class="col-xs-3">
						<h5><?php echo form_dropdown(array('class' => "selectpicker", 'data-live-search' => "true", 'data-width' => "100%", 'name' => "selectYear", 'id' => "selectYear", ), $years); ?></h5>		
						</div>
						<div class="col-xs-2">
						<input type="submit" class="btn btn-primary btn-statistics-buscar" value="Buscar" style="position: relative; top: 10px;">
						</div>	
					</div>
				<?php echo form_close(); ?>
				<div class="divider"></div>
			
				<?php if(isset($no_service) == true):?>
				<div class="divider"></div>

				<h4 ><strong>Visitas</strong></h4>
				<h5><?= $no_service ?></h5>
				<div class="divider"></div>
				<?php endif; ?>

				</div> <!-- END PROFILE-CONTENT -->

			</div> <!-- END COL -->
		</div> <!-- END ROW -->
	</div> <!-- END CONTAINER -->

</div>