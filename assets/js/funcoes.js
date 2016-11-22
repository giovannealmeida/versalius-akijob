/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

var loadFile = function (event) {
    var output = document.getElementById('preview_image');
    output.src = URL.createObjectURL(event.target.files[0]);
    $('#avatar').val(($('#preview_image')[0].src));
};

var offset = 1;//Variável auxiliar utilizada para gerar os comentários dinâmicos de 5 em 5
$('#ButtonLoadMoreComments').on('click', function () {
    var $btn = $(this).button('loading');
    var x = offset;
    offset++;
    var idService = $("#id_service").val();
    urlConsulta = base_url.url + "index.php/consult/getComments/" + idService + "/" + x;
    $.ajax({url: urlConsulta,
        success: function (result) {
            if (result === "null") {
                alert("Não existem mais comentários a serem exibidos.");
            }
            $.each(JSON.parse(result), function (i, data) {
                $('#comments').append("<div class=\"panel panel-default\">\
                                <div class=\"panel-heading\">" + data.user_name + "</div>\
                                <div class=\"panel-body\">\
                                <div class=\"row\">\
                                        <div class=\"col-xs-12 col-sm-2 col-md-2 col-lg-1\">\
                                            <img class=\"img-circle img-responsive center-block profile-photo\" src=" + data.avatar + " alt=\"\" >\
                                        </div>\
                                        <div class=\"col-xs-12 col-sm-10 col-md-10 col-lg-11\">\
                                            <p><small class=\"address\"> </span> Postado" + data.current_date + "</small></p>\
                                            <p class=\"text-justify\">" + data.comment + "</p> \
                                        </div>\
                                    </div>\
                                </div>\
                            </div>");
            });
        },
        error: function (error) {
            alert("Falha ao consultar Comentário!");
        }
    });
    $btn.button('reset');
});