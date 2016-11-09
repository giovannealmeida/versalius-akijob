var options_city = {
    ajax: {
        url: 'http://localhost/akijob/consult/getCityByName/',
        type: 'POST',
        dataType: 'json',
        // Use "{{{q}}}" as a placeholder and Ajax Bootstrap Select will
        // automatically replace it with the value of the search query.
        data: {
            q: '{{{q}}}'
        }
    },
    locale: {
        emptyTitle: 'Cidade',
        currentlySelected: 'Selecionado',
        errorText: "Houve um erro na busca",
        searchPlaceholder: "Buscar cidades",
        statusInitialized: "Comece a escrever para fazer a busca",
        statusNoResults: "Sem resultados",
        statusSearching: "Buscando..."
    },
    log: 3,
    preprocessData: function(data) {
        var i, l = data.length,
            array = [];
        if (l) {
            for (i = 0; i < l; i++) {
                array.push($.extend(true, data[i], {
                    text: data[i].name, // Nome da cidade
                    value: data[i].id, // id da cidade
                    data: {
                        subtext: " - " + data[i].initials // estado
                    }
                }));
            }
        }
        // You must always return a valid array when processing data. The
        // data argument passed is a clone and cannot be modified directly.
        return array;
    }
};

var options_job = {
    ajax: {
        url: 'http://localhost/akijob/consult/getJobsByName/',
        type: 'POST',
        dataType: 'json',
        // Use "{{{q}}}" as a placeholder and Ajax Bootstrap Select will
        // automatically replace it with the value of the search query.
        data: {
            q: '{{{q}}}'
        }
    },
    locale: {
        emptyTitle: 'Serviços',
        currentlySelected: 'Selecionado',
        errorText: "Houve um erro na busca",
        searchPlaceholder: "Buscar serviços",
        statusInitialized: "Comece a escrever para fazer a busca",
        statusNoResults: "Sem resultados",
        statusSearching: "Buscando..."
    },
    log: 3,
    preprocessData: function(data) {
        var i, l = data.length,
            array = [];
        if (l) {
            for (i = 0; i < l; i++) {
                array.push($.extend(true, data[i], {
                    text: data[i].name, // Nome da cidade
                    value: data[i].id // id da cidade

                }));
            }
        }
        // You must always return a valid array when processing data. The
        // data argument passed is a clone and cannot be modified directly.
        return array;
    }
};

$('#selectCity').selectpicker().filter('.with-ajax').ajaxSelectPicker(options_city);
$('#selectCity').trigger('change');
$('#selectJob').selectpicker().filter('.with-ajax').ajaxSelectPicker(options_job);
$('#selectJob').trigger('change');
