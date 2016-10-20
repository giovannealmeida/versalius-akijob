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
            <form action="<?= base_url('index.php/register_service/index'); ?>" method="post" id="registerService">
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
                        <br/>
                    </div>
                <?php elseif ($this->session->flashdata("erro")): ?>
                    <div class="alert alert-danger">
                        <strong><?php echo $this->session->flashdata("mensagem"); ?></strong><br/>
                        <br/>
                    </div>
                <?php endif; ?>
                <div class = "row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Serviço(s):</label>
                            <?php if ($this->input->post('selectService') != NULL): ?>
                                <?php $selectedService = array($this->input->post('selectService')); ?>
                            <?php else : ?>
                                <?php $selectedService = array(0); ?>
                            <?php endif; ?>
                            <?php foreach ($jobs as $job): ?>
                                <?php $optionsService[$job['id']] = $job['name']; ?>
                            <?php endforeach; ?>
                            <?php echo form_multiselect(array('class' => "selectpicker", 'multiple data-live-search' => "true", 'data-width' => "100%", 'name' => "selectService[]", 'id' => "selectService",), $optionsService, ($this->input->post('selectService')) ? $this->input->post('selectService') : $selectedService); ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Descrição:</label>
                            <?php echo form_input(array('name' => 'description', 'class' => 'form-control', 'id' => 'description'), set_value('description', $this->input->post('description') == NULL ? '' : $this->input->post('description'))); ?>
                        </div>
                    </div>
                </div>
                <div class = "row">
                    <div class="col-md-5">
                        <div class="form-group">
                            <label>Endereço:</label>
                            <?php echo form_input(array('name' => 'address', 'class' => 'form-control', 'id' => 'address'), set_value('address', $this->input->post('address') == NULL ? '' : $this->input->post('address'))); ?>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Número:</label>
                            <?php echo form_input(array('name' => 'number', 'class' => 'form-control', 'id' => 'number'), set_value('number', $this->input->post('number') == NULL ? '' : $this->input->post('number'))); ?>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <label>Complemento:</label>
                            <?php echo form_input(array('name' => 'complement', 'class' => 'form-control', 'id' => 'complement'), set_value('complement', $this->input->post('complement') == NULL ? '' : $this->input->post('complement'))); ?>
                        </div>
                    </div>
                </div>

                <div class = "row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Bairro:</label>
                            <?php echo form_input(array('name' => 'neighborhood', 'class' => 'form-control', 'id' => 'neighborhood'), set_value('neighborhood', $this->input->post('neighborhood') == NULL ? '' : $this->input->post('neighborhood'))); ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Estado:</label>
                            <?php if ($this->input->post('selectState') != NULL): ?>
                                <?php $selectedState = array($this->input->post('selectState')); ?>
                            <?php else : ?>
                                <?php $selectedState = array(0); ?>
                            <?php endif; ?>
                            <?php $optionsState = array("" => "--"); ?>
                            <?php foreach ($states as $state) : ?>
                                <?php $optionsState += array($state['id'] => $state['name'] . ' - ' . $state['initials']); ?>
                            <?php endforeach; ?>
                            <?php echo form_dropdown(array('class' => "selectpicker", 'data-live-search' => "true", 'data-width' => "100%", 'name' => "selectState", 'id' => "selectState",), $optionsState, ($this->input->post('selectState')) ? $this->input->post('selectState') : $selectedState); ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Cidade:</label>
                            <?php if (isset($citys)) : ?>
                                <?php foreach ($citys as $city) : ?>
                                    <?php $optionsCity[$city["id"]] = $city["name"]; ?>
                                <?php endforeach; ?>
                                <?php $selectedCity = array($this->input->post('selectCity')); ?>
                            <?php else : ?>
                                <?php $optionsCity = array("" => " -- "); ?>
                                <?php $selectedCity = array(0); ?>
                            <?php endif; ?>
                            <?php echo form_dropdown(array('class' => "selectpicker", 'data-live-search' => "true", 'data-width' => "100%", 'name' => "selectCity", 'id' => "selectCity",), $optionsCity, ($this->input->post('selectCity')) ? $this->input->post('selectCity') : $selectedCity); ?>
                        </div>
                    </div>
                </div>
                <div class = "row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>CEP:</label>
                            <?php echo form_input(array('name' => 'zipCode', 'class' => 'form-control', 'id' => 'zipCode'), set_value('zipCode', $this->input->post('zipCode') == NULL ? '' : $this->input->post('zipCode'))); ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Latitude:</label>
                            <?php echo form_input(array('name' => 'latitude', 'class' => 'form-control', 'id' => 'latitude'), set_value('latitude', $this->input->post('latitude') == NULL ? '' : $this->input->post('latitude'))); ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Longitude:</label>
                            <?php echo form_input(array('name' => 'longitude', 'class' => 'form-control', 'id' => 'longitude'), set_value('longitude', $this->input->post('longitude') == NULL ? '' : $this->input->post('longitude'))); ?>
                        </div>
                    </div>
                </div>
            </form>
            <div class="col-md-12" style="height: 100%;">
                <!-- BEGIN MAPA -->
                <div id="map"></div>
                <input id="pac-input" class="controls" type="text" placeholder="Pesquisar">
                <!-- END MAPA-->
            </div>
            <div class = "row">
                <div class="col-md-1" style="margin-top: 30px; float:right;">
                    <button type="submit" class="btn btn-success" id="register">Cadastrar</button>
                </div>
                <div class="col-md-1" style="margin-top: 30px; float:right;">
                    <button type="button" class="btn btn-danger">Cancelar</button>
                </div>
            </div>
        </div>
        <script type='text/javascript'>var base_url = {url: "<?= base_url() ?>"};</script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC69Ji81pHJ6ol7VhIrIDE1mUofcZw_WuA&libraries=places&callback=initAutocomplete" async defer></script>
        <script src="<?= base_url('/assets/js/google_maps/mapsRegister.js'); ?>" type="text/javascript"></script>
        <script> setLatLng(-14,78556, -39,28028); </script>
        <script src="<?= base_url('/assets/js/changeCity.js'); ?>" type="text/javascript"></script>
        <link href="<?= base_url('/assets/css/google_maps/mapsRegister.css'); ?>" rel="stylesheet" type="text/css" />
    </body>
</html>