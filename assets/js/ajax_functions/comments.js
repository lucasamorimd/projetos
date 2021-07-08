window.onpageshow = setInterval(ping, 50000);

function comentar(e) {
    var form = document.getElementById('form_details');
    var comments_body = document.getElementById('comments_body');
    var form = new FormData($('#form_details')[0])

    $.ajax({
        url: 'comments_ctrl.php',
        type: 'post',
        dataType: 'json',
        cache: false,
        processData: false,
        contentType: false,
        data: form,
        success: function(resultado) {

            var msgJson = JSON.stringify(resultado);
            console.log(resultado);
            conn.publish(room.value, msgJson);
        }

    })
}

conn = new ab.Session('wss://wschatoo.herokuapp.com/ws', function() {
        conn.subscribe(room.value, function(topic, data) {
            if (data != "@reconnect@") {

                var json = JSON.parse(data);
                showComment(json);
            }
        });
    },
    function() {
        console.warn('WebSocket connection closed');
    }, { 'skipSubprotocolCheck': true }
);

function showComment(e) {
    var conteudo = document.createTextNode(e.body);
    var data_comentario = document.createTextNode(e.data_criacao);
    var nome_comentador = document.createTextNode(e.nome_user);

    var span_data = document.createElement('span');
    span_data.appendChild(data_comentario);

    var divData = document.createElement('div');
    divData.classList.add('author');
    divData.appendChild(span_data);

    var divCardStats = document.createElement('div');
    divCardStats.classList.add('card-stats');
    divCardStats.appendChild(divData);

    var cardTitle = document.createElement('h4');
    cardTitle.classList.add('card-title');
    cardTitle.appendChild(conteudo);

    var cardCategoria = document.createElement('h5');
    cardCategoria.classList.add('card-category');
    cardCategoria.classList.add('card-category-social');
    cardCategoria.appendChild(nome_comentador);

    var cardBody = document.createElement('div');
    cardBody.classList.add('card-body');
    cardBody.appendChild(cardCategoria);
    cardBody.appendChild(cardTitle);
    cardBody.appendChild(divCardStats);

    var card = document.createElement('div');
    card.classList.add('card');
    card.appendChild(cardBody);

    var col = document.createElement('div');
    col.classList.add('col-md-12');
    col.appendChild(card);

    var row = document.createElement('div');
    row.classList.add('row');

    row.appendChild(col);
    comments_body.appendChild(row);

    window.scroll({ top: 1000000000, left: 0, behavior: 'smooth' });

}