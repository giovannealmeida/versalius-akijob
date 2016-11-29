
<!-- Begin page content -->
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-6 col-sm-offset-3 col-md-6 col-md-offset-3 col-lg-4 col-lg-offset-4">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h4>Insira seu email</h4>
                    <?php if (validation_errors()): ?>
                        <div class="row">
                            <div class="col-xs-12 errors">
                                <ul class=" bg-danger">
                                    <?= validation_errors() ?>
                                </ul>

                            </div>
                        </div>

                    <?php endif; ?>
                    <?php if (isset($success) && $success): ?>
                        <div class="row">
                            <div class="col-xs-12 errors">
                                <ul class=" bg-danger">
                                    <?= validation_errors() ?>
                                </ul>
                            </div>
                        </div>
                    <?php endif; ?>

                    <form method="post" data-toggle="validator">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label for="email" class="sr-only">Email</label>
                                    <input name="email" type="text" id="email" placeholder="Email" class="form-control" autofocus required="true">
                                </div>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <button type="submit" name="button" class="btn btn-primary btn-block">Confirmar</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>


</div>
</div>
