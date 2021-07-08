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