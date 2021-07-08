<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th class="text-center">Id</th>
                <th class="text-center">Nome</th>
                <th class="text-center">Email</th>
                <th class="text-center">Apelido</th>
                <th class="text-center">Follow/Unfollow</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($userList as $u) : ?>
                <?php $is_following = $followsDaoMySql->existsFollow($userInfo->id_usuario, $u->id_usuario);

                ?>
                <tr>
                    <td class="text-center"><?= $u->id_usuario ?></td>
                    <td class="text-center"><a data-toggle="tooltip" data-placement="top" title="Ir ao Perfil" href="<?= $base ?>/views/perfil.php?id=<?= $u->id_usuario ?>"><?= $u->nome ?></a></td>
                    <td class="text-center"><?= $u->email ?></td>
                    <td class="text-center"><?= $u->apelido ?></td>
                    <?php if (isset($is_following) && $is_following != "me") : ?>
                        <td class="td-actions text-center">
                            <a id="botao_user<?= $u->id_usuario ?>" onclick="event.preventDefault(), follow(<?= $u->id_usuario ?>)" href="#" data-toggle="tooltip" data-placement="top" title="" rel="tooltip" class="btn btn-danger">
                                <i id="icon<?= $u->id_usuario ?>" class="material-icons">person_remove</i>
                            </a>
                        </td>
                    <?php elseif ($is_following === "me") : ?>
                        <td class="td-actions text-center">
                            <a id="botao_user<?= $u->id_usuario ?>" href="<?= $base ?>/views/perfil.php" rel="tooltip" data-toggle="tooltip" data-placement="top" title="Seu Perfil" class="btn btn-default">
                                <i class="material-icons">person_outline</i>
                            </a>
                        </td>
                    <?php else : ?>
                        <td class="td-actions text-center">
                            <a id="botao_user<?= $u->id_usuario ?>" onclick="event.preventDefault(), follow(<?= $u->id_usuario ?>)" href="#" data-toggle="tooltip" data-placement="top" rel="tooltip" title="" class="btn btn-info">
                                <i id="icon<?= $u->id_usuario ?>" class="material-icons">person_add</i>
                            </a>
                        </td>
                    <?php endif; ?>
                    <form id="form_follow_user_id<?= $u->id_usuario ?>">
                        <input value="<?= $u->id_usuario ?>" type="hidden" name="id_follow">
                    </form>
                <?php endforeach; ?>
                </tr>
        </tbody>
    </table>
</div>
<!-- FORM COM INPUTS HIDDEN -->