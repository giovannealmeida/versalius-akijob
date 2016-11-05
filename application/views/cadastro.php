

            <!-- Begin page content -->
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-10 col-lg-offset-1">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <?php if ($action == 'login/register'): ?>
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-6 col-md-4 col-md-offset-2">
                                            <a href="<?= $login_url_google ?>" class="btn btn-block btn-social btn-google">
                                                <span class="fa fa-google"></span>Cadastre-se com o Gmail
                                            </a>

                                        </div>
                                        <div class="col-xs-12 col-sm-6 col-md-4">
                                            <a href="<?= $login_url_facebook ?>" class="btn btn-block btn-social btn-facebook ">
                                                <span class="fa fa-facebook"></span> Cadastre-se com Facebook
                                            </a>
                                        </div>

                                    </div>
                                    <div class="divider"></div>
                                <?php endif; ?>
                                <h3 class="text-center"><?= $title ?></h3>
                                <?php if (isset($user_profile)): ?>
                                    <?php if ($this->session->flashdata('email_exists')): ?>
                                        <div class="bg-danger" style="padding:15px; margin-bottom:10px;">
                                            <p class="text-info">O email já foi cadastrado</p>

                                    <?php else: ?>
                                        <div class="bg-info" style="padding:15px; margin-bottom:10px;">
                                            <p class="text-info">Estamos quase lá! Preencha os dados faltantes</p>

                                    <?php endif; ?>
                                    </div>
                                <?php endif; ?>
                                <?php echo form_open($action, array('id' => "register", "class" => "form-horizontal", "role" => "form")); ?>

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
                                <div class="form-group">
                                    <?php echo form_label('Nome Completo', 'fullname', array("class" => "col-md-3 control-label")); ?>
                                    <div class="col-md-9">
                                        <?php echo form_input(array('name' => 'fullname', 'class' => 'form-control', 'id' => 'fullname', 'placeholder' => "Nome Completo", "autofocus"), set_value('fullname', isset($user_profile) ? $user_profile["name"] : "")); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <?php echo form_label('Email', 'email', array("class" => "col-md-3 control-label")); ?>
                                    <div class="col-md-9">
                                        <?php echo form_input(array('name' => 'email', 'class' => 'form-control', 'id' => 'email', 'placeholder' => "Email", "autofocus", "type" => "email"), set_value('email', isset($user_profile) ? $user_profile["email"] : "")); ?>
                                    </div>
                                </div>
                                <?php if ($action == 'login/register'): ?>
                                    <div class="form-group">
                                        <?php echo form_label('Senha', 'password', array("class" => "col-md-3 control-label")); ?>
                                        <div class="col-md-9">
                                            <?php echo form_input(array('name' => 'password', 'class' => 'form-control', 'id' => 'password', 'placeholder' => "Senha", "autofocus", "type" => "password")); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <?php echo form_label('Digite a Senha Novamente', 'password2', array("class" => "col-md-3 control-label")); ?>
                                        <div class="col-md-9">
                                            <?php echo form_input(array('name' => 'password2', 'class' => 'form-control', 'id' => 'password2', 'placeholder' => "Digite a Senha Novamente", "autofocus", "type" => "password")); ?>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <div class="form-group">
                                    <?php echo form_label('Data de Nascimento', 'birthDate', array("class" => "col-md-3 control-label")); ?>
                                    <div class="col-md-9">
                                    <?php echo form_input(array('name' => 'birthDate', 'class' => 'form-control', 'id' => 'birthDate', "type" => "date"), set_value('birthDate', isset($user_profile["birthday"]) ? $user_profile["birthday"] : "")); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <?php echo form_label('Estado', 'selectState', array("class" => "col-md-3 control-label")); ?>
                                    <div class="col-md-9">
                                        <?php echo form_dropdown(array('class' => "selectpicker", 'data-live-search' => "true", 'data-width' => "100%", 'name' => "selectState", 'id' => "selectState",), $states, isset($state) ? $state->id : NULL, set_value('selectState')); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <?php echo form_label('Cidade', 'name', array("class" => "col-md-3 control-label")); ?>
                                    <div class="col-md-9">
                                        <?php echo form_dropdown(array('class' => "selectpicker", 'data-live-search' => "true", 'data-width' => "100%", 'name' => "selectCity", 'id' => "selectCity",), $citys, null, set_value('selectCity')); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <?php echo form_label('Telefone', 'phone', array("class" => "col-md-3 control-label")); ?>
                                    <div class="col-md-9">
                                        <?php echo form_input(array('name' => 'phone', 'class' => 'form-control', 'id' => 'phone', 'placeholder' => "Telefone", "autofocus"), set_value('phone', isset($user_profile["phone"]) ? $user_profile["phone"] : "")); ?>
                                    </div>
                                </div>
                                <!-- /.form-group -->
                                <div class="form-group">
                                    <label class="control-label col-md-3">Sexo</label>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="radio-inline">
                                                    <?php echo form_radio(array('name' => 'gender', 'value' => 2, 'checked' => (isset($user_profile["id_gender"]) && 2 == $user_profile["id_gender"]) ? TRUE : set_radio('gender', '2'), 'id' => 'male')) ?>Feminino
                                                </label>
                                            </div>
                                            <div class="col-sm-4">
                                                <label class="radio-inline">
                                                    <?php echo form_radio(array('name' => 'gender', 'value' => 1, 'checked' => (isset($user_profile["id_gender"]) && 1 == $user_profile["id_gender"]) ? TRUE : set_radio('gender', '1'), 'id' => 'male')) ?>Masculino
                                                </label>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <!-- /.form-group -->
                                <?php if ($action == 'login/register'): ?>
                                    <div class="form-group">
                                        <div class="col-xs-12">
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" name="termAcceptance" id="termAcceptance">Eu li e concordo com os <a href="#"> Termos e Condições de Uso</a>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <!-- /.form-group -->
                                <div class="form-group">
                                    <div class="col-xs-4 col-xs-offset-4 ">
                                        <input type="submit" class="btn btn-primary btn-block btn-lg" value="<?= $titleAction ?>">
                                    </div>
                                </div>
                                <?php form_close() ?>
                            </div>
                        </div>

                    </div>
                </div>


            </div>
        </div>
