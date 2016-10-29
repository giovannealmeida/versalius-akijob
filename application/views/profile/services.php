<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
        <script type='text/javascript'>var base_url = {url: "<?= base_url() ?>"};</script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link href="<?= base_url('/assets/css/style.css'); ?>" rel="stylesheet" type="text/css" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <title>Perfil</title>
    </head>
    <body>
        <div class="container" id="alterPassword">
            <h2>Serviços</h2>
            <br>
            <?php if ($this->session->flashdata("mensagem")) : ?>
                <div class="alert alert-success">
                    <strong><?php echo $this->session->flashdata("mensagem"); ?></strong><br/>
                </div>
            <?php endif; ?>
            <?php if ($this->session->flashdata("erro")) : ?>
                <div class="alert alert-success">
                    <strong><?php echo $this->session->flashdata("erro"); ?></strong><br/>
                </div>
            <?php endif; ?>
            <table class="table">
                <thead class="thead-inverse">
                    <tr>
                        <th>#</th>
                        <th>Função</th>
                        <th>Endereço</th>
                        <th>Número</th>
                        <th>Complemento</th>
                        <th>Bairo</th>
                        <th>Cidade</th>
                        <th>CEP</th>
                        <th></th>

                    </tr>
                </thead>
                <tbody>
                    <?php if (count($services) > 0): ?>
                        <?php foreach ($services as $key => $service): ?>
                            <tr>
                                <th scope="row"><?= $key + 1 ?></th>
                                <td><?= $service->job ?></td>
                                <td><?= $service->address ?></td>
                                <td><?= $service->number ?></td>
                                <td><?= $service->complement ?></td>
                                <td><?= $service->neighborhood ?></td>
                                <td><?= $service->city ?></td>
                                <td><?= $service->zip_code ?></td>
                                <td><a href="<?= base_url("service/edit/{$service->id}"); ?>">Editar</a> | <a onclick="return confirm('Tem certeza que deseja excluir?')" href="<?= base_url("profile/deleteService/{$service->id}"); ?>">Excluir</a></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
            <div style="margin-top: 30px; margin-bottom: 30px; float: right;">
                <a href="<?php echo $premium_data['isPremium'] == TRUE  || count($services) == 0 ? base_url("service/novo") :  base_url("subscribe")?>" type="button" class="btn btn-success" id="cancel">Adicionar</a>
            </div>
        </div>
    </body>
</html>
