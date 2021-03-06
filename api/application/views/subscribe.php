<!-- Begin page content -->
<div class="container">
	<div class="comparison">
		<table>
			<thead>
				<tr>
					<th class="tl tl2"></th>
					<th class="product text-center" style="">Básico</th>
					<th class="product text-center" style="">Premium</th>
				</tr>
				<tr>
					<th></th>
					<th class="price-info">
						<div class="price-now text-center"><span>Grátis</span>
						</div>
					</th>
					<th class="price-info">
						<div class="price-now text-center"><span>R$ 6,99</span>
							<p>  / mês</p>
						</div>
					</th>

				</tr>
			</thead>
			<tbody>
				<tr>
					<td></td>
					<td colspan="3">Busca de Profissionais</td>
				</tr>
				<tr class="compare-row">
					<td>Busca de Profissionais</td>
					<td><span class="glyphicon glyphicon-ok"></span></span>
					</td>
					<td><span class="glyphicon glyphicon-ok"></span></td>

				</tr>
				<tr>
					<td> </td>
					<td colspan="3">Recomendar Profissinais</td>
				</tr>
				<tr>
					<td>Recomendar Profissinais</td>
					<td><span class="glyphicon glyphicon-ok"></span></span>
					</td>
					<td><span class="glyphicon glyphicon-ok"></span></td>

				</tr>
				<tr>
					<td> </td>
					<td colspan="3">Avaliar Serviço</td>
				</tr>
				<tr class="compare-row">
					<td>Avaliar Serviço</td>
					<td><span class="glyphicon glyphicon-ok"></span></span>
					</td>
					<td><span class="glyphicon glyphicon-ok"></span></td>

				</tr>
				<tr>
					<td> </td>
					<td colspan="4">Anunciar Serviço</td>
				</tr>
				<tr>
					<td>Anunciar Serviço</td>
					<td><span class="glyphicon glyphicon-ok"></span></span>
					</td>
					<td><span class="glyphicon glyphicon-ok"></span></td>

				</tr>
				<tr>
					<td> </td>
					<td colspan="3">Portfolio</td>
				</tr>
				<tr class="compare-row">
					<td>Portfolio</td>
					<td><span class="glyphicon glyphicon-remove"></span></td>
					<td><span class="glyphicon glyphicon-ok"></span></td>

				</tr>
				<tr>
					<td> </td>
					<td colspan="4">Anunciar mais de um Serviço</td>
				</tr>
				<tr>
					<td>Anunciar mais de um Serviço</td>
					<td><span class="glyphicon glyphicon-remove"></span></td>
					<td><span class="glyphicon glyphicon-ok"></span></td>

				</tr>

				<tr>
					<td> </td>
					<td colspan="4">Maior Visibilidade</td>
				</tr>
				<tr class="compare-row">
					<td>Maior Visibilidade</td>
					<td><span class="glyphicon glyphicon-remove"></span></td>
					<td><span class="glyphicon glyphicon-ok"></span></td>

				</tr>

				<tr>
					<td> </td>
					<td colspan="4">Painel de Estatística sobre o Perfil</td>
				</tr>
				<tr>
					<td>Painel de Estatística sobre o Perfil</td>
					<td><span class="glyphicon glyphicon-remove"></span></td>
					<td><span class="glyphicon glyphicon-ok"></span></td>

				</tr>

				<tr>
					<td> </td>
				</tr>
				<tr>
					<td style="border-bottom: none;border-left: none;"></td>
					<td>
						<a href="<?=base_url("register")?>">
							<button type="button" name="button" class="btn btn-primary btn-lg btn-block" <?= $this->session->userdata('logged_in') ? 'disabled="disabled"' : "" ?>>Cadastre-se</button>
						</a>

					</td>
					<td>
						<?php if ($this->session->userdata('logged_in')): ?>
							<button type="button" name="button" class="btn btn-success btn-lg" onclick="open_lightbox()">Contrate!</button>
							<script type="text/javascript"
					            src="https://stc.sandbox.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.lightbox.js">
					        </script>
							<script type="text/javascript">
								function open_lightbox(){
									var isOpenLightbox = PagSeguroLightbox({
									    code: '<?=$code?>'
									}, {
									    success : function(transactionCode) {
											window.location = base_url.url + "profile";
									    },
									    abort : function() {
									    }
									});
									// Redirecionando o cliente caso o navegador não tenha suporte ao Lightbox
									if (!isOpenLightbox){
									    location.href="https://sandbox.pagseguro.uol.com.br/v2/checkout/payment.html?code="+code;
									}
								}
							</script>
						<?php else: ?>
							<a href="<?=base_url("login")?>">
								<button type="button" name="button" class="btn btn-success btn-lg">Contrate!</button>
							</a>
						<?php endif; ?>


					</td>
				</tr>
			</tbody>
		</table>

	</div>
</div>
</div>
