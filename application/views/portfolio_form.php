<!-- Begin page content -->
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-10 col-md-offset-1 col-lg-10 col-lg-offset-1">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h2>Portfólio - Novo Item</h2>
                    <div class="divider"></div>
                    <p class="hint bg-info text-info"><i class="fa fa-info-circle" aria-hidden="true"></i> Preencha as informações abaixo</p>
                    <?php if (validation_errors()): ?>
                        <div class="alert alert-danger">
                            <strong>Erros no formulário!</strong><br/>
                            <br/>
                            <?php echo validation_errors(); ?>
                        </div>
                    <?php endif; ?>
                    <?php if ($this->session->flashdata("erro")) : ?>
                        <div class="alert alert-danger">
                            <strong><?php echo $this->session->flashdata("erro"); ?></strong><br/>
                        </div>
                    <?php endif; ?>
                    <form action="<?= base_url("service/portfolioNovo/{$idService}") ?>" method="post" enctype="multipart/form-data" data-toggle="validator">
                        <img src="//placehold.it/500"  id="preview_image" style="max-width: 500px; max-height: 500px;">

                        <div class="form-group">
                            <label for="inputFile">Escolha sua imagem aqui</label>
                            <input type="file" id="inputFile" name="inputFile" onchange="loadFile(event)" required="true">
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group">
                            <label for="description">Descrição</label>
                            <textarea class="form-control" id="description" name="description" required="true"></textarea>
                            <div class="help-block with-errors"></div>
                        </div>
                        <a href="<?= base_url('service/cancelPortfolio'); ?>" type="button" class="btn btn-danger" id="cancel">Cancelar</a>
                        <button type="submit" class="btn btn-success">Cadastrar</button>

                    </form>
                </div>
            </div>

        </div>
    </div>


</div>
</div>
