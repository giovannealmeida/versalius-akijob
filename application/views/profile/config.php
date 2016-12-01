<h2 class="profile-page-title"><strong>Configurações</strong></h2>
<div class="divider"></div>
<div class="row">

    <div class="col-lg-3 hidden-xs hidden-sm hidden-md">
        <ul class="nav nav-pills" role="tablist" id="tab-list">
            <li role="presentation" class="active">
                <a href="#alter_user" aria-controls="alter_user" role="tab" >Alterar Dados</a>
            </li>
            <li role="presentation">
                <a href="#alter_pass" aria-controls="alter_pass" role="tab" >Alterar Senha</a>
            </li>
        </ul>

    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-9">
        <div class="hidden-lg">
            <ul class="nav nav-pills" role="tablist" id="tab-list">
                <li role="presentation" class="active">
                    <a href="#alter_user" aria-controls="alter_user" role="tab" >Alterar Dados</a>
                </li>
                <li role="presentation">
                    <a href="#alter_pass" aria-controls="alter_pass" role="tab" >Alterar Senha</a>
                </li>
            </ul>
            <br>
        </div>
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane fade in active" id="alter_user">
                <form action="<?= base_url('profile/config') ?>" method="post" enctype="multipart/form-data" data-toggle ="validator">
                    <?php if ($this->session->flashdata("erro_validation_profile")): ?>
                        <div class="alert alert-danger">
                            <strong>Erros no formulário!</strong><br/>
                            <br/>
                            <?php echo $this->session->flashdata("erro_validation_profile"); ?>
                        </div>
                    <?php endif; ?>
                    <?php if ($this->session->flashdata("mensagem_profile")) : ?>
                        <div class="alert alert-success">
                            <strong><?php echo $this->session->flashdata("mensagem_profile"); ?></strong><br/>
                        </div>
                    <?php endif; ?>
                    <?php if ($this->session->flashdata("erro_profile")) : ?>
                        <div class="alert alert-danger">
                            <strong><?php echo $this->session->flashdata("erro_profile"); ?></strong><br/>
                        </div>
                    <?php endif; ?>

                    <div class="row">
                        <div class="form-group">
                            <div class="col-xs-12">
                                <?php echo form_label('Nome Completo', 'fullname'); ?>
                                <?php echo form_input(array('name' => 'fullname', 'class' => 'form-control', 'id' => 'fullname', 'placeholder' => "Nome Completo", "autofocus", "required" => "true"), set_value('fullname', isset($user_profile->name) ? $user_profile->name : "")); ?>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <div class="col-xs-12">
                                <?php echo form_label('Email', 'email'); ?>
                                <?php echo form_input(array('name' => 'email', 'class' => 'form-control', 'id' => 'email', 'placeholder' => "Email", "autofocus", "type" => "email", "required" => "true"), set_value('email', isset($user_profile->email) ? $user_profile->email : "")); ?>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="form-group">
                            <div class="col-xs-12">
                                <?php echo form_label('Data de Nascimento', 'birthDate'); ?>
                                <?php echo form_input(array('name' => 'birthDate', 'class' => 'form-control', 'id' => 'birthDate', "type" => "date", "required" => "true"), set_value('birthDate', isset($user_profile->birthday) ? $user_profile->birthday : "")); ?>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="form-group">
                            <div class="col-xs-12">
                                <?php echo form_label('Estado', 'selectState'); ?>
                                <?php echo form_dropdown(array('class' => "selectpicker", 'data-live-search' => "true", 'data-width' => "100%", 'name' => "selectState", 'id' => "selectState",), $states, isset($state->id) ? $state->id : set_value('selectState')); ?>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="form-group">
                            <div class="col-xs-12">
                                <?php echo form_label('Cidade', 'name'); ?>
                                <?php echo form_dropdown(array('class' => "selectpicker", 'data-live-search' => "true", 'data-width' => "100%", 'name' => "selectCity", 'id' => "selectCity",), $citys, isset($user_profile->id_city) ? $user_profile->id_city : set_value('selectCity')); ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <div class="col-xs-12">
                                <?php echo form_label('Telefone', 'phone'); ?>
                                <?php echo form_input(array('name' => 'phone', 'class' => 'form-control phone', 'id' => 'phone', 'placeholder' => "Telefone", "autofocus"), set_value('phone', isset($user_profile->phone) ? $user_profile->phone : "")); ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <div class="col-xs-12">
                                <?php echo form_label('Site', 'site'); ?>
                                <div class="input-group">
                                    <div class="input-group-addon">http://</div>
                                    <?php echo form_input(array('name' => 'site', 'class' => 'form-control', 'id' => 'site', 'placeholder' => "Site"), set_value('site', isset($user_profile) ? $user_profile->site : "")); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <div class="col-xs-12">
                                <?php echo form_label('Facebook', 'facebook'); ?>
                                <div class="input-group">
                                    <div class="input-group-addon">facebook.com/</div>
                                    <?php echo form_input(array('name' => 'facebook', 'class' => 'form-control', 'id' => 'facebook', 'placeholder' => "Facebook"), set_value('facebook', isset($user_profile) ? $user_profile->facebook : "")); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">

                            <div class="col-xs-12">
                                <?php echo form_label('Twitter', 'twitter'); ?>
                                <div class="input-group">
                                    <div class="input-group-addon">@</div>
                                    <?php echo form_input(array('name' => 'twitter', 'class' => 'form-control', 'id' => 'twitter', 'placeholder' => "Twitter"), set_value('twitter', isset($user_profile) ? $user_profile->twitter : "")); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <div class="col-xs-12">
                                <label class="control-label">Sexo</label>
                                <label class="checkbox-inline">
                                    <?php echo form_radio(array('name' => 'gender', 'value' => 2, "required" => "true", 'checked' => (isset($user_profile->id_gender) && 2 == $user_profile->id_gender) ? TRUE : set_radio('gender', '2'), 'id' => 'male')) ?>Feminino
                                </label>
                                <label class="checkbox-inline">
                                    <?php echo form_radio(array('name' => 'gender', 'value' => 1, "required" => "true", 'checked' => (isset($user_profile->id_gender) && 1 == $user_profile->id_gender) ? TRUE : set_radio('gender', '1'), 'id' => 'male')) ?>Masculino
                                </label>
                            </div>
                        </div>
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <div class="col-xs-12">
                                <label for="upload_avatar"></label>
                                <input type="file" accept="image/*" name="upload_avatar" onchange="loadFile(event)" id="upload_avatar">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-4 col-xs-offset-4 ">
                            <input type="submit" class="btn btn-primary btn-block btn-lg" value="Atualizar">
                        </div>
                    </div>
                </form>
            </div>
            <div role="tabpanel" class="tab-pane fade" id="alter_pass">
                <form action="<?= base_url('profile/alterPassword') ?>" method="post" data-toggle ="validator">
                    <?php if ($this->session->flashdata("erro_validation_password")): ?>
                        <div class="alert alert-danger">
                            <strong>Erros no formulário!</strong><br/>
                            <br/>
                            <?php echo $this->session->flashdata("erro_validation_password"); ?>
                        </div>
                    <?php endif; ?>
                    <?php if ($this->session->flashdata("mensagem_password")) : ?>
                        <div class="alert alert-success">
                            <strong><?php echo $this->session->flashdata("mensagem_password"); ?></strong><br/>
                        </div>
                    <?php endif; ?>
                    <?php if ($this->session->flashdata("erro_password")) : ?>
                        <div class="alert alert-danger">
                            <strong><?php echo $this->session->flashdata("erro_password"); ?></strong><br/>
                        </div>
                    <?php endif; ?>
                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <?php echo form_label('Senha Atual', 'oldPassword'); ?>
                                <span class="required">*</span>
                                <?php if ($user_profile->password == NULL): ?>
                                    <?php $config = array("name" => "oldPassword", "id" => "oldPassword", 'class' => 'form-control', 'placeholder' => "Senha Atual", 'disabled' => 'true'); ?>
                                <?php else: ?>
                                    <?php $config = array("name" => "oldPassword", "id" => "oldPassword", 'class' => 'form-control', 'placeholder' => "Senha Atual", "Senha", "required" => "true", "data-minlength" => "6", "maxlength" => "22"); ?>
                                <?php endif; ?>
                                <?php echo form_password($config); ?>
                                <div class="help-block">A senha deve ter entre 6 a 22 caracteres</div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <?php echo form_label('Nova Senha', 'password'); ?>
                                <span class="required">*</span>
                                <?php echo form_password(array("name" => "password", "id" => "password", 'class' => 'form-control', 'placeholder' => "Senha", "required" => "true", "data-minlength" => "6", "maxlength" => "22")); ?>
                                <div class="help-block">A senha deve ter entre 6 a 22 caracteres</div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <?php echo form_label('Confirmar Nova Senha', 'ConfirmPassword'); ?>
                                <span class="required">*</span>
                                <?php echo form_password(array("name" => "ConfirmPassword", "id" => "ConfirmPassword", 'class' => 'form-control', 'placeholder' => "Confirme a senha", "required" => "true", "data-match" => "#password", "data-match-error" => "As senhas não conferem")); ?>
                                <div class="help-block with-errors"></div>
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
                        <div style="">
                            <a href="<?= base_url('service/cancel'); ?>" type="button" class="btn btn-danger" id="cancel">Cancelar</a>
                            <input type="submit" class="btn btn-success" value="Atualizar" onclick="return confirm('Confirma a atualização?')">
                        </div>
                    </div>
                </form>
            </div>


        </div>
    </div>
</div>



</div> <!-- END PROFILE-CONTENT -->

</div> <!-- END COL -->
</div> <!-- END ROW -->
</div> <!-- END CONTAINER -->

</div>
