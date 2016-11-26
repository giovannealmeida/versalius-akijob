

<!-- Begin page content -->
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-10 col-lg-offset-1">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-xs-12 col-lg-6">
                            <button class="btn btn-block btn-social btn-google" id="google_login">
                                <span class="fa fa-google"></span>Cadastre-se com o Gmail
                            </button>

                        </div>
                        <div class="col-xs-12 col-lg-6">
                            <button onclick="fb_login()" class="btn btn-block btn-social btn-facebook" id="facebook_login">
                                <span class="fa fa-facebook"></span> Cadastre-se com Facebook
                            </button>

                        </div>
                    </div>
                    <div class="divider"></div>
                    <h3 class="text-center">Cadastrar</h3>
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
                        <?php echo form_open('login/register', array('id' => "register", "class" => "form-horizontal", "role" => "form", "enctype" => "multipart/form-data")); ?>
                        <?php echo form_input(array('name' => 'avatar', 'class' => 'form-control', 'id' => 'avatar', 'type' => 'hidden', 'value' => isset($user_profile) ? $user_profile['avatar'] : NULL)); ?>
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
                            <div class="col-md-12">
                                <div class="text-center">
                                    <img src="<?php if (isset($user_profile)): ?>
                                        <?= $user_profile['avatar'] ?>
                                    <?php elseif ($this->input->post('avatar') != NULL): ?>
                                        <?= $this->input->post('avatar') ?>
                                    <?php else: ?>
                                        <?= '//placehold.it/200' ?>
                                         <?php endif; ?>" class="avatar img-circle" alt="avatar" id="preview_image" style="max-width: 200px; max-height: 200px;">
                                    <h5><b>Avatar</b></h5>
                                </div>
                                <input type="file" accept="image/*" name="avatar" onchange="loadFile(event)">
                            </div>
                        </div>
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
                                <?php echo form_input(array('name' => 'phone', 'class' => 'form-control phone', 'id' => 'phone', 'placeholder' => "Telefone", "autofocus"), set_value('phone', isset($user_profile["phone"]) ? $user_profile["phone"] : "")); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <?php echo form_label('Site', 'site', array("class" => "col-md-3 control-label")); ?>
                            <div class="col-md-9">
                                <div class="input-group">
                                    <div class="input-group-addon">http://</div>
                                    <?php echo form_input(array('name' => 'site', 'class' => 'form-control', 'id' => 'site', 'placeholder' => "Site"), set_value('site', isset($user_profile) ? $user_profile["site"] : "")); ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <?php echo form_label('Facebook', 'facebook', array("class" => "col-md-3 control-label")); ?>
                            <div class="col-md-9">
                                <div class="input-group">
                                    <div class="input-group-addon">facebook.com/</div>
                                    <?php echo form_input(array('name' => 'facebook', 'class' => 'form-control', 'id' => 'facebook', 'placeholder' => "Facebook"), set_value('facebook', isset($user_profile) ? $user_profile["facebook"] : "")); ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <?php echo form_label('Twitter', 'twitter', array("class" => "col-md-3 control-label")); ?>
                            <div class="col-md-9">
                                <div class="input-group">
                                    <div class="input-group-addon">@</div>
                                    <?php echo form_input(array('name' => 'twitter', 'class' => 'form-control', 'id' => 'twitter', 'placeholder' => "Twitter"), set_value('twitter', isset($user_profile) ? $user_profile["twitter"] : "")); ?>
                                </div>
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
                        <div class="form-group">
                            <div class="col-xs-12">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="termAcceptance" id="termAcceptance">Eu li e concordo com os <a href="#"> Termos e Condições de Uso</a>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <!-- /.form-group -->
                        <div class="form-group">
                            <div class="col-xs-4 col-xs-offset-4 ">
                                <input type="submit" class="btn btn-primary btn-block btn-lg" value="Cadastre-se">
                            </div>
                        </div>
                        <?php form_close() ?>
                    </div>
                </div>

            </div>
        </div>


    </div>
</div>
