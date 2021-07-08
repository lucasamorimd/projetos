//var conn = new WebSocket('ws://localhost:8085');

var form = document.getElementById('mensagem');
var conteudo = document.getElementById('conteudo');
var botao = document.getElementById('enviar');
var room = document.getElementById('room');
var chatBody = document.getElementById('chatBody');
var content = document.getElementById('content');
var id_usuario_logado = document.getElementById('id_user_logado').value;
var conn;

if (chatBody) {
    chatBody.scroll({ top: 1000000000, left: 0, behavior: 'smooth' });
    window.scroll({ top: 1000000000, left: 0, behavior: 'smooth' });
}
/*
form.addEventListener('keypress', function(e) {
    var fon = e.shiftKey;

    console.log(fon);
    if (e.key === "Enter" && fon != true) {
        e.preventDefault();
        botao.click();
        console.log(e.key);
        //e.target.value = "";
    }


});*/
if (form) {
    botao.addEventListener('click', function(e) {

        e.preventDefault();
        var mensagem = document.getElementById('conteudo').value;
        var id_chat = document.getElementById('user_to').value;
        if (mensagem && id_chat) {
            var form = new FormData($('#mensagem')[0])
            $.ajax({
                url: 'mensagens_ctrl.php',
                type: 'post',
                dataType: 'json',
                cache: false,
                processData: false,
                contentType: false,
                data: form,
                success: function(resultado) {

                    var msgJson = JSON.stringify(resultado);
                    conn.publish(resultado.user_to, msgJson);
                    showMessage_from(resultado);
                    conteudo.value = '';

                }
            })



        }

    })
}

//wschatoo.herokuapp.com/ws
if (room) {
    window.onpageshow = setInterval(ping, 50000);

    conn = new ab.Session('wss://wschatoo.herokuapp.com/ws', function() {
            conn.subscribe(room.value, function(topic, data) {
                if (data != "@reconnect@") {

                    var json = JSON.parse(data);

                    if (json.user_to != json.user_from) {
                        console.log(json.nome_to);
                        showMessage_to(json);
                        md.showNotification('top', 'right', json.nome_from + ': ' + json.conteudo, 1);

                    }
                }
            });
        },
        function() {
            console.warn('WebSocket connection closed');
        }, { 'skipSubprotocolCheck': true }
    );
}



function ping() {
    conn.publish(room.value, '@reconnect@');
}

function showMessage_from(data) {

    var conteudo = document.createTextNode(data.conteudo);
    var nome = document.createTextNode(data.nome_from);
    var data_mensagem = document.createTextNode(data.data_mensagem + ' ' + data.hora_mensagem);
    var hora_mensagem = document.createTextNode(data.hora_mensagem);
    //conteudo = conteudo.replace(/\n/g, "<br />");

    var divConteudo = document.createElement('p');
    divConteudo.classList.add('card-text');
    divConteudo.appendChild(conteudo);

    var divBody = document.createElement('div');
    divBody.classList.add('card-body');
    divBody.appendChild(divConteudo);

    var pData = document.createElement('p');
    pData.classList.add('card-category');
    pData.appendChild(data_mensagem);

    var divTitle = document.createElement('h4');
    divTitle.classList.add('card-title');
    divTitle.appendChild(nome);

    var divHeader = document.createElement('div');
    divHeader.classList.add('card-header');
    divHeader.classList.add('card-header-primary');
    divHeader.classList.add('text-left');
    divHeader.appendChild(divTitle);
    divHeader.appendChild(pData);


    var divBg = document.createElement('div');
    divBg.classList.add('card');
    divBg.classList.add('bg-dark');
    divBg.appendChild(divHeader);
    divBg.appendChild(divBody);


    var divCol = document.createElement('div');
    divCol.classList.add('col-md-6');
    divCol.appendChild(divBg);

    var divRow = document.createElement('div');
    divRow.classList.add('row');
    divRow.appendChild(divCol);
    chatBody.appendChild(divRow);

    chatBody.scroll({ top: 1000000000, left: 0, behavior: 'smooth' });
    window.scroll({ top: 1000000000, left: 0, behavior: 'smooth' });



}



function showMessage_to(data) {

    if (chatBody) {
        var conteudo = document.createTextNode(data.conteudo);
        var nome_to = document.createTextNode(data.nome_from);
        var data_mensagem = document.createTextNode(data.data_mensagem + ' ' + data.hora_mensagem);
        var hora_mensagem = document.createTextNode(data.hora_mensagem);

        var divConteudo = document.createElement('p');
        divConteudo.classList.add('card-text');
        divConteudo.appendChild(conteudo);

        var divBody = document.createElement('div');
        divBody.classList.add('card-body');
        divBody.appendChild(divConteudo);

        var pData = document.createElement('p');
        pData.classList.add('card-category');
        pData.appendChild(data_mensagem);

        var divTitle = document.createElement('h4');
        divTitle.classList.add('card-title');
        divTitle.appendChild(nome_to);

        var divHeader = document.createElement('div');
        divHeader.classList.add('card-header');
        divHeader.classList.add('card-header-danger');
        divHeader.classList.add('text-right');
        divHeader.appendChild(divTitle);
        divHeader.appendChild(pData);


        var divBg = document.createElement('div');
        divBg.classList.add('card');
        divBg.appendChild(divHeader);
        divBg.appendChild(divBody);


        var divCol = document.createElement('div');
        divCol.classList.add('col-md-6');
        divCol.appendChild(divBg);

        var divRow = document.createElement('div');
        divRow.classList.add('d-flex');
        divRow.classList.add('flex-row-reverse');
        divRow.appendChild(divCol);
        chatBody.appendChild(divRow);

        chatBody.scroll({ top: 1000000000, left: 0, behavior: 'smooth' });
        window.scroll({ top: 1000000000, left: 0, behavior: 'smooth' });

    }

}