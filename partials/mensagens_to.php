<div class="d-flex msg-to flex-row-reverse">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header card-header-danger text-right">
                <h4 class="card-title "><?= $chatInfo['user_to_nome']; ?></h4>
                <p class="card-category"><?= date('d/m/Y', strtotime($m->data_mensagem)) . ' ' . date('H:i', strtotime($m->hora_mensagem)) ?></p>
            </div>
            <div class="card-body">
                <p class="card-text"><?= nl2br($m->conteudo) ?></p>
            </div>
        </div>
    </div>
</div>