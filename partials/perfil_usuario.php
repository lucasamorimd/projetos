<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title">Perfil do Usuário</h4>
                <p class="card-category"></p>
            </div>
            <div class="card-body">
                <form action="follow_ctrl.php">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="bmd-label-floating">Nome Completo</label>
                                <input type="text" readonly class="form-control" value="<?= $userIdInfo->nome ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="bmd-label-floating">Apelido</label>
                                <input type="text" readonly class="form-control" value="<?= ($userIdInfo->apelido) ? $userIdInfo->apelido : 'Nenhum' ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="bmd-label-floating">Email</label>
                                <input type="email" value="<?= $userIdInfo->email ?>" class="form-control" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Descrição</label>
                                <div class="form-group">
                                    <label class="bmd-label-floating"></label>
                                    <textarea class="form-control" rows="6" name="descricao" readonly><?= $userIdInfo->descricao; ?></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </form>
            </div>
        </div>
        <?php foreach ($postsPerfil as $item) : ?>
            <?php
            require 'posts.php';
            ?>
        <?php endforeach; ?>
    </div>
    <div class="col-md-4">
        <div class="card card-profile">
            <div class="card-avatar">
                <a href="javascript:;">
                    <img class="img" src="<?= $base ?>/media/avatar/<?= $userIdInfo->avatar ?>" />
                </a>
            </div>
            <div class="card-body">
                <h6 class="card-category text-gray">Criar Categoria</h6>
                <h4 class="card-title"><?= $userIdInfo->nome; ?></h4>
                <p class="card-description">
                    <?= $userIdInfo->descricao ?>
                </p>
                <a id="botao_perfil" onclick="event.preventDefault(); followPerfil(<?= $userIdInfo->id_usuario ?>)" href="#" class="btn btn-<?= ($following) ? 'default' : 'primary' ?> btn-round"><?= ($following) ? 'following' : 'follow' ?></a>
            </div>
        </div>
    </div>
</div>
<form id="form_follow_user_id">
    <input value="<?= $userIdInfo->id_usuario ?>" type="hidden" name="id_follow">
</form>