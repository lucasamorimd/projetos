<?php $render('header', $dados); ?>
<?php $render('sidebar', $dados); ?>
<?php $render('navbar'); ?>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <?php if ($dados['usuario']->id_usuario == $user_profile['perfil']['id_usuario']) : ?>
                    <?php $render('meu_perfil', $user_profile); ?>
                <?php endif; ?>

                <?php foreach ($user_profile['post'] as $post) : ?>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-category card-category-social">
                                        <i class="material-icons">update</i>
                                        <a href="<?= $base ?>/post/<?= $post['id_post'] ?>">
                                            <?= date('d/m/Y H:i', strtotime($post['data_criacao'])) ?>
                                        </a>
                                    </h5>
                                    <p class="card-content">
                                        <?= nl2br($post['body']) ?>
                                    </p>

                                    <div class="card-stats">
                                        <div class="author">
                                            <a href="<?= $base ?>/views/perfil.php?id=<?= $post['id_usuario'] ?>">
                                                <img src="<?= $base ?>/avatar/<?= $user_profile['perfil']['avatar'] ?>" rel="nofollow" alt="..." class="avatar img-raised">
                                                <span><?= $post['nome_user']; ?></span>
                                            </a>
                                        </div>
                                        <div class="stats ml-auto">
                                            <a class="btn btn-<?= ($post['liked']) ? 'danger' : 'default' ?> btn-fab btn-fab-mini btn-round" onclick="event.preventDefault();curtir({base:'<?= $base ?>',id:'<?= $post['id_post'] ?>',id_usuario:'<?= $post['id_user'] ?>'})" id="like<?= $post['id_post'] ?>" data-toggle="tooltip" data-placement="top" title="<?= ($post['liked']) ? 'Descurtir' : 'Curtir' ?>" href="#">
                                                <i id="icon<?= $post['id_post'] ?>" class="material-icons">
                                                    favorite
                                                </i>
                                            </a>

                                            <span id="likeCounts<?= $post['id_post'] ?>"><?= $post->likeCount; ?>&#xB7;</span>
                                            <a class="btn btn-primary btn-fab btn-fab-mini btn-round" data-toggle="tooltip" data-placement="top" title="Comentar" href="<?= $base ?>/views/post_details.php?post=<?= $post['id_post'] ?>">
                                                <i class="material-icons">
                                                    chat_bubble
                                                </i>
                                            </a>
                                            <span><?= $post->countComments; ?></span>
                                            <form id="teste<?= $post['id_post'] ?>">
                                                <input id="id_post<?= $post['id_post'] ?>" type="hidden" value="<?= $post['id_post'] ?>" name="id_post">
                                                <input type="hidden" value="<?= $post['id_user'] ?>" name="id_user_post">
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <?php $render('card', $dados); ?>
        </div>
    </div>
</div>
<?php $render('footer'); ?>