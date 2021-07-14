<?php $render('header'); ?>
<main id="main">
    <section class="breadcrumbs">
        <div class="container">

            <ol>
                <li><a href="<?= $base ?>">Home</a></li>
                <li>Agendamentos</li>
            </ol>
            <h2><?= ucfirst($tipo_atendimento); ?></h2>

        </div>
    </section>
    <section id="blog" class="blog">
        <div class="container" data-aos="fade-up">
            <div class="row justify-content-center">
                <div class="table-responsive">
                    <table class="table text-center align-middle caption-top">
                        <caption>Agentamentos de <?= $tipo_atendimento ?> realizados</caption>
                        <thead>
                            <tr>
                                <th scope="col">Paciente</th>
                                <th scope="col"><?= ucfirst($tipo_atendimento) ?></th>
                                <th scope="col">Unidade</th>
                                <th scope="col">Telefone da Unidade</th>
                                <th scope="col">Detalhar</th>


                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($dados_agendamentos as $agendamento) : ?>
                                <tr>
                                    <td><?= $agendamento['nome_paciente'] ?></td>
                                    <td><?= $agendamento['nome_atendimento'] ?></td>
                                    <td><?= $agendamento['nome_unidade'] ?></td>
                                    <td><?= $agendamento['telefone_unidade'] ?></td>
                                    <td><button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modal-<?= $tipo_atendimento . $agendamento['id_agendamento'] ?>"><i class="material-icons">search</i></button></td>
                                </tr>
                            <?php endforeach; ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</main>
<?php foreach ($dados_agendamentos as $modalAgendamento) : ?>

    <div class="modal fade" id="modal-<?= $tipo_atendimento . $modalAgendamento['id_agendamento'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Paciente <?= $modalAgendamento['nome_paciente'] ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card card-nav-tabs">
                        <h4 class="card-header card-header-info"><?= $modalAgendamento['nome_atendimento'] ?></h4>
                        <div class="card-body">
                            <h4 class="card-title">Exame</h4>
                            <p class="card-text"><?= $modalAgendamento['descricao_servico'] ?></p>
                            <div class="row">

                                <div class="col-md-6">
                                    <div class="table-responsive">
                                        <table class="table text-left">
                                            <thead class="table-dark">
                                                <tr>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <th scope="row">Unidade</th>
                                                    <td><?= $modalAgendamento['nome_unidade'] ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Endereco</th>
                                                    <td><?= $modalAgendamento['endereco_unidade'] ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Cidade</th>
                                                    <td><?= $modalAgendamento['cidade_unidade'] ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Data Marcada</th>
                                                    <td><?= date('d/m/Y', strtotime($modalAgendamento['data_atendimento'])) ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Horário Marcado</th>
                                                    <td><?= date('H:i', strtotime($modalAgendamento['hora_atendimento'])) ?> horas</td>
                                                </tr>
                                                <tr>
                                                    <th class="align-middle" scope="row">Médico</th>
                                                    <td>
                                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#detalha_medico<?= $modalAgendamento['id_agendamento'] ?>">
                                                            Detalhar
                                                        </button>
                                                    </td>
                                                </tr>
                                                <?php if ($modalAgendamento['id_prontuario']) : ?>
                                                    <tr>
                                                        <th class="align-middle" scope="row">Resultado</th>
                                                        <td>
                                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#detalha_prontuario<?= $modalAgendamento['id_prontuario'] ?>">
                                                                Detalhar
                                                            </button>
                                                        </td>
                                                    </tr>
                                                <?php endif; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-md-6 mx-auto" style="width: 200px;">
                                    <div class="card" style="width: 18rem;">
                                        <img src="<?= $base ?>/assets/img/team/<?= $modalAgendamento['foto_medico'] ?>" class="card-img-top" alt="...">
                                        <div class="card-body">
                                            <h5 class="card-title text-center"><?= $modalAgendamento['nome_medico'] ?></h5>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn get-started-btn" data-bs-dismiss="modal">Retornar</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="detalha_medico<?= $modalAgendamento['id_agendamento'] ?>" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content ">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalToggleLabel2">Dados do Médico</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?php $render('modal_medico', ['modalAgendamento' => $modalAgendamento]); ?>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger" data-bs-dismiss="modal">Retornar</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="detalha_prontuario<?= $modalAgendamento['id_prontuario'] ?>" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content ">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalToggleLabel2">Resumo do prontuario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?php $render('modal_prontuario', ['modalAgendamento' => $modalAgendamento, 'usuario' => $usuario_dados]); ?>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger" data-bs-dismiss="modal">Retornar</button>
                </div>
            </div>
        </div>
    </div>

<?php endforeach; ?>
<script src="<?= $base ?>/assets/js/functions.js"></script>
<?php $render('footer'); ?>
<?php $render('scripts'); ?>