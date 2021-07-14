<section id="exames" class="services section-bg ">
    <div class="container" data-aos="fade-up">

        <div class="section-title">
            <h2>Exames</h2>
            <p>Aqui será colocado todos os exames que a clínica faz</p>
        </div>
        <?php foreach ($lista_exames as $exame) : ?>
            <div class="row">
                <div class="col-md-6">
                    <div class="icon-box" data-aos="fade-up" data-aos-delay="100">
                        <i class="bi bi-briefcase"></i>
                        <h4><a href="#"><?= $exame['nome_exame'] ?></a></h4>
                        <p><?= $exame['descricao_exame'] ?></p>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>
<section id="consultas" class="services section-bg ">
    <div class="container" data-aos="fade-up">

        <div class="section-title">
            <h2>Consultas</h2>
            <p>Aqui será colocado todas as consultas que a clínica faz</p>
        </div>
        <?php foreach ($lista_consultas as $consulta) : ?>
            <div class="row">
                <div class="col-md-6">
                    <div class="icon-box" data-aos="fade-up" data-aos-delay="100">
                        <i class="bi bi-briefcase"></i>
                        <h4><a href="#"><?= $consulta['tipo_consulta']; ?></a></h4>
                        <p><?= $consulta['descricao_consulta'] ?></p>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>
<section id="procedimentos" class="services section-bg ">
    <div class="container" data-aos="fade-up">

        <div class="section-title">
            <h2>Procedimentos</h2>
            <p>Aqui será colocado todos os procedimentos que a clínica realiza</p>
        </div>
        <?php foreach ($lista_procedimentos as $procedimento) : ?>
            <div class="row">
                <div class="col-md-6">
                    <div class="icon-box" data-aos="fade-up" data-aos-delay="100">
                        <i class="bi bi-briefcase"></i>
                        <h4><a href="#"><?= $procedimento['nome_procedimento'] ?></a></h4>
                        <p><?= $procedimento['descricao_procedimento'] ?></p>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>