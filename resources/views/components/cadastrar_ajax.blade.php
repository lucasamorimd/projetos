<script>
    function cadastrar() {

        var form = new FormData($('#cadastrar')[0])
        var action = document.getElementById('cadastrar').action

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "post",
            url: action,
            data: form,
            dataType: 'json',
            processData: false,
            contentType: false,
            success: function(resultado) {
                Swal.fire({
                    position: 'top-end',
                    type: resultado.bg_notificacao,
                    title: resultado.titulo_notificacao,
                    text: resultado.msg,
                    footer: resultado.subtitulo_notificacao,
                    showConfirmButton: false,
                    timer: 2500
                }).then((result) => {
                    window.location.href = resultado.route
                })
            },
            error: function(msg) {
                $(".print-error-msg").find("ul").html('');
                $(".print-error-msg").css('display', 'block');

                if (msg.responseJSON.errors.senha) {

                    if (Object.keys(msg.responseJSON.errors.senha).length > 1) {
                        $(".print-error-msg").find("ul").append('<li>' + 'Senha: ' + ' ' + msg.responseJSON.errors.senha[0] + '</li>');
                        $(".print-error-msg").find("ul").append('<li>' + 'Senha: ' + ' ' + msg.responseJSON.errors.senha[1] + '</li>');
                    }
                    if (Object.keys(msg.responseJSON.errors.senha).length == 1) {
                        $(".print-error-msg").find("ul").append('<li>' + 'Senha: ' + ' ' + msg.responseJSON.errors.senha + '</li>');
                    }

                }
                $.each(msg.responseJSON.errors, function(key, value) {
                    if (key != 'senha') {
                        $(".print-error-msg").find("ul").append('<li>' + value + '</li>');
                    }
                });
            }
        })
        /*var form = document.getElementById('cadastrar_unidade')
        form.submit()*/
    }
</script>