<!-- Begin page content -->
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-10 col-md-offset-1 col-lg-10 col-lg-offset-1">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h2>Portifólio - <?= $services->job ?>(a)</h2>
                    <div class="divider"></div>
                    <p class="hint bg-info text-info"><i class="fa fa-info-circle" aria-hidden="true"></i> Dica: Clique nas datas para visualizar as imagens</p>
                    <?php foreach ($portfolios as $key => $portfolio): ?>
                        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" >
                                    <h4 class="panel-title">
                                        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#<?= $key ?>" aria-expanded="true" aria-controls="collapseOne">
                                            Foto de 07/11/2016
                                        </a>
                                    </h4>
                                    <div class="portifolio-buttons">
                                        <a class="btn btn-warning" href="<?= base_url("service/editPortfolio/{$portfolio->id}"); ?>">Editar</a>
                                        <a class="btn btn-danger" href="<?= base_url("service/deletePortfolio/{$portfolio->id}"); ?>">Excluir</a>
                                    </div>
                                </div>
                                <div id="<?= $key ?>" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                                    <div class="panel-body">
                                        <img class="img-responsive center-block" src="<?= 'data:image/jpeg;base64,' . base64_encode(stripslashes($portfolio->image)) ?>" alt="" />
                                        <p class="portifolio-description">
                                            <?= $portfolio->description ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>


                </div>
            </div>

        </div>
    </div>


</div>
</div>
