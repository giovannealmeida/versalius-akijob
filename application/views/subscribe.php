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
        <title>Assine</title>
    </head>
    <body>
        <div class="container" id="alterPassword">
            <h2>Redefinir senha</h2>
            <br>
            <a href="<?= base_url() ?>">Início</a>
            <table class="table">
                <thead>
                    <tr>
                        <th>Assinatura Padrão</th>
                        <th>Assinatura Anual</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>R$ 5,00/mês</td>
                        <td>R$ 50,00/ano</td>
                    </tr>
                    <tr>
                        <td><a href="<?= base_url("subscribe/plan/1/1") ?>"><button>Assinar</button></a></td>
                        <td><a href="<?= base_url("subscribe/plan/1/2") ?>"><button>Assinar</button></a></td>
                    </tr>

                </tbody>
            </table>
            <br>
            <br>

            <form action="<?= base_url("subscribe/redeem") ?>" method="post">
                <label>Insira o Código: </label>
                <input class="form-control" type="text" name="code" id="code">
                <br>
                <input type="submit" value="Resgatar">
            </form>
        </div>
    </body>
</html>