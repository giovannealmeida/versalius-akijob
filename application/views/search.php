<!-- Begin page content -->
<div class="container" id="search-container">
    <div class="row">
        <div class="col-xs-10 col-sm-8 col-md-4 col-lg-4 col-xs-offset-1 col-sm-offset-2 col-md-offset-4 col-lg-offset-4">
            <img src="<?= base_url("assets/img/logo-vetor.png") ?>" alt="logo" class="img-responsive center-block" />

        </div>
    </div>
    <div class="search-form-container row">
        <div class="col-lg-8 col-lg-offset-2  ">
            <form class="form-group" data-toggle="validator" id="search-form" action="<?= base_url("results") ?>" method="post">
                <div class="form-group col-xs-12 col-sm-5 col-md-5 col-lg-5 search-element">
                    <?php echo form_dropdown(array('class' => "form-control selectpicker with-ajax", "data-abs-log" => "false", 'data-live-search' => "true", 'data-width' => "100%", 'name' => "selectJob", 'id' => "selectJob", "required" => "true"), set_value('selectJob')); ?>
                    <div class="help-block with-errors"></div>
                </div>
                <div class="form-group col-xs-12 col-sm-5 col-md-5 col-lg-5 search-element">
                    <label class="sr-only" for="city_select ">Cidade</label>
                    <?php echo form_dropdown(array('class' => "form-control selectpicker with-ajax", "data-abs-log" => "false", 'data-live-search' => "true", 'data-width' => "100%", 'name' => "selectCity", 'id' => "selectCity", "required" => "true"), set_value('selectCity')); ?>
                    <div class="help-block with-errors"></div>
                </div>
                <div class="col-xs-12 col-sm-2 col-md-2 col-lg-2 search-element">
                    <button type="submit" class="btn btn-primary btn-lg search-button">Buscar</button>
                </div>
                <?php if ($this->session->flashdata("erro")): ?>
                    <div class="col-lg-5 alert alert-danger">
                        <h6><?= $this->session->flashdata("erro") ?></h6>
                    </div>
                <?php endif; ?>
            </form>
        </div>

    </div>
</div>
</div>
