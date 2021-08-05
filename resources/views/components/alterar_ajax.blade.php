<script>
    function alterar() {

        var form = new FormData($('#alterar')[0])
        var action = document.getElementById('alterar').action

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

            }
        }).done(function(response) {

            Swal.fire({
                type: response.bg_notificacao,
                title: response.titulo_notificacao,
                text: response.msg,
                footer: response.subtitulo_notificacao,
                showConfirmButton: true
            })
        })
        /*var form = document.getElementById('cadastrar_unidade')
        form.submit()*/
    }
</script>