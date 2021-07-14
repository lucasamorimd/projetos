<div class="row">
    <div class="col-md-6">
        <div class="card">
            <img class="card-img-top" src="<?= $base ?>/assets/img/team/<?= $modalAgendamento['foto_medico'] ?>" alt="...">
        </div>
    </div>
    <div class="col-md-6">
        <div class="table-responsive">
            <table class="table text-left">
                <tbody>
                    <tr>
                        <th scope="row">Nome</th>
                        <td><?= $modalAgendamento['nome_medico'] ?></td>
                    </tr>
                    <tr>
                        <th scope="row">CRM</th>
                        <td><?= $modalAgendamento['crm'] ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Área de atuação</th>
                        <td><?= $modalAgendamento['area_atuacao'] ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>