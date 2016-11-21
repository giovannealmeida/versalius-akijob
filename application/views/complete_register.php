

<!-- Begin page content -->
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-10 col-lg-offset-1">
            <div class="panel panel-default">
                <div class="panel-body">

                    <h3 class="text-center">Complete o Cadastro</h3>
                    <div class="divider"></div>
                    <div class="hint bg-info">
                        <span class="text-info">Estamos quase la! Complete seu cadastro a seguir!</span>
                    </div>
                        <?php if ($this->session->flashdata('email_exists')): ?>
                            <div class="bg-danger" style="padding:15px; margin-bottom:10px;">
                                <p class="text-info">O email já foi cadastrado</p>
                            </div>
                        <?php endif; ?>

                        <?php echo form_open('login/complete_register', array('id' => 'register', 'class' => 'form-horizontal', 'role' => 'form', 'enctype' => 'multipart/form-data')); ?>
                        <?php echo form_hidden('id_auth', set_value("id_auth", $user_profile["id_auth"])); ?>
                        <?php if (validation_errors()): ?>
                            <div class="alert alert-danger">
                                <strong>Erros no formulário!</strong><br/>
                                <br/>
                                <?php echo validation_errors(); ?>
                            </div>
                        <?php endif; ?>

                        <div class="form-group">
                            <?php echo form_label('Nome Completo', 'fullname', array('class' => 'col-md-3 control-label')); ?>
                            <div class="col-md-9">
                                <?php echo form_input(array('name' => 'fullname', 'class' => 'form-control', 'id' => 'fullname', 'placeholder' => 'Nome Completo', 'autofocus'), set_value('fullname', $user_profile['name'])); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <?php echo form_label('Email', 'email', array('class' => 'col-md-3 control-label')); ?>
                            <div class="col-md-9">
                                <?php echo form_input(array('name' => 'email', 'class' => 'form-control', 'id' => 'email', 'placeholder' => 'Email', 'autofocus', 'type' => 'email'), set_value('email', $user_profile['email'])); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <?php echo form_label('Data de Nascimento', 'birthDate', array('class' => 'col-md-3 control-label')); ?>
                            <div class="col-md-9">
                                <?php echo form_input(array('name' => 'birthDate', 'class' => 'form-control', 'id' => 'birthDate', 'type' => 'date'), set_value('birthDate')); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <?php echo form_label('Estado', 'selectState', array('class' => 'col-md-3 control-label')); ?>
                            <div class="col-md-9">
                                <?php echo form_dropdown(array('class' => 'selectpicker', 'data-live-search' => 'true', 'data-width' => '100%', 'name' => 'selectState', 'id' => 'selectState'), $states, isset($state) ? $state->id : null, set_value('selectState')); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <?php echo form_label('Cidade', 'name', array('class' => 'col-md-3 control-label')); ?>
                            <div class="col-md-9">
                                <?php echo form_dropdown(array('class' => 'selectpicker', 'data-live-search' => 'true', 'data-width' => '100%', 'name' => 'selectCity', 'id' => 'selectCity'), $citys, null, set_value('selectCity')); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <?php echo form_label('Telefone', 'phone', array('class' => 'col-md-3 control-label')); ?>
                            <div class="col-md-9">
                                <?php echo form_input(array('name' => 'phone', 'class' => 'form-control phone', 'id' => 'phone', 'placeholder' => 'Telefone', 'autofocus'), set_value('phone')); ?>
                            </div>
                        </div>
                        <!-- /.form-group -->
                        <div class="form-group">
                            <label class="control-label col-md-3">Sexo</label>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label class="radio-inline">
                                            <?php echo form_radio(array('name' => 'gender', 'value' => 2, 'checked' => (isset($user_profile['id_gender']) && 2 == $user_profile['id_gender']) ? true : set_radio('gender', '2'), 'id' => 'male')) ?>Feminino
                                        </label>
                                    </div>
                                    <div class="col-sm-4">
                                        <label class="radio-inline">
                                            <?php echo form_radio(array('name' => 'gender', 'value' => 1, 'checked' => (isset($user_profile['id_gender']) && 1 == $user_profile['id_gender']) ? true : set_radio('gender', '1'), 'id' => 'male')) ?>Masculino
                                        </label>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- /.form-group -->
                        <div class="form-group">
                            <div class="col-xs-12 col-md-offset-2">
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
