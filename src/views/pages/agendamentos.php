<?php /* echo "<pre>";
print_r($dados_agendamentos);
die();*/
?>
<?php $render('header'); ?>
<?php if ($_SESSION['swal']) : ?>
    <?php $render('swallnot'); ?>
<?php
    $_SESSION['type'] = null;
    $_SESSION['swal'] = null;
endif; ?>
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
                        <caption>Agentamentos de <?= $tipo_atendimento ?> <?= $situacao . 's' ?></caption>
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
                                    <td><a class="btn btn-danger btn-sm" href="<?= $base ?>/<?= $tipo_atendimento ?>/<?= $situacao ?>/<?= $agendamento['id_agendamento'] ?>"><i class="material-icons">search</i></button></td>
                                </tr>
                            <?php endforeach; ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</main>
<script src="<?= $base ?>/assets/js/confirm_functions.js"></script>
<?php $render('footer'); ?>
<?php $render('scripts'); ?>