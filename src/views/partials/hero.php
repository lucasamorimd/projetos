<section id="hero" class="d-flex align-items-center">

    <div class="container" data-aos="zoom-out" data-aos-delay="100">
        <div class="row">
            <div class="col-xl-6">
                <h1><?= $usuario->nome ?></h1>
                <h2>Seja bem-<?= ($usuario->sexo  === 'm') ? 'vindo' : 'vinda' ?> a sua área de paciente!</h2>
                <?php if ($usuario->status == 0) : ?>
                    <h2>Clique aqui para enviar um link de confirmação de conta para o email cadastrado</h2> <a href="<?= $base ?>/usuarios/send-confirmation/<?= md5($usuario->id_usuario) ?>" class="btn-get-started scrollto">Enviar</a>
                <?php endif; ?>
            </div>
        </div>
    </div>

</section><!-- End Hero -->