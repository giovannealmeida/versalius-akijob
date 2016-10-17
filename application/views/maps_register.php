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
        <div class="container">
            <h2>Cadastro de serviços</h2>
            <br>
            <form>
                <div class = "row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Endereço:</label>
                            <input type="text" class="form-control" id="endereco">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Número:</label>
                            <input type="text" class="form-control" id="numero">
                        </div>
                    </div>
                </div>

                <div class = "row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Complemento:</label>
                            <input type="text" class="form-control" id="complemento">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Bairro:</label>
                            <input type="text" class="form-control" id="bairro">
                        </div>
                    </div>
                </div>

                <div class = "row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Cidade:</label>
                            <select class="selectpicker" data-width="100%">
                                <option>Itajuípe</option>
                                <option>Coaraci</option>
                                <option>Itapitanga</option>
                                <option>Itabuna</option>
                                <option>Buerarema</option>
                                <option>Ilhéus</option>
                            </select>

                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Estado:</label>
                            <select class="selectpicker" data-width="100%">
                                <option>Acre</option>
                                <option>Amazonas</option>
                                <option>Alagoas</option>
                                <option>Bahia</option>
                                <option>Ceará</option>
                                <option>Distrito Federal</option>
                            </select>

                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>CEP:</label>
                            <input type="text" class="form-control" id="cep">
                        </div>
                    </div>
                </div>

                <div class = "row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Serviço:</label>
                            <div class="select_service">
                                <select class="selectpicker" multiple data-live-search="true" data-width="100%">
                                    <option>Pedreiro</option>
                                    <option>Ajudante de pedreiro</option>
                                    <option>Encanador</option>
                                    <option>Advogado</option>
                                    <option>Padeiro</option>
                                    <option>Economista</option>
                                    <option>Médico</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="form-group">
                            <label>Descrição:</label>
                            <input type="text" class="form-control" id="descricao">
                        </div>
                    </div>
                </div>

                <div class = "row">
                    <div class="col-md-5">
                        <div class="form-group">
                            <label>Latitude:</label>
                            <input type="text" class="form-control" id="latitude">
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <label>Longitude:</label>
                            <input type="text" class="form-control" id="longitude">
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <!-- BEGIN MAPA -->
        <div id="map"></div>
        <input id="pac-input" class="controls" type="text" placeholder="Pesquisar">
        <!-- END MAPA-->
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC69Ji81pHJ6ol7VhIrIDE1mUofcZw_WuA&libraries=places&callback=initAutocomplete" async defer></script>
        <script src="<?= base_url('/assets/js/google_maps/maps_register.js'); ?>" type="text/javascript"></script>
        <link href="<?= base_url('/assets/css/google_maps/maps_register.css'); ?>" rel="stylesheet" type="text/css" />
    </body>
</html>