

<!-- Begin page content -->
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-10 col-lg-offset-1">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h3 class="text-center">Editar Informações</h3>
                    <?php echo form_open('profile/edit', array('id' => "edit_user", "class" => "form-horizontal", "role" => "form", "enctype" => "multipart/form-data")); ?>
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
                                <img src="
                                <?php if ($user_profile->avatar === NULL): ?>
                                    <?= '//placehold.it/200' ?>
                                <?php elseif ($user_profile->avatar == base64_decode(base64_encode(stripslashes($user_profile->avatar)))): ?>
                                    <?= $user_profile->avatar ?>
                                <?php else: ?>
                                    <?= 'data:image/jpeg;base64,' . base64_encode(stripslashes($user_profile->avatar)); ?>
                                <?php endif; ?>
                                     " class="avatar img-circle" alt="avatar" id="preview_image" style="max-width: 200px; max-height: 200px;">
                                <h5><b>Avatar</b></h5>
                            </div>
                            <input type="file" accept="image/*" name="avatar" onchange="loadFile(event)">
                        </div>
                    </div>
                    <div class="form-group">
                        <?php echo form_label('Nome Completo', 'fullname', array("class" => "col-md-3 control-label")); ?>
                        <div class="col-md-9">
                            <?php echo form_input(array('name' => 'fullname', 'class' => 'form-control', 'id' => 'fullname', 'placeholder' => "Nome Completo", "autofocus"), set_value('fullname', isset($user_profile->name) ? $user_profile->name : "")); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <?php echo form_label('Email', 'email', array("class" => "col-md-3 control-label")); ?>
                        <div class="col-md-9">
                            <?php echo form_input(array('name' => 'email', 'class' => 'form-control', 'id' => 'email', 'placeholder' => "Email", "autofocus", "type" => "email"), set_value('email', isset($user_profile->email) ? $user_profile->email : "")); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <?php echo form_label('Data de Nascimento', 'birthDate', array("class" => "col-md-3 control-label")); ?>
                        <div class="col-md-9">
                            <?php echo form_input(array('name' => 'birthDate', 'class' => 'form-control', 'id' => 'birthDate', "type" => "date"), set_value('birthDate', isset($user_profile->birthday) ? $user_profile->birthday : "")); ?>
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
                            <?php echo form_dropdown(array('class' => "selectpicker", 'data-live-search' => "true", 'data-width' => "100%", 'name' => "selectCity", 'id' => "selectCity",), $citys, $user_profile->id_city, set_value('selectCity')); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <?php echo form_label('Telefone', 'phone', array("class" => "col-md-3 control-label")); ?>
                        <div class="col-md-9">
                            <?php echo form_input(array('name' => 'phone', 'class' => 'form-control', 'id' => 'phone', 'placeholder' => "Telefone", "autofocus"), set_value('phone', isset($user_profile->phone) ? $user_profile->phone : "")); ?>
                        </div>
                    </div>
                    <!-- /.form-group -->
                    <div class="form-group">
                        <label class="control-label col-md-3">Sexo</label>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-sm-4">
                                    <label class="radio-inline">
                                        <?php echo form_radio(array('name' => 'gender', 'value' => 2, 'checked' => (isset($user_profile->id_gender) && 2 == $user_profile->id_gender) ? TRUE : set_radio('gender', '2'), 'id' => 'male')) ?>Feminino
                                    </label>
                                </div>
                                <div class="col-sm-4">
                                    <label class="radio-inline">
                                        <?php echo form_radio(array('name' => 'gender', 'value' => 1, 'checked' => (isset($user_profile->id_gender) && 1 == $user_profile->id_gender) ? TRUE : set_radio('gender', '1'), 'id' => 'male')) ?>Masculino
                                    </label>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- /.form-group -->
                    <div class="form-group">
                        <div class="col-xs-4 col-xs-offset-4 ">
                            <input type="submit" class="btn btn-primary btn-block btn-lg" value="Atualizar">
                        </div>
                    </div>
                    <?php form_close() ?>
                </div>
            </div>

        </div>
    </div>


</div>
</div>
