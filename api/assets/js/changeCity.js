jQuery(function () {
    urlConsulta = base_url.url + "index.php/consultas/getEstados/";
    // $('#selectCidade').append($('<option></option>').val(0).html("Carregando..."));

    $("#selectState").change(function () {
        var idState = this.value;
        $("#selectCity").empty();

        $('#selectCity').append($('<option></option>').val(0).html("Carregando..."));
        $('#selectCity').prop('disabled', true);
        $('#selectCity').prop('disabled', true);
        $('#selectCity').selectpicker('refresh');

        urlConsulta = base_url.url + "index.php/consult/getCityByState/" + idState;
        $.ajax({url: urlConsulta,
            success: function (result) {
                $("#selectCity").empty();
                $.each(JSON.parse(result), function (index, item) {
                    $('#selectCity').append($('<option></option>').val(index).html(item));
                });

                $('#selectCity').prop('disabled', false);
                $('#selectCity').prop('disabled', false);
                $('#selectCity').selectpicker('refresh');
            },
            error: function (error) {
                alert("Falha ao consultar cidade!");
            }
        });

    }); //  end selectEstado OnChange

}); // end document ready
