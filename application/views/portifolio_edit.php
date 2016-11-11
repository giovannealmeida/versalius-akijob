<!-- Begin page content -->
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-10 col-md-offset-1 col-lg-10 col-lg-offset-1">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h2>Portifólio - Editar</h2>
                    <div class="divider"></div>
                    <p class="hint bg-info text-info"><i class="fa fa-info-circle" aria-hidden="true"></i> Atualize as informações abaixo</p>
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
                    <form action="<?= base_url("service/editPortfolio/{$portfolio->id}") ?>" method="post" enctype="multipart/form-data">
                        <img src="
                        <?php if (isset($portfolio)): ?>
                            <?= 'data:image/jpeg;base64,' . base64_encode(stripslashes($portfolio->image)) ?>
                        <?php elseif ($this->input->post('inputFile') != NULL): ?>
                            <?= $this->input->post('inputFile') ?>
                        <?php else: ?>
                            <?= '//placehold.it/200' ?>
                             <?php endif; ?>"  id="preview_image" style="max-width: 500px; max-height: 500px;">

                        <div class="form-group">
                            <label for="inputFile">Escolha sua imagem aqui</label>
                            <input type="file" id="inputFile" name="inputFile" onchange="loadFile(event)">
                        </div>
                        <div class="form-group">
                            <label for="description">Descrição</label>
                            <textarea class="form-control" id="description" name="description"><?= $portfolio->description ?></textarea>
                        </div>
                        <button type="submit" class="btn btn-success">Cadastrar</button>

                    </form>
                </div>
            </div>

        </div>
    </div>


</div>
</div>
