function curtir(em) {
    var id_post = document.getElementById('id_post' + em);
    var like = document.getElementById('like' + em);
    var likeCount = document.getElementById('likeCounts' + em);
    console.log(likeCount);
    var form = new FormData($('#teste' + em)[0])
    $.ajax({
        url: 'like_ctrl.php',
        type: 'post',
        dataType: 'json',
        cache: false,
        processData: false,
        contentType: false,
        data: form,
        success: function(e) {
            console.log(e);
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

    })
}

function likes(e) {
    console.log(like);
    console.log(e.countLikes);
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