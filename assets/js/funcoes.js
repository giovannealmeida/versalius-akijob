/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

var loadFile = function (event) {
    var output = document.getElementById('preview_image');
    output.src = URL.createObjectURL(event.target.files[0]);
};

$('#ButtonLoadMoreComments').on('click', function () {
    var $btn = $(this).button('loading');
    var x = $("#offset").val();
    $("#offset").val(x + 1);
    var idService = $("#id_service").val();
    urlConsulta = base_url.url + "index.php/consult/getComments/" + idService + "/" + x;
        $.ajax({url: urlConsulta,
            success: function (result) {
                if(result === "null"){
                    alert("Não existem mais comentários a serem exibidos.");
                }
                $.each(JSON.parse(result), function (i, comment) {
                    $('#comments').append("<div class=\"panel panel-default\">\
                                <div class=\"panel-heading\">" + comment.user_name + "</div>\
                                <div class=\"panel-body\">\
                                   " + comment.comment + " \
                                </div> \
                            </div>");
                });
            },
            error: function (error) {
                alert("Falha ao consultar Comentário!");
            }
        });
    $btn.button('reset');
});