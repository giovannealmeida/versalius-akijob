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
        <link href="<?= base_url('/assets/css/bootstrap-select.min.css'); ?>" rel="stylesheet" type="text/css" />
        <script src="<?= base_url('/assets/js/bootstrap-select.min.js'); ?>" type="text/javascript"></script>
        <title>Perfil</title>
    </head>
    <body>
        <div class="container" id="personal_data">
            <h2>Dados Pessoais</h2>
            <br>
            <?php echo form_open('profile/index', array('id' => "personalData")); ?>
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
                <div class="alert alert-success">
                    <strong><?php echo $this->session->flashdata("erro"); ?></strong><br/>
                </div>
            <?php endif; ?>
            <div class = "row">
                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo form_label('Nome: ', 'name'); ?>
                        <span class="required">*</span>
                        <?php echo form_input(array('name' => 'name', 'class' => 'form-control', 'id' => 'name', 'placeholder' => "Nome", 'value' => $user_profile->name), set_value('name')); ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo form_label('Email: ', 'email'); ?>
                        <?php echo form_input(array('name' => 'email', 'class' => 'form-control', 'id' => 'email', 'placeholder' => "Email", 'value' => $user_profile->email), set_value('email')); ?>
                    </div>
                </div>
            </div>
            <div class = "row">
                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo form_label('Gênero: ', 'gender'); ?>
                        <span class="required">*</span>
                        <?php echo form_dropdown(array('class' => "selectpicker", 'data-width' => "100%", 'name' => "selectGender", 'id' => "selectGender",), $genders, $user_profile->id_gender, set_value('selectGender')); ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo form_label('Data de Nascimento: ', 'birthday'); ?>
                        <span class="required">*</span>
                        <?php echo form_input(array('name' => 'birthday', 'class' => 'form-control', 'id' => 'birthday', 'placeholder' => "Data de Nascimento", 'value' => $user_profile->birthday), set_value('birthday')); ?>
                    </div>
                </div>
            </div>
            <div class = "row">
                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo form_label('Estado: ', 'selectState'); ?>
                        <span class="required">*</span>
                        <?php echo form_dropdown(array('class' => "selectpicker", 'data-live-search' => "true", 'data-width' => "100%", 'name' => "selectState", 'id' => "selectState",), $states, $state->id, set_value('selectState')); ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo form_label('Cidade: ', 'selectCity'); ?>
                        <span class="required">*</span>
                        <?php echo form_dropdown(array('class' => "selectpicker", 'data-live-search' => "true", 'data-width' => "100%", 'name' => "selectCity", 'id' => "selectCity",), $citys, $user_profile->id_city, set_value('selectCity')); ?>
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
        <script src="<?= base_url('/assets/js/changeCity.js'); ?>" type="text/javascript"></script>
    </body>
</html>
