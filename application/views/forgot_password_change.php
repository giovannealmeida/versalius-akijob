

		<!-- Begin page content -->
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-6 col-sm-offset-3 col-md-6 col-md-offset-3 col-lg-4 col-lg-offset-4">
					<div class="panel panel-default">
						<div class="panel-body">
							<h4>Insira sua nova senha</h4>
							<?php if (validation_errors()): ?>
								<div class="row">
									<div class="col-xs-12 errors">
										<ul class=" bg-danger">
											<?=validation_errors()?>
										</ul>

									</div>
								</div>

							<?php endif; ?>
							<form method="post">
								<div class="row">
									<div class="col-xs-12">
										<div class="form-group">
											<label for="password" class="sr-only">Digite a nova senha</label>
											<input name="password" type="password" id="password" placeholder="Digite a nova senha" class="form-control" autofocus>
										</div>

									</div>
								</div>
								<div class="row">
									<div class="col-xs-12">
										<div class="form-group">
											<label for="password2" class="sr-only">Digite a senha novamente</label>
											<input name="password2" type="password" id="password2" placeholder="Digite a senha novamente" class="form-control">
										</div>

									</div>
								</div>
								<div class="row">
									<div class="col-xs-12">
										<div class="form-group">
											<button type="submit" name="button" class="btn btn-primary btn-block">Confirmar</button>
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>

				</div>
			</div>


		</div>
	</div>
