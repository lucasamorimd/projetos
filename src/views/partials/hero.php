<section id="hero" class="d-flex align-items-center">

    <div class="container" data-aos="zoom-out" data-aos-delay="100">
        <div class="row">
            <div class="col-xl-6">
                <h1><?= $usuario->nome ?></h1>
                <h2>Seja bem-<?= ($usuario->sexo) === 'm' ? 'vindo' : 'vinda' ?> a sua área de paciente!</h2>
            </div>
        </div>
    </div>

</section><!-- End Hero -->