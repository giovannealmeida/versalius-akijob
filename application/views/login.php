
<!-- Begin page content -->
<div class="container">
    <div class="row">
        <div class="col-sm-6 col-sm-offset-3  col-md-6 col-md-offset-3 col-lg-6 col-lg-offset-3">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-xs-12 col-lg-6">
                            <button class="btn btn-block btn-social btn-google" id="google_login">
                                <span class="fa fa-google"></span>Login com o Gmail
                            </button>

                        </div>
                        <div class="col-xs-12 col-lg-6">
                            <button onclick="fb_login()" class="btn btn-block btn-social btn-facebook" id="facebook_login">
                                <span class="fa fa-facebook"></span> Login com Facebook
                            </button>

                        </div>

                    </div>
                    <div class="divider"></div>
                    <?php if (validation_errors()) : ?>
                        <div class="alert alert-danger">
                            <?php echo validation_errors(); ?>
                        </div>
                    <?php endif; ?>
                    <?php if (isset($login_status) && ($login_status == "error")) : ?>
                        <div class="alert alert-danger hint">
                            <p><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> O usuário informado não existe</p>
                        </div>
                    <?php endif; ?>
                    <?php if ($this->session->flashdata("login_status")): ?>
                        <div class="alert alert-danger hint">
                            <p><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Este email já está cadastrado no sistema</p>
                        </div>
                    <?php endif; ?>

                    <h3 class="text-center">Acesse a sua conta</h3>
                    <?php echo form_open('login', array("data-toggle" => "validator")); ?>
                    <div class="form-group">
                        <?php echo form_input(array("name" => "email", "id" => "email", "class" => "form-control", "type" => "email", "placeholder" => "Email", "required" => "true")); ?>
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group">
                        <?php echo form_input(array("name" => "password", "id" => "password", "class" => "form-control", "type" => "password", "placeholder" => "Senha", "data-minlength" => "6", "maxlength"=>"22")); ?>
                        <div class="help-block">A senha deve ter entre 6 a 22 caracteres</div>
                    </div>
                    <div class="form-group">
                        <input class="form-control btn btn-success" type="submit" name="login" value="Login">
                    </div>
                    <div class="login-help">
                        <a href="<?= base_url("login/register") ?>">Cadastre-se</a> - <a href="<?= base_url("login/forgot_password") ?>">Esqueceu sua senha?</a>
                    </div>
                    <?php form_close(); ?>
                </div>
            </div>

        </div>
    </div>


</div>
</div>
