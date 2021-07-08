function dismiss(e) {
    var dados = JSON.stringify(e);
    $.ajax({
        url: e.base + '/controlls/notificacoes_dismiss.php',
        type: 'post',
        dataType: 'json',
        cache: false,
        processData: false,
        contentType: false,
        data: dados,
        success: function(resultado) {
            console.log(resultado);
        }
    });
}