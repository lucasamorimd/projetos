<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th class="text-center">Conversar</th>
                <th class="text-center">Nome</th>
                <th class="text-center">Apelido</th>

            </tr>
        </thead>
        <tbody>
            <?php foreach ($userList as $u) : ?>
                <?php $is_following = $followsDaoMySql->existsFollow($userInfo->id_usuario, $u->id_usuario); ?>
                <?php if (isset($is_following)) : ?>
                    <tr>
                        <?php if ($is_following != "me") : ?>
                            <td class="td-actions text-center">
                                <a href="<?= $base ?>/controlls/chat_ctrl.php?id=<?= $u->id_usuario ?>&&nome_to=<?= $u->nome ?>" data-toggle="tooltip" data-placement="top" title="Continuar Conversa" class="btn btn-info">
                                    <i class="material-icons">message</i>
                                </a>
                            </td>
                        <?php elseif ($is_following === "me") : ?>
                            <td class="td-actions text-center">
                                <a href="<?= $base ?>/controlls/chat_ctrl.php?id=<?= $u->id_usuario ?>&&nome_to=<?= $u->nome ?>" rel="tooltip" data-toggle="tooltip" data-placement="top" title="Ir ao seu Perfil" class="btn btn-default">
                                    <i class="material-icons">person_outline</i>
                                </a>
                            </td>
                        <?php else : ?>
                            <td class="td-actions text-center">
                                <a href="<?= $base ?>/controlls/follow_ctrl.php?id=<?= $u->id_usuario ?>&&dir=<?= $dir1 ?>" data-toggle="tooltip" data-placement="top" title="Seguir Usuário" rel="tooltip" class="btn btn-info">
                                    <i class="material-icons">person_add</i>
                                </a>
                            </td>
                        <?php endif; ?>
                        <td class="text-center"><a data-toggle="tooltip" data-placement="top" title="Ir ao Perfil" href="<?= $base ?>/views/perfil.php?id=<?= $u->id_usuario ?>"><?= $u->nome ?></a></td>
                        <td class="text-center"><?= $u->apelido ?></td>
                    <?php endif; ?>
                <?php endforeach; ?>
                    </tr>
        </tbody>
    </table>
</div>