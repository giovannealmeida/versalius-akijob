<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link href="<?= base_url('/assets/css/bootstrap-select.min.css'); ?>" rel="stylesheet" type="text/css" />
        <script src="<?= base_url('/assets/js/bootstrap-select.min.js'); ?>" type="text/javascript"></script>
        <title>Places Searchbox</title>
    </head>
    <body>
        <div class="container" style="height:50%;">
            <h2>Cadastro de serviços</h2>
            <br>
            <?php echo form_open('register_service/index', array('id' => "registerService")); ?>
            <?php echo form_input(array('name' => 'latitude', 'class' => 'form-control', 'id' => 'latitude', 'type' => "hidden")); ?>
            <?php echo form_input(array('name' => 'longitude', 'class' => 'form-control', 'id' => 'longitude', 'type' => "hidden")); ?>
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
            <?php elseif ($this->session->flashdata("erro")): ?>
                <div class="alert alert-danger">
                    <strong><?php echo $this->session->flashdata("mensagem"); ?></strong><br/>
                </div>
            <?php endif; ?>
            <div class = "row">
                <div class="col-md-5">
                    <div class="form-group">
                        <?php echo form_label('Endereço: ', 'address'); ?>
                        <?php echo form_input(array('name' => 'address', 'class' => 'form-control', 'id' => 'address', 'placeholder' => "Endereço"), set_value('address')); ?>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <?php echo form_label('Número: ', 'number'); ?>
                        <?php echo form_input(array('name' => 'number', 'class' => 'form-control', 'id' => 'number', 'placeholder' => "Número"), set_value('number')); ?>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="form-group">
                        <?php echo form_label('Complemento: ', 'complement'); ?>
                        <?php echo form_input(array('name' => 'complement', 'class' => 'form-control', 'id' => 'complement', 'placeholder' => "Complemento"), set_value('complement')); ?>
                    </div>
                </div>
            </div>
            <div class = "row">
                <div class="col-md-4">
                    <div class="form-group">
                        <?php echo form_label('Bairro: ', 'neighborhood'); ?>
                        <?php echo form_input(array('name' => 'neighborhood', 'class' => 'form-control', 'id' => 'neighborhood', 'placeholder' => "Bairro"), set_value('neighborhood')); ?>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <?php echo form_label('Estado: ', 'name'); ?>
                        <?php $optionsState = array("" => "--"); ?>
                        <?php foreach ($states as $state) : ?>
                            <?php $optionsState += array($state['id'] => $state['name'] . ' - ' . $state['initials']); ?>
                        <?php endforeach; ?>
                        <?php echo form_dropdown(array('class' => "selectpicker", 'data-live-search' => "true", 'data-width' => "100%", 'name' => "selectState", 'id' => "selectState",), $optionsState, set_value('selectState')); ?>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <?php echo form_label('Cidade: ', 'name'); ?>
                        <?php $optionsCity = array(NULL => "--") ?>
                        <?php if (isset($citys)) : ?>
                            <?php foreach ($citys as $city) : ?>
                                <?php $optionsCity[$city["id"]] = $city["name"]; ?>
                            <?php endforeach; ?>
                        <?php endif; ?>
                        <?php echo form_dropdown(array('class' => "selectpicker", 'data-live-search' => "true", 'data-width' => "100%", 'name' => "selectCity", 'id' => "selectCity",), $optionsCity, set_value('selectCity')); ?>
                    </div>
                </div>
            </div>
            <div class = "row">
                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo form_label('CEP: ', 'zipCode'); ?>
                        <?php echo form_input(array('name' => 'zipCode', 'class' => 'form-control', 'id' => 'zipCode', 'pattern' => "\(\d{2}\)\d{4}-\d{4}"), set_value('zipCode')); ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo form_label('Serviço(s): ', 'name'); ?>
                        <?php foreach ($jobs as $job): ?>
                            <?php $optionsService[$job['id']] = $job['name']; ?>
                        <?php endforeach; ?>
                        <?php echo form_dropdown(array('class' => "selectpicker", 'data-live-search' => "true", 'data-width' => "100%", 'name' => "selectService", 'id' => "selectService",), $optionsService, set_value('selectService')); ?>
                    </div>
                </div>
            </div>
            <div class = "row">
                <div class="col-md-12">
                    <div class="form-group">
                        <?php echo form_checkbox(array('name' => "availability_fds", 'id' => 'availability_fds', 'value' => 1, 'style' => 'margin:10px', 'checked' => set_checkbox('availability_fds', 1, false))) . form_label('Disponibilidade Final de Semana', 'availability_fds'); ?>
                        <?php echo form_checkbox(array('name' => 'availability_24h', 'id' => 'availability_24h', 'value' => 1, 'style' => 'margin:10px', 'checked' => set_checkbox('availability_fds', 1, false))) . form_label('Disponibilidade 24h', 'availability_24h'); ?> 
                    </div>
                </div>
            </div>
            <div class = "row">
                <div class="col-md-12">
                    <div class="form-group">
                        <?php echo form_label('Qualificação: ', 'qualification'); ?>
                        <textarea name="qualification" id="qualification" class="form-control" rows="5" placeholder="Ex. Especialista em assentar piso.
Ex. Especialista em conserto de carros. 
Ex. Especialista em Java." ><?php echo set_value('qualification'); ?></textarea>
                    </div>
                </div>
            </div>
            <?php echo form_close(); ?>
            <div class="col-md-12" style="height: 100%;">
                <!-- BEGIN MAPA -->
                <div id="map"></div>
                <?php echo form_input(array('class' => 'controls', 'id' => 'pac-input', 'placeholder' => "Pesquisar")); ?>
                <!-- END MAPA-->
            </div>
            <div class = "row">
                <div style="margin-top: 30px; margin-bottom: 30px; float: right;">
                    <?php echo form_submit('submit', 'Cancelar', array('class' => "btn btn-danger", 'id' => "cancel")); ?>
                    <?php echo form_submit('submit', 'Cadastrar', array('class' => "btn btn-success", 'id' => "register")); ?>
                </div>
            </div>
        </div>
        <script type='text/javascript'>var base_url = {url: "<?= base_url() ?>"};</script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC69Ji81pHJ6ol7VhIrIDE1mUofcZw_WuA&libraries=places&callback=initAutocomplete" async defer></script>
        <script src="<?= base_url('/assets/js/google_maps/mapsRegister.js'); ?>" type="text/javascript"></script>
        <script> setLatLng(<?= $coordinates[0]['latitude'] ?>, <?= $coordinates[0]['longitude'] ?>);</script>
        <script src="<?= base_url('/assets/js/changeCity.js'); ?>" type="text/javascript"></script>
        <link href="<?= base_url('/assets/css/google_maps/mapsRegister.css'); ?>" rel="stylesheet" type="text/css" />
    </body>
</html>