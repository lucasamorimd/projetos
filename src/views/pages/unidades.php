<?php $render('header'); ?>
<main id="main">
    <section class="breadcrumbs">
        <div class="container">
            <ol>
                <li><a href="<?= $base ?>">Home</a></li>
                <li>Unidades</li>
            </ol>
            <h2>Selecionar Unidade </h2>

        </div>
    </section>
    <section id="exames" class="services section-bg ">
        <div class="container" data-aos="fade-up">

            <div class="section-title">
                <h2>Unidade</h2>
                <p>Escolha uma de nossas unidades</p>
            </div>
            <div class="row">
                <?php foreach ($lista_unidades as $unidade) : ?>
                    <div class="col-md-6">
                        <div class="icon-box" data-aos="fade-up" data-aos-delay="100">
                            <i class="bi bi-file-medical"></i>
                            <h4><a href="<?= $base ?>/unidades/<?= $unidade['id_unidade'] ?>/<?= $nome_servico ?>"><?= $unidade['nome_unidade'] ?></a></h4>
                            <p>Endereço:</p>
                            <p><?= $unidade['endereco_unidade'] ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
</main>
<?php $render('footer'); ?>
<?php $render('scripts'); ?>