<?php $render('header_out_home'); ?>
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Fazer Login</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?= $base ?>/signin" method="POST">
                    <div class="row">
                        <div class="form-group">
                            <label for="login">Email ou Login</label>
                            <input type="text" name="login" class="form-control" id="loginForm" placeholder="Digite seu E-mail ou Login" required>
                        </div>
                    </div>
                    <br />
                    <div class="row">
                        <div class="form-group">
                            <label for="senha">Senha</label>
                            <input type="password" class="form-control" name="senha" id="senhaForm" placeholder="Sua senha" required>
                        </div>
                    </div>
            </div>
            <p class="text-center">Não é cadastrado? <a href="<?= $base ?>/signup">Cadastre-se</a></p>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-danger">Logar</button>
            </div>
            </form>
        </div>
    </div>
</div>
<main id="main">
    <!-- ======= Breadcrumbs ======= -->
    <section class="breadcrumbs">
        <div class="container">

            <ol>
                <li><a href="<?= $base ?>">Home</a></li>
                <li>Signup</li>
            </ol>
            <h2>Formulário de cadastro</h2>

        </div>
    </section><!-- End Breadcrumbs -->

    <section class="inner-page">
        <div class="container" data-aos="fade-up">
            <section class="contact">
                <div class="container" data-aos="fade-up">
                    <div class="row justify-content-center" data-aos="fade-up" data-aos-delay="100">
                        <div class="col-lg-6">
                            <div class="reply-form">
                                <h4>Olá!</h4>
                                <p>Vamos nos conhecer melhor? </p>
                                <form action="<?= $base ?>/signup" method="POST">
                                    <div class="row">
                                        <div class="col form-group">
                                            <input type="text" name="nome" class="form-control" id="name" placeholder="Diga-nos seu nome" required>
                                        </div>
                                        <div class="col form-group">
                                            <input type="email" class="form-control" name="email" id="email" placeholder="Agora o seu Email" required>
                                        </div>
                                    </div>
                                    <br />
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="rg" id="rg" placeholder="Precisamos do seu RG" required>
                                    </div>
                                    <br />
                                    <label for="sexo">
                                        Seu Sexo?
                                    </label>
                                    <br />
                                    <br />
                                    <select id="sexo" class="form-select" aria-label="Seu Sexo?" name="sexo">
                                        <option value="m">Masculino</option>
                                        <option value="f">Feminino</option>
                                    </select>
                                    <br />
                                    <div class="form-group">
                                        <label>
                                            Quando você nasceu?
                                        </label>
                                        <br />
                                        <br />
                                        <input type="date" class="form-control" name="data_nascimento" id="data_nascimento" placeholder="Quando você nasceu?" required>
                                    </div>
                                    <br />
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="telefone" id="telefone" placeholder="Coloque um número para contato." required>
                                    </div>
                                    <br />
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="endereco" id="endereco" placeholder="Diz aí o seu endereço" required>
                                    </div>
                                    <br />
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="cep" id="cep" placeholder="Você sabe o cep?">
                                    </div>
                                    <br />
                                    <div class="row">
                                        <div class="col form-group">
                                            <input type="text" name="cidade" class="form-control" id="cidade" placeholder="Em que cidade fica este endereço?" required>
                                        </div>
                                        <div class="col form-group">
                                            <input type="text" class="form-control" name="estado" id="estado" placeholder="De qual estado é?" required>
                                        </div>
                                    </div>
                                    <br />
                                    <h5>Agora precisamos que você crie algumas informações referente ao seu login</h5>
                                    <br />
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="login" id="login" placeholder="Cria aí um nome para login bem legal!" required>
                                    </div>
                                    <br />
                                    <div class="form-group">
                                        <input type="password" class="form-control" name="senha" id="senha" placeholder="E agora uma senha bem forte." required>
                                    </div>
                                    <br />
                                    <div class="form-group">
                                        <input type="password" class="form-control" name="senha_confirm" id="senha_confirm" placeholder="Digita novamente a senha só pra ter certeza" required>
                                    </div>
                                    <br />
                                    <button type="submit" class="btn btn-danger align-center">Finalizar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </section>

</main><!-- End #main -->

<?php $render('footer'); ?>
<?php $render('scripts'); ?>