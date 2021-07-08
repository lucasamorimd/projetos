<div class="card sticky-top">
    <div class="card-header card-header-primary">
        <div class="author">
            <a href="<?= $base ?>/views/perfil.php?id=<?= $post_details->id_usuario ?>">
                <img src="<?= $base ?>/media/avatar/<?= $post_details->avatar ?>" rel="nofollow" alt="..." class="avatar img-raised">
                <span><?= $post_details->nome; ?></span>
            </a>
        </div>
        <p class="card-category"><?= date('d/m/Y H:i', strtotime($post_details->data_criacao)) ?></p>
    </div>
    <div class="card-body">
        <h5 class="card-category card-category-social">
            <i class="material-icons">update</i> <?= date('d/m/Y H:i', strtotime($post_details->data_criacao)) ?>
        </h5>
        <h4 class="card-title">
            <?= nl2br($post_details->body) ?>
        </h4>

        <div class="card-stats">

            <div class="stats ml-auto">

                <a class="btn btn-<?= ($post_details->liked) ? 'danger' : 'default' ?> btn-fab btn-fab-mini btn-round" onclick="event.preventDefault();curtir({base:'<?= $base ?>',id:'<?= $post_details->id_posts ?>'})" id="like<?= $post_details->id_posts ?>" data-toggle="tooltip" data-placement="top" href="#">
                    <i class="material-icons">
                        favorite
                    </i>
                </a>

                <span id="likeCounts<?= $post_details->id_posts ?>"><?= $post_details->likeCount; ?> &#xB7;</span>

                <a class="btn btn-primary btn-fab btn-fab-mini btn-round" data-toggle="tooltip" data-placement="top" title="Comentar" class="card-link" href="<?= $base ?>/views/post_details.php?post=<?= $post_details->id_posts ?>">
                    <i class="material-icons">
                        chat_bubble
                    </i>
                </a>
                <span id="commentsCount<?= $post_details->id_posts ?>"><?= ($post_details->comments) ? count($post_details->comments) : 0; ?></span>

            </div>
        </div>
        <form id="form_details" method="POST">
            <div class="row">
                <div class="col-md-10">
                    <div class="form-group">
                        <label>&nbsp;</label>
                        <div class="form-group">
                            <label class="bmd-label-floating"> Escreva um comentário</label>
                            <textarea id="textArea" class="form-control" rows="1" name="body"></textarea>
                        </div>
                    </div>
                </div>
                <div class="col" style="padding-top: 6.1%;">
                    <button onclick="event.preventDefault();comentar({room:'<?= $chatRoom ?>',id:'<?= $post_details->id_posts ?>'});" type="button" class="btn btn-primary btn-fab btn-fab-mini btn-round"><i class="material-icons">send</i></button>
                </div>
            </div>
            <div class="clearfix"></div>
            <!-- INPUTS HIDDEN PARA PEGAR NO AJAX VIA POST -->
            <input type="hidden" value="<?= $post_details->id_posts ?>" name="id_post">
            <input type="hidden" value="<?= $chatRoom ?>" id="roomset">
        </form>
        <form id="teste<?= $post_details->id_posts ?>">
            <input id="id_post<?= $post_details->id_posts ?>" type="hidden" value="<?= $post_details->id_posts ?>" name="id_post">
        </form>
    </div>
</div>