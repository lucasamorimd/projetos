function follow(e) {
    var botao = document.getElementById('botao_user' + e);
    var icon = document.getElementById('icon' + e);
    //var follow_id = document.getElementById('follow_user');
    var form = new FormData($('#form_follow_user_id' + e)[0]);
    var countFollowings = document.getElementById('countFollowings');
    $.ajax({
        url: '../controlls/follow_ctrl.php',
        type: 'post',
        dataType: 'json',
        cache: false,
        processData: false,
        contentType: false,
        data: form,
        success: function(e) {
            if (e.resultado == "follow") {
                botao.classList.remove('btn-info');
                botao.classList.add('btn-danger');
                icon.innerHTML = "person_remove";
                countFollowings.innerHTML = "Seguindo " + e.countFollowings;
                $(botao).attr("data-original-title", "Deixar de Seguir");
                md.showNotification('top', 'right', e.aviso, e.cor);
                var not = JSON.stringify(e);
                conn.publish(e.not.usuario_to, not);

            } else {
                botao.classList.remove('btn-danger');
                botao.classList.add('btn-info');
                icon.innerHTML = "person_add";
                countFollowings.innerHTML = "Seguindo " + e.countFollowings;
                $(botao).attr("data-original-title", "Seguir");
                md.showNotification('top', 'right', e.aviso, e.cor);
                var not = JSON.stringify(e);
                conn.publish(e.id_unfollowed, not);
            }



        }
    })
}

function followPerfil(e) {
    var botao = document.getElementById('botao_perfil');
    var form = new FormData($('#form_follow_user_id')[0]);
    var countFollowings = document.getElementById('countFollowings');
    $.ajax({
        url: '../controlls/follow_ctrl.php',
        type: 'post',
        dataType: 'json',
        cache: false,
        processData: false,
        contentType: false,
        data: form,
        success: function(e) {
            if (e.resultado == "follow") {
                botao.classList.remove('btn-primary');
                botao.classList.add('btn-default');
                botao.innerHTML = "Following";
                countFollowings.innerHTML = "Seguindo " + e.countFollowings;
                md.showNotification('top', 'right', e.aviso, e.cor);
                var not = JSON.stringify(e);
                conn.publish(e.not.usuario_to, not);

            } else {
                botao.classList.remove('btn-default');
                botao.classList.add('btn-primary');
                botao.innerHTML = "Follow";
                countFollowings.innerHTML = "Seguindo " + e.countFollowings;
                md.showNotification('top', 'right', e.aviso, e.cor);
                var not = JSON.stringify(e);
                conn.publish(e.id_unfollowed, not);
            }



        }
    })
}