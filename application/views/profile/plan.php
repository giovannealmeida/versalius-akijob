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
            <h2>Assinatura</h2>
            <br>
            <table class="table">
                <thead class="thead-inverse">
                    <tr>
                        <th>#</th>
                        <th>Plano</th>
                        <th>Assinou</th>
                        <th>Expira em</th>
                        <th>Valor</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($premium as $key => $value): ?>
                    <tr>
                        <td><?= $key+1 ?></td>
                        <td><?= $value->name ?></td>
                        <td><?= $value->start ?></td>
                        <td><?= $value->end ?></td>
                        <td>R$ <?= $value->price_per_month ?>,00</td>
                        <td><a onclick="return confirm('Tem certeza que deseja cancelar?')" href="#">Cancelar</a></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <div style="margin-top: 30px; margin-bottom: 30px; float: right;">
                <!--<a href="<?php echo $premium_data['isPremium'] == TRUE || count($services) == 0 ? base_url("service/novo") : base_url("subscribe") ?>" type="button" class="btn btn-success" id="cancel">Adicionar</a>-->
            </div>
        </div>
    </div>
</body>
</html>
