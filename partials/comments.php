<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-category card-category-social">
                    <?= $c->nome_user ?>
                </h5>
                <h4 class="card-title">
                    <?= nl2br($c->body) ?>
                </h4>
                <div class="card-stats">
                    <div class="author">
                        <span><?= date('d/m/Y H:i', strtotime($c->data_criacao)) ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>