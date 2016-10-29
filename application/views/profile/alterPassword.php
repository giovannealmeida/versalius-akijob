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
            <h2>Redefinir senha</h2>
            <br>
            <?php echo form_open('profile/alterPassword', array('id' => "alterPassword")); ?>
            <?php if (validation_errors()): ?>
                <div class="alert alert-danger">
                    <strong>Erros no formulário!</strong><br/>
                    <br/>
                    <?php echo validation_errors(); ?>
                </div>
            <?php endif; ?>
            <?php if ($this->session->flashdata("mensagem")) : ?>
                <div class="alert alert-success">
                    <strong><?php echo $this->session->flashdata("mensagem"); ?></strong><br/>
                </div>
            <?php endif; ?>
            <?php if ($this->session->flashdata("erro")) : ?>
                <div class="alert alert-danger">
                    <strong><?php echo $this->session->flashdata("erro"); ?></strong><br/>
                </div>
            <?php endif; ?>
            <div class = "row">
                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo form_label('Senha Antiga: ', 'oldPassword'); ?>
                        <span class="required">*</span>
                        <?php if ($user_profile->password == NULL): ?>
                            <?php $config = array("name" => "oldPassword", "id" => "oldPassword", 'class' => 'form-control', 'placeholder' => "Senha Antiga", 'disabled' => 'true'); ?>
                        <?php else: ?>
                            <?php $config = array("name" => "oldPassword", "id" => "oldPassword", 'class' => 'form-control', 'placeholder' => "Senha Antiga"); ?>
                        <?php endif; ?>
                        <?php echo form_password($config); ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo form_label('Senha: ', 'password'); ?>
                        <span class="required">*</span>
                        <?php echo form_password(array("name" => "password", "id" => "password", 'class' => 'form-control', 'placeholder' => "Senha")); ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo form_label('Confirme a senha: ', 'ConfirmPassword'); ?>
                        <span class="required">*</span>
                        <?php echo form_password(array("name" => "ConfirmPassword", "id" => "ConfirmPassword", 'class' => 'form-control', 'placeholder' => "Confirme a senha")); ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label class="control-label" style="margin-top: 3%">Itens com asteríscos são obrigatórios</label>
                    <span class="required"> * </span>
                </div>
            </div>
            <div class = "row">
                <div style="margin-top: 30px; margin-bottom: 30px; float: right;">
                    <a href="<?= base_url('register_service/cancel'); ?>" type="button" class="btn btn-danger" id="cancel">Cancelar</a>
                    <input type="submit" class="btn btn-success" value="Atualizar" onclick="return confirm('Confirma a atualização?')">
                </div>
            </div>
            <?php echo form_close(); ?>
        </div>
    </body>
</html>
