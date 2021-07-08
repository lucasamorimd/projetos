var room = document.getElementById('room');
var dropdown_not = document.getElementById('dropdown-not');

function curtir(em) {

    var like = document.getElementById('like' + em.id);
    var likeCount = document.getElementById('likeCounts' + em.id);

    $.ajax({
        url: em.base + '/controlls/like_ctrl.php',
        type: 'post',
        dataType: 'json',
        cache: false,
        processData: false,
        contentType: false,
        data: JSON.stringify(em),
        success: function(e) {
            console.log(e);
            var contagem = e.countLikes;
            likeCount.innerHTML = contagem + "&#xB7;";
            if (e.resultado == "disliked") {
                $(like).attr("data-original-title", "Curtir");
                like.classList.remove('btn-danger');
                like.classList.add('btn-default');
                md.showNotification('top', 'right', 'Removido', e.cor);
                $(like).tooltip('hide');
                var not = JSON.stringify(e);
                conn.publish(e.post.id_usuario, not);
            } else {
                e.id_post = parseInt(em.id, 10);
                $(like).attr("data-original-title", "Remover");
                like.classList.remove('btn-default');
                like.classList.add('btn-danger');
                md.showNotification('top', 'right', 'Curtido', e.cor);
                $(like).tooltip('hide');
                var not = JSON.stringify(e);
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