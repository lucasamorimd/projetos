//var conn = new WebSocket('ws://localhost:8085');
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
                            showMessage_to(json);
                            //md.showNotification('top', 'right', json.nome_from + ': ' + json.conteudo, 1);

                        }

                        break;

                    case "Like":

                        if (json.not.usuario_from != json.not.usuario_to) {
                            console.log(json);
                            json.cor = 5;
                            var likeCount = document.getElementById('likeCounts' + json.id_post);
                            likeCount.innerHTML = json.countLikes + "&#xB7;";
                            showNot(json);
                            alteraContagem(json.countNot);

                        }

                        break;

                    case "Dislike":

                        console.log(json.post.likeCount);
                        var likeCount = document.getElementById('likeCounts' + json.post.id_posts);
                        likeCount.innerHTML = json.post.likeCount + "&#xB7;";

                        break;

                    case "Follow":

                        if (json.not.usuario_from != json.not.usuario_to) {
                            json.cor = 6;
                            showNot(json);
                            alteraContagem(json.countNot);
                            var countFollowers = document.getElementById('countFollowers');
                            countFollowers.innerHTML = "Seguidores " + json.countFollowers;
                        }

                        break;
                    case "Unfollow":
                        var countFollowers = document.getElementById('countFollowers');
                        countFollowers.innerHTML = "Seguidores " + json.countFollowers;
                        break;

                    case "Comments":

                        showComment(json);

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

function alteraContagem(e) {
    countNot.innerHTML = e;
    countNot.classList.add('notification');
}

function showNot(data) {
    var span_titulo = document.createElement('span');
    span_titulo.innerHTML = data.not.titulo;

    var img = document.createElement('img');
    img.classList.add('avatar');
    img.classList.add('img-raised');
    $(img).attr('src', data.base + '/media/avatar/' + data.not.avatar);
    $(img).attr('rel', 'nofollow');
    $(img).attr('alt', '...');

    var card_author = document.createElement('div');
    card_author.classList.add('author');
    card_author.appendChild(img);
    card_author.appendChild(span_titulo);

    var card_stats = document.createElement('div');
    card_stats.classList.add('card-stats');
    card_stats.appendChild(card_author);

    var h5_titulo = document.createElement('h5');
    h5_titulo.classList.add('card-title');
    h5_titulo.innerHTML = data.not.conteudo;

    var body = document.createElement('div');
    body.classList.add('card-body');
    body.appendChild(h5_titulo);
    body.appendChild(card_stats);

    var card = document.createElement('div');
    card.classList.add('card');
    card.appendChild(body);

    var dropdown_item = document.createElement('a');
    dropdown_item.classList.add('dropdown-item');
    $(dropdown_item).attr('href', data.base + data.not.url);
    $(dropdown_item).attr('onclick', "dismiss({base:'" + data.base + "',id:" + data.not.id_notificacao + "})");
    dropdown_item.appendChild(card);

    dropdown_not.prepend(dropdown_item);

    md.showNotification('top', 'right', '<a class="alert-link" href="' + data.base + data.not.url + '">' + data.not.conteudo + '</a>', data.cor);
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