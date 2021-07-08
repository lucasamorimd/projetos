//window.onpageshow = setInterval(ping, 50000);
var roomset = document.getElementById('roomset');
room.value = roomset.value;

function comentar(e) {
    var form = document.getElementById('form_details');
    var comments_body = document.getElementById('comments_body');
    var form = new FormData($('#form_details')[0])
    var textArea = document.getElementById('textArea');
    $.ajax({
        url: '../controlls/comments_ctrl.php',
        type: 'post',
        dataType: 'json',
        cache: false,
        processData: false,
        contentType: false,
        data: form,
        success: function(resultado) {
            console.log(e);
            textArea.value = "";
            var msgJson = JSON.stringify(resultado);
            conn.publish(e.room, msgJson);
        }

    })


}