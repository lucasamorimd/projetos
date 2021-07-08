<div class="row msg-from">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header card-header-primary text-left">
                <h4 class="card-title "><?= $chatInfo['user_from_nome']; ?></h4>
                <p class="card-category"><?= date('d/m/Y', strtotime($m->data_mensagem)) . ' ' . date('H:i', strtotime($m->hora_mensagem)) ?></p>
            </div>
            <div class="card-body">
                <p class="card-text"><?= nl2br($m->conteudo) ?></p>
            </div>
        </div>
    </div>
</div>