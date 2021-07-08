<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-category card-category-social">
                    <i class="material-icons">update</i>
                    <a href="<?= $base ?>/views/post_details.php?post=<?= $item->id_posts ?>">
                        <?= date('d/m/Y H:i', strtotime($item->data_criacao)) ?>
                    </a>
                </h5>
                <p class="card-content">
                    <?= nl2br($item->body) ?>
                </p>

                <div class="card-stats">
                    <div class="author">
                        <a href="<?= $base ?>/views/perfil.php?id=<?= $item->id_usuario ?>">
                            <img src="<?= $base ?>/media/avatar/<?= $item->user->avatar ?>" rel="nofollow" alt="..." class="avatar img-raised">
                            <span><?= $item->user->nome; ?></span>
                        </a>
                    </div>
                    <div class="stats ml-auto">
                        <a class="btn btn-<?= ($item->liked) ? 'danger' : 'default' ?> btn-fab btn-fab-mini btn-round" onclick="event.preventDefault();curtir({base:'<?= $base ?>',id:'<?= $item->id_posts ?>'})" id="like<?= $item->id_posts ?>" data-toggle="tooltip" data-placement="top" title="<?= ($item->liked) ? 'Descurtir' : 'Curtir' ?>" href="#">
                            <i id="icon<?= $item->id_posts ?>" class="material-icons">
                                favorite
                            </i>
                        </a>

                        <span id="likeCounts<?= $item->id_posts ?>"><?= $item->likeCount; ?>&#xB7;</span>
                        <a class="btn btn-primary btn-fab btn-fab-mini btn-round" data-toggle="tooltip" data-placement="top" title="Comentar" href="<?= $base ?>/views/post_details.php?post=<?= $item->id_posts ?>">
                            <i class="material-icons">
                                chat_bubble
                            </i>
                        </a>
                        <span><?= $item->countComments; ?></span>
                        <form id="teste<?= $item->id_posts ?>">
                            <input id="id_post<?= $item->id_posts ?>" type="hidden" value="<?= $item->id_posts ?>" name="id_post">
                            <input type="hidden" value="<?= $item->id_usuario ?>" name="id_user_post">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>