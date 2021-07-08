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
            <?php if (isset($chatList)) : ?>
                <?php foreach ($chatList as $u) : ?>
                    <tr>
                        <td class="td-actions text-center">
                            <a href="<?= $base ?>/controlls/chat_ctrl.php?id=<?= $u->user_to ?>&&nome_to=<?= $u->user_to_nome ?>" data-toggle="tooltip" data-placement="top" title="Voltar a Conversa" class="btn btn-info">
                                <i class="material-icons">message</i>
                            </a>
                        </td>
                        <td class="text-center"><a data-toggle="tooltip" data-placement="top" title="Ir ao Perfil" href="<?= $base ?>/views/perfil.php?id=<?= $u->user_to ?>"><?= $u->user_to_nome ?></a></td>
                        <td class="text-center"><?= $u->userChat_to->apelido ?></td>

                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>