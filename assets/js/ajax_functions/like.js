var room = document.getElementById('room');
var dropdown_not = document.getElementById('dropdown-not');

function curtir(em) {
    var id_post = document.getElementById('id_post' + em.id);
    var like = document.getElementById('like' + em.id);
    var likeCount = document.getElementById('likeCounts' + em.id);
    var icon = document.getElementById('icon' + em.id)
    var form = new FormData($('#teste' + em.id)[0])
    $.ajax({
        url: em.base + '/controlls/like_ctrl.php',
        type: 'post',
        dataType: 'json',
        cache: false,
        processData: false,
        contentType: false,
        data: form,
        success: function(e) {

            var contagem = e.countLikes;
            likeCount.innerHTML = contagem + "&#xB7;";
            if (e.resultado == "disliked") {
                $(like).attr("data-original-title", "Curtir");
                like.classList.remove('btn-danger');
                like.classList.add('btn-default');
                md.showNotification('top', 'right', 'Removido', e.cor);
                $(like).tooltip('hide');
            } else {
                $(like).attr("data-original-title", "Remover");
                like.classList.remove('btn-default');
                like.classList.add('btn-danger');
                md.showNotification('top', 'right', 'Curtido', e.cor);
                $(like).tooltip('hide');
                var not = JSON.stringify(e);
                console.log(not);
                conn.publish(e.not.usuario_to, not);
            }
        }

    })
}

function likes(e) {
    var contagem = e.countLikes;
    likeCount.innerHTML = contagem + "&#xB7;";
    if (e.resultado == "disliked") {
        $(like).attr("data-original-title", "Curtir");
        md.showNotification('top', 'right', 'Removido', e.cor);
        $(like).tooltip('hide');
    } else {
        $(like).attr("data-original-title", "Remover");
        md.showNotification('top', 'right', 'Curtido', e.cor);
        $(like).tooltip('hide');
    }


}

function showLikeNot(data) {
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

    md.showNotification('top', 'right', '<a class="alert-link" href="' + data.base + data.not.url + '">' + data.not.conteudo + '</a>', 1);
}