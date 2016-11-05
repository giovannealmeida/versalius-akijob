
            <!-- Begin page content -->
            <div class="container">
                <div class="row">
                    <div class="col-sm-6 col-sm-offset-3  col-md-6 col-md-offset-3 col-lg-4 col-lg-offset-4">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <a href="<?= $login_url_google ?>" class="btn btn-block btn-social btn-google">
                                    <span class="fa fa-google"></span>Login com o Gmail
                                </a>
                                <a href="<?= $login_url_facebook ?>" class="btn btn-block btn-social btn-facebook">
                                    <span class="fa fa-facebook"></span> Login com Facebook
                                </a>
                                <div class="divider"></div>
                                <h3 class="text-center">Acesse a sua conta</h3>
                                <?php echo form_open('login'); ?>
                                <?php if ($this->session->flashdata("login_error")) : ?>
                                    <div class="alert alert-danger">
                                        <strong><?php echo $this->session->flashdata("login_error"); ?></strong><br/>
                                    </div>
                                <?php endif; ?>
                                <div class="form-group">
                                    <?php echo form_input(array("name" => "email", "id" => "email", "class" => "form-control", "type" => "text", "placeholder" => "Email")); ?>
                                </div>
                                <div class="form-group">
                                    <?php echo form_input(array("name" => "password", "id" => "password", "class" => "form-control", "type" => "password", "placeholder" => "Senha")); ?>
                                </div>
                                <div class="form-group">
                                    <input class="form-control btn btn-success" type="submit" name="login" value="Login">
                                </div>
                                <div class="login-help">
                                    <a href="<?= base_url("login/register") ?>">Cadastre-se</a> - <a href="<?=base_url("login/forgot_password")?>">Esqueceu sua senha?</a>
                                </div>
                                <?php form_close(); ?>
                            </div>
                        </div>

                    </div>
                </div>


            </div>
        </div>
