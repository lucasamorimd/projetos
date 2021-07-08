//var conn = new WebSocket('ws://localhost:8085');
var span_not = document.getElementById('span_not');
var countNot = document.getElementById('countNot');
var conn;

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

//wschatoo.herokuapp.com/ws

conn = new ab.Session('wss://wschatoo.herokuapp.com/ws', function() {

        conn.subscribe(room.value, function(topic, data) {
            if (data != "@reconnect@") {

                var json = JSON.parse(data);
                switch (json.webSocket) {
                    case "Mensagem":
                        if (json.user_to != json.user_from) {
                            console.log(json.nome_to);
                            showMessage_to(json);
                            //md.showNotification('top', 'right', json.nome_from + ': ' + json.conteudo, 1);

                        }
                        break;
                    case "Like":
                        if (json.not.usuario_from != json.not.usuario_to) {
                            console.log(span_not.value);
                            showLikeNot(json);
                            countNot.classList.add('notification')
                            countNot.innerHTML = 1 + parseInt(span_not.value, 10);
                        }
                        break;

                }

            } else {
                console.log('websocket reconectado');
            }
        });
    },
    function() {
        console.warn('WebSocket connection closed');
    }, { 'skipSubprotocolCheck': true }
);
window.onpageshow = setInterval(ping, 50000);

function ping() {
    conn.publish(room.value, '@reconnect@')
}