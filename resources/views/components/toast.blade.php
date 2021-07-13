<script>
    $(document).Toasts('create', {
        class: '{{session("aviso")["bg_notificacao"]}}',
        title: '{{session("aviso")["titulo_notificacao"]}} ',
        subtitle: ' - {{session("aviso")["subtitulo_notificacao"]}} ',
        body: '{{session("aviso")["msg"]}}',
        autohide: true,
        delay: 5000,
        fixed: false,
        position: 'topLeft'
    })
</script>