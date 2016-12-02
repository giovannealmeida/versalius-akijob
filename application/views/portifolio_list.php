<!-- Begin page content -->
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-10 col-md-offset-1 col-lg-10 col-lg-offset-1">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h2>Portifólio - <?= $services->job ?></h2>
                    <a class="btn btn-success" href="<?= base_url("service/new_portfolio/{$idService}"); ?>">Novo</a>
                    <div class="divider"></div>
                    <?php if (count($portfolios)): ?>
                        <p class="hint bg-info text-info"><i class="fa fa-info-circle" aria-hidden="true"></i> Dica: Clique nas datas para visualizar as imagens</p>
                        <?php foreach ($portfolios as $key => $portfolio): ?>
                            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                                <div class="panel panel-default">
                                    <div class="panel-heading" role="tab" >
                                        <h4 class="panel-title">
                                            <a role="button" data-toggle="collapse" data-parent="#accordion" href="#<?= $key ?>" aria-expanded="true" aria-controls="collapseOne">
                                                <?= $portfolio->description ?>
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="<?= $key ?>" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                                        <div class="panel-body">
                                            <img class="img-responsive center-block" src="<?= 'data:image/jpeg;base64,' . base64_encode(stripslashes($portfolio->image)) ?>" alt="" />
                                        </div>
                                    </div>
                                    <div class="panel-heading portifolio-buttons" >
                                        <a class="btn btn-warning" href="<?= base_url("service/edit_portfolio/{$portfolio->id}"); ?>">Editar</a>
                                        <a class="btn btn-danger" href="<?= base_url("service/delete_portfolio/{$portfolio->id}"); ?>">Excluir</a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>

                </div>
            </div>

        </div>
    </div>


</div>
</div>
