<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-category card-category-social">
                    <i class="material-icons">update</i><a href="<?= $base ?>/post_details.php?post=<?= $item->id_posts ?>"> <?= date('d/m/Y H:i', strtotime($item->data_criacao)) ?></a>
                </h5>
                <h4 class="card-title">
                    <?= nl2br($item->body) ?>
                </h4>

                <div class="card-stats">
                    <div class="author">
                        <a href="<?= $base ?>/perfil.php?id=<?= $item->id_usuario ?>">
                            <img src="<?= $base ?>/media/avatar/<?= $item->user->avatar ?>" rel="nofollow" alt="..." class="avatar img-raised">
                            <span><?= $item->user->nome; ?></span>
                        </a>
                    </div>
                    <div class="stats ml-auto">
                        <i class="material-icons">
                            <a onclick="event.preventDefault();curtir(<?= $item->id_posts ?>)" id="like<?= $item->id_posts ?>" data-toggle="tooltip" data-placement="top" title="<?= ($item->liked) ? 'Descurtir' : 'Curtir' ?>" href="#">
                                favorite
                            </a>
                        </i>
                        <span id="likeCounts<?= $item->id_posts ?>"><?= $item->likeCount; ?>&#xB7;</span>
                        <i class="material-icons">
                            <a data-toggle="tooltip" data-placement="top" title="Comentar" class="card-link" href="<?= $base ?>/post_details.php?post=<?= $item->id_posts ?>">
                                chat_bubble
                            </a>
                        </i>
                        <?= $item->countComments; ?>
                        <form id="teste<?= $item->id_posts ?>">
                            <input id="id_post<?= $item->id_posts ?>" type="hidden" value="<?= $item->id_posts ?>" name="id_post">

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>