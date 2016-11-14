
<!-- Begin page content -->
<div class="container">
    <div class="row">
        <div class="col-cs-12 col-sm-12 col-md-10 col-md-offset-1 col-lg-10 col-lg-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><strong><?= $title ?> Serviço</strong></h3>
                </div>
                <div class="panel-body">
                    <?php echo form_open("service/{$action}/{$id}", array('id' => "registerService")); ?>
                    <?php echo form_input(array('name' => 'latitude', 'class' => 'form-control', 'id' => 'latitude', 'type' => "hidden"), set_value('latitude', isset($dataService) ? $dataService->latitude : "")); ?>
                    <?php echo form_input(array('name' => 'longitude', 'class' => 'form-control', 'id' => 'longitude', 'type' => "hidden"), set_value('longitude', isset($dataService) ? $dataService->longitude : "")); ?>
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
                        <div class="alert alert-danger">
                            <strong><?php echo $this->session->flashdata("erro"); ?></strong><br/>
                        </div>
                    <?php endif; ?>
                    <div class="row">
                        <div class="col-lg-5">
                            <div class="form-group">
                                <?php echo form_label('Rua', 'street'); ?>
                                <span class="required">*</span>
                                <?php echo form_input(array('name' => 'street', 'class' => 'form-control', 'id' => 'street', 'placeholder' => "Rua"), set_value('street', isset($dataService) ? $dataService->street : "")); ?>
                            </div>
                        </div>

                        <div class="col-lg-5">
                            <div class="form-group">
                                <?php echo form_label('Complemento', 'complement'); ?>
                                <?php echo form_input(array('name' => 'complement', 'class' => 'form-control', 'id' => 'complement', 'placeholder' => "Complemento"), set_value('complement', isset($dataService) ? $dataService->complement : "")); ?>
                            </div>

                        </div>
                        <div class="col-lg-2">
                            <div class="form-group">
                                <?php echo form_label('Número', 'number'); ?>
                                <?php echo form_input(array('name' => 'number', 'class' => 'form-control', 'id' => 'number', 'placeholder' => "Número"), set_value('number', isset($dataService) ? $dataService->number : "")); ?>
                            </div>
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-lg-2">
                            <div class="form-group">
                                <?php echo form_label('CEP', 'zipCode'); ?>
                                <span class="required">*</span>
                                <?php echo form_input(array('name' => 'zipCode', 'class' => 'form-control cep', 'id' => 'zipCode', 'pattern' => ".{8,}"), set_value('zipCode', isset($dataService) ? $dataService->zip_code : "")); ?>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <?php echo form_label('Bairro', 'neighborhood'); ?>
                                <span class="required">*</span>
                                <?php echo form_input(array('name' => 'neighborhood', 'class' => 'form-control', 'id' => 'neighborhood', 'placeholder' => "Bairro"), set_value('neighborhood', isset($dataService) ? $dataService->neighborhood : "")); ?>
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <div class="form-group">
                                <?php echo form_label('Estado', 'selectState'); ?>
                                <span class="required">*</span>
                                <?php echo form_dropdown(array('class' => "selectpicker", 'data-live-search' => "true", 'data-width' => "100%", 'name' => "selectState", 'id' => "selectState",), $states, set_value('selectState', isset($dataService) ? $idState->id : "")); ?>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="form-group">
                                <?php echo form_label('Cidade', 'selectCity'); ?>
                                <span class="required">*</span>
                                <?php echo form_dropdown(array('class' => "selectpicker", 'data-live-search' => "true", 'data-width' => "100%", 'name' => "selectCity", 'id' => "selectCity",), $citys, set_value('selectCity', isset($dataService) ? $dataService->id_city : "")); ?>
                            </div>
                        </div>



                    </div>

                    <div class="row">
                        <div class="col-xs-12">
                            <div class="form-group">
                                <?php echo form_label('Serviço', 'selectJob'); ?>
                                <span class="required">*</span>
                                <?php echo form_dropdown(array('class' => "selectpicker", 'data-live-search' => "true", 'data-width' => "100%", 'name' => "selectJob", 'id' => "selectJob",), $jobs, set_value('selectJob', isset($dataService) ? $dataService->id_job : "")); ?>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-12">
                            <?php echo form_label('Competências', 'skills'); ?>
                            <textarea class="form-control" name="skills" id="skills" placeholder="Informe aqui sua experiência e capacidade no serviço escolhido"><?php echo set_value('skills', isset($dataService) ? $dataService->skills : ""); ?></textarea>
                        </div>
                    </div>

                    <div class="divider"></div>


                    <h4 class="text-info">Diferenciais</h4>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                            <div class="checkbox">
                                <label style="width:100%;">
                                    <?php echo form_checkbox(array("data-toggle" => "toggle", "data-on" => "Possui Disponibilidade<br> 24h", "data-off" => "Não Possui Disponibilidade<br> 24h", 'name' => 'availability_24h', 'id' => 'availability_24h', 'value' => 1, 'style' => 'margin:10px', 'checked' => isset($dataService) ? $dataService->availability_24h : set_checkbox('availability_24h', 1))); ?>
                                </label>
                            </div>

                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-5">
                            <div class="checkbox">
                                <label style="width:100%;">
                                    <?php echo form_checkbox(array("data-toggle" => "toggle", "data-on" => "Possui Disponibilidade<br>no Final de Semana", "data-off" => "Não Possui Disponibilidade<br>no Final de Semana ", 'name' => 'availability_fds', 'id' => 'availability_fds', 'value' => 1, 'style' => 'margin:10px', 'checked' => isset($dataService) ? $dataService->availability_fds : set_checkbox('availability_fds', 1))); ?>
                                </label>
                            </div>

                        </div>
                    </div>

                    <div class="divider"></div>

                    <div class="row">
                        <div class="col-xs-12">
                            <h4 class="text-info">Onde te encontrar?</h4>
                            <div id="map" style="width:100%;height: 500px; margin-left: 0px"></div>
                            <?php echo form_input(array('class' => 'controls', 'id' => 'pac-input', 'placeholder' => "Pesquisar")); ?>
                        </div>
                    </div>

                </div>

                <div class="divider"></div>

                <div class="row button-row">
                    <div class="col-xs-12 col-sm-12 col-md-6  col-lg-2 col-lg-offset-8">
                        <a href="<?= base_url('service/cancel'); ?>" type="button" class="btn btn-danger btn-lg btn-block" id="cancel">Cancelar</a>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-6  col-lg-2 ">
                        <input type="submit" class="btn btn-success btn-lg btn-block" value="<?= $titleAction ?>" onclick="return confirm('Tem certeza que deseja <?= $titleAction ?>?')">
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>

    </div>
</div>
</div>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC69Ji81pHJ6ol7VhIrIDE1mUofcZw_WuA&libraries=places&callback=initMap" async defer></script>
