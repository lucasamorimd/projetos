<section id="team" class="team section-bg">
    <div class="container" data-aos="fade-up">

        <div class="section-title">
            <h2>Médicos</h2>
            <p>Um texto sobre os médicos que atendem na clínica.</p>
        </div>

        <div class="row">
            <?php foreach ($medicos as $medico) : ?>
                <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
                    <div class="member" data-aos="fade-up" data-aos-delay="100">
                        <div class="member-img">
                            <img src="<?= $base ?>/assets/img/team/<?= $medico['foto_medico'] ?>" class="img-fluid" alt="">
                            <div class="social">
                                <a href=""><i class="bi bi-twitter"></i></a>
                                <a href=""><i class="bi bi-facebook"></i></a>
                                <a href=""><i class="bi bi-instagram"></i></a>
                                <a href=""><i class="bi bi-linkedin"></i></a>
                            </div>
                        </div>
                        <div class="member-info">
                            <h4><?= $medico['nome_medico'] ?></h4>
                            <span><?= $medico['area_atuacao'] ?></span>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>

        </div>

    </div>
</section>