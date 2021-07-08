//window.onpageshow = setInterval(ping, 50000);
var roomset = document.getElementById('roomset');


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

            textArea.value = "";
            var msgJson = JSON.stringify(resultado);
            conn.publish(e.room, msgJson);
        }

    })


}


function showComment(e) {
    var countComments = document.getElementById('commentsCount' + e.id_post);
    var conteudo = document.createTextNode(e.body);
    var data_comentario = document.createTextNode(e.data_criacao);
    var nome_comentador = document.createTextNode(e.nome_user);

    countComments.innerHTML = e.countComments;

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
    setTimeout(() => row.style.animation = "active-teste 0.4s linear", 20);
    comments_body.appendChild(row);

    window.scroll({ top: 1000000000, left: 0, behavior: 'smooth' });

}