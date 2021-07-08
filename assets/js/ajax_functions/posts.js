function post() {
    var form = new FormData($('#form_post')[0])
    var textArea = document.getElementById('textArea');
    $.ajax({
        url: 'controlls/post_ctrl.php',
        type: 'post',
        dataType: 'json',
        cache: false,
        processData: false,
        contentType: false,
        data: form,
        success: function(resultado) {
            showPost(resultado);
            textArea.value = "";
        }

    })
}

function showPost(e) {
    var curtir_data = { base: e.base, id: e.id_posts }
    var post_create = document.getElementById('post_create');

    var span_comment = document.createElement('span');
    span_comment.innerHTML = 0;

    var i_comment = document.createElement('i');
    i_comment.classList.add('material-icons');
    i_comment.innerHTML = "chat_bubble";

    var a_comment = document.createElement('a');
    a_comment.classList.add('btn');
    a_comment.classList.add('btn-primary');
    a_comment.classList.add('btn-fab');
    a_comment.classList.add('btn-fab-mini');
    a_comment.classList.add('btn-round');
    a_comment.setAttribute("data-toggle", "tooltip");
    a_comment.setAttribute("data-placement", "top");
    a_comment.setAttribute("data-original-title", "Comentar");
    a_comment.setAttribute("id", "likeCounts" + e.id_posts);
    a_comment.setAttribute("href", e.base + "/views/post_details.php?post=" + e.id_posts);
    a_comment.appendChild(i_comment);

    var span_like = document.createElement('span');
    $(span_like).attr("id", "likeCounts" + e.id_posts);
    span_like.innerHTML = 0 + "&#xB7;";

    var i_like = document.createElement('i');
    i_like.classList.add('material-icons');
    $(i_like).attr("id", "icon" + e.id_posts);
    i_like.innerHTML = "favorite";

    var a_like = document.createElement('a');
    a_like.classList.add('btn');
    a_like.classList.add('btn-default');
    a_like.classList.add('btn-fab');
    a_like.classList.add('btn-fab-mini');
    a_like.classList.add('btn-round');
    $(a_like).attr("data-toggle", "tooltip");
    $(a_like).attr("data-placement", "top");
    $(a_like).attr("data-original-title", "Curtir");
    $(a_like).attr("href", '#')
    $(a_like).attr("id", "like" + e.id_posts)
    $(a_like).attr('onclick', "curtir({base: 'http://localhost/socialMVC_wsTeste/rede_social'" + ", id:" + curtir_data.id + "})")
    a_like.appendChild(i_like);

    var stats_auto = document.createElement('div');
    stats_auto.classList.add('stats');
    stats_auto.classList.add('ml-auto');
    stats_auto.appendChild(a_like);
    stats_auto.appendChild(span_like);
    stats_auto.appendChild(a_comment);
    stats_auto.appendChild(span_comment);

    var span_nome = document.createElement('span');
    span_nome.innerHTML = e.nome;

    var img_avatar = document.createElement('img');
    img_avatar.classList.add('avatar');
    img_avatar.classList.add('img-raised');
    img_avatar.setAttribute('alt', '...');
    img_avatar.setAttribute('rel', 'nofollow');
    img_avatar.setAttribute('src', e.base + '/media/avatar/' + e.avatar);

    var a_avatar = document.createElement('a');
    a_avatar.setAttribute('href', e.base + 'views/perfil.php?id=' + e.id_usuario);
    a_avatar.appendChild(img_avatar);
    a_avatar.appendChild(span_nome);

    var author = document.createElement('div');
    author.classList.add('author');
    author.appendChild(a_avatar);

    var card_stats = document.createElement('div');
    card_stats.classList.add('card-stats');
    card_stats.appendChild(author);
    card_stats.appendChild(stats_auto);

    var card_content = document.createElement('p');
    card_content.classList.add('card-content');
    card_content.innerHTML = e.body;

    var i_data = document.createElement('i');
    i_data.classList.add('material-icons');
    i_data.innerHTML = "update";

    var a_data = document.createElement('a');
    a_data.setAttribute('href', e.base + "/views/post_details.php?post=" + e.id_posts);
    a_data.innerHTML = e.data_criacao;

    var card_category = document.createElement('h5')
    card_category.classList.add('card-category');
    card_category.classList.add('card-category-social');
    card_category.appendChild(i_data);
    card_category.appendChild(a_data);


    var card_body = document.createElement('div');
    card_body.classList.add('card-body');
    card_body.appendChild(card_category);
    card_body.appendChild(card_content);
    card_body.appendChild(card_stats);

    var card = document.createElement('div');
    card.classList.add('card');
    card.appendChild(card_body);

    var col = document.createElement('div');
    col.classList.add('col-md-12');
    col.appendChild(card);

    var row = document.createElement('div');
    row.classList.add('row');
    row.appendChild(col);
    setTimeout(() => row.style.animation = "active-teste 0.4s linear", 20);
    var input = document.createElement('input');
    $(input).attr("id", "id_post" + e.id_posts);
    $(input).attr("type", "hidden");
    $(input).attr("value", e.id_posts);
    $(input).attr("name", "id_post");

    var form = document.createElement('form');
    $(form).attr("id", "teste" + e.id_posts);
    form.appendChild(input);
    post_create.prepend(row);
    post_create.appendChild(form);

}